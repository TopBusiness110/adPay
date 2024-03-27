<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderInterface $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    public function index(Request $request)
    {
        return $this->orderInterface->index($request);
    }

    public function delete(Request $request)
    {
        return $this->orderInterface->delete($request);
    }
}
