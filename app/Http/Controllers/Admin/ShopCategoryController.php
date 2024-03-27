<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ShopCategoryInterface;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    private ShopCategoryInterface $shopCategoryInterface;

    public function __construct(ShopCategoryInterface $shopCategoryInterface)
    {
        $this->shopCategoryInterface = $shopCategoryInterface;
    }

    public function index(Request $request)
    {
        return $this->shopCategoryInterface->index($request);
    }

    public function showCreate()
    {
        return $this->shopCategoryInterface->showCreate();
    }

    public function store(Request $request)
    {
        return $this->shopCategoryInterface->store($request);
    }

    public function showEdit($id)
    {
        return $this->shopCategoryInterface->showEdit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->shopCategoryInterface->update($request, $id);
    }

    public function delete(Request $request)
    {
        return $this->shopCategoryInterface->delete($request);
    }
}
