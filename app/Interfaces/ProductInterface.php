<?php

namespace App\Interfaces;

Interface ProductInterface {
    public function index($request);
    public function delete($request);
    public function changeProductsStatus($request);
}
