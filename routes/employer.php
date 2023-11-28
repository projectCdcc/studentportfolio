<?php

use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Employer\EmployerRegisterController;
use App\Http\Controllers\Employer\TransferUsersToEmployers;
use App\Http\Controllers\Employer\EmployerJobController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Employers Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/empProfile', [EmployerProfileController::class, 'edit'])->name('empProfile');


Route::get('/employer/dashboard', function () {
    return view('employer.empdashboard');
})->middleware(['auth', 'verified'])->name('employer.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/employer/profile', [EmployerProfileController::class, 'edit'])->name('empProfile.edit');
    Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('empProfile.update');
    Route::patch('/employer/avatarupdate/{id}', [EmployerProfileController::class, 'avatarUpdate'])->name('empAvatar.update');
    Route::patch('/employer/organization/update', [EmployerProfileController::class, 'orgUpdate'])->name('orgDetail.update');
    Route::delete('/employer/profile', [EmployerProfileController::class, 'destroy'])->name('empProfile.destroy');
    Route::get('/employer/profile/detail', [EmployerProfileController::class, 'viewDetail'])->name('empProfile.detail');
});

Route::middleware('guest')->group(function () {
    Route::get('empRegister', [EmployerRegisterController::class, 'create'])->name('empRegister.view');
    Route::post('empRegister', [EmployerRegisterController::class, 'store'])->name('empRegister.store');
});


/********************* Job routes **********************/

Route::middleware('auth')->group(function () {
    Route::get('/employer/job', [EmployerJobController::class, 'index'])->name('empJob.show');
    Route::post('/employer/job/store/{id}', [EmployerJobController::class, 'store'])->name('empJob.store');
 });