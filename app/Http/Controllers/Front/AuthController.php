<?php

namespace App\Http\Controllers\Front;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
  public function get_registerClient()
  {
    $cities = City::all();
     return view('front.client.auth.register',compact('cities'));
  }


  public function registerClient(Request $request)
    {
      $this->validate($request, [
              'name' => 'required',
              'email' => 'required|unique:clients',
              'phone' => 'required',
              'password' => 'required',
              'city_id' => 'required',
              'block_id' => 'required',
              'image' => 'required',
          ], [
              'name.required' => 'يجب كتابه الاسم',
              'email.required' => 'يجب كتابه الايميل',
              'number_phone.required' => 'يجب كتابه رقم الهاتف',
              'password.required' => 'يجب كتابه الرقم السرى',
              'city_id.required' => 'يجب اختيار المدينه',
              'block_id.required' => 'يجب كتابه تاريخ الميلاد',
              'image.required' => 'يجب اختيار صوره',
          ]);

          $request->merge(['password'=>bcrypt($request->password)]);
          $client = Client::create($request->all());
          if ( $request->hasFile('image')  ) {
              $image = $request->image;
              $image_new_name = time() . $image->getClientOriginalName();
              $image->move('uploads/clients', $image_new_name);

              $client->image = 'uploads/clients/'.$image_new_name;
              $client->save();
          }
          $client->api_token = str_random(60);
          $client->save();
          flash()->success("تم انشاء الحساب بنجاح");
          return redirect(url('/'));
    }

  public function clientLogin()
   {
     return view('front.client.auth.login');
   }


   public function PostClientLogin(Request $request)
      {
        $rememberme = request('rememberme') == 1 ? true : false;
      if (auth()->guard('web-client')->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
          return redirect()->route('index');
      } else {
          return back()->with('error', 'Wrong Login Details');
      }
      }

  public function clientLogout()
    {
      if (auth('client')->check())
      {
          auth()->guard('client')->logout();
          return redirect()->route('index');
      }
      return redirect()->back();
    }
    public function resetPasswordClient(Request $request) {
          $this->validate($request, [
              'email' => 'required',
          ]);

          $user = Client::where('email',$request->email)->first();
  //        dd($user);
          if ($user) {
              $code = rand(1111, 9999);
  //            $code = random_int(1111, 9999);
              $update = $user->update(['pin_code' => $code]);
  //            dd($user->update(['pin_code' => $code])) ;
              if ($update) {

                  Mail::to($user->email)
                      ->bcc('mido.15897@gmail.com')
                      ->send(new ResetPassword($code));
                  return redirect()->route('auth.resetClient');
              } else {
                  return back()->with('error', 'Wrong Email Details');
              }
          } else {
              return back()->with('error', 'Wrong Email Details');
          }

      }

      public function newPasswordClient()
      {
          return view('front.auth.newPasswordClient');
      }

      public function postNewPasswordClient(Request $request) {
          $this->validate($request, [
              'pin_code' => 'required',
              'email' => 'required',
              'password' => 'required|confirmed',
          ]);

          $user = Client::where('pin_code',$request->pin_code)->where('pin_code', '!=' , 0)
              ->where('email',$request->email)->first();
          if ($user) {
              $user->password = bcrypt($request->password);
              $user->pin_code = null;

              if ($user->save())
              {
                  return redirect()->route('front.client.get');
              } else {
                  return back()->with('error', 'Wrong email Or Code Or Password Details');
              }
          } else {
              return back()->with('error', 'Wrong email Or Code Or Password Details');
          }
      }













    public function get_register()
    {
      return view('front.restaurant.auth.register');
    }

    public function registerRestaurant(Request $request)
    {
      $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:restaurants',
            'phone' => 'required',
            'password' => 'required',
            'city_id' => 'required',
            'block_id' => 'required',
            'image' => 'required',
            'min' => 'required',
            'delivery_cost' => 'required',
            'whatsup' => 'required',
            'restaurant_phone' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'يجب كتابه الاسم',
            'email.required' => 'يجب كتابه الايميل',
            'phone.required' => 'يجب كتابه رقم الهاتف',
            'password.required' => 'يجب كتابه الرقم السرى',
            'city_id.required' => 'يجب اختيار المدينه',
            'block_id.required' => 'يجب اختيار الحى',
            'image.required' => 'يجب اختيار صوره',
            'min.required' => 'يجب كتابه الحد الادفى للطلب',
            'delivery_cost.required' => 'يجب كتابه سعر خدمه التوصيل',
            'whatsup.required' => 'يجب كتابه رقم الواتس اب',
            'restaurant_phone.required' => 'يجب كتابه رقم هاتف  المطعم',
            'category_id.required' => 'يجب اختيار الاقسام الخاصه بالمطعم',
        ]);

        $request->merge(['password'=>bcrypt($request->password)]);
        $restaurant = Restaurant::create($request->all());
        $restaurant->api_token = str_random(60);
        if ( $request->hasFile('image')  ) {
            $logo = $request->image;
            $logo_new_name = time() . $logo->getClientOriginalName();
            $logo->move('uploads/restaurants', $logo_new_name);

            $restaurant->image = 'uploads/restaurants/'.$logo_new_name;
            $restaurant->save();
        }
        $restaurant->categories()->attach($request->input('category_id'));

        $restaurant->save();
        flash()->success("تم انشاء الحساب بنجاح");
        return redirect(url('/'));
    }



  // Login
public function get_login()
{
// return 1;
  if (auth()->guard('restaurant')->check()) {
    return redirect('/');
  }
  return view('front.restaurant.auth.login');
}



public function loginRestaurant(Request $request)
{
  $this->validate(request(),[
            'email'              => 'required|email|exists:restaurants,email',
            'password'           => 'required',
        ]);
        if (auth()->guard('web-restaurant')->attempt($request->only('email', 'password'))) {
            return redirect(route('index'));
        }else{
            flash()->error('بيانات التسجيل عير صحيحة');
            return back();
        }
}

public function logout(){
  if (auth('web-restaurant')->check()){
          auth()->guard('web-restaurant')->logout();
          return redirect()->route('index');
      }
      return redirect()->back();
 }

}
