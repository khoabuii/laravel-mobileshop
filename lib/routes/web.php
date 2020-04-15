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
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
//home page
Route::get('/','IndexController@getIndex');
// cate product
Route::get('/{id}-{cate_slug}','CateController@getCate');
// blog
Route::get('/blog','CateController@getBlog');

//detail product
Route::get('/product/{id}-{prod_slug}','detailController@getProduct');

//product highlight
Route::get('/product_feature','CateController@getFeature');
// product new
Route::get('/product_new','CateController@getNew');
//detail blog
Route::get('/blog/{id}-{prod_slug}','detailController@getBlog');

//login homepage-google
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
//login homepage
route::get('/login','Auth\LoginController@getLogin');
route::post('/login','Auth\LoginController@postLogin');

Route::get('/register','Auth\LoginController@getRegister');
Route::post('/register','Auth\LoginController@postRegister');
//logout
Route::get('/logout','IndexController@getLogout');
//admin page
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'login','middleware'=>'CheckLoginAdmin'],function() {
            Route::get("/","LoginAdminController@getLogin");
            Route::post("/","LoginAdminController@postLogin");
        });
        Route::get('logout','LoginAdminController@getLogout');
        Route::group(['prefix'=>'home','middleware'=>'CheckLogoutAdmin'],function(){
            Route::get('/','AdminController@getHome');
        });
        // Category
        Route::group(['prefix' => 'category','middleware'=>'CheckLogoutAdmin'], function () {
            Route::get("/","CateController@getCate");
            Route::post("/","CateController@postCate");

            Route::get("delete/{id}","cateController@getDelete");
            Route::get("edit/{id}","cateController@getEdit");
            Route::post("edit/{id}","cateController@postEdit");
        });
        // Product
        Route::group(['prefix'=>'product','middleware'=>'CheckLogoutAdmin'],function(){
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

            // blogs
            Route::group(['prefix' => 'blog','middleware'=>'CheckLogoutAdmin'], function () {
                Route::get('/','blogController@getBlog');
                Route::post('/','blogController@postBlog');
                //add
                Route::get('add','blogController@getAdd');
                Route::post('add','blogController@postAdd');
                //update
                Route::get('edit/{id}','blogController@getEdit');
                Route::post('edit/{id}','blogController@postEdit');
                //delete
                Route::get('delete/{id}','blogController@getDelete');
                //
                Route::resource('blog','blogController');
            });
            // slide
            Route::group(['prefix' => 'slide','middleware'=>'CheckLogoutAdmin'], function () {
                Route::get('/','slideController@getSlide');
                Route::get('add','slideController@getAdd');
                Route::post('add','slideController@postAdd');

                Route::get('edit/{id}','slideController@getEdit');
                Route::post('edit/{id}','slideController@postEdit');
                Route::get('delete/{id}','slideController@getDelete');
            });
        });
    });

