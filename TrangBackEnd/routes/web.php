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

Route::get('/admin','AdminController@loginAdmin');
Route::post('/admin','AdminController@postloginAdmin');

Route::get('/home', function () {
    return view('home');
});
Route::prefix('admin')->group(function () {
    //categories
    Route::prefix('categories')->group(function () {
        Route::get('/',[
            'as' => 'categories.index',
            'uses' =>'CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create',[
            'as' => 'categories.create',
            'uses' =>'CategoryController@create',
            'middleware' => 'can:category-add'

        ]);
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' =>'CategoryController@store'
        ]);

        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' =>'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' =>'CategoryController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' =>'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);

    });
    //menu
    Route::prefix('menu')->group(function () {
        Route::get('/', [
            'as' => 'menu.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create',[
            'as' => 'menu.create',
            'uses' =>'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
        Route::post('/store',[
            'as' => 'menu.store',
            'uses' =>'MenuController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'menu.edit',
            'uses' =>'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'menu.update',
            'uses' =>'MenuController@update'

        ]);

        Route::get('/delete/{id}',[
            'as' => 'menu.delete',
            'uses' =>'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);
    });

    //slider
    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' => 'slider.index',
            'uses' => 'SliderAdminController@index',
            'middleware' => 'can:slider-list'
        ]);

        Route::get('/create', [
            'as' => 'slider.create',
            'uses' => 'SliderAdminController@create',
            'middleware' => 'can:slider-add'
        ]);


        Route::post('/store', [
            'as' => 'slider.store',
            'uses' => 'SliderAdminController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'slider.edit',
            'uses' => 'SliderAdminController@edit',
            'middleware' => 'can:slider-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'slider.update',
            'uses' => 'SliderAdminController@update',
            'middleware' => 'can:slider-edit'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'slider.delete',
            'uses' => 'SliderAdminController@delete',
            'middleware' => 'can:slider-delete'
        ]);




    });

    //settings
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'AdminSettingController@index'
        ]);
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'AdminSettingController@create'
        ]);
        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'AdminSettingController@store'
        ]);
        Route::get('/edit{id}', [
            'as' => 'settings.edit',
            'uses' => 'AdminSettingController@edit'
        ]);

        Route::post('/update{id}', [
            'as' => 'settings.update',
            'uses' => 'AdminSettingController@update'
        ]);

        Route::get('/delete{id}', [
            'as' => 'settings.delete',
            'uses' => 'AdminSettingController@delete'
        ]);



    });

    //users
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index',
            'middleware' => 'can:user-list'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create',
            'middleware' => 'can:user-add'
        ]);

        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit',
            'middleware' => 'can:user-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update',
            'middleware' => 'can:user-edit'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete',
            'middleware' => 'can:user-delete'
        ]);

    });

    //roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index',
            'middleware' => 'can:roles-list'
        ]);

        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create',
            'middleware' => 'can:roles-add'
        ]);

        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit',
            'middleware' => 'can:roles-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update',
            'middleware' => 'can:roles-edit'
        ]);


    });

    //permissions
    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@createPermissions'
        ]);

        Route::POST('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);



    });

    //order
    Route::prefix('order')->group(function () {
        Route::get('/order', [
            'as' => 'order.index',
            'uses' => 'OrderController@index'
        ]);
        Route::get('/order-view/{id}', [
            'as' => 'view.order',
            'uses' => 'OrderController@view_order'
        ]);
        Route::get('/order-delete/{id}', [
            'as' => 'delete.order',
            'uses' => 'OrderController@delete_order'
        ]);



    });
});




