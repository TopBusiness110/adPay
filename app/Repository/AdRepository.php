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
                    return $ads->user->name;
                })
                ->editColumn('image', function ($ads) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $ads->image) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/ads/index');
        }
    }
}