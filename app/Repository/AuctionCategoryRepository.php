<?php 

namespace App\Repository;

use App\Interfaces\AuctionCategoryInterface;
use App\Models\AuctionCategory;
use Yajra\DataTables\DataTables;

class AuctionCategoryRepository implements AuctionCategoryInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $auction_categories = AuctionCategory::get();
            return DataTables::of($auction_categories)
                ->addColumn('action', function ($auction_categories) {
                    return '
                            <a href="' . route('auctionCategory.edit', $auction_categories->id) . '" class="btn btn-pill btn-info-light"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $auction_categories->id . '" data-title="' . $auction_categories->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/auction_categories/index');
        }
    }

    public function showCreate()
    {
        return view('admin/auction_categories/parts/create');
    }

    public function store($request)
    {
        try {
            $inputs = $request->all();

            if ($this->createAdPackage($inputs)) {
                toastr()->addSuccess('تم اضافة فئة الحراج بنجاح');
                return redirect()->back();
            } else {
                toastr()->addError('هناك خطأ ما');
            }
        } catch (\Exception $e) {
            toastr()->addError('حدث خطأ: ' . $e->getMessage());
        }
    }

    private function createAdPackage($inputs)
    {
        return AuctionCategory::create($inputs);
    }

    public function showEdit($id)
    {
        $auctionCategory = AuctionCategory::findOrFail($id);

        return view('admin/auction_categories/parts/edit', compact('auctionCategory'));
    }

    public function update($request, $id)
    {
        try {
            $auction_category = AuctionCategory::findOrFail($id);

            $inputs = $request->except('id');

            $auction_category->update($inputs);

            toastr()->addSuccess('تم التعديل فئة الحراج بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->addError('هناك خطأ: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function delete($request)
    {
        $auction_category = AuctionCategory::findOrFail($request->id);

        $auction_category->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}