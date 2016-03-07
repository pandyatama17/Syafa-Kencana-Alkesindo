<?php

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/','MainController@index');

/* Session */
Route::any('/login','UserController@showLogin');
Route::any('/auth','UserController@doLogin');
Route::any('/logout','UserController@logout');

#Profile Routing
Route::get('/profile', 'UserController@profile');
Route::post('/profile/updateinfo', 'UserController@profileUpdateInfo');
Route::post('/profile/changepassword', 'UserController@profileChangePassword');
Route::post('/profile/updateimage', 'UserController@updateAvatar');

/* Storage Routing */
Route::any('/storage','ItemController@index');
Route::any('/storage/list','ItemController@showlist');
Route::any('/storage/restock','ItemController@restock');
Route::any('/storage/restock/store','ItemController@itemInSave');
Route::any('/storage/add/','ItemController@addItem');
Route::post('/storage/add/store','ItemController@storeItem');
Route::get('/storage/show/{id}', 'ItemController@show');
Route::post('/storage/update/', 'ItemController@update');
Route::get('/storage/delete/{id}', 'ItemController@destroy');
Route::get('/storage/restock/{id}','ItemController@restockItem');
Route::any('/storage/invoice/list', 'InvoiceController@listPending');
Route::any('/storage/restock_report', 'MainController@itemInReport');

/* Supplier Routing */
Route::any('/supplier','MainController@supplier');
Route::any('/supplier/add','MainController@addSupplier');
Route::post('/supplier/add/store','MainController@storeSupplier');
Route::get('/supplier/delete/{id}', 'MainController@destroySuppplier');

#Owner Routing
Route::any('/owner', 'MainController@owner');

#Finance Routing
Route::any('/finance',"FinanceController@index");

#Invoice Routing
Route::any('/invoice/create', 'InvoiceController@createInvoice');
Route::any('/invoice/store', 'InvoiceController@storeInvoice');
Route::any('/invoice',"InvoiceController@index");
Route::get('/invoice/show/{id}', 'InvoiceController@show');

#DeliveryOrder Routing
Route::any('/deliveryorder', 'DOController@index');
Route::any('/deliveryorder/create', 'DOController@create');
Route::any('/deliveryorder/create/base/{id}', 'DOController@createWithInvoice');
Route::any('/deliveryorder/show/{id}', 'DOController@show');
Route::post('/deliveryorder/store', 'DOController@store');

#Piutang Routing
Route::any('/piutang/all', 'PiutangController@showAll');
Route::any('/piutang/clear', 'PiutangController@showLunas');
Route::any('/piutang/pending', 'PiutangController@showHutang');
Route::get('/piutang/check/{id}', 'PiutangController@check');

#Admin User Routing
Route::any('/user/list', 'UserController@index');
Route::any('/user/create', 'UserController@create');
Route::any('/user/store', 'UserController@store');

#JSON Controls
Route::get('/finance/usersJSON/{id}',"FinanceController@getUsersForIv");
Route::get('/storage/itemAsJSON/{id}', 'InvoiceController@getItemData');
Route::get('/invoice/changedatavalue={id}', 'InvoiceController@changedatavalue');

#Samples
Route::any('/iv','MainController@sampInvoice');
Route::any('/sampDO','MainController@sampDO');
Route::get('/showDO/{id}','ItemController@showDO');
