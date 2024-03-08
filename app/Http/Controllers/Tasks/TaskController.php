<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Tasks\TaskRequest;
use App\Interfaces\TaskInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends AppBaseController
{
    public TaskInterface $TaskInterface;
    public function __construct(TaskInterface $TaskInterface)
    {
        $this->TaskInterface = $TaskInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->TaskInterface->index($request);
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
    public function store(TaskRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $this->TaskInterface->store($validated);
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
            $data = $this->TaskInterface->show($id);
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
                'completed' => 'required|boolean|in:0,1',
            ]);
            $data = $this->TaskInterface->update($request, $id);
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
            $data = $this->TaskInterface->destroy($id);
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

    public function getAllReferencesInTask($task_id)
    {
        $data = $this->TaskInterface->getAllReferencesInTask($task_id);
        return $this->sendResponse(
            $data['data'],
            $data['msg'],
            200,
            0
        );
    }
}
