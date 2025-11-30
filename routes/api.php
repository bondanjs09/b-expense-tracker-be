<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Superadmin\UserManagementController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Login
Route::post('/login', [LoginController::class, 'login']);

// User Management
Route::middleware(['auth:api', 'superadmin'])->group(function () {
    Route::post(
        '/superadmin/user-management/add-user',
        [UserManagementController::class, 'addUser']
    );
});

// Token Test
Route::middleware(['auth:api'])->get('/me', function () {
    return auth()->user();
});
