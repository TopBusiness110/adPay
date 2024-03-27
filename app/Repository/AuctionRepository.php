<?php 

namespace App\Repository;

use App\Interfaces\AuctionInterface;
use App\Models\Auction;
use Yajra\DataTables\DataTables;

class AuctionRepository implements AuctionInterface
{
    public function index($request)
    {
        if ($request->ajax()) {
            $auctions = Auction::get();
            return DataTables::of($auctions)
                ->addColumn('action', function ($auctions) {
                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $auctions->id . '" data-title="' . $auctions->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->editColumn('user_id', function ($auctions) {
                    return $auctions->user->name ?? '';
                })
                ->editColumn('cat_id', function ($auctions) {
                    return $auctions->auctionCategory->title_ar;
                })
                ->editColumn('sub_cat_id', function ($auctions) {
                    return $auctions->auctionSubCategory->title_ar;
                })
                ->editColumn('image', function ($auctions) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $auctions->image) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/auctions/index');
        }
    }

    public function delete($request)
    {
        $auction = Auction::findOrFail($request->id);

        $auction->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}