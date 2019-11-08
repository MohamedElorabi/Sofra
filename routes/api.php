<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
        Route::post('contact-us', 'MainController@contact_us');
        Route::get('categories', 'MainController@categories');
        Route::get('cities', 'MainController@cities');
        Route::get('block', 'MainController@block');
        Route::post('paymentMethods', 'MainController@paymentMethods');

Route::group(['prefix' => 'restaurant'], function () {
        Route::post('restaurant-register', 'Restaurant\RestaurantAuthController@register');
        Route::post('restaurant-login', 'Restaurant\RestaurantAuthController@login');
        Route::post('reset-password', 'Restaurant\RestaurantAuthController@resetPassword');
        Route::post('new-password', 'Restaurant\RestaurantAuthController@newPassword');
        Route::get('payment-method', 'Restaurant\RestaurantMainController@payment_method');

    Route::group(['middleware' => 'auth:restaurant'], function () {
        Route::post('create-item', 'Restaurant\RestaurantMainController@createItems');
        Route::post('edit-item', 'Restaurant\RestaurantMainController@editItem');
        Route::post('delete-item', 'Restaurant\RestaurantMainController@deleteItem');
        Route::post('create-offer', 'Restaurant\RestaurantMainController@createOffer');
        Route::post('edit-offer', 'Restaurant\RestaurantMainController@editOffer');
        Route::post('delete-offer', 'Restaurant\RestaurantMainController@deleteOffer');
        Route::post('profile-edit', 'Restaurant\RestaurantMainController@profileEdit');
        Route::get('show-profile', 'Restaurant\RestaurantMainController@showProfile');
        Route::get('show-items', 'Restaurant\RestaurantMainController@showItems');
        Route::post('show-item', 'Restaurant\RestaurantMainController@showItem');
        Route::post('register-token', 'Restaurant\RestaurantAuthController@registerToken');
        Route::post('remove-token', 'Restaurant\RestaurantAuthController@removeToken');
        Route::get('restaurant-new-order', 'Restaurant\OrderController@restaurantNewOrder');
        Route::get('restaurant-current-order', 'Restaurant\OrderController@restaurantCurrentOrder');
        Route::get('restaurant-old-order', 'Restaurant\OrderController@restaurantOldOrder');
        Route::get('commission', 'Restaurant\OrderController@commission');
        Route::post('accepted-order', 'Restaurant\OrderController@acceptedOrder');
        Route::post('rejected-order', 'Restaurant\OrderController@rejectedOrder');
        Route::post('delivered-order', 'Restaurant\OrderController@deliveredOrder');
        

      });
});

Route::group(['prefix' => 'client'], function () {
      Route::post('client-register', 'Client\ClientAuthController@register');
      Route::post('client-login', 'Client\ClientAuthController@login');
      Route::post('reset-password', 'Client\ClientAuthController@resetPassword');
      Route::post('new-password', 'Client\ClientAuthController@newPassword');
      Route::post('show-offer', 'Client\ClientMainController@showOffer');
      Route::get('show-restaurant-open', 'Client\ClientMainController@showRestaurantOpen');
      Route::get('information-restaurant', 'Client\ClientMainController@informationRestaurant');
      Route::get('restaurant-review-inside', 'Client\ClientMainController@reviewInsideRestaurant');
      Route::get('restaurant-items-inside', 'Client\ClientMainController@itemsInsideRestaurant');
      Route::get('offer-items-restaurant', 'Client\ClientMainController@offerItems');


  Route::group(['middleware' => 'auth:client'], function () {
        Route::post('profile-edit', 'Client\ClientMainController@profileEdit');
        Route::post('register-token', 'Client\ClientAuthController@registerToken');
        Route::post('remove-token', 'Client\ClientAuthController@removeToken');
        Route::post('review', 'Client\ClientMainController@review');
        Route::post('new-order', 'Client\OrderController@newOrder');
        Route::get('client-current-order', 'Client\OrderController@clientCurrentOrder');
        Route::get('client-old-order', 'Client\OrderController@clientOldOrder');
        Route::post('declined-order', 'Client\OrderController@declinedOrder');
        Route::post('delivered-order', 'Client\OrderController@deliveredOrder');
        Route::post('show-order', 'Client\OrderController@showOrder');
        Route::get('show-profile', 'Client\OrderController@showprofile');
        Route::post('edit-profile', 'Client\OrderController@editprofile');
    });
  });
});
