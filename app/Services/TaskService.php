<?php

namespace App\Services;

use App\Http\Resources\Tasks\TaskCollection;
use App\Http\Resources\Tasks\TaskResource;
use App\Interfaces\TaskInterface;
use App\Models\Tasks\Task;

class TaskService implements TaskInterface
{
    public function index($request)
    {
        $limit = 20;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');

        $Tasks = Task::paginate($limit);

        return ['data' => new TaskCollection($Tasks), 'msg' => 'retrived Successfully'];
    }

    public function store($request)
    {
        $Task = Task::create($request);
        return ['data' => TaskResource::make($Task), 'msg' => 'Created Successfully'];
    }
    public function show($id)
    {
        $Task = Task::findOrFail($id);
        return ['data' => TaskResource::make($Task), 'msg' => 'retrived Successfully'];
    }

    public function update($request, $id)
    {
        $Task = Task::findOrFail($id);
        if ($request->has('title')) {
            if ($request->title != null)
                $Task->title = $request->title;
        }
        if ($request->has('description')) {
            if ($request->description != null)
                $Task->description = $request->description;
        }
        if ($request->has('start_date')) {
            if ($request->start_date != null)
                $Task->start_date = $request->start_date;
        }
        if ($request->has('end_date')) {
            if ($request->end_date != null)
                $Task->end_date = $request->end_date;
        }
        if ($request->has('completed')) {
            if ($request->completed != null)
                $Task->completed = $request->completed;
        }
        $Task->save();
        return ['data' => TaskResource::make($Task), 'msg' => 'updated Successfully'];
    }
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return ['data' => null, 'msg' => 'deleted Successfully'];
    }

    public function getAllReferencesInTask($task_id)
    {
        $task = Task::findOrFail($task_id);
        return ['data' => $task->references, 'msg' => 'retrived successfully'];
    }
}
