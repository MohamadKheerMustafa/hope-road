<?php

namespace App\Interfaces;

interface ServicesInterface
{
    public function index($request);
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
    public function getAllServiceToChoose();
    public function getAllServiceInfoForEveryService($service_id);
}
