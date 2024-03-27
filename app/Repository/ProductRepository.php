<?php

namespace App\Repository;

use App\Interfaces\ProductInterface;
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
                ->editColumn('user_id', function ($products) {
                    return $products->user->name;
                })
                ->editColumn('images', function ($products) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $products->image) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/products/index');
        }
    }

    public function changeStatusProduct($request)
    {

    }

    public function delete($request)
    {
        $product = Product::findOrFail($request->id);

        $product->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}