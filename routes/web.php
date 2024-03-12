<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\WelcomeController;
use App\Models\Employee;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/explore', [WelcomeController::class, 'explore'])->name('explore');

Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
// Route::get('/employees', 'EmployeeController@index')->name('employees.index');

Route::get('department/show', [DepartmentController::class, 'show'])->name('department.show');
Route::get('employee/show', [EmployeeController::class, 'show'])->name('employee.show');


Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
// Route::get('/employees/search', 'EmployeeController@search')->name('employees.search');
Route::get('/employee/statistics', [EmployeeController::class, 'statistics'])->name('employees.statistics');
