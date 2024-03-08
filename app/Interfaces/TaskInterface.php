<?php

namespace App\Interfaces;

interface TaskInterface
{
    public function index($request);
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
    public function getAllReferencesInTask($task_id);
}
