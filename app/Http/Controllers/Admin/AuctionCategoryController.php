<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AuctionCategoryInterface;
use Illuminate\Http\Request;

class AuctionCategoryController extends Controller
{
    private AuctionCategoryInterface $auctionCategoryInterface;

    public function __construct(AuctionCategoryInterface $auctionCategoryInterface)
    {
        $this->auctionCategoryInterface = $auctionCategoryInterface;
    }

    public function index(Request $request)
    {
        return $this->auctionCategoryInterface->index($request);
    }

    public function showCreate()
    {
        return $this->auctionCategoryInterface->showCreate();
    }

    public function store(Request $request)
    {
        return $this->auctionCategoryInterface->store($request);
    }

    public function showEdit($id)
    {
        return $this->auctionCategoryInterface->showEdit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->auctionCategoryInterface->update($request, $id);
    }

    public function delete(Request $request)
    {
        return $this->auctionCategoryInterface->delete($request);
    }
}
