<?php

namespace App\Http\Controllers\Api\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class ClientAuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = validator()->make($request->all(),[
      'name' => 'required',
      'phone' => 'required',
      'email' => 'required|unique:clients',
      'password' => 'required|confirmed',
      'block_id' => 'required',

    ]);

    if ($validator->fails())
    {
      return responseJson(0,$validator->errors()->first(),$validator->errors());
    }

    $request->merge(['password' => bcrypt($request->password)]);
    $client = Client::create($request->all());
    $client->api_token = str_random(60);
    $client->save();
    return responseJson(1,'تم الاضافة بنجاح',[
      'api_token' => $client -> api_token,
      'client' => $client
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

      $client = Client::where('email',$request->email)->first();
      if($client)
      {
          if(Hash::check($request->password,$client->password))
          {
              return responseJson(1,'تم تسجيل الدخول بنجاح',[
                'api_token' => $client->api_token,
                'client' =>$client
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


  $client = Client::where('email',$request->email)->first();
  if($client)
  {
    $code = rand(1111,9999);
    $update = $client->update(['pin_code' => $code]);
    if($update){
      // send email
      Mail::to($client->email)
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
        $data = $validation->errors();
        return responseJson(0, $validation->errors()->first(),$data);

      }

      $client = Client::where('pin_code', $request->pin_code)->where('pin_code','!=',0)
      ->where('email',$request->email)->first();

      if($client)
      {
        $client->password = bcrypt($request->password);
        $client->pin_code = null;

        if($client->save())
        {
          return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
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
        'type' => 'required|in:android,ios'
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
