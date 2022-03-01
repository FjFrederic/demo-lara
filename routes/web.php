<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OperationsController;

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
    return view('auth.login');
});

Route::get('/home', [OperationsController::class, 'index'])
    ->name('home');

Route::post('ajoutOperation', [OperationsController::class, 'ajoutOperation'])
->name('ajoutOperation');

Route::delete('deleteOperation/{id}', [OperationsController::class, 'deleteOperation'])
    ->name('deleteOperation');

Auth::routes();
