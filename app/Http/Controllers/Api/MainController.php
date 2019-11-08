<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\City;
use App\Models\Block;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function contact_us(Request $request)
    {
      $validator =  validator()->make($request->all() , [
            'name' => 'required',
            'email' => 'required',
            'phone' =>   'required',
            'message' =>     'required',
            'type' =>    'required'
        ]);

        $contacts = Contact::create($request->all());

        $contacts->save();

        return responseJson(1,'success', $contacts);
    }


    public function categories()
    {
      $categories = Category::all();

      return responseJson(1,'success', $categories);
    }

    public function cities()
      {
        $cities = City::all();
        return responseJson(1, 'success', $cities);
      }

    public function block(Request $request){
      $blocks = Block::where(function ($query) use($request)
      {
        if($request->has('city_id'))
        {
            $query->where('city_id', $request->city_id);
        }
      })->get();
      return responseJson(1, 'success',$blocks);
    }

    public function paymentMethods()
    {
      $paymentMethods = PaymentMethod::paginate(10);
      return responseJson(1, 'تمت العملية بنجاح', $paymentMethods);
    }
}
