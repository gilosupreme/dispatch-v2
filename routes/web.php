<?php

use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DispatcherRedirectController;
use App\Http\Controllers\SupervisorRedirectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/login/custom', [CustomLoginController::class, 'login'])->name('login.custom');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/supervisor', [SupervisorRedirectController::class, 'index'])->name('supervisor.index');
    Route::get('/dispatcher', [DispatcherRedirectController::class, 'index'])->name('dispatcher.index');
});


Route::middleware(['supervisor'])->group(function () {
    Route::get('/supervisor', [SupervisorRedirectController::class, 'index'])->name('supervisor.index');
});

Route::middleware(['dispatcher'])->group(function () {
    Route::get('/dispatcher', [DispatcherRedirectController::class, 'index'])->name('dispatcher.index');
});
