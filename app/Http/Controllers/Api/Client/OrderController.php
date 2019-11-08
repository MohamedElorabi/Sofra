<?php

namespace App\Http\Controllers\Api\Client;
use App\Models\Review;
use App\Models\Order;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function newOrder(Request $request)
    {
    $validation = validator()->make($request->all(), [
        'restaurant_id'     => 'required|exists:restaurants,id',
        'items'             => 'required|array',
        'items.*'           => 'required|exists:items,id',
        'quantities'        => 'required|array',
        'notes'             => 'required|array',
        'address'           => 'required',
        'payment_method_id' => 'required|exists:payment_methods,id',
        //            'need_delivery_at' => 'required|date_format:Y-m-d',// H:i:s
    ]);
    if ($validation->fails()) {
        $data = $validation->errors();
        return responseJson(0, $validation->errors()->first(), $data);
    }
    $restaurant = Restaurant::find($request->restaurant_id);
    // restaurant closed
    if ($restaurant->availability == 'closed') {
        return responseJson(0, 'عذرا المطعم غير متاح في الوقت الحالي');
    }
    // client
    // set defaults
    $order = $request->user()->orders()->create([
        'restaurant_id'     => $request->restaurant_id,
        'note'              => $request->note,
        'status'             => 'pending', // db default
        'address'           => $request->address,
        'payment_method_id' => $request->payment_method_id,
    ]);
    $cost = 0;
    $delivery_cost = $restaurant->delivery_cost;
    if ($request->has('items')) {
        $counter = 0;
        foreach ($request->items as $itemId) {
            $item = Item::find($itemId);
            $order->items()->attach([
                $itemId => [
                    'qty' => $request->quantities[$counter],
                    'price'    => $item->price,
                    'note'     => $request->notes[$counter],
                ]
            ]);
            $cost += ($item->price * $request->quantities[$counter]);
            $counter++;
        }
    }
    // minimum charge
    if ($cost >= $restaurant->minimum_charger) {
        $total = $cost + $delivery_cost; // 200 SAR
        $commission = settings()->commission * $cost; // 20 SAR  // 10 // 0.1  // $total; edited to remove delivery cost from percent.
        $net = $total - settings()->commission;
        $update = $order->update([
            'cost'          => $cost,
            'delivery_cost' => $delivery_cost,
            'total'         => $total,
            'commission'    => $commission,
            'net'           => $net,
        ]);
        // $request->user()->cart()->detach();
        /* notification */
        $notification = $restaurant->notifications()->create([
            'title'      => 'لديك طلب جديد',
            'body'    => 'لديك طلب جديد من العميل ' . $request->user()->name,
            'action'     => 'new order',
            'order_id'   => $order->id,
        ]);
        $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
       
        if (count($tokens)) {
            $title = $notification->title;
            $content = $notification->content;
            $data = [
                'order_id' => $order->id,
            ];
            
            $send = notifyByFirebase($title, $content, $tokens, $data);
            
            info("firebase result: " . $send);
            
        }
        $data = [
            'order' => $order->fresh()->load('items',  'client') // $order->fresh()  ->load (lazy eager loading) ->with('items')
        ];
        
        return responseJson(1, 'تم الطلب بنجاح', ['date' => $data]);
    } else {
        $order->items()->delete();
        $order->delete();
        return responseJson(0, 'الطلب لابد أن لا يكون أقل من ' . $restaurant->minimum_charger . ' ريال');
    }
  }
    public function clientCurrentOrder(Request $request)
    {
        $order = $request->user()->orders()->whereIn('status', ['pending', 'accpeted'])->get();

        return responseJson(1, 'تمت العمليه بنجاح', ['order' => $order->load('client', 'paymentMethod')]);
    }

    public function showOrder(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'id' => 'required|exists:orders,id', //
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $order = $request->user()->orders()->find($request->id);
        if ($order) {
            return responseJson(1, 'تمت العمليه بنجاح', ['order' => $order->load('client', 'paymentMethod')]);
        }
        return responseJson(1, 'تم الحذف بنجاح');
    }


    public function clientOldOrder(Request $request)
    {
        $order = $request->user()->orders()->whereIn('status', ['rejected', 'delivered', 'declined'])->get();

        return responseJson(1, 'تمت العمليه بنجاح', ['order' => $order->load('client', 'paymentMethod')]);
    }


    public function deliveredOrder(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $order = $request->user()->orders()->find($request->order_id);
        // dd($order);
        if ($order->status == 'pending' || $order->status == 'accepted') {
            $orders = $order->update([
                'status' => 'delivered' // تسليم
            ]);

            $restaurant = $order->restaurant;
            $notification = $restaurant->notifications()->create([
                'title' => 'تمت الموافقه على ان الطلب تم تسليمه',
                'body' => 'تمت الموافقه على الطلب من المستخدم ' . $request->user()->name . 'على انه استلمه',
                'order_id' => $request->order_id,
            ]);
//            $send = null;
            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'order_id' => $order->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);

            }

            $data = [
                'order' => $order->fresh()->load('items')
            ];

            return responseJson(1, 'تم الارسال بنجاح', ['data' => $data, 'send' => $send]);
        }
        return responseJson(0, 'هذا الطلب لا يمكن الموافقه عليه');
    }

    public function declinedOrder(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $order = $request->user()->orders()->find($request->order_id);
        if ($order->status == 'pending' || $order->status == 'accepted') {
            $orders = $order->update([
                'status' => 'declined' // رفض
            ]);
            $restaurant = $order->restaurant;
            $notification = $restaurant->notifications()->create([
                'title' => 'تمت رفض الطلب',
                'body' => 'تمت رفض الطلب من المستخدم ' . $request->user()->name,
                'order_id' => $request->order_id
            ]);
            //$send = null;
            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
//            dd($tokens);
            if (count($tokens)) {
                $title = $notification->title;
                $body = $notification->body;
                $data = [
                    'order_id' => $order->name
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
//dd($send);
            }

            $data = [
                'order' => $order->fresh()->load('items')
            ];

            return responseJson(1, 'تم الطلب بنجاح',$data);
        }
        return responseJson(0, 'هذا الطلب لا يمكن الموافقه عليه');
    }
}
