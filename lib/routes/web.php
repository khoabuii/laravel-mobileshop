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
        Route::group(['prefix' => 'category'], function () {
            Route::get("/","CateController@getCate");
            Route::post("/","CateController@postCate");

            Route::get("delete","cateController@getDelete");
        });
    });

});
