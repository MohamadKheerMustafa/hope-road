<?php

namespace App\Services;

use App\Http\Resources\Orders\OrdersCollection;
use App\Http\Resources\Orders\OrdersResource;
use App\Interfaces\OrdersInterface;
use App\Models\Orders\Order;
use Illuminate\Support\Facades\Request;

class OrderService implements OrdersInterface
{
    public function index($request)
    {
        $limit = 20;
        if ($request->query('limit') != null)
            $limit = $request->query('limit');

        $orders = Order::paginate($limit);
        return ['data' => OrdersCollection::collection($orders), 'msg' => 'retrived Successfully'];
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return ['data' => OrdersResource::make($order), 'msg' => 'retrived Successfully'];
    }

    public function store($request)
    {
        $order = Order::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'telephone' => $request->has('telephone') ? $request->telephone : null,
            'notes' => $request->has('notes') ? $request->notes : null,
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'service_id' => $request->service_id,
        ]);
        return ['data' => OrdersResource::make($order), 'msg' => 'Created Successfully'];
    }

    public function adminStore($request)
    {
        $order = Order::create([
            'service_id' => $request->service_id,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phoneNumber' => $request->phoneNumber,
            'telephone' => $request->has('telephone') ? $request->telephone : null,
            'notes' => $request->has('notes') ? $request->notes : null,
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'status' => $request->status,
            'employeeNotes' => $request->employeeNotes,
            'user_id' => $request->user_id
        ]);
        return ['data' => OrdersResource::make($order), 'msg' => 'Created Successfully'];
    }

    public function update($request, $id)
    {
        $order = Order::findOrFail($id);
        if ($request->has('firstName')) {
            if ($request->firstName != null)
                $order->firstName = $request->firstName;
        }
        if ($request->has('lastName')) {
            if ($request->lastName != null)
                $order->lastName = $request->lastName;
        }
        if ($request->has('phoneNumber')) {
            if ($request->phoneNumber != null)
                $order->phoneNumber = $request->phoneNumber;
        }
        if ($request->has('telephone')) {
            if ($request->telephone != null)
                $order->telephone = $request->telephone;
        }
        if ($request->has('notes')) {
            if ($request->notes != null)
                $order->notes = $request->notes;
        }
        if ($request->has('service_id')) {
            if ($request->service_id != null)
                $order->service_id = $request->service_id;
        }
        if ($request->has('user_id')) {
            if ($request->user_id != null)
                $order->user_id = $request->user_id;
        }
        if ($request->has('status')) {
            if ($request->status != null)
                $order->status = $request->status;
        }
        if ($request->has('employeeNotes')) {
            if ($request->employeeNotes != null)
                $order->employeeNotes = $request->employeeNotes;
        }
        $order->save();
        return ['data' => OrdersResource::make($order), 'msg' => 'updated Successfully'];
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return ['data' => null, 'msg' => 'deleted Successfully'];
    }
}
