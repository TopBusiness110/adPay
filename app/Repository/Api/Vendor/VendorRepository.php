<?php

namespace App\Repository\Api\Vendor;

use App\Http\Resources\UserResource;
use App\Http\Resources\VendorResource;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;
use App\Models\Ad;
use App\Models\AppUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Slider;
use App\Models\Wallet;
use App\Repository\Api\ResponseApi;
use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VendorRepository extends ResponseApi implements VendorRepositoryInterface
{
    use PhotoTrait, FirebaseNotification;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'nullable|image',
                'phone' => 'required|numeric|unique:app_users,phone',
                'password' => 'required',
                'type' => 'required|in:advertise,vendor',
                'device_token' => 'required',
                // Vendor Shop requests
                'logo' => 'nullable',
                'banner' => 'nullable',
                'title_ar' => 'nullable',
                'title_en' => 'nullable',
                'shop_cat_id' => 'nullable',
                'shop_sub_cat' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $newVendor = new AppUser();
            if ($request->has('image')) {
                $newVendor->image = self::uploadImage($request->image);
            }
            $newVendor->name = $request->name;
            $newVendor->phone = $request->phone;
            $newVendor->password = Hash::make($request->password);
            $newVendor->type = $request->type;
            $newVendor->device_token = $request->device_token;

            if ($newVendor->save()) {

                $credentials = ['phone' => $request->phone, 'password' => $request->password];
                $token = Auth::guard('user-api')->attempt($credentials);
                $newVendor['token'] = $token;


                if ($newVendor->type == 'vendor') {
                    $newVendorShop = new Shop();
                    if ($request->has('banner')) {
                        $newVendorShop->banner = self::uploadImage($request->banner);
                    }
                    if ($request->has('logo')) {
                        $newVendorShop->logo = self::uploadImage($request->logo);
                    }
                    $newVendorShop->title_ar = $request->title_ar;
                    $newVendorShop->title_en = $request->title_en;
                    $newVendorShop->shop_cat_id = $request->shop_cat_id;
                    $newVendorShop->shop_sub_cat = $request->shop_sub_cat;
                    $newVendorShop->vendor_id = $newVendor->id;

                    if ($newVendorShop->save()) {
                        return self::returnDataSuccess(new VendorResource($newVendor), 'Vendor Shop Register Success', 200);
                    } else {
                        return self::returnDataFail(null, 'something error', 422);
                    }
                }

                return self::returnDataSuccess(new UserResource($newVendor), 'Vendor Register Success', 200);
            } else {
                return self::returnDataFail(null, 'something error', 422);
            }
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // end register()

    /**
     * @return JsonResponse
     */
    public function vendorHome(): JsonResponse
    {
        try {
            $vendor = AppUser::find(auth('user-api')->user()->id);
            $sliders = Slider::query()
                ->select('id', 'status', 'image', 'url')
                ->where('status', '=', 1)
                ->latest()->get();
            $wallet_total = Wallet::where('vendor_id', $vendor->id)->firstOrFail()->valueOrFail('total');
            $orders_count = Order::where('vendor_id', $vendor->id)->count();
            $products_count = Product::query()->where('vendor_id', '=', $vendor->id)->count();
            $ads_count = Ad::query()->where('user_id', '=', $vendor->id)->count();

            $orders_incomplete = Order::query()->where('vendor_id', '=', $vendor->id)
                ->whereNotIn('type', ['complete', 'cancelled'])
                ->count();
            $orders_complete = Order::query()->where('vendor_id', '=', $vendor->id)
                ->whereIn('type', ['new', 'pending'])
                ->count();
            $ads_incomplete = Ad::query()->where('user_id', '=', $vendor->id)
                ->where('complete', '=', 0)->count();

            $ads_complete = Ad::query()->where('user_id', '=', $vendor->id)
                ->where('complete', '=', 1)->count();

            $data = [
                'sliders' => $sliders,
                'wallet_total' => $wallet_total,
                'orders_count' => $orders_count,
                'products_count' => $products_count,
                'ads_count' => $ads_count,
                'orders_incomplete' => $orders_incomplete,
                'orders_complete' => $orders_complete,
                'ads_incomplete' => $ads_incomplete,
                'ads_complete' => $ads_complete,
                'vendor' => new VendorResource($vendor)
            ];
            return self::returnDataSuccess($data, 'Get Home Page Data Successfully');

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // vendorHome()

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function orders(Request $request): JsonResponse
    {
        try {

            $validator = Validator::make($request->all(), [
                'type' => 'nullable|in:new,pending,complete,cancelled',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $type = $request->type;
            $vendor = AppUser::find(auth('user-api')->user()->id);
            $orders = Order::where('vendor_id', $vendor->id)->when($type, function (Builder $query) use ($type) {
                $query->where('type', $type);
            })->get();

            if ($orders->count() > 0) {
                return self::returnDataSuccess($orders, 'Get Orders Successfully');
            } else {
                return self::returnDataFail(null, 'No Orders Yet', 200);
            }


        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // orders()

    public function orderDetails($id): JsonResponse
    {
        try {

            $order = Order::whereId($id)->with('details')->get();

            if ($order->count() > 0) {
                return self::returnDataSuccess($order, 'Get Order Successfully');
            } else {
                return self::returnDataFail(null, 'No Order find with this id', 200);
            }

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // orderDetails()

    public function myProducts(Request $request): JsonResponse
    {
        try {

            $validator = Validator::make($request->all(), [
                'type' => 'required|in:new,used',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $products = Product::where('vendor_id', auth('user-api')->user()->id)
                ->where('type', $request->type)->when($request->category_id, function (Builder $query) use ($request) {
                    $query->where('shop_cat_id', $request->category_id);
                })->get();

            if ($products->count() > 0) {
                return self::returnDataSuccess($products, 'Get Products Successfully');
            } else {
                return self::returnDataFail(null, 'No Products found', 200);
            }

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // myProducts()

    public function changOrderStatus(Request $request): JsonResponse
    {
        try {

            $validator = Validator::make($request->all(), [
                'type' => 'required|in:new,pending,complete,cancelled',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $order = Order::find($request->id);

            if ($order) {
                if ($order->type == 'complete') {
                    return self::returnDataSuccess($order, 'Order can`t be change it already complete');
                } else {
                    $order->update([
                        'type' => $request->type
                    ]);
                    return self::returnDataSuccess($order, 'Order status update Successfully');
                }
            } else {
                return self::returnDataFail(null, 'No Order find with this id', 200);
            }
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // changOrderStatus()
} // eldapour
###############|> Made By https://github.com/eldapour (eldapour) 🚀
