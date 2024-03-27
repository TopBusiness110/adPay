<?php

namespace App\Interfaces;


Interface ShopCategoryInterface {
    
    public function index($request);
    
    public function showCreate();
    
    public function store($request);
    
    public function showEdit($id);
    
    public function update( $request, $id);
    
    public function delete($request);
    
}