<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructorAttendanceController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentController;
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

Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login')->name('home');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('login.auth');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', 'dashboard')->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resources([
        'student' => StudentController::class,
        'room' => RoomController::class,
        'instructor' => InstructorController::class,
        'instructorAttendance' => InstructorAttendanceController::class,
        'studentAttendance' => StudentAttendanceController::class,
        'report' => ReportController::class,
        'score' => ScoreController::class,
        'shift' => ShiftController::class,
        'assignment' => AssignmentController::class,
    ]);
});
