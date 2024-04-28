<?php

namespace App\Repository;

use App\Interfaces\AppUserInterface;
use App\Models\AppUser;
use Yajra\DataTables\DataTables;

class AppUserRepository implements AppUserInterface
{
    public function index($request)
    {
        $app_users = AppUser::query();
        if ($request->ajax()) {
            if ($request->has('status') && $request->status !== 'all') {
                $app_users = AppUser::where('type', $request->status);
            }
            $app_users = $app_users->latest()->get();

            return DataTables::of($app_users)
                ->addColumn('action', function ($app_users) {
                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $app_users->id . '" data-title="' . $app_users->name . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->editColumn('status', function ($app_users) {
                    return '<input class="tgl tgl-ios statusBtn" data-id="'. $app_users->id .'" name="statusBtn" id="statusUser-' . $app_users->id . '" type="checkbox" '. ($app_users->status == 1 ? 'checked' : 'unchecked') .'/>
                    <label class="tgl-btn" dir="ltr" for="statusUser-' . $app_users->id . '"></label>';

                })
                ->editColumn('type', function ($app_users) {
                    if ($app_users->type == 'user') {
                        return 'مستخدم';
                    } else if ($app_users->type == 'vendor') {
                        return 'بائع';
                    } else if ($app_users->type == 'advertise') {
                        return 'معلن';
                    }
                    return;
                })
                ->editColumn('image', function ($app_users) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $app_users->image) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/app_users/index');
        }
    }

    public function changeUserStatus($request)
    {
        $app_user = AppUser::find($request->id);
        $app_user->status = $request->status;
        $app_user->save();
    }

    public function delete($request)
    {
        $app_user = AppUser::findOrFail($request->id);

        $app_user->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
