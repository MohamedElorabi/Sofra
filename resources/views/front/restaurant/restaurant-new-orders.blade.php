@extends('front.master')
@section('content')
<section class="orders">

      <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" href="{{url('restaurant-new-orders')}}">
                  <h3>طلبات جديدة</h3>
              </a>
              <a class="nav-item nav-link" href="{{url('restaurant-current-orders')}}">
                  <h3>طلبات جديدة</h3>
              </a>
              <a class="nav-item nav-link" href="{{url('restaurant-past-orders')}}">
                  <h3>طلبات سابقة</h3>
              </a>
          </div>
      </nav>

      <div class="tab-content" id="nav-tabContent">
          <center>@include('flash::message')</center>

          <div class="tab-pane active">
              @if(count($records))
              @foreach($records as $record)
              <div class="col-6 media">
                  <img src="{{asset('front/img/images/res-img.png')}}" class="mr-3" alt="res-img" width="30%">
                  <div class="media-body">
                      <h4>العميل : {{optional($record->client)->name}}</h4>
                      <div class="restaurant-content">
                          <h5>رقم الطلب : {{$record->id}}</h5>
                          <h5>المجموع : {{$record->total}} ريال</h5>
                          <h5>العنوان : {{$record->address}}</h5>
                      </div>
                      <!--restaurant-content-->
                      <div class="button-orders mt-5">
                          <button class="phone h6 btn btn-lg px-5"><a href="#">اتصال</a></button>
                          <button class="confirm h6 btn btn-lg px-5"><a href="{{url('restaurant-accepted',$record->id)}}">استلام</a></button>
                          <button class="refuse h6 btn btn-lg px-5"><a href="{{url('restaurant-rejected',$record->id)}}">رفض</a></button>
                      </div>
                      <!--button-orders-->
                  </div>
                  <!--media-body-->
              </div>
              <!--media-->
              @endforeach
          @else
              <center><h3>لا يوجد طلبات</h3></center>
          </div>
          @endif
          <!--tab-pane-->

      </div>
      <!--tab-content-->

  </section>
@endsection
