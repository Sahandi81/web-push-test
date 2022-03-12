<?php

use App\Http\Controllers\PushController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home',     [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/push',    [PushController::class, 'store']) ->name("store_push") ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
Route::get('/push',     [PushController::class, 'push'])->name('push');
