<?php

namespace App\Repository;

use App\Interfaces\AdPackageInterface;
use App\Models\AdPackage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdPackageRepository implements AdPackageInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $ad_packages = AdPackage::get();
            return DataTables::of($ad_packages)
                ->addColumn('action', function ($ad_packages) {
                    return '
                            <a href="' . route('ad_packages.edit', $ad_packages->id) . '" class="btn btn-pill btn-info-light"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $ad_packages->id . '" data-title="' . $ad_packages->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/ad_packages/index');
        }
    }

    public function showCreate()
    {
        return view('admin/ad_packages/parts/create');
    }

    public function store($request)
    {
        try {


            $validator = Validator::make(request()->all(), [
                'title_ar' => 'required',
                'title_en' => 'required',
                'count' => 'required',
                'price' => 'required',
            ]);

            if ($validator->fails()) {
                toastr()->addError('هذه الحقول مطلوبه');
                return redirect()->back();            }

            $inputs = $request->all();
            if ($this->createAdPackage($inputs)) {
                toastr()->addSuccess('تم اضافة الباقة بنجاح');
                return redirect()->back();
            } else {
                toastr()->addError('هناك خطأ ما');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            toastr()->addError('حدث خطأ: ' . $e->getMessage());
            return redirect()->back(); // Add this line to return a response
        }
    }

    private function createAdPackage($inputs)
    {
        return AdPackage::create($inputs);
    }

    public function showEdit($id)
    {
        $ad_package = AdPackage::findOrFail($id);

        return view('admin/ad_packages/parts/edit', compact('ad_package'));
    }

    public function update($request, $id)
    {
        try {
            $ad_package = AdPackage::findOrFail($id);

            $inputs = $request->except('id');

            $ad_package->update($inputs);

            toastr()->addSuccess('تم التعديل المدينة بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->addError('هناك خطأ: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function delete($request)
    {
        $ad_package = AdPackage::findOrFail($request->id);

        $ad_package->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
