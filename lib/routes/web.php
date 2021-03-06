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

// profile
Route::get('/user','UserController@getUser');
Route::get('user/edit','UserController@getUserEdit');
Route::post('user/edit','UserController@postUserEdit');
//search
Route::get('search','IndexController@getSearch');
// feedback
Route::get('feedback','IndexController@getFeedback');
Route::post('feedback','IndexController@postFeedback');
//comment
Route::post('/product/{id}-{prod_slug}','detailController@postCommentProduct');
Route::post('/blog/{id}-{prod_slug}','detailController@postCommentBlog');
//cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('/','cartController@getCart');
    Route::get('add/{id}','cartController@getAdd');
    Route::get('order/{id}','cartController@getOrder');
    Route::get('update','cartController@getUpdate');
    Route::get('deleteAll/{id}','cartController@getDeleteAllUser');
    Route::get('delete/{id}','cartController@getDeleteCart');
    Route::get('updatePlus/{id}','cartController@getUpdateCartPlus');
    Route::get('updateReduct/{id}','cartController@getUpdateCartReduct');
});
// cancel bill by User
Route::get('/cancelbill/{id}','UserController@getCancelBill');
//
Route::get('checkout','cartController@getCheckout');
Route::post('checkout','cartController@postCheckout');
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
            //customer
            Route::group(['prefix'=>'customers','middleware'=>'CheckLogoutAdmin'],function(){
                Route::get('/','AdminController@getCustomers');
                Route::get('delete/{id}','AdminController@getDeleteCustomers');
            });

            Route::group(['prefix' => 'feedback','middleware'=>'CheckLogoutAdmin'],function(){
                 Route::get('/','AdminController@getFeedback');
                 Route::get('delete/{id}','AdminController@getFeedbackDelete');
            });

            Route::group(['prefix' => 'order','middleware'=>'CheckLogoutAdmin'], function () {
                Route::get('/','AdminController@getOrder');
                Route::get('view/{id}','AdminController@getViewOrder');
                Route::post('view/{id}','AdminController@postViewOrder');
            });

        });
    });

