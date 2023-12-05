<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentRegisterController;
use App\Http\Controllers\Student\StudentProfileController;

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
})->name('welcome');



Route::middleware('auth')->group(function () {
    Route::get('/student-profile/edit/', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::patch('/student-profile/update', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::get('/student-profile/delete', [StudentProfileController::class, 'destroy'])->name('student.profile.delete');
    Route::get('/student-profile/detail', [StudentProfileController::class, 'viewDetail'])->name('student.profile.detail');
    Route::patch('/student-avatarupdate/{id}', [StudentProfileController::class, 'avatarUpdate'])->name('student.avatar.update');
    Route::patch('/student-profile/detailupdate', [StudentProfileController::class, 'detailUpdate'])->name('student.detail.update');
});

/**
 * 
 * Students routes 
 * 
 */

 Route::middleware('guest')->group(function () {
    Route::get('/student/register', [StudentRegisterController::class, 'create'])->name('student.register.view');
    Route::post('/student/register', [StudentRegisterController::class, 'store'])->name('student.Register.store');
});

Route::get('/student/dashboard', function () {
    return view('student.student-dashboard');
})->middleware(['auth', 'verified'])->name('student.dashboard');



Route::middleware('auth')->group(function () {
    // Route::get('/employer/profile', [EmployerProfileController::class, 'edit'])->name('empProfile.edit');
    // Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('empProfile.update');
    // Route::patch('/employer/avatarupdate/{id}', [EmployerProfileController::class, 'avatarUpdate'])->name('empAvatar.update');
    // Route::patch('/employer/organization/update', [EmployerProfileController::class, 'orgUpdate'])->name('orgDetail.update');
    // Route::delete('/employer/profile/destroy/', [EmployerProfileController::class, 'destroy'])->name('empProfile.destroy');
    // Route::get('/employer/profile/detail', [EmployerProfileController::class, 'viewDetail'])->name('empProfile.detail');
});

require __DIR__.'/auth.php';
