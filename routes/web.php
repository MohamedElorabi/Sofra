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

Route::group(['namespace' => 'Front'], function() {
   // Route::group(['middleware' => 'check-auth'],function(){
      Route::get('restaurant-register', 'AuthController@get_register');
      Route::post('restaurant-register', 'AuthController@registerRestaurant');
      Route::get('restaurant-login', 'AuthController@get_login');
      Route::post('restaurant-login', 'AuthController@loginRestaurant');
      Route::get('client-register', 'AuthController@get_registerClient');
      Route::post('client-register', 'AuthController@registerClient');
      Route::get('client-login', 'AuthController@clientLogin');
      Route::post('client-login', 'AuthController@PostClientLogin');
   // });
    Route::get('/', 'MainController@home')->name('index');
    Route::get('offers','MainController@offers');
    Route::get('restaurants','MainController@restaurants');
    Route::get('restaurant-details/{id}','MainController@restaurantDetails');
    Route::get('restaurant-meals/{id}','MainController@restaurantMeals');
    Route::get('meal-details/{id}','MainController@mealDetails');
    Route::get('contact','MainController@contact');
    Route::post('contact','MainController@postContact');

    Route::group(['middleware' => 'auth:web-client'], function (){

        Route::get('client-logout','AuthController@clientLogout');
        Route::get('client-account','MainController@getClientAccount');
        Route::post('client-account','MainController@postClientAccount');
        Route::get('client-current-orders','MainController@clientCurrentOrders');
        Route::get('client-past-orders','MainController@clientPostOrders');
        Route::get('client-delivered/{id}','MainController@clientDeliverOrder');
        Route::get('client-declined/{id}','MainController@clientDeclineOrder');


        Route::post('add-comment','MainController@addComment');

      });

       Route::group(['middleware' => 'auth'], function (){

        Route::get('restaurant-logout',function(){return 1;});
        Route::get('restaurant-offers','MainController@RestaurantOffers');
        Route::get('add-offer','MainController@addOffer');
        Route::post('add-offer','MainController@PostAddOffer');
        Route::get('add-item','MainController@addItem');
        Route::post('add-item','MainController@PostAddItem');
        Route::get('restaurant-account','MainController@restaurantAccount');
        Route::post('restaurant-account','MainController@PostRestaurantAccount');
        Route::get('restaurant-current-orders','MainController@restaurantCurrentOrders');
        Route::get('restaurant-past-orders','MainController@restaurantPostOrders');
        Route::get('restaurant-new-orders','MainController@restaurantNewOrders');
        Route::get('restaurant-accepted/{id}','MainController@restaurantAcceptOrder');
        Route::get('restaurant-rejected/{id}','MainController@restaurantRejectOrder');
        Route::get('restaurant-delivered/{id}','MainController@restaurantDeliverOrder');

     });
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Admin panel
Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath']] ,  function()
{
Route::group(['middleware' => ['auth','auto-check-permission'] , 'namespace' => 'Admin', 'prefix' => 'admin'] , function(){
    Route::resource('restaurants', 'RestaurantsController');
    Route::get('active/{id}','RestaurantsController@active');
    Route::get('disactive/{id}','RestaurantsController@disactive');
    Route::resource('categories', 'CategoryController');
    Route::resource('orders', 'OrderController');
    Route::resource('cities', 'CityController');
    Route::resource('blocks', 'BlockController');
    Route::resource('financial-operations', 'FinancialOperationsController');
    Route::resource('offers', 'OfferController');
    Route::resource('clients', 'ClientsController');
    Route::resource('payments', 'PaymentController');
    Route::resource('contacts', 'ContactController');
    Route::resource('settings', 'SettingController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');

      //  User reset  Password
      Route::get('user/change-password', 'UserController@getChangePassword');

});
});
Route::post('user/change-password', 'UserController@changePassword_save');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
