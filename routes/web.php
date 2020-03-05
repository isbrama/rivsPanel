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

Route::get('/', function () {
    return view('welcome');
});

//GENERAL
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//PRODUCTS
Route::get('/produits_liste', 'productsController@products')->name('products.list');
Route::get('/products', 'productsController@gestion')->name('products.gestion');
Route::post('/product_add', 'productsController@add')->name('products.add');
Route::post('/product_update/{id}', 'productsController@modify')->name('products.modify');
Route::get('/product_del/{id}', 'productsController@delete')->name('products.delete');
Route::get('/product_img/{filename}', 'productsController@getImage')->name('products.image');
//BANK
Route::get('/bank_add/{id?}', 'bankController@add')->name('bank.add');
Route::get('/bank_del/{id?}', 'bankController@delete')->name('bank.del');
Route::get('/car', 'bankController@car')->name('bank.car');
Route::get('/bank_delete', 'bankController@deleteAll')->name('bank.delete');
Route::get('/bank_delone/{id?}', 'bankController@deleteOne')->name('bank.delone');

//ORDERS
Route::get('/monhistorique', 'ordersController@mylist')->name('orders.mylist');
Route::get('/historique', 'ordersController@gestion')->name('orders.gestion');
Route::post('/orders_add', 'ordersController@add')->name('orders.add');
Route::get('/orders_detail/{id}', 'ordersController@detail')->name('orders.detail');
Route::get('/orders_del/{id}', 'ordersController@delete')->name('orders.delete');

//USERS
Route::get('/usagers', 'usersController@gestion')->name('users.gestion');
Route::post('/user_update/{id}', 'usersController@modify')->name('users.modify');
Route::get('/user_del/{id}', 'usersController@delete')->name('users.delete');

//CATEGORY
Route::get('/category', 'categoryController@gestion')->name('category.gestion');
Route::post('/category_update/{id}', 'categoryController@modify')->name('category.modify');
Route::post('/category_add', 'categoryController@add')->name('category.add');
Route::get('/category_del/{id}', 'categoryController@delete')->name('category.delete');
