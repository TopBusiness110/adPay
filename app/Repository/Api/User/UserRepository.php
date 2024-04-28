<?php

namespace App\Repository\Api\User;


use App\Http\Resources\AuctionResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VendorResource;
use App\Interfaces\Api\User\UserRepositoryInterface;
use App\Models\Ad;
use App\Models\Address;
use App\Models\AppUser;
use App\Models\Auction;
use App\Models\AuctionComment;
use App\Models\Cart;
use App\Models\contactUs;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\Slider;
use App\Models\VendorRate;
use App\Repository\Api\ResponseApi;
use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository extends ResponseApi implements UserRepositoryInterface
{
    use PhotoTrait, FirebaseNotification;

    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'nullable|image',
                'phone' => 'required|numeric|unique:app_users,phone',
                'password' => 'required',
                'device_token' => 'required',
            ]);

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            $newUser = new AppUser();
            if ($request->has('image')) {
                $newUser->image = self::uploadImage($request->image);
            }
            $newUser->name = $request->name;
            $newUser->phone = $request->phone;
            $newUser->password = Hash::make($request->password);
            $newUser->type = 'user';
            $newUser->device_token = $request->device_token;

            if ($newUser->save()) {

                $credentials = ['phone' => $request->phone, 'password' => $request->password];
                $token = Auth::guard('user-api')->attempt($credentials);
                $newUser['token'] = $token;

                return self::returnDataSuccess(new UserResource($newUser), 'User Register Success');
            } else {
                return self::returnDataFail(null, 'something error', 422);
            }
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // end register

    public function login(Request $request): JsonResponse
    {
        try {
            // Validation Rules
            $validatorLogin = Validator::make($request->all(), [
                'phone' => 'required',
                'device_token' => 'required',
                'password' => 'required'
            ]);

            if ($validatorLogin->fails()) {
                $errors = $validatorLogin->errors()->first();
                return self::returnDataFail(null, $errors, 422);

            } else {
                $check_exists = AppUser::query()
                    ->where('phone', '=', $request->phone)
                    ->first();

                if ($check_exists) {
                    // Authenticate User
                    $credentials = ['phone' => $request->phone, 'password' => $request->password];
                    $token = Auth::guard('user-api')->attempt($credentials);
                    if (!$token) {
                        return self::returnDataFail(null, 'phone or password is not correct !', 200);
                    }
                    // Get User and Attach Token
                    $user = Auth::guard('user-api')->user();
                    $user['token'] = $token;

                    AppUser::find($user->id)->update(['session' => session()->getId()]);

                    return self::returnDataSuccess(new UserResource($user), 'login success');
                }
                return self::returnDataFail(null, 'user not exists', 200);
            }
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }// end login

    public function logout(): JsonResponse
    {
        try {
            Auth::guard('user-api')->logout(); // Logout the user
            return self::returnDataSuccess(null, "successfully logged out");
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // logout

    public function deleteAccount(): JsonResponse
    {
        try {
            $user = AppUser::find(Auth::guard('user-api')->user()->id);
            $user->delete();
            Auth::guard('user-api')->logout();

            return self::returnDataSuccess(null, "Account deleted successfully and logout");
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // deleteAccount

    public function checkUser(Request $request): JsonResponse
    {
        try {
            // Validation Rules
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            } else {
                $check_exists = AppUser::query()
                    ->where('phone', $request->phone)
                    ->first();
                if ($check_exists) {
                    if ($check_exists->type == 'vendor') {
                        return self::returnDataSuccess(new VendorResource($check_exists), 'user is exists');
                    } else {
                        return self::returnDataSuccess(new UserResource($check_exists), 'user is exists');
                    }
                } else {
                    return self::returnDataFail(null, 'user doesnt exists', 422);
                }
            }

        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end checkUser

    public function resetPassword(Request $request): JsonResponse
    {
        try {
            // Validation Rules
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed',
                'phone' => 'required'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            } else {
                $check_exists = AppUser::query()
                    ->where('phone', $request->phone)
                    ->first();
                if ($check_exists) {
                    $check_exists->password = \Hash::make($request->password);
                    $check_exists->save();
                    if ($check_exists->type == 'vendor') {
                        return self::returnDataSuccess(null, 'password updated successfully');
                    } else {
                        return self::returnDataSuccess(null, 'password updated successfully');
                    }
                } else {
                    return self::returnDataFail(null, 'user doesnt exists', 422);
                }
            }
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end resetPassword


    public function getHome(): JsonResponse
    {
        try {
            $user = AppUser::find(Auth::guard('user-api')->user()->id);
            $sliders = Slider::query()
                ->select('id', 'image', 'url')
                ->where('status', '=', 1)->latest()->get();
            $categories = ShopCategory::query()
                ->select('id', 'title_ar', 'title_en')
                ->where('status', '=', 1)->latest()->get();
            $ads = Ad::query()
                ->where('status', '=', 1)
                ->where('complete', '=', 0)
                ->latest()->get();
            $product_most_sell_ids = OrderDetail::query()->groupBy('product_id')->pluck('product_id')->toArray();
            $product_most_sell = Product::query()
                ->whereIn('id', $product_most_sell_ids)->latest()->get();
            $shops = Shop::query()->latest()->get();

            $auctions = Auction::query()->latest()->get();

            $products = Product::query()->latest()->get();

            $data = [
                'sliders' => $sliders,
                'categories' => $categories,
                'ads' => $ads,
                'product_most_sell' => $product_most_sell,
                'shops' => $shops,
                'auctions' => $auctions,
                'products' => $products,
                'user' => $user
            ];

            return self::returnDataSuccess($data, 'get home success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getHome

    public function getCategories(): JsonResponse
    {
        try {
            $categories = ShopCategory::query()->get();
            return self::returnDataSuccess($categories, 'get categories success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getCategories

    public function myAddresses(): JsonResponse
    {
        try {
            $addresses = Address::query()->where('user_id', Auth::guard('user-api')->user()->id)->get();
            return self::returnDataSuccess($addresses, 'get addresses success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end myAddresses

    public function addAddress(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'address_id' => 'required',
                'city' => 'required',
                'region' => 'required',
                'details' => 'nullable',
                'default' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            }

            // if default is true update all default to false
            if ($request->default == 1) {
                Address::query()->where('user_id', Auth::guard('user-api')->user()->id)->update([
                    'default' => 0
                ]);
            }

            $address = new Address();
            $address->user_id = Auth::guard('user-api')->user()->id;
            $address->region = $request->region;
            $address->city = $request->city;
            $address->details = $request->details;
            $address->default = $request->default;
            $address->save();
            return self::returnDataSuccess($address, 'add address success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end addAddress

    public function updateAddress(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'address_id' => 'required',
                'city' => 'required',
                'region' => 'required',
                'details' => 'nullable',
                'default' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return self::returnDataFail(null, $errors, 422);
            }

            $address = Address::query()->find($request->address_id);

            if ($address) {
                // if default is true update all default to false
                if ($request->default == 1) {
                    Address::query()->where('user_id', Auth::guard('user-api')->user()->id)->update([
                        'default' => 0
                    ]);
                }
                $address->region = $request->region;
                $address->city = $request->city;
                $address->details = $request->details;
                $address->default = $request->default;
                $address->save();
                return self::returnDataSuccess($address, 'update address success');
            } else {
                return self::returnDataFail(null, 'address not found', 422);
            }
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        } // end try
    } // end updateAddress

    public function deleteAddress($id): JsonResponse
    {
        try {
            $address = Address::query()->whereId($id)->where('user_id', Auth::guard('user-api')->user()->id)->first();
            if ($address) {
                $address->delete();
                return self::returnDataSuccess(null, 'delete address success');
            } else {
                return self::returnDataFail(null, 'address not found', 422);
            }
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // delete address

    public function getRegions(): JsonResponse
    {
        try {
            // Read the JSON file
            $regions_json = file_get_contents(public_path('locations/city.json'));

            // Decode the JSON data
            $regions_data = json_decode($regions_json, true);

            // Check if decoding was successful
            if ($regions_data === null) {
                // Handle JSON decoding error
                return response()->json(['error' => 'Failed to decode JSON data'], 500);
            }

            // Return the regions data
            return self::returnDataSuccess($regions_data, 'get regions success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getRegions

    public function getCityByRegion(Request $request): JsonResponse
    {
        try {
            // Validate the region ID
            $request->validate([
                'region_id' => 'required|integer',
            ]);

            // Read the JSON file containing cities data
            $cities_json = file_get_contents(public_path('locations/area.json'));

            // Decode the JSON data
            $cities_data = json_decode($cities_json, true);

            // Check if decoding was successful
            if ($cities_data === null) {
                // Handle JSON decoding error
                return response()->json(['error' => 'Failed to decode JSON data'], 500);
            }

            // Extract cities for the specified region ID
            $region_id = $request->input('region_id');
            $region_cities = [];

            foreach ($cities_data as $city) {
                if ($city['region_id'] == $region_id) {
                    $region_cities[] = $city;
                }
            }

            // Return the cities data for the specified region
            return self::returnDataSuccess($region_cities, 'get cities success');

        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getCityByRegion

    public function getProducts(Request $request): JsonResponse
    {
        try {
            $products = Product::query()
                ->when($request->cat_id, function ($query) use ($request) {
                    $query->where('shop_cat_id', $request->cat_id);
                })->get();
            return self::returnDataSuccess(ProductResource::collection($products), 'get products success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getProducts

    public function getAuctions(Request $request): JsonResponse
    {
        try {
            $auctions = Auction::query()
                ->when($request->cat_id, function ($query) use ($request) {
                    $query->where('cat_id', $request->cat_id);
                })->get();
            return self::returnDataSuccess(AuctionResource::collection($auctions), 'get auctions success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getAuctions

    public function getShops(Request $request): JsonResponse
    {
        try {
            $shops = AppUser::query()
                ->where('type', 'vendor')
                ->whereHas('shop')
                ->when($request->cat_id, function ($query) use ($request) {
                    $query->whereHas('shop', function ($query) use ($request) {
                        $query->where('shop_cat_id', $request->cat_id);
                    });
                })->get();
            return self::returnDataSuccess(VendorResource::collection($shops), 'get Vendor Shops success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getShop

    public function getAds(Request $request): JsonResponse
    {
        try {
            $ads = Ad::query()->where('complete', '=', 0)
                ->where('status', '=', 1)
                ->get();
            return self::returnDataSuccess($ads, 'get ads success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getAds

    public function productDetails($id): JsonResponse
    {
        try {
            $product = Product::query()->find($id);
            if ($product)
                return self::returnDataSuccess(new ProductResource($product), 'get product details success');
            else
                return self::returnDataFail(null, 'product not found', 404);
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end productDetails

    public function addToCart(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'qty' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }
            $cart = Cart::query()->where('user_id', \auth('user-api')->user()->id)
                ->where('product_id', $request->product_id)
                ->first();
            $product = Product::query()->find($request->product_id);
            if ($cart) {
                $cart->update([
                    'qty' => $cart->qty + $request->qty,
                    'total' => $cart->total + ($product->price * $request->qty)
                ]);
            } else {
                $cart = Cart::query()->create([
                    'user_id' => \auth('user-api')->user()->id,
                    'vendor_id' => $product->vendor_id,
                    'product_id' => $request->product_id,
                    'qty' => $request->qty,
                    'total' => $request->qty * $product->price
                ]);
            }
            return self::returnDataSuccess($cart, 'add to cart success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end addToCart

    public function getCart(): JsonResponse
    {
        try {
            $carts = Cart::query()->where('user_id', \auth('user-api')->user()->id)->get();

            $groupedCarts = $carts->groupBy('vendor_id');
            $vendorCarts = new Collection();

            foreach ($groupedCarts as $vendorId => $carts) {
                $vendorCarts->push([
                    'vendor' => new VendorResource(AppUser::whereId($vendorId)->first()),
                    'carts' => $carts->toArray()
                ]);
            }

            return self::returnDataSuccess($vendorCarts, 'get cart success');
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end getCart

    public function auctionDetails($id): JsonResponse
    {
        try {
            $auction = Auction::query()->find($id);
            if ($auction)
                return self::returnDataSuccess(new AuctionResource($auction), 'get auction details success');
            else
                return self::returnDataFail(null, 'auction not found', 404);
        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end auctionDetails


    public function storeComment($request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'auction_id' => 'required|exists:auctions,id',
                'comment' => 'required|string',
                'type' => 'required|in:comment,reply',
                'comment_id' => 'required_if:type,reply|exists:auction_comments,id',
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }

            $comment = new AuctionComment();
            $comment->user_id = Auth::guard('user-api')->user()->id;
            $comment->auction_id = $request->auction_id;
            $comment->type = $request->type;
            $comment->comment = $request->comment;
            $comment->comment_id = $request->comment_id ?? null;
            $comment->save();


            return self::returnDataSuccess($comment, ' comment store success');


        } catch (Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end storeComment

    public function myOrders($request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:new,pending,complete,cancelled',
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }


            $orders = Order::query()
                ->where('type', $request->type)
                ->where('user_id', \auth('user-api')->user()->id)->with('details')
                ->latest()->get();

            return self::returnDataSuccess($orders, 'get my orders success');

        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    } // end myOrders

    public function rateVendor($request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'rate' => 'required|in:1,2,3,4,5',
                'vendor_id' => 'required|exists:app_users,id',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }

            $checkRate = VendorRate::whereUserId(\auth('user-api')->user()->id)->whereVendorId($request->vendor_id)->first();
            if ($checkRate) {
                return self::returnDataFail($checkRate, 'You have already rated this vendor', 201);
            }
            $rate = new VendorRate();
            $rate->user_id = \auth('user-api')->user()->id;
            $rate->vendor_id = $request->vendor_id;
            $rate->rate = $request->rate;
            $rate->description = $request->description;

            if ($rate->save()) {
                return self::returnDataSuccess($rate, 'Vendor rated successfully');
            } else {
                return self::returnDataFail(null, 'Something went wrong', 500);
            }
        } catch (\Exception $exception) {
            return self::returnDataFail(null, $exception->getMessage(), 500);
        }
    }// end rateVendor

    public function vendorProfile($request): JsonResponse
    {
        try {
            $vendor = AppUser::whereId($request->id)
                ->with('products', function ($query) use ($request) {
                    $query->when($request->key, function ($query) use ($request) {
                        $query->where('shop_sub_cat', $request->key);
                    });
                })
                ->first();
            $data = [
                'vendor' => new VendorResource($vendor),
                'products' => ProductResource::collection($vendor->products),
            ];
            return self::returnDataSuccess($data, 'Vendor Retrieved Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // end vendorProfile

    public function storeAuction($request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'images' => 'required|image',
                'title_ar' => 'required',
                'description_ar' => 'required|string',
                'user_id' => 'required|exists:app_users,id',
                'price' => 'required|numeric',
                'cat_id' => 'required|exists:auction_categories,id',
                'sub_cat_id' => 'required|exists:auction_sub_categories,id',
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }
            if ($request->hasFile('images')) {

                $imagePath = $request->file('images')->store('uploads/auction', 'public');

            } else {
                $imagePath = [];
            }

            $auction = new Auction();
            $auction->images = $imagePath;
            $auction->title_ar = $request->title_ar;
            $auction->description_ar = $request->description_ar ?? null;
            $auction->user_id = $request->user_id;
            $auction->price = $request->price;
            $auction->cat_id = $request->cat_id;
            $auction->sub_cat_id = $request->sub_cat_id;
            $auction->save();
            return self::returnDataSuccess($auction, 'Auction Created Successfully');
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // end storeAuction

    public function sendContactUs(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make(request()->all(), [
                'subject' => 'required',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return self::returnDataFail(null, $validator->errors()->first(), 422);
            }

            // new contact us message
            $contactUs = new ContactUs();
            $contactUs->subject = $request->subject;
            $contactUs->message = $request->message;
            $contactUs->user_id = Auth::guard('user-api')->user()->id;
            if ($contactUs->save()) {
            return self::returnDataSuccess($contactUs, 'Message Sent Successfully !');
            }else{
                return self::returnDataFail(null, 'Something went wrong', 500);
            }
        } catch (Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    } // end sendContactUs


} // eldapour
###############|> Made By https://github.com/eldapour (eldapour) 🚀
