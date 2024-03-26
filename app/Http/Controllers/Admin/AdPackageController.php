<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdPackageInterface;
use Illuminate\Http\Request;

class AdPackageController extends Controller
{
    private AdPackageInterface $adPackageInterface;

    public function __construct(AdPackageInterface $adPackageInterface)
    {
        $this->adPackageInterface = $adPackageInterface;
    }

    public function index(Request $request)
    {
        return $this->adPackageInterface->index($request);
    }

    public function showCreate()
    {
        return $this->adPackageInterface->showCreate();
    }

    public function store(Request $request)
    {
        return $this->adPackageInterface->store($request);
    }

    public function showEdit($id)
    {
        return $this->adPackageInterface->showEdit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->adPackageInterface->update($request, $id);
    }

    public function delete(Request $request)
    {
        return $this->adPackageInterface->delete($request);
    }
}
