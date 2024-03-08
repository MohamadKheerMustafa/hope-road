<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ServicesAndOrders\OrdersRequest;
use App\Interfaces\OrdersInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrdersController extends AppBaseController
{
    public OrdersInterface $OrdersInterface;
    public function __construct(OrdersInterface $OrdersInterface)
    {
        $this->OrdersInterface = $OrdersInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->OrdersInterface->index($request);
        return $this->sendResponse(
            $data['data'],
            $data['msg'],
            200,
            0
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrdersRequest $request)
    {
        try {
            $data = $this->OrdersInterface->store($request);
            return $this->sendResponse(
                $data['data'],
                $data['msg'],
                201,
                0
            );
        } catch (ValidationException $ValidationExc) {
            return $this->sendResponse(
                $ValidationExc->errors(),
                $ValidationExc->getMessage(),
                422,
                1
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }

    public function adminStore(OrdersRequest $request)
    {
        try {
            $data = $this->OrdersInterface->adminStore($request);
            return $this->sendResponse(
                $data['data'],
                $data['msg'],
                201,
                0
            );
        } catch (ValidationException $ValidationExc) {
            return $this->sendResponse(
                $ValidationExc->errors(),
                $ValidationExc->getMessage(),
                422,
                1
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data = $this->OrdersInterface->show($id);
            return $this->sendResponse(
                $data['data'],
                $data['msg'],
                200,
                0
            );
        } catch (ModelNotFoundException $ModelNotFoundExc) {
            return $this->sendResponse(
                $ModelNotFoundExc->getMessage(),
                'Model Not Found',
                404,
                1
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'firstName' => 'sometimes|string',
                'lastName' => 'sometimes|string',
                'phoneNumber' => 'sometimes|string',
                'telephone' => 'sometimes|integer',
                'notes' => 'sometimes|string',
                'service_id' => 'sometimes|exists:services,id',
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:0,1,2',
                'employeeNotes' => 'required|string'
            ]);
            $data = $this->OrdersInterface->update($request, $id);
            return $this->sendResponse(
                $data['data'],
                $data['msg'],
                200,
                0
            );
        } catch (ModelNotFoundException $ModelNotFoundExc) {
            return $this->sendResponse(
                $ModelNotFoundExc->getMessage(),
                'Model Not Found',
                404,
                1
            );
        } catch (ValidationException $ValidationExc) {
            return $this->sendResponse(
                $ValidationExc->errors(),
                $ValidationExc->getMessage(),
                422,
                1
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = $this->OrdersInterface->destroy($id);
            return $this->sendResponse(
                $data['data'],
                $data['msg'],
                200,
                0
            );
        } catch (ModelNotFoundException $ModelNotFoundExc) {
            return $this->sendResponse(
                $ModelNotFoundExc->getMessage(),
                'Model Not Found',
                404,
                1
            );
        } catch (Exception $e) {
            return $this->sendResponse(
                $e->getMessage(),
                'something wrong',
                500,
                1
            );
        }
    }
}
