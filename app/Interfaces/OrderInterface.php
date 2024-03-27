<?php

namespace App\Interfaces;


Interface OrderInterface {
    
    public function index($request);
    
    public function delete($request);
}