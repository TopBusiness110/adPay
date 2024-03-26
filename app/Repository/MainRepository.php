<?php

namespace App\Repository;

use App\Interfaces\MainInterface;
use Yajra\DataTables\DataTables;

class MainRepository implements MainInterface
{
    public function index()
    {
        return view('admin/index');
    }
}
