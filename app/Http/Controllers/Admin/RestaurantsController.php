<?php

namespace App\Http\Controllers\Admin;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Restaurant::all();
       return view('admin/restaurants/index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function active($id){
        $record = Restaurant::findOrFail($id);
        if($record->is_active == 1){
            $record->is_active = 0;
            $record->save();
        }
        return back();
    }
    public function disactive($id){
        $record = Restaurant::findOrFail($id);
        if($record->is_active == 0){
            $record->is_active = 1;
            $record->save();
        }
        return back();
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = Restaurant::findOrFail($id);
      $record->delete();
      $order=Order::where('restaurant_id',$id);
      $order->delete();
      return redirect(route('restaurants.index'));
    }
}
