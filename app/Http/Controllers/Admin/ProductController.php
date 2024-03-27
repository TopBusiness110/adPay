<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductInterface $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    public function index(Request $request)
    {
        return $this->productInterface->index($request);
    }

    public function changeStatusProduct(Request $request)
    {
        return $this->productInterface->changeStatusProduct($request);
    }

    public function delete(Request $request)
    {
        return $this->productInterface->delete($request);
    }
}
