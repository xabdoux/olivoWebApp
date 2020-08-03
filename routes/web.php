<?php

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

Route::view('privacy-policy', 'privacy');
Route::get('/', function () {
	return view('auth.login');
})->middleware('guest');


Route::middleware(['can:isCaissiere, Auth::user()', 'auth'])->group(function () {

	Route::get('/dashboard/{days}', 'Caissiere@allClients');
	Route::get('profileClient/{clientId}', 'Caissiere@profileClient')->name('profileClient');
	Route::get('proceedToPayment/{clientId}', 'Caissiere@proceedToPayment');
	Route::get('productOut/{clientId}', 'Caissiere@productOut');
	Route::get('productOutCanceled/{clientId}', 'Caissiere@productOutCanceled');
	Route::get('paymentCanceled/{clientId}', 'Caissiere@paymentCanceled');
	Route::get('finishedClients/{days}', 'Caissiere@finishedClients');
	Route::get('printInvoicePayed/{clientId}', 'Caissiere@printInvoicePayed');

	Route::get('ajaxtest', 'Caissiere@ajaxtest');
	Route::get('getData/14', 'Caissiere@getData14');
	Route::get('getData/30', 'Caissiere@getData30');
	Route::get('getData/lifetime', 'Caissiere@getDataLifeTime');

	Route::get('getFinishedData/14', 'Caissiere@getFinishedData14');
	Route::get('getFinishedData/30', 'Caissiere@getFinishedData30');
	Route::get('getFinishedData/lifetime', 'Caissiere@getFinishedDataLifeTime');
});

Route::middleware(['can:isInjecteur, Auth::user()', 'auth'])->group(function () {

	Route::get('/ajouter-client', 'Injecteur@addCustomer');
	Route::get('printInvoice/{clientId}', 'Injecteur@printInvoice');
	Route::post('storeData', 'Injecteur@storeData');
	Route::get('ShowClientDetails/{clientId}', 'Injecteur@ShowClientDetails')->name('ShowClientDetails');
	Route::post('modifyData/{clientId}', 'Injecteur@modifyData');
	Route::get('all-Clients', 'Injecteur@allClients');
	Route::get('deleteClient/{clientId}', 'Injecteur@deleteClient');
	Route::get('deleted-Clients', 'Injecteur@deletedClients');
	Route::get('ShowTrashedClientDetails/{clientId}', 'Injecteur@ShowTrashedClientDetails');
	Route::get('restorerClient/{clientId}', 'Injecteur@restorerClient');
});


Route::middleware(['can:isDonneur, Auth::user()', 'auth'])->group(function () {

	Route::get('donneur', 'Donneur@allClients');
	Route::get('productGone/{clientId}', 'Donneur@productGone');
	Route::get('clientDetails/{clientId}', 'Donneur@clientDetails');
	Route::get('clientDetailsList', 'Donneur@clientDetailsList');
});

Route::middleware(['can:isAdmin, Auth::user()', 'auth'])->group(function () {
	Route::get('adminDashboard', function () {
		return redirect('addUser');
	});
	Route::get('home', function () {
		return redirect('addUser');
	});
	Route::get('addUser', 'Admin@addUser');
	Route::post('addUser', 'Admin@registerUser');
	Route::get('deleteUser/{userId}', 'Admin@deleteUser');
	Route::post('updateUser/{userId}', 'Admin@updateUser');

	Route::resource('configuration', 'ConfigurationController');
});

Auth::routes(['register' => false]);
Route::match(['get', 'post'], 'register', function () {
	return abort(403, 'Forbidden');
})->name('register');

Route::get('dashboard', function () {
		return redirect('dashboard/14');
	});
