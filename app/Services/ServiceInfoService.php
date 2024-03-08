<?php

namespace App\Services;

use App\Http\Resources\Services\ServiceInfoCollection;
use App\Http\Resources\Services\ServiceInfoResource;
use App\Interfaces\ServiceInfoInterface;
use App\Models\ServiceInfo\ServiceInfo;

class ServiceInfoService implements ServiceInfoInterface
{
    public function index($request)
    {
        $limit = 10;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');

        $serviceInfo = ServiceInfo::paginate($limit);

        return ['data' => new ServiceInfoCollection($serviceInfo), 'msg' => 'retrived Successfully'];
    }

    public function show($id)
    {
        $serviceInfo = ServiceInfo::with('service')->findOrFail($id);
        return ['data' => ServiceInfoResource::make($serviceInfo), 'msg' => 'retrived successfully'];
    }

    public function store($request)
    {
        $serviceInfo = ServiceInfo::create($request);
        return ['data' => ServiceInfoResource::make($serviceInfo), 'msg' => 'added successfully'];
    }

    public function update($request, $id)
    {
        $serviceInfo = ServiceInfo::findOrFail($id);
        if ($request->has('service_id')) {
            if ($request->service_id != null)
                $serviceInfo->service_id = $request->service_id;
        }
        if ($request->has('country')) {
            if ($request->country != null)
                $serviceInfo->country = $request->country;
        }
        if ($request->has('durationOfCompletion')) {
            if ($request->durationOfCompletion != null)
                $serviceInfo->durationOfCompletion = $request->durationOfCompletion;
        }
        if ($request->has('serviceValidityPeriod')) {
            if ($request->serviceValidityPeriod != null)
                $serviceInfo->serviceValidityPeriod = $request->serviceValidityPeriod;
        }
        if ($request->has('details')) {
            if ($request->details != null)
                $serviceInfo->details = $request->details;
        }
        if ($request->has('price')) {
            if ($request->price != null)
                $serviceInfo->price = $request->price;
        }
        if ($request->has('requiredPapers')) {
            if ($request->requiredPapers != null)
                $serviceInfo->requiredPapers = $request->requiredPapers;
        }
        if ($request->has('paymentPrice')) {
            if ($request->paymentPrice != null)
                $serviceInfo->paymentPrice = $request->paymentPrice;
        }
        if ($request->has('entity')) {
            if ($request->entity != null)
                $serviceInfo->entity = $request->entity;
        }
        $serviceInfo->save();
        return ['data' => ServiceInfoResource::make($serviceInfo), 'msg' => 'updated successfully'];
    }

    public function destroy($id)
    {
        ServiceInfo::findOrFail($id)->delete();
        return ['data' => null, 'msg' => 'deleted successfully'];
    }
}
