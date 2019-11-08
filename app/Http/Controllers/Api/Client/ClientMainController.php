<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Restaurant;
use App\Models\Offer;
use App\Models\Item;
class ClientMainController extends Controller
{
    public function review(Request $request)
    {
      $validator =  validator()->make($request->all() , [
            'comment' => 'required',
            'react' => 'required',
            'client_id' =>  'exists:clients,id',
            'restaurant_id' => 'exists:restaurants,id'
        ]);


        $review = Review::create($request->all());

        $review->save();

        return responseJson(1,'success', $review);
    }


    public function showOffer(Request $request)
    {
      $offer = Offer::find($request->offer_id);
      return responseJson(1, 'success',$offer);
    }


  public function reviewInsideRestaurant(Request $request)
  {
      $validator = validator()->make($request->all(), [
          'restaurant_id' => 'required|exists:restaurants,id', // |exists:restaurants,id
      ]);
      if ($validator->fails()) {
          return responseJson(0, $validator->errors()->first(), $validator->errors());
      }
      $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
      $review = Review::where('restaurant_id', $request->restaurant_id)->get();
      return responseJson(1, 'تمت الاضافه بنجاح', [
          'restaurant' => $restaurant,
          'restaurant review' => $review,
      ]);
  }

  public function itemsInsideRestaurant(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id', // |exists:restaurants,id
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
        $items = Item::where('restaurant_id', $request->restaurant_id)->get();
        return responseJson(1, 'تمت الاضافه بنجاح', [
            'restaurant' => $restaurant,
            'restaurant items' => $items,
        ]);
    }

    public function offerItems(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id', // |exists:restaurants,id
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $item = Item::where('restaurant_id' , $request->restaurant_id)->where('offer', '!=', null)->get();
        if (!empty($item)) {
            return responseJson(1, 'تمت العمليه بنجاح', $item);
        }
        return responseJson(0, 'لا توجد عروض');
    }

    public function informationRestaurant(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id', // |exists:restaurants,id
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
        return responseJson(1, 'تمت الاضافه بنجاح', [
            'restaurant' => $restaurant
        ]);
    }



}
