<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\MainInterface;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private MainInterface $mainInterface;

    public function __construct(MainInterface $mainInterface)
    {
        $this->mainInterface = $mainInterface;
    }

    public function index()
    {
        return $this->mainInterface->index();
    }
}
