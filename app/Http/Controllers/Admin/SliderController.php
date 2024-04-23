<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\SliderInterface;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private SliderInterface $sliderInterface;

    public function __construct(SliderInterface $sliderInterface)
    {
        $this->sliderInterface = $sliderInterface;
    }

    public function index(Request $request)
    {
        return $this->sliderInterface->index($request);
    }

    public function showCreate()
    {
        return $this->sliderInterface->showCreate();
    }

    public function store(Request $request)
    {
        return $this->sliderInterface->store($request);
    }

    public function showEdit($id)
    {
        return $this->sliderInterface->showEdit($id);
    }

    public function update(Request $request,$id)
    {
        //dd($request->all());

        return $this->sliderInterface->update($request, $id);
    }

    public function delete(Request $request)
    {
        return $this->sliderInterface->delete($request);
    }
}
