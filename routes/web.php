<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::resource('tasks', TaskController::class)->only(['store', 'update', 'destroy']);

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.action');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify');

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/forgot-password', 'auth.forget_password')->name('password.forgot')->middleware('guest');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.request')->middleware('guest');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
