<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleConteroller;
use App\Http\Controllers\Api\UserController;
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
});
