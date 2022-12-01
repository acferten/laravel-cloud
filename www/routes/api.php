<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;


Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/authorization', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->id;
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/folders', [FolderController::class, 'create']);
    Route::post('/folders/{id}/files', [FileController::class, 'create']);
});
