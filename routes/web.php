<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form', [App\Http\Controllers\FormController::class,'index']);
Route::post('/form', [App\Http\Controllers\FormController::class,'insert']);
Route::get('/delete_admin/{id}', [App\Http\Controllers\FormController::class,'deleteAdmin']);
Route::get('/update_admin/{id}', [App\Http\Controllers\FormController::class,'updateAdmin']);
Route::post('/update_form', [App\Http\Controllers\FormController::class,'updateAdmindata']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
