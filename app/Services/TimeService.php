<?php

namespace App\Services;


use App\Http\Resources\Times\TimeCollection;
use App\Http\Resources\Times\TimeResource;
use App\Interfaces\TimeInterface;
use App\Models\Tasks\Time;

class TimeService implements TimeInterface
{
    public function index($request)
    {
        $limit = 12;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');

        $Times = Time::paginate($limit);

        return ['data' => new TimeCollection($Times), 'msg' => 'retrived Successfully'];
    }

    public function store($request)
    {
        $Time = Time::create($request);
        return ['data' => TimeResource::make($Time), 'msg' => 'Created Successfully'];
    }
    public function show($id)
    {
        $Time = Time::findOrFail($id);
        return ['data' => TimeResource::make($Time), 'msg' => 'retrived Successfully'];
    }

    public function update($request, $id)
    {
        $Time = Time::findOrFail($id);
        if ($request->has('statement')) {
            if ($request->statement != null)
                $Time->statement = $request->statement;
        }
        if ($request->has('start_date')) {
            if ($request->start_date != null)
                $Time->start_date = $request->start_date;
        }
        if ($request->has('end_date')) {
            if ($request->end_date != null)
                $Time->end_date = $request->end_date;
        }
        $Time->save();
        return ['data' => TimeResource::make($Time), 'msg' => 'updated Successfully'];
    }
    public function destroy($id)
    {
        Time::findOrFail($id)->delete();
        return ['data' => null, 'msg' => 'deleted Successfully'];
    }
}
