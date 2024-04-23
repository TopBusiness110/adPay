<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

Interface SliderInterface {

    public function index($request);

    public function showCreate();

    public function store(Request $request);

    public function showEdit($id);

    public function update( $request, $id);

    public function delete($request);
}
