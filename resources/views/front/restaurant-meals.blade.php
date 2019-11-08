@extends('front.master')
@section('content')

<!--================================START RESTAURANT=================================-->
  <section class="restaurant-header text-center text-white">
      <img src="{{asset('front/img/images/res-img.png')}}" width="300rem">
      <h1>دجاج كنتاكى</h1>
      <div class="rating">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
      </div>
      <!--rating-->
  </section>
  <!--================================START RESTAURANT=================================-->



  <!--================================START FOOD=================================-->
  <section class="food">
      <div class="row">
          @foreach($records as $record)
              <div class="col-sm">
                  <div class="card" style="width: 100%;">
                      <img src="{{asset('front/img/images/appetizer-chicken-chicken-dippers-1059943 (1).jpg')}}" class="card-img-top" alt="...">
                      <div class="card-body text-center">
                          <h5 class="card-title">{{$record->title}}</h5>
                          <p class="small">{{$record->description}}</p>
                          <p class="card-text text-left ml-5 h5">
                              <img src="{{asset('front/img/images/food-order.png')}}" width="10%">
                              {{$record->duration}} دقيقة تقريباً
                          </p>
                          <p class="card-text text-left ml-5 h5">
                              <img src="{{asset('front/img/images/pig.png')}}" width="10%">
                              {{$record->price}} ريال
                          </p>
                          <button type="button" class="btn btn-primary btn-lg m-2">
                              <a href="{{url('meal-details', $record->id)}}"> اضغط هنا للتفاصيل</a>
                          </button>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
  </section>
  <!--================================END FOOD=================================-->

@endsection
