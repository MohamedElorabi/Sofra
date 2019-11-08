<?php

namespace App\Http\Controllers\Api\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
class RestaurantAuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = validator()->make($request->all(),[
      'name' => 'required',
      'email' => 'required|unique:restaurants',
      'phone' => 'required',
      'block_id' => 'required',
      'password' => 'required|confirmed',
      'min' => 'required',
      'fees' => 'required',
      'restaurant_phone' => 'required',
      'whatsup' => 'required',

    ]);

    if ($validator->fails())
    {
      return responseJson(0,$validator->errors()->first(),$validator->errors());
    }

    $request->merge(['password' => bcrypt($request->password)]);
    $restaurant = Restaurant::create($request->all());
    $restaurant->api_token = str_random(60);
    $restaurant->save();
    return responseJson(1,'تم الاضافة بنجاح',[
      'api_token' => $restaurant -> api_token,
      'restaurant' => $restaurant
    ]);
  }


  // login
    public function login(Request $request)
      {
        $validator = validator()->make($request->all(),[
          'email' => 'required',
          'password' => 'required',
        ]);

        if ($validator->fails())
        {
          return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $restaurnt = Restaurant::where('email',$request->email)->first();
        if($restaurnt)
        {
            if(Hash::check($request->password,$restaurnt->password))
            {
                return responseJson(1,'تم تسجيل الدخول بنجاح',[
                  'api_token' => $restaurnt->api_token,
                  'client' =>$restaurnt
                ]);
            }else{
              return responseJson(0,'بيانات الدخول غير صحيحة');
            }
        }else{
            return responseJson(0,'بيانات الدخول غير صحيحة');
        }

      }


      public function resetPassword(Request $request)
      {
        $validation = validator()->make($request->all(),[
          'email' => 'required',

        ]);

        if ($validation->fails()){
          $data = $validation->errors();
          return responseJson(0,$validation->errors()->first(),$data);
        }


    $restaurnt = Restaurant::where('email',$request->email)->first();
    if($restaurnt)
    {
      $code = rand(1111,9999);
      $update = $restaurnt->update(['pin_code' => $code]);
      if($update){
        // send email
        Mail::to($restaurnt->email)
          ->bcc("elorabi199@gmail.com")
          ->send(new ResetPassword($code));

          return responseJson(1,'برجاء فحص الايميل',
          [
            'pin_code_for_test' => $code,
          ]);
      }else{
        return responseJson(0,'حدث خطأ. حاول مرة أخرى ');
      }
    }else{
        return responseJson(0, 'لا يوجد حساب مرتبط بهذا الايميل');
    }

  }


  public function newPassword(Request $request)
  {
      $validation = validator()->make($request->all(), [
        'pin_code' => 'required',
        'email' => 'required',
        'password' => 'required|confirmed'
      ]);

      if ($validation->fails()) {

        return responseJson(0, $validation->errors()->first(),$data);

      }

      $restaurnt = Restaurant::where('pin_code', $request->pin_code)->where('pin_code','!=',0)
      ->where('email',$request->email)->first();

      if($restaurnt)
      {
        $restaurnt->password = bcrypt($request->password);
        $restaurnt->pin_code = null;

        if($restaurnt->save())
        {
          return responseJson(1, 'تم تغيير كلمة المروو بنجاح');
        }else{
          return responseJson(0, 'حدث خطأ , حاول مرة أخرى');
        }
      }else{
        return responseJson(0, 'هذا الكود غير صالح');
      }
  }


  public function registerToken(Request $request)
  {
    $validator = validator()->make($request->all(),[
      'token' => 'required',
      'type' => 'required|in:android,ios',
    ]);

    if ($validator->fails()){
      return responseJson(0, $validator->errors()->first(), $validator->errors());
    }

    Token::where('token',$request->token)->delete();
    $token = $request->user()->tokens()->create($request->all());
    return responseJson(1, 'success');
  }

  public function removeToken(Request $request)
  {
      $validator = validator()->make($request->all(),[
          'token' => 'required'
      ]);

      if ($validator->fails()) {
          $data = $validator->errors();
          return responseJson(0, $validator->errors()->first(), $data);
      }

      Token::where('token',$request->token)->delete();

      return responseJson(1,'تم المسح بنجاح ');
  }
}
