<?php

namespace App\Http\Controllers\Front;
use App\Models\Restaurant;
use App\Models\Offer;
use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function home()
    {
  dd(auth()->guard('restaurant')->check());
      $restaurants = Restaurant::paginate(6);
      return view('front/home',  compact('restaurants'));
    }

    public function contact()
  {
      return view('front.contact');
  }

  public function postContact()
  {
      $data = $this->validate(request(),[
          'name' => 'required|string',
          'email' => 'required|email',
          'phone' => 'required|digits:11',
          'message' => 'required',
          'type' => 'required|in:complain,suggest,enquiry'
      ]);
      Contact::create($data);
      flash()->success('تم التواصل');
      return back();
  }

  public function offers()
  {
      $offers = Offer::latest()->paginate(10);
      return view('front.offers',compact('offers'));
  }

  public function addOffer()
  {
      return view('front.restaurant.add-offer');
  }

  public function PostAddOffer()
  {
      $this->validate(request(),[
          'name' => 'required|string',
          'description' => 'required|string',
          'from' => 'required|date',
          'to' => 'required|date',
          'image' => 'nullable'
      ]);
      $offer = request()->user()->offers()->create(request()->all());
      if (request()->hasFile('image')) {
          $path = public_path();
          $destinationPath = $path . '/uploads/restaurant'; // upload path
          $logo = request()->file('image');
          $extension = $logo->getClientOriginalExtension(); // getting image extension
          $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
          $logo->move($destinationPath, $name); // uploading file to given path
          $offer->image =   'uploads/restaurant' . $name;
      }
      $offer->save();
      flash()->success('تم الاضافة');
      return back();
  }

  public function RestaurantOffers()
  {
      $offers = Offer::where('restaurant_id',auth()->user()->id)->get();
      return view('front.offers',compact('offers'));
  }

  public function addItem()
  {
      return view('front.restaurant.add-item');
  }

  public function PostAddItem()
  {
      $this->validate(request(),[
          'name' => 'required|string',
          'description' => 'required|string',
          'price' => 'required|numeric',
          'image' => 'nullable'
      ]);
      $item = request()->user()->items()->create(request()->all());
      if (request()->hasFile('image')) {
          $path = public_path();
          $destinationPath = $path . '/uploads/restaurant'; // upload path
          $logo = request()->file('image');
          $extension = $logo->getClientOriginalExtension(); // getting image extension
          $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
          $logo->move($destinationPath, $name); // uploading file to given path
          $item->image =   'uploads/restaurant' . $name;
      }
      $product->save();
      flash()->success('تم الاضافة');
      return back();
  }

  public function restaurantAccount()
{
    $profile = request()->user();
    return view('front.restaurant.restaurant-account',compact('profile'));
}

public function PostRestaurantAccount()
{
    $this->validate(request(),[
        'name'               => 'required|string',
        'email'              => 'required|email|unique:restaurants,email,' . request()->user()->id,
        'phone'              => 'required|digits:11|unique:restaurants,phone,' . request()->user()->id,
        'password'           => 'required|confirmed|min:8',
        'district_id'        => 'required|exists:districts,id',
        'image'              => 'nullable',
        'category_id'        => 'required|exists:categories,id',
        'delivery_cost'    => 'required|numeric',
        'min'      => 'required|numeric',
        'contact_phone'      => 'required|digits:11',
        'whats'              => 'required|digits:11',
    ]);
    if(request()->has('password')){
        request()->merge(['password' => bcrypt(request()->password)]);
    }
    $restaurant = request()->user()->update(request()->except('image'));
    if (request()->hasFile('image')) {
        if(file_exists($restaurant->image))
        {
            unlink($restaurant->image);
        }
        $path = public_path();
        $destinationPath = $path . '/uploads/restaurant'; // upload path
        $logo = request()->file('image');
        $extension = $logo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $logo->move($destinationPath, $name); // uploading file to given path
        $restaurant->image =   'uploads/restaurant' . $name;
        $restaurant->save();
    }
    flash()->success('تم التعديل');
    return back();
}

public function restaurantMeals($id)
{
    $records = Item::where('restaurant_id',$id)->get();
    return view('front.restaurant-meals',compact('records'));
}

