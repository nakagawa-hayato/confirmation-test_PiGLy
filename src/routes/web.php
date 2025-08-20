<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WeightLogController;

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

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'postStep1'])->name('register.postStep1');

Route::get('/register/step2', [RegisterController::class, 'showStep2'])->middleware('auth')->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'postStep2'])->middleware('auth')->name('register.postStep2');

Route::middleware('auth')->group(function () {
    Route::get('weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('weight_logs/goal_setting', [WeightLogController::class, 'showGoalSetting'])->name('weight_logs.goal_setting');
    Route::put('weight_logs/goal_setting', [WeightLogController::class, 'updateGoalSetting'])->name('weight_logs.goal_setting.update');
    Route::post('weight_logs/create', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('weight_logs/search', [WeightLogController::class, 'index'])->name('weight_logs.search');
    Route::get('weight_logs/{weightLog}', [WeightLogController::class, 'show'])->name('weight_logs.show');
    Route::put('weight_logs/{weightLog}/update', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('weight_logs/{weightLog}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.delete');
    Route::get('weight_logs/goal_setting', [WeightLogController::class, 'showGoalSetting'])->name('weight_logs.goal_setting');
    Route::put('weight_logs/goal_setting', [WeightLogController::class, 'updateGoalSetting'])->name('weight_logs.goal_setting.update');
});