<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ServicesAndOrders\ServicesRequest;
use App\Interfaces\ServicesInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServicesController extends AppBaseController
{
    public ServicesInterface $ServicesInterface;

    public function __construct(ServicesInterface $ServicesInterface)
    {
        $this->ServicesInterface = $ServicesInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->ServicesInterface->index($request);
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
    public function store(ServicesRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $this->ServicesInterface->store($validated);
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
            $data = $this->ServicesInterface->show($id);
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
                'name' => 'sometimes|required|string|unique:services,name,' . $id,
                'type' => 'sometimes|required|string',
                'active' => 'sometimes|required|boolean|in:0,1',
            ]);
            $data = $this->ServicesInterface->update($request, $id);
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
            $data = $this->ServicesInterface->destroy($id);
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
    public function getAllServiceToChoose()
    {
        $data = $this->ServicesInterface->getAllServiceToChoose();
        return $this->sendResponse(
            $data['data'],
            $data['msg'],
            200,
            0
        );
    }

    public function getAllServiceInfoForEveryService($service_id)
    {
        $data = $this->ServicesInterface->getAllServiceInfoForEveryService($service_id);
        return $this->sendResponse(
            $data['data'],
            $data['msg'],
            200,
            0
        );
    }
}
