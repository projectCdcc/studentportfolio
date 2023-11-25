<?php

use App\Http\Controllers\Employer\EmployerProfileController;
use App\Http\Controllers\Employer\EmployerRegisterController;
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

//Route::get('/empProfile', [EmployerProfileController::class, 'edit'])->name('empProfile');


Route::get('/employer/dashboard', function () {
    return view('employer.empdashboard');
})->middleware(['auth', 'verified'])->name('employer.dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/employer/profile', [EmployerProfileController::class, 'edit'])->name('empProfile.edit');
    Route::patch('/employer/profile', [EmployerProfileController::class, 'update'])->name('empProfile.update');
    Route::delete('/employer/profile', [EmployerProfileController::class, 'destroy'])->name('empProfile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('empRegister', [EmployerRegisterController::class, 'create'])
        ->name('empRegister.view');

    Route::post('empRegister', [EmployerRegisterController::class, 'store'])->name('empRegister.store');

});


//require __DIR__.'/auth.php';