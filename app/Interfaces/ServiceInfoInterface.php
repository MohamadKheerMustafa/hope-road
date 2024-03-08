<?php

namespace App\Interfaces;

interface ServiceInfoInterface
{
    public function index($request);
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
}
