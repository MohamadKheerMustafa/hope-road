<?php

namespace App\Interfaces;

interface ReferenceInterface
{
    public function index($request);
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
    public function destroyUserFromTask($task_id, $Reference_id);
    public function getReferenceNames();
    public function attachReferenceToTask($task_id, $Reference_id);
}
