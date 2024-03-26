<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdInterface;
use Illuminate\Http\Request;

class AdController extends Controller
{
    private AdInterface $adInterface;

    public function __construct(AdInterface $adInterface)
    {
        $this->adInterface = $adInterface;
    }

    public function index(Request $request)
    {
        return $this->adInterface->index($request);
    }
}
