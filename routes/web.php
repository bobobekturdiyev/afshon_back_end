<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', function () {
    return view('login');
});
Route::get('/login', function () {
    if(\Illuminate\Support\Facades\Auth::check()){
        return redirect()->route("dashboard");
    }
    return view('login');
})->name('login');
// Login Request
Route::post('/sign-in', [\App\Http\Controllers\AuthController::class, 'login'])->name('sign');


Route::get('logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route("login");
})->name("logout");

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::resource('subject', \App\Http\Controllers\SubjectController::class);
    Route::resource('file', \App\Http\Controllers\FileController::class);
    Route::resource('file_join_subject', \App\Http\Controllers\FileJoinSubjectController::class);
});

