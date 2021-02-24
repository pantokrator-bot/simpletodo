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

Route::get('/', [\App\Http\Controllers\TaskController::class, 'index']);
Route::get('/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('create-task');
Route::post('/admin_login', [\App\Http\Controllers\TaskController::class, 'admin_login'])->name('admin_login');
Route::post('/admin_edit', [\App\Http\Controllers\TaskController::class, 'admin_edit'])->name('admin_edit');
