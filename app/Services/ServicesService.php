<?php

namespace App\Services;

use App\Http\Resources\Services\ServicesCollection;
use App\Http\Resources\Services\ServicesResource;
use App\Interfaces\ServicesInterface;
use App\Models\Orders\Service;

class ServicesService implements ServicesInterface
{
    public function index($request)
    {
        $limit = 20;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');

        $services = Service::paginate($limit);

        return ['data' => new ServicesCollection($services), 'msg' => 'retrived Successfully'];
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return ['data' => ServicesResource::make($service), 'msg' => 'retrived Successfully'];
    }

    public function store($request)
    {
        $service = Service::create($request);
        return ['data' => ServicesResource::make($service), 'msg' => 'Created Successfully'];
    }

    public function update($request, $id)
    {
        $service = Service::findOrFail($id);
        if ($request->has('name')) {
            if ($request->name != null)
                $service->name = $request->name;
        }
        if ($request->has('type')) {
            if ($request->type != null)
                $service->type = $request->type;
        }
        if ($request->has('active')) {
            if ($request->active != null)
                $service->active = $request->active;
        }
        $service->save();
        return ['data' => ServicesResource::make($service), 'msg' => 'updated Successfully'];
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return ['data' => null, 'msg' => 'deleted Successfully'];
    }

    public function getAllServiceToChoose()
    {
        $services = Service::where('active', 1)->get(['id', 'name']);
        return ['data' => $services, 'msg' => 'retrived Successfully'];
    }

    public function getAllServiceInfoForEveryService($service_id)
    {
        $service = Service::with('serviceInfo')->findOrFail($service_id);
        return ['data' => ServicesResource::make($service), 'msg' => 'retrived successfully'];
    }
}
