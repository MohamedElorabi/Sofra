<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Offer;
use App\Models\Restaurant;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class RestaurantMainController extends Controller
{
    public function createItems(Request $request)
    {
      $validator =  validator()->make($request->all() , [
            'image' => 'required',
            'name' => 'required',
            'description' =>  'required',
            'price' =>   'required',
            'restaurnt_id' => 'exists:restaurnts,id'
        ]);


        $item = Item::create($request->all());

        $item->save();

        return responseJson(1,'success', $item);
    }

    public function editItem(Request $request)
    {
        $validator = validator()->make($request->all(), [
          'image' => 'required',
          'name' => 'required',
          'description' => 'required',
          'price' => 'required',
          'item_id' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson(0, $validator->errors()->first(), $validator->errors());
            }
            $item = $request->user()->items()->find($request->item_id);
            $item->update($request->all());

        return responseJson(1,'success updated',$item);
    }


    public function deleteItem(Request $request)
    {
      $validator = validator()->make($request->all(), [
        'item_id' => 'required|exists:items,id',
      ]);
      if ($validator->fails()) {
          return responseJson(0, $validator->errors()->first(), $validator->errors());
      }

      $item = $request->user()->items()->find($request->item_id);
      if(!$item) {
        return responseJson(0,'no item found');
      }
      $item->delete();

      return responseJson(1,'deleted');
    }


    public function createOffer(Request $request)
    {
      $validator =  validator()->make($request->all() , [
            'name' => 'required',
            'description' =>  'required',
            'from' =>   'required',
            'to' =>   'required',
            'restaurant_id' => 'exists:restaurants,id',
        ]);


        $offer = Offer::create($request->all());

        $offer->save();

        return responseJson(1,'success', $offer);
    }

    public function editOffer(Request $request)
    {
      $validator =  validator()->make($request->all() , [
            'image' => 'required',
            'name' => 'required',
            'description' =>  'required',
            'from' =>   'required',
            'to' =>   'required',
            'restaurant_id' => 'exists:restaurants,id',
        ]);


        if ($validator->fails()) {

            return responseJson(0, $validator->errors()->first(), $validator->errors());
            }
            $offer = $request->user()->offers()->find($request->offer_id);
            $offer->update($request->all());

        return responseJson(1,'success updated',$offer);
    }

    public function deleteOffer(Request $request)
    {
      $validator = validator()->make($request->all(), [
        'offer_id' => 'required|exists:offers,id',
      ]);
      if ($validator->fails()) {
          return responseJson(0, $validator->errors()->first(), $validator->errors());
      }

      $offer = $request->user()->offers()->find($request->offer_id);
      if(!$offer) {
        return responseJson(0,'no offer found');
      }
      $offer->delete();

      return responseJson(1,'deleted');
    }

    public function profileEdit(Request $request)
    {
        $validator = validator()->make($request->all(), [
          'name' => 'required',
          'email' => 'required|unique:restaurants,email,' . $request->user()->id,
          'phone' => 'required',
          'block_id' => 'required',
          'password' => 'required|confirmed',
          'min' => 'required',
          'fees' => 'required',
          'restaurnt_phone' => 'required',
          'whatsup' => 'required',
        ]);


        if ($validator->fails()) {

            return responseJson(0, $validator->errors()->first(), $validator->errors());
            }


        if(request()->has('password')){

            $request->merge(['password' => bcrypt($request->password)]);
        }
        $request->user()->update($request->all());

        return responseJson(1,'success updated',['user' => $request->user()]);
    }



    public function showItems(Request $request)
    {
      $items = $request->user()->items()->get();
      return responseJson(1, 'success', $items);
    }

    public function showItem(Request $request)
    {
      $validator = validator()->make($request->all(), [
        'item_id' => 'required|exists:items,id',
      ]);
      if ($validator->fails()) {
          return responseJson(0, $validator->errors()->first(), $validator->errors());
      }

      $item = $request->user()->items()->find($request->item_id);

      return responseJson(1,'success', $item);
    }

    public function showProfile(Request $request)
    {

      return responseJson(1, 'success',['restaurant'=>$request->user()]);
    }
}
