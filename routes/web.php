<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
     return redirect()->route('login');

});
Route::get('/check-students', function () {
    return response()->json([
        'students_count' => DB::table('students')->count(),
        'students' => DB::table('students')->get(),
    ]);
});
Route::middleware('guest')->group(function () {


    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');

    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::middleware(['auth', 'role:admin'])->group(function () {
Route::middleware(['auth'])->group(function () {
Route::resource('/students', StudentController::class);

Route::resource('/teachers', TeacherController::class);

Route::resource('/courses', CourseController::class);

Route::resource('/batches', BatchController::class);

Route::resource('/enrollments', EnrollmentController::class);

Route::resource('/payments', PaymentController::class);

Route::get('report/report1/{pid}', [ReportController::class,'report1']);
Route::patch('/students/{id}/restore', [StudentController::class, 'restore'])
    ->name('students.restore');
});
