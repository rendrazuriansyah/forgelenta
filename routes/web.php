<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
| GET        /tasks/create          -> create
| POST       /tasks                 -> store
| GET        /tasks/{task}          -> show
| GET        /tasks/{task}/edit     -> edit
| PUT/PATCH  /tasks/{task}          -> update   <-- Nah, action UPDATE ini di-handle pake PUT/PATCH
| DELETE     /tasks/{task}          -> destroy
|
| Ini bikin code routing lebih ringkas & konsisten ngikutin standar RESTful.
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);
    // Route::get('/dashboard/presence', [DashboardController::class, 'presence'])->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);
    Route::get('/dashboard/presence', [DashboardController::class, 'presence'])->name('dashboard.presence')->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);

    Route::resource('/departments', DepartmentController::class)->middleware(['role:HR Manager']);

    Route::resource('/roles', RoleController::class)->middleware(['role:HR Manager']);

    Route::resource('/employees', EmployeeController::class)->middleware(['role:HR Manager']);

    Route::resource('/presences', PresenceController::class)->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);

    Route::resource('/leave-requests', LeaveRequestController::class)->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);
    Route::patch('/leave-requests/{leave_request}/status', [LeaveRequestController::class, 'updateStatus'])->name('leave-requests.update-status')->middleware(['role:HR Manager']);

    Route::resource('/tasks', TaskController::class)->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.update-status')->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);

    Route::resource('/payrolls', PayrollController::class)->middleware(['role:HR Manager,Software Engineer,Sales Manager,Accountant,Marketing Specialist,Operations Manager,Project Manager,Data Analyst']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
