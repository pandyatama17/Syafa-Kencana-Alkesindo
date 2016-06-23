<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {

    // Route::get('/', 'HomeController@welcome');
    Route::auth();
    // Route::get('/home', 'HomeController@index');
    // Route::resource('products', 'ProductsController');
    // Route::get('catalogs', 'CatalogsController@index');
    // Route::resource('categories', 'CategoriesController');

    #basic Routing
    Route::get('/', 'MainController@index');
    Route::get('/home', 'MainController@index');

    #Profile Routing
    Route::get('/profile', 'UserController@profile');
    Route::post('/profile/updateinfo', 'UserController@profileUpdateInfo');
    Route::post('/profile/changepassword', 'UserController@profileChangePassword');
    Route::post('/profile/updateimage', 'UserController@updateAvatar');

    /* Storage Routing */
    Route::any('/storage','ItemController@index');
    Route::any('/item/list','ItemController@index');
    Route::any('/item/add/','ItemController@create');
    Route::post('/item/store','ItemController@store');
    Route::get('/item/show/{id}', 'ItemController@show');
    Route::post('/item/update/', 'ItemController@update');
    Route::get('/item/in/', 'ItemController@in');
    Route::post('/item/in/store', 'ItemController@inStore');

    Route::any('/storage/restock','ItemController@restock');
    Route::any('/storage/restock/store','ItemController@itemInSave');
    Route::get('/storage/delete/{id}', 'ItemController@destroy');
    Route::get('/storage/restock/{id}','ItemController@restockItem');
    Route::any('/storage/invoice/list', 'InvoiceController@listPending');
    Route::any('/storage/restock_report', 'MainController@itemInReport');
    Route::any('/storage/purchase', 'ItemController@purchase');

    /* Supplier Routing */
    Route::any('/supplier','SupplierController@index');
    Route::any('/supplier/add','SupplierController@create');
    Route::post('/supplier/add/store','SupplierController@store');
    Route::get('/supplier/delete/{id}', 'SupplierController@destroy');

    #Owner Routing
    Route::any('/owner', 'MainController@owner');

    #Finance Routing
    Route::any('/finance',"FinanceController@index");

    #Invoice Routing
    Route::any('/invoice/create', 'InvoiceController@create');
    Route::any('/invoice/store', 'InvoiceController@store');
    Route::any('/invoice',"InvoiceController@index");
    Route::get('/invoice/show/{id}', 'InvoiceController@show');

    #DeliveryOrder Routing
    Route::any('/deliveryorder', 'DeliveryOrderController@index');
    Route::any('/deliveryorder/create', 'DeliveryOrderController@create');
    Route::any('/deliveryorder/create/base/{id}', 'DeliveryOrderController@createWithInvoice');
    Route::any('/deliveryorder/show/{id}', 'DeliveryOrderController@show');
    Route::post('/deliveryorder/store', 'DeliveryOrderController@store');

    #Piutang Routing
    Route::any('/piutang/all', 'PiutangController@all');
    Route::any('/piutang/done', 'PiutangController@done');
    Route::any('/piutang/pending', 'PiutangController@pending');
    Route::get('/piutang/check/{id}', 'PiutangController@check');
    Route::post('/piutang/repayment', 'PiutangController@repayment');
    Route::get('/piutang/rekap', 'PiutangController@rekap');

    #Hutang Routing
    Route::any('/hutang/all', 'HutangController@all');
    Route::any('/hutang/done', 'HutangController@done');
    Route::any('/hutang/pending', 'HutangController@pending');
    Route::get('/hutang/check/{id}', 'HutangController@check');
    Route::post('/hutang/repayment', 'HutangController@repayment');
    Route::get('/hutang/rekap', 'HutangController@rekap');

    #Admin User Routing
    Route::any('/admin', 'MainController@admin');
    Route::any('/user/list', 'UserController@index');
    Route::any('/user/create', 'UserController@create');
    Route::any('/user/store', 'UserController@store');
    Route::any('/user/show/{id}', 'UserController@show');

    #Order Routing
    Route::any('/order/list','OrderController@index');
    Route::any('/order/new','OrderController@create');
    Route::any('/order/new/store','OrderController@store');
    Route::any('/order/show/{id}','OrderController@show');

    #Customer Routing
    Route::any('/customer/list','CustomerController@index');
    Route::any('/customer/add','CustomerController@create');
    Route::post('/customer/store','CustomerController@store');

    #JSON Controls
    Route::get('/finance/usersJSON/{id}',"FinanceController@getUsersForIv");
    Route::get('/invoice/changedatavalue={id}', 'InvoiceController@changedatavalue');
    Route::get('/item/itemAsJSON/{id}', 'ItemController@getItemJSON');
    Route::get('/customer/customerAsJSON/{id}', 'CustomerController@getCustomerJSON');
    Route::get('/supplier/supplierAsJSON/{id}', 'SupplierController@getSupplierJSON');
    Route::get('/item/in/changeSupplier/{id}', 'ItemController@changeSupplier');

    #Samples
    Route::any('/iv','MainController@sampInvoice');
    Route::any('/sampDO','MainController@sampDO');
    Route::get('/showDO/{id}','ItemController@showDO');

    Route::any('/sample', 'HomeController@index');
    Route::get('/sample/login/auth', 'UserController@auth');
});
