<?php

use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Employer\EmployerRegisterController;
use App\Http\Controllers\Employer\TransferUsersToEmployers;
use App\Http\Controllers\Employer\EmployerJobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employer\JobController;
use App\Models\Student;
use App\Models\User;

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
    $students = Student::with('user')->orderBy('created_at', 'desc')->paginate(4);
    // Assuming you want to get the avatar of the first user associated with the first student.
    
    return view('employer.empdashboard')->with('students', $students);
})->middleware(['auth', 'verified'])->name('employer.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/employer/profile', [EmployerProfileController::class, 'edit'])->name('empProfile.edit');
    Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('empProfile.update');
    Route::patch('/employer/avatarupdate/{id}', [EmployerProfileController::class, 'avatarUpdate'])->name('empAvatar.update');
    Route::patch('/employer/organization/update', [EmployerProfileController::class, 'orgUpdate'])->name('orgDetail.update');
    Route::delete('/employer/profile/destroy/', [EmployerProfileController::class, 'destroy'])->name('empProfile.destroy');
    Route::get('/employer/profile/detail', [EmployerProfileController::class, 'viewDetail'])->name('empProfile.detail');
    Route::get('/employer/view/student/{id}', [EmployerProfileController::class, 'viewStudent'])->name('employer.view.student');
});

Route::middleware('guest')->group(function () {
    Route::get('/employer/register', [EmployerRegisterController::class, 'create'])->name('empRegister.view');
    Route::post('/employer/register', [EmployerRegisterController::class, 'store'])->name('empRegister.store');
});


/********************* Job routes **********************/

Route::middleware('auth')->group(function () {
    Route::get('/employer/job/id={id}', [EmployerJobController::class, 'index'])->name('empJob.show');
    Route::post('/employer/job/store/{id}', [EmployerJobController::class, 'store'])->name('empJob.store');
    Route::delete('/employer/{userId}/job/delete/{jobId}', [EmployerJobController::class, 'destroy'])->name('employer.job.destroy');
    Route::post('/employer/job/update/id={id}', [EmployerJobController::class, 'update'])->name('employer.job.update');
    Route::get('/job/detail/id={id}', [JobController::class, 'jobDetail'])->name('employer.job.detail');
});



/***************** Stand alone route */


Route::get('/job/list', [JobController::class, 'jobList'])->name('job.list');
