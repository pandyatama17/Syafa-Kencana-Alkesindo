<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('siswa/all', 'SiswaController@index');

Route::get('siswa/add', 'SiswaController@create');
Route::post('siswa/store', 'SiswaController@store');

Route::get('siswa/edit/{id}', 'SiswaController@edit');
Route::post('siswa/update', 'SiswaController@update');

Route::get('siswa/delete/{id}', 'SiswaController@destroy');
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/','MainController@index');

Route::any('/login','UserController@showLogin');
Route::any('/auth','UserController@doLogin');
Route::any('/logout','UserController@logout');
Route::any('/storage','ItemController@index');
Route::any('/storage/list','ItemController@showlist');
Route::any('/storage/restock','ItemController@restock');
Route::any('/storage/restock/store','ItemController@itemInSave');
Route::any('/supplier','MainController@supplier');
Route::any('/supplier/add','MainController@addSupplier');
Route::post('/supplier/add/store','MainController@storeSupplier');
Route::any('/storage/add/','ItemController@addItem');
Route::post('/storage/add/store','ItemController@storeItem');
Route::any('/storage/out/item={id}', 'ItemController@getItemData');
Route::any('/storage/out/', 'ItemController@showOutPage');
Route::post('/storage/out/keluaringihsono', 'ItemController@itemOut');
Route::any('/storage/DO', 'ItemController@createDO');
Route::get('/storage/DO/{id}',"ItemController@getItemsForDO");
Route::post('/storage/DO/store',"ItemController@storeDO");
Route::get('/storage/show/{id}', 'ItemController@show');
Route::post('/storage/update/', 'ItemController@update');
Route::get('/storage/delete', 'ItemController@destroy');

Route::any('/finance',"FinanceController@index");
Route::any('/finance/invoice',"FinanceController@createInvoice");
Route::any('/finance/invoice/store',"FinanceController@storeInvoice");
Route::any('/finance/invoice/{id}',"FinanceController@showInvoice");
Route::get('/finance/usersJSON/{id}',"FinanceController@getUsersForIv");
Route::any('/finance/invoices',"FinanceController@showInvoices");
Route::get('/finance/srcinvoice/{id}',"FinanceController@srcInvoice");


Route::any('/iv','MainController@sampInvoice');
Route::any('/sampDO','MainController@sampDO');
Route::get('/showDO/{id}','ItemController@showDO');

Route::get('/storage/restock/{id}','ItemController@restockItem');

Route::any('/invoice/create', 'InvoiceController@createInvoice');
Route::any('/invoice/createOLD', 'InvoiceController@old');
Route::any('/invoice/store', 'InvoiceController@storeInvoice');
Route::get('/storage/itemAsJSON/{id}', 'InvoiceController@getItemData');
Route::get('/invoice/changedatavalue={id}', 'InvoiceController@changedatavalue');
Route::any('/invoice',"InvoiceController@index");
Route::get('/invoice/show/{id}', 'InvoiceController@show');

Route::any('/deliveryorder/create', 'DOController@create');
Route::any('/deliveryorder/create/base/{id}', 'DOController@createWithInvoice');
Route::any('/deliveryorder/create/itembase/{id}', 'DOController@createWithItem');
Route::post('/deliveryorder/store', 'DOController@store');

Route::any('/storage/invoice/list', 'InvoiceController@listPending');
