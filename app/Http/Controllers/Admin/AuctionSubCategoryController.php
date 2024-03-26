<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AuctionSubCategoryInterface;
use Illuminate\Http\Request;

class AuctionSubCategoryController extends Controller
{
    private AuctionSubCategoryInterface $auctionSubCategoryInterface;

    public function __construct(AuctionSubCategoryInterface $auctionSubCategoryInterface)
    {
        $this->auctionSubCategoryInterface = $auctionSubCategoryInterface;
    }

    public function index(Request $request)
    {
        return $this->auctionSubCategoryInterface->index($request);
    }

    public function showCreate()
    {
        return $this->auctionSubCategoryInterface->showCreate();
    }

    public function store(Request $request)
    {
        return $this->auctionSubCategoryInterface->store($request);
    }

    public function showEdit($id)
    {
        return $this->auctionSubCategoryInterface->showEdit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->auctionSubCategoryInterface->update($request, $id);
    }

    public function delete(Request $request)
    {
        return $this->auctionSubCategoryInterface->delete($request);
    }
}
