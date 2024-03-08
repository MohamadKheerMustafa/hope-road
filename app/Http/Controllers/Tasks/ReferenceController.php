<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Tasks\ReferenceRequest;
use App\Interfaces\ReferenceInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReferenceController extends AppBaseController
{
    public ReferenceInterface $ReferenceInterface;
    public function __construct(ReferenceInterface $ReferenceInterface)
    {
        $this->ReferenceInterface = $ReferenceInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->ReferenceInterface->index($request);
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
    public function store(ReferenceRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $this->ReferenceInterface->store($validated);
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
            $data = $this->ReferenceInterface->show($id);
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
                'name' => 'sometimes|required|exists:users,name',
                'type' => 'sometimes|required|exists:roles,name',
                'task_id' => 'sometimes|required|exists:tasks,id'
            ]);
            $data = $this->ReferenceInterface->update($request, $id);
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
            $data = $this->ReferenceInterface->destroy($id);
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

    public function destroyUserFromTask($task_id, $Reference_id)
    {
        try {
            $data = $this->ReferenceInterface->destroyUserFromTask($task_id, $Reference_id);
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

    public function getReferenceNames()
    {
        $data = $this->ReferenceInterface->getReferenceNames();
        return $this->sendResponse(
            $data['data'],
            $data['msg'],
            200,
            0
        );
    }

    public function attachReferenceToTask($task_id, $Reference_id)
    {
        try {
            $data = $this->ReferenceInterface->attachReferenceToTask($task_id, $Reference_id);
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
