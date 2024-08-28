<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class, 'processLogin'])->name('process.login');
Route::get('/logout',[LoginController::class,'logout'])->name('proccess.logout');

Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');


Route::controller(EmployeeController::class)->group(function(){
    Route::get('/employee','index')->name('employee');
    Route::get('/employee/create','create')->name('employee.create');
    Route::post('/employee','store')->name('employee.store');
    Route::post('/employee/{id}/update','update')->name('employee.update');
    Route::get('/employee/{id}/delete','destroy')->name('employee.delete');
});
