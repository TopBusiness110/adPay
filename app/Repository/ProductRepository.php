<?php

namespace App\Repository;

use App\Interfaces\ProductInterface;
use App\Models\AppUser;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductRepository implements ProductInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $products = Product::get();
            return DataTables::of($products)
                ->addColumn('action', function ($products) {
                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $products->id . '" data-title="' . $products->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';

                })
                ->editColumn('vendor_id', function ($products) {
                    return $products->vendor->name ?? '';
                })
                ->editColumn('shop_cat_id', function ($products) {
                    return $products->shopCategory->title_ar ?? '';
                })
                ->editColumn('type', function ($products) {
                    if ($products->type == 'new') {
                        return 'جديد' ?? '';
                    } else if ($products->type == 'used') {
                        return 'مستخدمة' ?? '';
                    }
                })
                ->editColumn('status', function ($product) {
                    return '<input class="tgl tgl-ios statusBtn1" data-id="'. $product->id .'" name="statusBtn1" id="statusProduct-' . $product->id . '" type="checkbox" '. ($product->status == 1 ? 'checked' : 'unchecked') .'/>
                    <label class="tgl-btn" dir="ltr" for="statusProduct-' . $product->id . '"></label>';

                })
                ->editColumn('images', function ($products) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $products->image) . '">
                    ' ?? '';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/products/index');
        }
    }

    public function changeProductsStatus($request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
    }

    public function delete($request)
    {
        $product = Product::findOrFail($request->id);

        $product->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
