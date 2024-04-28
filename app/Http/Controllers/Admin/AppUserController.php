<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AppUserInterface;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    private AppUserInterface $appUserInterface;

    public function __construct(AppUserInterface $appUserInterface)
    {
        $this->appUserInterface = $appUserInterface;
    }

    public function index(Request $request)
    {
        return $this->appUserInterface->index($request);
    }

    public function delete(Request $request)
    {
        return $this->appUserInterface->delete($request);
    }
    public function changeUserStatus(Request $request)
    {
        return $this->appUserInterface->changeUserStatus($request);
    }
}
