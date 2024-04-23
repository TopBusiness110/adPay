<?php


namespace App\Repository;

use App\Interfaces\NotificationInterface;
use App\Models\AppUser;
use App\Models\Notification;
use Yajra\DataTables\DataTables;

class NotificationRepository implements NotificationInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $notifications = Notification::get();
            return DataTables::of($notifications)
                ->addColumn('action', function ($notifications) {
                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $notifications->id . '" data-title="' . $notifications->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                    })
                ->editColumn('logo', function ($notifications) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $notifications->logo) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/notifications/index');
        }
    }

    public function showCreate()
    {
        return view('admin/notifications/parts/create');
    }

    public function store($request)
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
            $request->except('logo'),
        );
    }

    private function uploadImage($request, &$inputs)
    {
        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('uploads/notification', 'public');
            $inputs['logo'] = $imagePath;
        } else {
            unset($inputs['logo']);
        }
    }

    private function create($inputs)
    {
        return Notification::create($inputs);
    }

    public function getUsers($request)
    {
        $cat_id = $request->input('cat_id');

        if ($cat_id === 'all') {
            $users = AppUser::query()->select('id', 'name')->get();
        } else if($cat_id === 'user') {
            $users = AppUser::query()->select('id', 'name')->where('type', 'user')->get();
        } else if($cat_id === 'vendor') {
            $users = AppUser::where('type', 'vendor')->get();
        } else if($cat_id === 'advertise') {
            $users = AppUser::where('type', 'advertise')->get();
        }

        return response()->json($users);
    }

    public function delete($request)
    {
        $notification = Notification::findOrFail($request->id);

        $notification->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
