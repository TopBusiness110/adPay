<?php

namespace App\Repository;

use App\Interfaces\ShopCategoryInterface;
use App\Models\ShopCategory;
use Yajra\DataTables\DataTables;

class ShopCategoryRepository implements ShopCategoryInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $shop_categories = ShopCategory::get();
            return DataTables::of($shop_categories)
                ->addColumn('action', function ($shop_categories) {
                    return '
                            <a href="' . route('shop_category.edit', $shop_categories->id) . '" class="btn btn-pill btn-info-light"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $shop_categories->id . '" data-title="' . $shop_categories->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/shop_categories/index');
        }
    }

    public function showCreate()
    {
        return view('admin/shop_categories/parts/create');
    }

    public function store($request)
    {
        try {
            $inputs = $request->all();

            if ($this->create($inputs)) {
                toastr()->addSuccess('تم اضافة فئة المتجر بنجاح');
                return redirect()->back();
            } else {
                toastr()->addError('هناك خطأ ما');
            }
        } catch (\Exception $e) {
            toastr()->addError('حدث خطأ: ' . $e->getMessage());
        }
    }

    private function create($inputs)
    {
        return ShopCategory::create($inputs);
    }

    public function showEdit($id)
    {
        $shopCategory = ShopCategory::findOrFail($id);

        return view('admin/shop_categories/parts/edit', compact('shopCategory'));
    }

    public function update($request, $id)
    {
        try {
            $shop_category = ShopCategory::findOrFail($id);

            $inputs = $request->except('id');

            $shop_category->update($inputs);

            toastr()->addSuccess('تم التعديل فئة المتجر بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->addError('هناك خطأ: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function delete($request)
    {
        $shop_category = shopCategory::findOrFail($request->id);

        $shop_category->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}