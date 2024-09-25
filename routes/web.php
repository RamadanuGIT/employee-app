<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InvoiceController;
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
    return view('auth.login');
});

// Route::get('/',[LoginController::class,'index'])->name('login');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login-proccess',[LoginController::class, 'processLogin'])->name('process.login');
Route::post('/logout',[LoginController::class, 'logout'])->name('process.logout');


Route::controller(InvoiceController::class)->group(function () {
    Route::get('/invoice', 'index')->name('invoice');
    Route::get('/create', 'create')->name('create.invoice');
    Route::post('/store', 'store')->name('invoice.store');
});

Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');


Route::controller(EmployeeController::class)->group(function(){
    Route::get('/employee','index')->name('employee');
    Route::get('/employee/create','create')->name('employee.create');
    Route::post('/employee','store')->name('employee.store');
    Route::post('/employee/{id}/update','update')->name('employee.update');
    Route::get('/employee/{id}/delete','destroy')->name('employee.delete');
});
