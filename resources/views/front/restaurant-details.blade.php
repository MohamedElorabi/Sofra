@extends('front.master')
@section('content')

<section class="meal container">

        <img src="{{asset('front/img/images/beef-bread-bun-1639557.jpg')}}" class="meal-photo">
        <h1>{{$record->name}}</h1>
        <div class="meal-details">
            <h5> البريد الالكترونى :{{$record->email}}</h5>
            <h5> الهاتف :{{$record->phone}} </h5>
            <h5> تواصل معانا :{{$record->contact_phone}}</h5>
            <h5> واتس :{{$record->whats}}</h5>
            <h5> الحى :{{optional($record->block)->name}}</h5>
            <h5> الفئة :@foreach($record->categories as $cat)
                    {{$cat->name}}
                @endforeach </h5>
            <h5><img src="{{asset('front/img/images/Layer 3.png')}}"> الحد الادنى للطلب : {{$record->minimum_charge}} ريال</h5>
            <h5><img src="{{asset('front/img/images/Layer 3.png')}}">رسوم التوصيل : {{$record->delivery_charge}} ريال</h5>
        </div>

        <hr>
        <button class="btn btn-primary btn-lg">
            <h2 style="display: inline"><a href="{{url('restaurant-meals',$record->id)}}">الوجبات</a></h2>
        </button>

        <div class="meal-info">
            <h5><img src="{{asset('front/img/images/Layer 4.png')}}" width="7%">معلومات عن المتجر</h5>
            <h3 class="border-l">تقييمات المستخدمين</h3>
            <p class="sm ml-3">155 تقييم</p>
        </div>
        <!--meal-info-->

        <div class="reviews">
            @foreach($reviews as $review)
                <div class="review">
                    <span>بواسطة {{optional($review->client)->name}}</span>
                    <div class="rating" style="display: inline-block">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <!--rating-->
                    <h5 class="mt-5 mb-3">{{$review->comment}}</h5>
                </div>
            @endforeach
        </div>
        <!--reviews-->

        <div class="review-write my-5">
            <h4 class="border-l">أضف تقييمك</h4>
            <center>@include('flash::message')</center>
            <div class="rating">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
            <!--rating-->
            <textarea rows="6" name="comment" placeholder="أضف تقييمك"></textarea>
            <button type="submit" class="btn btn-primary btn-lg">
                <h2 style="display: inline">إرسال</h2>
            </button>
        </div>
        <!--review-write-->
    </section>

@endsection
