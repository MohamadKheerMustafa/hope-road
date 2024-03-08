<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ServicesAndOrders\ServiceInfoRequest;
use App\Interfaces\ServiceInfoInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServiceInfoController extends AppBaseController
{
    public ServiceInfoInterface $ServiceInfoInterface;
    public function __construct(ServiceInfoInterface $ServiceInfoInterface)
    {
        $this->ServiceInfoInterface = $ServiceInfoInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->ServiceInfoInterface->index($request);
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
    public function store(ServiceInfoRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $this->ServiceInfoInterface->store($validated);
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
            $data = $this->ServiceInfoInterface->show($id);
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
                'country' => 'sometimes|required',
                'durationOfCompletion' => 'sometimes|required',
                'serviceValidityPeriod' => 'sometimes|required',
                'details' => 'nullable',
                'price' => 'sometimes|required',
                'requiredPapers' => 'nullable',
                'paymentPrice' => 'sometimes|required',
                'entity' => 'sometimes|required',
            ]);
            $data = $this->ServiceInfoInterface->update($request, $id);
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
            $data = $this->ServiceInfoInterface->destroy($id);
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
