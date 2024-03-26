<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AuctionInterface;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    private AuctionInterface $auctionInterface;

    public function __construct(AuctionInterface $auctionInterface)
    {
        $this->auctionInterface = $auctionInterface;
    }

    public function index(Request $request)
    {
        return $this->auctionInterface->index($request);
    }

    public function delete(Request $request)
    {
        return $this->auctionInterface->delete($request);
    }
}
