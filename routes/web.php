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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', function() {
    return view('dashboard.index');
});

Route::resource('/orders', 'OrderController');

Route::resource('/items', 'ItemController');

Route::resource('/services', 'ServiceController');

Route::resource('/clients', 'ClientController');

Route::resource('/invoices', 'InvoiceController');

Route::get('/reports', function() {
    return view('invoices.index');
});

Route::resource('/staff', 'StaffController');

Route::resource('/account-settings', 'AccountSettingsController');