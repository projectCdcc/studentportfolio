<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentRegisterController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Models\Job;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Student\StudentCvController;

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

/**
 *
 * Landing page route (welcome )
 */


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


/**
 * 
 * About page route (about)
 */

Route::get('/home/about', function() {
    return view('about');
})->name('about'); 

/**
 *
 * Students routes
 *
 */

Route::middleware('auth')->group(function () {
    Route::get('/student-profile/edit/', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
    Route::patch('/student-profile/update', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::delete('/student-profile/delete', [StudentProfileController::class, 'destroy'])->name('student.profile.delete');
    Route::get('/student-profile/detail', [StudentProfileController::class, 'viewDetail'])->name('student.profile.detail');
    Route::patch('/student-avatarupdate/{id}', [StudentProfileController::class, 'avatarUpdate'])->name('student.avatar.update');
    Route::patch('/student-profile/detailupdate', [StudentProfileController::class, 'detailUpdate'])->name('student.detail.update');
});

 Route::middleware('guest')->group(function () {
    Route::get('/student/register', [StudentRegisterController::class, 'create'])->name('student.register.view');
    Route::post('/student/register', [StudentRegisterController::class, 'store'])->name('student.Register.store');
});

Route::get('/student/dashboard', function () {
    $jobs = Job::orderBy('created_at', 'desc')->paginate(4);
    return view('student.student-dashboard')->with('jobs', $jobs);
})->middleware(['auth', 'verified'])->name('student.dashboard');

/**
 *
 * Jobs route
 */
Route::middleware('auth')->group(function() {
    Route::get('/student/job/detail/id={id}', [JobController::class, 'jobDetail'])->name('job.detail');
});

/**
 * Standalone route
 */

 Route::get('/view/employer/{id}', [StudentProfileController::class, 'viewEmployer'])->name('view.employer');


/**
 *
 * Student cv routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/student/cv/', [StudentCvController::class, 'create'])->name('student.cv.view');
    Route::post('/student/cv/upload/{id}', [StudentCvController::class, 'upload'])->name('student.cv.upload');
});

require __DIR__.'/auth.php';


