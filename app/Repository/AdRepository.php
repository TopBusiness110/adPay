<?php

namespace App\Repository;

use App\Interfaces\AdInterface;
use App\Models\Ad;
use Yajra\DataTables\DataTables;

class AdRepository implements AdInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $ads = Ad::get();
            return DataTables::of($ads)
                ->addColumn('action', function ($ads) {
                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $ads->id . '" data-title="' . $ads->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->editColumn('user_id', function ($ads) {
                    return ($ads->user) ? $ads->user->name : '';
                })->editcolumn('status', function ($ads) {
                    return $ads->status == 1 ? 'مفعل' : 'غير مفعل';
                })
                ->editColumn('image', function ($ads) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset( $ads->image) . '">
                    ';
                })
                ->editColumn('status', function ($ads) {
                    return '<input class="tgl tgl-ios adStatusBtn" data-id="'. $ads->id .'" name="statusBtn" id="statusUser-' . $ads->id . '" type="checkbox" '. ($ads->status == 1 ? 'checked' : 'unchecked') .'/>
                    <label class="tgl-btn" dir="ltr" for="statusUser-' . $ads->id . '"></label>';

                })

                ->editColumn('video', function ($video) {
                    return '
                          <a target="_blank" href="'.asset('storage/'. $video->video).'" alt="video" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle">
                          ';
                })
                ->editColumn('complete',function ($complete){

                    return $complete->complete == 1 ? 'مكتمل' : 'غير مكتمل';

                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/ads/index');
        }
    }

    public function delete($request)
    {
        $ad = Ad::findOrFail($request->id);

        $ad->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }

    public function changeAdStatus($request)
    {
        $ad = Ad::find($request->id);
        $ad->status = $request->status;
        $ad->save();
    }
}
