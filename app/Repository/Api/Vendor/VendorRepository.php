<?php

namespace App\Repository\Api\Vendor;

use App\Http\Resources\AdResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RoomResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VendorResource;
use App\Interfaces\Api\Vendor\VendorRepositoryInterface;
use App\Models\Ad;
use App\Models\AdPackage;
use App\Models\AppUser;
use App\Models\Chat;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Room;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\Slider;
use App\Models\Wallet;
use App\Models\Withdraw;
use App\Repository\Api\ResponseApi;
use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Carbon\Carbon;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function getShopCategories(): JsonResponse
    {
        try {
            $shopCategories = ShopCategory::select('id', 'title_ar', 'title_en', 'status')->latest()->get();
            return self::returnDataSuccess($shopCategories, 'Get Shop Categories Successfully');

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // getShopCategories()

    public function getShopSubCategories(): JsonResponse
    {
        try {
            $vendor = AppUser::find(auth('user-api')->user()->id);

            $shopSubCategories = Shop::whereVendorId($vendor->id)->first()->shop_sub_cat;

            return self::returnDataSuccess($shopSubCategories, 'Get Shop Sub Categories Successfully');

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // getShopSubCategories()

    public function addProduct(Request $request): JsonResponse
    {
        try {
            $vendor = AppUser::find(auth('user-api')->user()->id);

            $validator = Validator::make($request->all(), [
                'images' => 'required',
                'title_ar' => 'required',
                'title_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
                'price' => 'required',
                'discount' => 'nullable',
                'type' => 'required',
                'shop_sub_cat' => 'required',
                'stock' => 'required',
                'props' => 'nullable',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }
            $uploadedImage = [];
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $uploadedImage[] = self::uploadImage($image, 'products');
                }
            }

            $newProduct = new Product();
            $newProduct->vendor_id = $vendor->id;
            $newProduct->images = $uploadedImage;
            $newProduct->title_ar = $request->title_ar;
            $newProduct->title_en = $request->title_en;
            $newProduct->description_ar = $request->description_ar;
            $newProduct->description_en = $request->description_en;
            $newProduct->price = $request->price;
            $newProduct->discount = $request->discount;
            $newProduct->type = $request->type;
            $newProduct->shop_cat_id = $vendor->shop->shop_cat_id;
            $newProduct->shop_sub_cat = $request->shop_sub_cat;
            $newProduct->stock = $request->stock;
            $newProduct->props = $request->props;
            $newProduct->save();

            return self::returnDataSuccess(new ProductResource($newProduct), 'Product Added Successfully');

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // addProduct()

    public function productDetails($id): JsonResponse
    {
        try {
            $product = Product::query()->find($id);
            if ($product) {
                return self::returnDataSuccess(new ProductResource($product), 'Get Product Details Successfully');
            } else {
                return self::returnDataFail(null, 'Product Not Found', 422);
            }
        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    }

    public function updateProduct(Request $request): JsonResponse
    {
        try {

            $product = Product::find($request->product_id);
            if (!$product) {
                return self::returnDataFail(null, 'Product Not Found', 422);
            }

            $vendor = AppUser::find(auth('user-api')->user()->id);

            $validator = Validator::make($request->all(), [
                'images' => 'required',
                'title_ar' => 'required',
                'title_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
                'price' => 'required',
                'discount' => 'nullable',
                'type' => 'required',
                'shop_sub_cat' => 'required',
                'stock' => 'required',
                'props' => 'nullable',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $uploadedImage[] = self::uploadImage($image, 'products');
                }
                $product->images = $uploadedImage;
            }

            $product->title_ar = $request->title_ar;
            $product->title_en = $request->title_en;
            $product->description_ar = $request->description_ar;
            $product->description_en = $request->description_en;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->type = $request->type;
            $product->shop_cat_id = $vendor->shop->shop_cat_id;
            $product->shop_sub_cat = $request->shop_sub_cat;
            $product->stock = $request->stock;
            $product->props = $request->props;
            $product->save();

            return self::returnDataSuccess(new ProductResource($product), 'Product Updated Successfully');

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // updateProduct()

    public function deleteProduct(Request $request): JsonResponse
    {
        try {
            $product = Product::find($request->product_id);

            if (!$product) {
                return self::returnDataFail(null, 'Product not found', 422);
            }

            $images = $product->images;
            foreach ($images as $image) {
                $relativePath = str_replace('/storage', 'public', $image);
                \Storage::delete($relativePath);
            }

            $product->delete();

            return self::returnDataSuccess(null, 'Product Deleted Successfully');
        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // deleteProduct()

    public function addAdvertise(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'image' => 'required',
                'title_ar' => 'required',
                'title_en' => 'required',
                'description_ar' => 'required',
                'description_en' => 'required',
                'count_views' => 'required',
                'package_id' => 'required',
                'video' => 'nullable',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $image = null;
            $video = null;
            if ($request->has('image')) {
                $image = self::uploadImage($request->image, 'ads-images');
            }
            if ($request->has('video')) {
                $video = self::uploadImage($request->video, 'ads-videos');
            }

            $newAd = new Ad();
            $newAd->image = $image;
            $newAd->title_ar = $request->title_ar;
            $newAd->title_en = $request->title_en;
            $newAd->description_ar = $request->description_ar;
            $newAd->description_en = $request->description_en;
            $newAd->user_id = auth('user-api')->user()->id;
            $newAd->status = 0;
            $newAd->count_views = $request->count_views;
            $newAd->package_id = $request->package_id;
            $newAd->views = 0;
            $newAd->complete = 0;
            $newAd->video = $video;
            $newAd->payment_status = 0;
            if ($newAd->save()) {
                return self::returnDataSuccess(new AdResource($newAd), 'Advertise Added Successfully');
            } else {
                return self::returnDataFail(null, 'Something went wrong', 500);
            }

        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // addAdvertise()

    public function myAdvertise(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:new,pending,complete',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $type = $request->type;

            if ($type == 'new') {
                $ads = Ad::query()->where('user_id', auth('user-api')->user()->id)
                    ->where('status', 0)
                    ->latest()->get();
            } elseif ($type == 'pending') {
                $ads = Ad::query()->where('user_id', auth('user-api')->user()->id)
                    ->where('status', 1)
                    ->latest()->get();
            } elseif ($type == 'complete') {
                $ads = Ad::query()->where('user_id', auth('user-api')->user()->id)
                    ->where('complete', 1)
                    ->latest()->get();
            }

            return self::returnDataSuccess(AdResource::collection($ads), 'Ads Retrieved Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // myAdvertise()

    public function getAdPackages(): JsonResponse
    {
        try {
            $packages = AdPackage::query()->select('id', 'count', 'price')->orderBy('count')->get();
            return self::returnDataSuccess($packages, 'Packages Retrieved Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // getAdPackages()

    public function getNotifications(): JsonResponse
    {
        try {
            $notifications = Notification::query()
                ->where('user_id', auth('user-api')->user()->id)
                ->latest()->get();
            return self::returnDataSuccess($notifications, 'Notifications Retrieved Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // getNotifications()

    public function getChatRoom(): JsonResponse
    {
        try {
            $chatRoom = Room::query()
                ->where('from_user_id', auth('user-api')->user()->id)
                ->Orwhere('to_user_id', auth('user-api')->user()->id)
                ->latest()->get();
            return self::returnDataSuccess(RoomResource::collection($chatRoom), 'Chat Room Retrieved Successfully');
        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // getChatRoom()

    public function getRoom($user_id): JsonResponse
    {
        try {
            $room = Room::where(function ($query) use ($user_id) {
                $query->where('to_user_id', $user_id)
                    ->orWhere('from_user_id', $user_id);
            })->where(function ($query) use ($user_id) {
                $query->where('to_user_id', \auth('user-api')->user()->id)
                    ->orWhere('from_user_id', \auth('user-api')->user()->id);
            })->with('messages')->first();

            if ($room){
                $room['from_user_id'] = new UserResource(AppUser::find($room->from_user_id));
                $room['to_user_id'] = new UserResource(AppUser::find($room->to_user_id));
                $this->updateSeen();
            }else{
                // create room
                $room = New Room();
                $room->from_user_id = \auth('user-api')->user()->id;
                $room->to_user_id = $user_id;
                $room->save();

                $room['from_user_id'] = new UserResource(AppUser::find($room->from_user_id));
                $room['to_user_id'] = new UserResource(AppUser::find($room->to_user_id));
            }

            return self::returnDataSuccess($room, 'Room Retrieved Successfully');
        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // getRoom()

    public function updateSeen(): JsonResponse
    {
        try {
            $messages = Chat::where('to_user_id', auth('user-api')->user()->id)
                ->update(['seen' => 1]);
            return self::returnDataSuccess(null, 'Messages Updated Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // updateSeen()

    public function sendMessage(Request $request, $id): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $room = Room::whereId($id)->first();
            $to_user_id = $room->from_user_id == auth('user-api')->user()->id ? $room->to_user_id : $room->from_user_id;

            $message = new Chat();
            $message->from_user_id = auth('user-api')->user()->id;
            $message->to_user_id = $to_user_id;
            $message->message = $request->message;
            $message->room_id = $id;
            $message->save();

            $data = [
                'title' => 'New Message',
                'body' => $request->message,
                'msg' => $message
            ];

            // send notification to user firebase
            self::sendFcmMsg($data, $request->to_user_id);

            $room = Room::whereId($id)->with('messages')->first();
            $room['from_user_id'] = new UserResource(AppUser::find($room->from_user_id));
            $room['to_user_id'] = new UserResource(AppUser::find($room->to_user_id));

            $this->updateSeen();
            return self::returnDataSuccess($room, 'Message Sent Successfully');

        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // sendMessage()

    public function myWallet(): JsonResponse
    {
        try {
            $vendor = AppUser::find(auth('user-api')->user()->id);
            $wallet = $vendor->wallet;
            $history = Payment::query()->where('user_id', auth('user-api')->user()->id)
                ->where('type', 'wallet')
                ->latest()->get();

            $data = [
                'balance_wallet' => $wallet->total,
                'history' => PaymentResource::collection($history),
                'vendor' => new VendorResource($vendor),
            ];
            return self::returnDataSuccess($data, 'Wallet Retrieved Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } //storeComments


} // eldapour
###############|> Made By https://github.com/eldapour (eldapour) 🚀
