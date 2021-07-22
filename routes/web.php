<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('admin-view', 'App\Http\Controllers\HomeController@adminView')->name('admin.view');

    Route::resource('companies', App\Http\Controllers\CompanyController::class);

    // Route::post('/companies/import/{id}', 'App\Http\Controllers\CompanyController@import');
    // TODO CR: Better
    Route::post('/companies/{id}/import', [App\Http\Controllers\CompanyController::class, 'import'])->name('companies.import');

    // Route::get('/companies/export/{id}/{format}', [App\Http\Controllers\CompanyController::class, 'export']);
    // TODO CR: Better (`format` - GET params!)
    Route::get('/companies/{id}/export', [App\Http\Controllers\CompanyController::class, 'export'])->name('companies.export');

    Route::resource('employes', App\Http\Controllers\EmployeController::class);
});




