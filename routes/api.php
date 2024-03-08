<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Orders\ServiceInfoController;
use App\Http\Controllers\Orders\ServicesController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\Tasks\ReferenceController;
use App\Http\Controllers\Tasks\TaskController;
use App\Http\Controllers\Tasks\TimeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/* ========================== Hope Road Routes ================================ */

Route::post('V1/login', [AuthController::class, 'Login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('V1/Roles', RoleController::class);
    /* ========================= Tasks and Refernces ============================= */
    Route::prefix('V1/')->group(function () {
        Route::apiResource('/Tasks', TaskController::class);
        Route::get('getAllReferencesInTask/{task_id}', [TaskController::class, 'getAllReferencesInTask']);
    });
    /* ========================= Tasks and Time ============================= */
    Route::apiResource('V1/Time', TimeController::class);
    /* ======================= Refernces in tasks ============================== */
    Route::prefix('V1/')->group(function () {
        Route::apiResource('/Reference', ReferenceController::class);
        Route::get('attachReferenceToTask/{task_id}/{Reference_id}', [ReferenceController::class, 'attachReferenceToTask']);
        Route::get('getReferenceNames', [ReferenceController::class, 'getReferenceNames']);
        Route::delete('destroyUserFromTask/{task_id}/{Reference_id}', [ReferenceController::class, 'destroyUserFromTask']);
    });
    /* ========================================================================= */
    Route::prefix('V1/')->group(function () {
        Route::apiResource('Services', ServicesController::class);
        Route::get('Service/getAllServiceToChoose', [ServicesController::class, 'getAllServiceToChoose']);
        Route::get('Service/getAllServiceInfoForEveryService/{service_id}', [ServicesController::class, 'getAllServiceInfoForEveryService']);
    });
    Route::prefix('V1')->group(function () {
        Route::apiResource('Orders', OrdersController::class)->except(['store']);
        Route::post('adminStore', [OrdersController::class, 'adminStore']);
    });
    Route::apiResource('V1/ServiceInfo', ServiceInfoController::class);
    Route::post('V1/logout', [AuthController::class, 'logout']);
});
/* ============================ Guests Routes =================================== */
Route::post('V1/addOrder', [OrdersController::class, 'store']);
