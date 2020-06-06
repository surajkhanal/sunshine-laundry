<?php

use App\Client;
use App\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;
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
    $users = User::all();
    $orders = Order::all();
    $clients = Client::all();
    return view('dashboard.index', ['users' => $users, 'orders' => $orders, 'clients' => $clients]);
})->middleware('auth');

Route::resource('/orders', 'OrderController');

Route::resource('/items', 'ItemController');

Route::resource('/services', 'ServiceController');

Route::resource('/clients', 'ClientController');

Route::resource('/invoices', 'InvoiceController');
Route::get('/download/{id}', 'InvoiceController@download');

Route::get('/reports', 'ReportController@index');
Route::post('/filterOrder', 'ReportController@filterOrder')->name('filterOrder');
Route::post('/filterInvoice', 'ReportController@filterInvoice')->name('filterInvoice');
Route::post('/filterClient', 'ReportController@filterClient')->name('filterClient');

Route::resource('/staff', 'StaffController');

Route::resource('/account-settings', 'AccountSettingsController');

// Route::get('/pdf/{id}', 'OrderController@createPDF');