<?php
Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('admin/login', 'Admin\Auth\LoginController@getLoginForm');
    Route::get('admin/', 'Admin\Auth\LoginController@getLoginForm');
    Route::post('admin/authenticate', 'Admin\Auth\LoginController@authenticate')->name('adminLogin');

});

Route::get('admin/no-permission','Admin\AdminController@noPermission')->name('NO_PERMS');
Route::get('/admin/test','Admin\TestController@test');
Route::group(['middleware' => ['admin']], function () {
    Route::get('admin/dashboard', 'Admin\AdminController@dashboard')->name('DASHBOARD');
    Route::post('admin/dashboard/filter', 'Admin\AdminController@dashboardFilter')->name('DASHBOARD');
    Route::get('admin/logout', 'Admin\Auth\LoginController@getLogout');

});

//Customers
Route::prefix('admin/customers')->group(function(){
    Route::get('/','Admin\CustomerController@index')->name('list-customer');
    Route::get('/details/{id}','Admin\CustomerController@view')->name('view-customer');
    Route::get('/edit/{id}','Admin\CustomerController@edit')->name('edit-customer');
    Route::post('/update/{id}','Admin\CustomerController@update')->name('update-customer');
});

//Pages
Route::prefix('admin/pages')->group(function(){
    Route::get('/','Admin\PagesController@index')->name('list-pages');
    Route::get('/add','Admin\PagesController@add')->name('add-pages');
    Route::post('/add','Admin\PagesController@save')->name('save-pages');
    Route::get('/edit/{id}','Admin\PagesController@edit')->name('edit-pages');
    Route::post('/edit/{id}','Admin\PagesController@update')->name('update-pages');
    Route::get('/view/{id}','Admin\PagesController@view')->name('view-pages');
});
