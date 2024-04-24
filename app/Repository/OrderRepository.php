<?php

namespace App\Repository;

use App\Enums\OrderTypeEnums;
use App\Interfaces\OrderInterface;
use App\Models\Order;
use Yajra\DataTables\DataTables;

class OrderRepository implements OrderInterface
{
    public function index($request)
    {

        $orders = Order::query();
        $total = Order::select('total')->get()->sum('total');

        if ($request->ajax()) {

            if ($request->has('status') && $request->status !== 'all') {
                $orders = Order::where('type', $request->status);
            }
            $orders = $orders->latest()->get();

            return DataTables::of($orders)
                ->addColumn('action', function ($orders) {
                    return '
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                        data-id="' . $orders->id . '" data-title="' . $orders->title_ar . '">
                                        <i class="fas fa-trash"></i>
                                </button>
                       ';
                })
                ->editColumn('user_id', function ($orders) {
                    return $orders->user->name ?? '';
                })
                ->editColumn('type', function ($orders) {
                    if ($orders->type === 'new') {
                        return 'جديد';
                    } else if ($orders->type == 'pending') {
                        return 'قيد الموافقة';
                    } else if ($orders->type == 'complete') {
                        return 'مكتملة';
                    } else if ($orders->type == 'cancelled') {
                        return 'الغاء';
                    }
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/orders/index',compact('total'));
        }
    }


    public function delete($request)
    {
        $order = Order::findOrFail($request->id);

        $order->delete();
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }
}
