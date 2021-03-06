<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RoleConteroller;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SampleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UserController::class);
    Route::get('users/permission/{permissionName}', [App\Http\Controllers\Api\UserController::class, 'checkPermission']);
    Route::resource('roles', RoleConteroller::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('samples', SampleController::class);
    Route::post('samples/signatureUpload/{id}', [App\Http\Controllers\SampleController::class, 'signatureUpload']);
    Route::post('samples/deleteSignature/{id}', [App\Http\Controllers\SampleController::class, 'deleteSignature']);
    Route::post('samples/sampleTypePhotoUpload/{id}', [App\Http\Controllers\SampleController::class, 'sampleTypePhotoUpload']);
    Route::post('samples/deleteSampleTypePhotoUpload/{id}', [App\Http\Controllers\SampleController::class, 'deleteSampleTypePhotoUpload']);
    Route::post('samples/updateSignature/{id}', [App\Http\Controllers\SampleController::class, 'updateSignature']);
    Route::post('samples/techDataPhotoUpload/{id}', [App\Http\Controllers\SampleController::class, 'techDataPhotoUpload']);
    Route::post('samples/deleteTechDataPhotoUpload/{id}', [App\Http\Controllers\SampleController::class, 'deleteTechDataPhotoUpload']);
    Route::get('/seeSampleStatus/{id}', [\App\Http\Controllers\SampleController::class, 'seeSampleStatus'])->name('seeSampleStatus');
    Route::post('samples/changeSampleStatus/{id}', [\App\Http\Controllers\SampleController::class, 'changeSampleStatus'])->name('changeSampleStatus');
    Route::get('samples/seeSampleActivityLogs/{id}', [\App\Http\Controllers\SampleController::class, 'seeSampleActivityLogs'])->name('seeSampleActivityLogs');
    Route::post('projects/manufacturesList', [\App\Http\Controllers\Api\ProjectController::class, 'manufacturesList'])->name('manufacturesList');
    Route::post('projects/subContractorsList', [\App\Http\Controllers\Api\ProjectController::class, 'subContractorsList'])->name('subContractorsList');

});
