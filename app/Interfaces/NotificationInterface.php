<?php

namespace App\Interfaces;

Interface NotificationInterface {
    
    public function index($request);
    
    public function showCreate();
    
    public function store($request);

    public function getUsers($request);
    
    public function delete($request);
}