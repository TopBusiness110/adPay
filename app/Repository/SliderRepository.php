<?php


namespace App\Repository;

use App\Interfaces\SliderInterface;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SliderRepository implements SliderInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $sliders = Slider::get();
            return DataTables::of($sliders)
                ->addColumn('action', function ($sliders) {
                    //<a href="' . route('ad_packages.edit', $sliders->id) . '" class="btn btn-pill btn-info-light"><i class="fa fa-edit"></i></a>

                    return '
                            <a href="' . route('slider.edit', $sliders->id) . '" class="btn btn-pill btn-info-light"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $sliders->id . '" data-title="' . $sliders->id . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->editColumn('image', function ($sliders) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $sliders->image) . '">
                    ';
                })
                ->editColumn('status', function ($sliders) {
                    if ($sliders->status == '0') {
                        return 'غير مفعل';
                    } else if ($sliders->status == '1') {
                        return 'مفعل';
                    }
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/sliders/index');
        }
    }

    public function showCreate()
    {
        return view('admin/sliders/parts/create');
    }

    public function store(Request $request)
    {
        try {
            $inputs = $this->processInputs($request);

            $this->uploadImage($request, $inputs);

            if ($this->create($inputs)) {
                toastr()->addSuccess('تم اضافة الاشعار بنجاح');
                return redirect()->back();
            } else {
                toastr()->addError('هناك خطأ ما');
            }
        } catch (\Exception $e) {
            toastr()->addError('حدث خطأ: ' . $e->getMessage());
        }
    }

    private function processInputs($request)
    {
        return array_merge(
            $request->except('image'),
        );
    }

    private function uploadImage($request, &$inputs)
    {
        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('uploads/sliders', 'public');
            $inputs['image'] = $imagePath;
        } else {
            unset($inputs['image']);
        }
    }

    private function create($inputs)
    {
        return Slider::create($inputs);
    }

    public function showEdit($id)
    {

        $slider = Slider::findOrFail($id);

        return view('admin/sliders/parts/edit', compact('slider'));
    }

    public function update($request, $id)
    {
//        return $request->all();
//        try {
        $slider = Slider::findOrFail($id);
        $path = $slider->image;

        $inputs = $request->except('id');

        if ($request->has('image')) {
            $this->deleteImage($request, $path);
            $this->uploadImage($request, $inputs);


        }
        $slider->update($inputs);

        toastr()->addSuccess('تم التعديل صور بنجاح');
        return redirect()->back();
//        } catch (\Exception $e) {
//            toastr()->addError('هناك خطأ: ' . $e->getMessage());
//        }

        return redirect()->back();
    }

    public function delete($request)
    {
        $slider = Slider::findOrFail($request->id);

        $slider->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }

    private function deleteImage($request, $path)
    {
        if ($request->hasFile('image')) {

            $imagePath = asset('storage/' . $path);
            if (Storage::disk('public')->exists($path)) {

                Storage::disk('public')->delete($path);
            }

        }
    }
}
