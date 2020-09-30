<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','home@index');
Route::get('/Cart', 'home@ShowCart');
Route::get('/Category/{id}','Category@Listcategory');
Route::get('/Category/','Category@ListCategory');
Route::get('/Product','Product@GetProduct');
Route::get('/ProductDetail/{id}','Product@ProductDetail');

Route::get('/admin/dashboard','AdminController@Admin');
Route::get('/admin/product/','AdminController@product');
Route::get('/admin/category','AdminController@category');
Route::get('/admin/Bill','AdminController@bill');
Route::get('/Search','Category@Search');

Route::post('/Admin/Product/Create', 'AdminController@Create');
Route::post('/Admin/Category/Create', 'AdminController@Create');
Route::post('/Admin/Remove', 'AdminController@Delete');
