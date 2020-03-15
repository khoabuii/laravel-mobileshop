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
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'login'],function() {
            Route::get("/","LoginAdminController@getLogin");
            Route::post("/","LoginAdminController@postLogin");
        });
        Route::get('logout','LoginAdminController@getLogout');
        Route::get('home','AdminController@getHome');
        // Category
        Route::group(['prefix' => 'category'], function () {
            Route::get("/","CateController@getCate");
            Route::post("/","CateController@postCate");

            Route::get("delete/{id}","cateController@getDelete");
            Route::get("edit/{id}","cateController@getEdit");
            Route::post("edit/{id}","cateController@postEdit");
        });
        // Product
        Route::group(['prefix'=>'product'],function(){
            Route::get("/","productController@getProduct");
            Route::post('/',"productController@postProduct");
//add
            Route::get("add","productController@getAdd");
            Route::post("add","productController@postAdd");
            //edit product
            Route::get("edit/{id}","productController@getEdit");
            Route::post("edit/{id}","productController@postEdit");
            //delete product
            Route::get("delete/{id}","productController@getDelete");
            });
        });
    });

