@extends('front.master')
@section('content')

<section class="meal container">

        <img src="{{asset('front/img/images/beef-bread-bun-1639557.jpg')}}" class="meal-photo">
        <h1>{{$record->name}}</h1>
        <h6>{{$record->description}}</h6>
        <div class="meal-details">
            <h5><img src="{{asset('front/img/images/Layer 5.png')}}"> السعر : {{$record->price}} ريال</h5>
            <h5><img src="{{asset('front/img/images/Layer 2.png')}}">مدة تجهيز الطلب : {{$record->duration}} دقيقة</h5>
            <h5><img src="{{asset('front/img/images/Layer 3.png')}}">رسوم التوصيل : {{optional($record->restaurant)->delivery_charge}} ريال</h5>
        </div>
        <!--meal-details-->
        <hr>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
            <h2 style="display: inline">أضف إلى العربة</h2>
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h4>كيف تريد الإستمرار؟</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <button type="button" class="btn btn-secondary">طلب طعام</button>
                    <button type="button" class="btn btn-primary">بيع طعام</button>

                </div>
            </div>
        </div>
        <!--modal-->

        <div class="meal-info">
            <h5><img src="{{asset('front/img/images/Layer 4.png')}}" width="7%"><a href="{{url('restaurant-details',optional($record->restaurant)->id)}}">معلومات عن هذا المتجر</a></h5>
        </div>
        <!--meal-info-->

        <div class="review-write my-5">
            <h4 class="border-l">أضف تقييمك</h4>
            <div class="rating">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
            <!--rating-->
            <textarea rows="6" placeholder="أضف تقييمك"></textarea>
            <button type="button" class="btn btn-primary btn-lg">
                <h2 style="display: inline">إرسال</h2>
            </button>
        </div>
        <!--review-write-->

        <div class="more-food" style="direction: ltr">
            <h4 class="border-l text-left">المزيد من أكلات هذا المطعم</h4>
            <div class="bg">
                <div class="container">
                    <div class="owl-carousel owl-theme" id="owl-services">
                        @foreach($items as $item)
                            <div class="item">
                                <img src="{{asset('front/img/images/burger-cheeseburger-delicious-1624473.jpg')}}">
                                <div class="overlay"></div>
                                <div class="button">
                                    <h4>{{$item->name}}</h4>
                                    <a href="{{url('meal-details',$item->id)}}"> اضغط للتفاصيل </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--owl-carousel-->
                </div>
                <!--container-->
            </div>
            <!--bg-->
        </div>
        <!--more-food-->




    </section>

@endsection
