<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('subject', \App\Http\Controllers\API\V1\WEB\SubjectController::class)->only(['index','show']);
Route::get('file-by-subject/{subject_id}', [\App\Http\Controllers\API\V1\WEB\FileController::class, 'index']);
Route::get('file-by-keyword/{keyword}', [\App\Http\Controllers\API\V1\WEB\FileController::class, 'show']);
Route::post('search/{text}', [\App\Http\Controllers\API\V1\WEB\FileController::class, 'search']);

Route::get('file/{filename}', [\App\Http\Controllers\API\V1\WEB\FileController::class, 'getFiles'])->name('object');