public function mealDetails($id)
{
    $record = Item::findOrFail($id);
    $items = Item::where('restaurant_id',$record->restaurant_id)->get();
    return view('front.meal-details',compact('record','items'));
}

public function restaurants()
{
    $records = Restaurant::paginate(10);
    return view('front.restaurants',compact('records'));
}

public function restaurantDetails($id)
{
    $record = Restaurant::findOrFail($id);
    $reviews = Review::where('restaurant_id',$record->id)->get();
    return view('front.restaurant-details',compact('record','reviews'));
}

public function addComment()
{
    $this->validate(request(),[
        'comment' => 'required|string',
    ]);
    request()->user()->reviews()->create(request()->all());
    flash()->success('تم الاضافة');
    return back();
}

public function restaurantNewOrders()
{
    $records = request()->user()->orders()->where('state','pending')->latest()->paginate(10);
    return view('front.restaurant.restaurant-new-orders',compact('records'));
}

public function restaurantCurrentOrders()
{
    $records = request()->user()->orders()->where('state','accepted')->latest()->paginate(10);
    return view('front.restaurant.restaurant-current-orders',compact('records'));
}


public function restaurantPostOrders()
{
    $records = request()->user()->orders()->whereIn('state',['delivered','rejected','declined'])->
    latest()->paginate(10);
    return view('front.restaurant.restaurant-post-orders',compact('records'));
}

  public function restaurantAcceptOrder($id)
  {
      $record = Order::findOrFail($id);
      $record->update(['state' => 'accepted']);
      flash()->success('تم الموافقه على الطلب');
      return back();
  }

  public function restaurantRejectOrder($id)
  {
      $record = Order::findOrFail($id);
      $record->update(['state' => 'rejected']);
      flash()->success('تم رفض الطلب');
      return back();
  }

  public function restaurantDeliverOrder($id)
  {
      $record = Order::findOrFail($id);
      $record->update(['state' => 'delivered']);
      flash()->success('تم استلام الطلب');
      return back();
  }

  public  function getClientAccount()
  {
      $profile = request()->user();
      return view('front.client.client-account',compact('profile'));
  }

  public  function postClientAccount()
  {
      $this->validate(request(),[
          'name'               => 'required|string',
          'email'              => 'required|email|unique:restaurants,email,' . request()->user()->id,
          'phone'              => 'required|digits:11|unique:restaurants,phone,' . request()->user()->id,
          'password'           => 'required|confirmed|min:8',
          'block_id'        => 'required|exists:districts,id',
          'image'              => 'nullable',
      ]);
      if(request()->has('password')){
          request()->merge(['password' => bcrypt(request()->password)]);
      }
      $restaurant = request()->user()->update(request()->except('image'));
      if (request()->hasFile('image')) {
          if(file_exists($restaurant->image))
          {
              unlink($restaurant->image);
          }
          $path = public_path();
          $destinationPath = $path . '/uploads/'; // upload path
          $logo = request()->file('image');
          $extension = $logo->getClientOriginalExtension(); // getting image extension
          $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
          $logo->move($destinationPath, $name); // uploading file to given path
          $restaurant->image =   'uploads/' . $name;
          $restaurant->save();
      }
      flash()->success('تم التعديل');
      return back();
  }

  public function clientCurrentOrders()
  {
      $records = request()->user()->orders()->where('state','accepted')->latest()->paginate(10);
      return view('front.client.client-current-orders',compact('records'));
  }

  public function clientPostOrders()
  {
      $records = request()->user()->orders()->whereIn('state',['delivered','rejected','declined'])->
      latest()->paginate(10);
      return view('front.client.client-past-orders',compact('records'));
  }

  public function clientDeliverOrder($id)
  {
      $record = Order::findOrFail($id);
      $record->update(['state' => 'delivered']);
      flash()->success('تم استلام الطلب');
      return back();
  }

  public function clientDeclineOrder($id)
  {
      $record = Order::findOrFail($id);
      $record->update(['state' => 'declined']);
      flash()->success('تم رفض الطلب');
      return back();
  }
}
