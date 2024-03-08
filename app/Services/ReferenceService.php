<?php

namespace App\Services;

use App\Http\Resources\Reference\ReferenceCollection;
use App\Http\Resources\Reference\ReferenceResource;
use App\Interfaces\ReferenceInterface;
use App\Models\Tasks\Reference;

class ReferenceService implements ReferenceInterface
{
    public function index($request)
    {
        $limit = 20;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');

        $Reference = Reference::paginate($limit);

        return ['data' => new ReferenceCollection($Reference), 'msg' => 'retrived Successfully'];
    }

    public function store($request)
    {
        $Reference = Reference::create($request);
        return ['data' => ReferenceResource::make($Reference), 'msg' => 'Created Successfully'];
    }

    public function show($id)
    {
        $Reference = Reference::findOrFail($id);
        return ['data' => ReferenceResource::make($Reference), 'msg' => 'retrived Successfully'];
    }

    public function update($request, $id)
    {
        $Reference = Reference::findOrFail($id);
        if ($request->has('name')) {
            if ($request->name != null)
                $Reference->name = $request->name;
        }
        if ($request->has('type')) {
            if ($request->type != null)
                $Reference->type = $request->type;
        }
        if ($request->has('task_id')) {
            if ($request->task_id != null)
                $Reference->tasks()->updateExistingPivot($request->task_id, [
                    'done' => true,
                    'by_Who' => auth()->user()->name
                ]);
        }
        $Reference->save();
        return ['data' => ReferenceResource::make($Reference), 'msg' => 'Updated Successfully'];
    }

    public function destroy($id)
    {
        $Reference = Reference::findOrFail($id);
        $Reference->delete();
        return ['data' => null, 'msg' => 'Deleted Successfully'];
    }

    public function destroyUserFromTask($task_id, $Reference_id)
    {
        $Reference = Reference::findOrFail($Reference_id);
        $Reference->tasks()->detach($task_id);
        return ['data' => null, 'msg' => 'Deleted Successfully from Pivot table'];
    }

    public function getReferenceNames()
    {
        $Reference = Reference::get(['id', 'name']);
        return ['data' => $Reference, 'msg' => 'retrived Successfully'];
    }

    public function attachReferenceToTask($Reference_id, $task_id)
    {
        $Reference = Reference::findOrFail($Reference_id);
        $Reference->tasks()->attach($task_id);
        return ['data' => ReferenceResource::make($Reference), 'msg' => 'attached successfully'];
    }
}
