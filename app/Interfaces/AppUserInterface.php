<?php

namespace App\Interfaces;

Interface AppUserInterface {

    public function index($request);

    public function delete($request);
    public function changeUserStatus($request);
}
