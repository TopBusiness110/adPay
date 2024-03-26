<?php

namespace App\Repository;

use App\Interfaces\AuctionSubCategoryInterface;
use App\Models\AuctionCategory;
use App\Models\AuctionSubCategory;
use Yajra\DataTables\DataTables;

class AuctionSubCategoryRepository implements AuctionSubCategoryInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $auction_sub_categories = AuctionSubCategory::get();
            return DataTables::of($auction_sub_categories)
                ->addColumn('action', function ($auction_sub_categories) {
                    return '
                            <a href="' . route('auctionSubCategory.edit', $auction_sub_categories->id) . '" class="btn btn-pill btn-info-light"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $auction_sub_categories->id . '" data-title="' . $auction_sub_categories->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->editColumn('cat_id', function ($auction_sub_categories) {
                    return $auction_sub_categories->auctionCategory->title_ar;
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/auction_sub_categories/index');
        }
    }

    public function showCreate()
    {
        $auctionCategories = AuctionCategory::query()->select('id', 'title_ar')->get();
        return view('admin/auction_sub_categories/parts/create', compact('auctionCategories'));
    }

    public function store($request)
    {
        try {
            $inputs = $request->all();

            if ($this->create($inputs)) {
                toastr()->addSuccess('تم اضافة فئة الفرعية الحراج بنجاح');
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
        return AuctionSubCategory::create($inputs);
    }

    public function showEdit($id)
    {
        $auctionCategories = AuctionCategory::query()->select('id', 'title_ar')->get();
        $auctionSubCategory = AuctionSubCategory::findOrFail($id);

        return view('admin/auction_sub_categories/parts/edit', compact('auctionSubCategory', 'auctionCategories'));
    }

    public function update($request, $id)
    {
        try {
            $auction_sub_category = AuctionSubCategory::findOrFail($id);

            $inputs = $request->except('id');

            $auction_sub_category->update($inputs);

            toastr()->addSuccess('تم التعديل فئة الحراج الفرعية بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->addError('هناك خطأ: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function delete($request)
    {
        $auction_sub_category = AuctionSubCategory::findOrFail($request->id);

        $auction_sub_category->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}