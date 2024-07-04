<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/create_task', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
    Route::get('/mark_as_done', [App\Http\Controllers\TaskController::class, 'markAsDone'])->name('tasks.mark_as_done');
    Route::get('/delete', [App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.delete');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin_screen', [App\Http\Controllers\Admin\AdminController::class, 'home'])->name('admin.home');
});
