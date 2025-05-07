<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Resource Route Explained
|--------------------------------------------------------------------------
|
| Baris di bawah ini pake fitur 'Route::resource' dari framework (ini contoh Laravel).
| 'Route::resource' ini otomatis generate BANYAK route CRUD standar
| (index, create, store, show, edit, UPDATE, destroy)
| buat resource '/tasks' yang dihandle sama 'TaskController'.
|
| Jadi, satu baris ini setara sama nulis route manual buat:
| GET        /tasks                 -> index
| POST       /tasks                 -> store
| GET        /tasks/{task}          -> show
| GET        /tasks/{task}/edit     -> edit
| PUT/PATCH  /tasks/{task}          -> update   <-- Nah, action UPDATE ini di-handle pake PUT/PATCH
| DELETE     /tasks/{task}          -> destroy
|
| Ini bikin code routing lebih ringkas & konsisten ngikutin standar RESTful.
|
*/
Route::resource('/tasks', TaskController::class);
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');

Route::resource('/employees', EmployeeController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
