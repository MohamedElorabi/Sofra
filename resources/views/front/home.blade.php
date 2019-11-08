@extends('front.master')
@section('content')

<main>
        <!--================================START HEADER===============================-->
        <header>
            <h1 class="main-heading">سُفرة</h1>
            <h1 class="sub-heading">بتشترى .. بتبيع ؟ كله عند أم ربيع</h1>
            <button type="button" class="btn btn-primary btn-lg">
                <a style="display: inline" class="h2" href="register.html">سجل الان</a>
                <img src="{{asset('front/img/images/dish.png')}}" class="ml-1" width="20%">
            </button>
        </header>
        <!--================================END HEADER=================================-->



        <!--================================START RESTAURANT===============================-->
        <section class="restaurant">
            <div class="container">
                <h2>ابحث عن مطعمك المفضل</h2>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected disabled>إختر المدينه</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <!--col-->
                    <div class="col-md-6">
                        <div class="search_box mb-3">
                            <input type="search" class="form-control mr-sm-2" placeholder="ابحث عن مطعمك المفضل">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <!--col-->
                </div>
                <!--row-->





                <div class="row mt-4">

                  @foreach($restaurants as $restaurant)
                    <div class="col-md-6">
                        <div class="media">
                            <img src="{{asset($restaurant->image)}}" class="mr-3" alt="res-img" width="40%">
                            <div class="media-body">
                               <a href="restaurant.html"> <h4>{{ $restaurant->name}}</h4></a>
                                <div class="rating">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <!--rating-->
                                <div class="restaurant-content">
                                    <h5 class="open">
                                        <i class="fas fa-circle mr-2" style="color: #17bf4e;"></i>
                                        مفتوح</h5>
                                    <p class="mt-3">الحد الأدنى للطلب : {{ $restaurant->min}}</p>
                                    <p>رسوم التوصيل: {{$restaurant->delivery_cost}}</p>
                                </div>
                                <!--restaurant-content-->
                            </div>
                            <!--media-body-->
                        </div>
                        <!--media-->
                    </div>
                    @endforeach
                    <!--col-->


                </div>
                <!--row-->
            </div>
            <!--container-->
        </section>

        <!--================================END RESTAURANT=================================-->



        <!--================================START OFFERS===============================-->
        <section class="offers">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{asset('front/img/images/offers.png')}}" width="100%">
                    </div>
                    <!--col-->
                    <div class="col-md-7">
                        <div class="bg text-center">
                            <h2 class="paragraph">نقدم فى سفرة أفضل العروض لكل أنواع المطاعم و الأكلات الشهية المهلبية ماذا تنتظر إبدأ الإستمتاع بالعروض الآن</h2>
                            <button type="button" class="btn btn-primary btn-lg">
                                <a style="display: inline" class="h2" href="offers.html">شاهد العروض</a>
                            </button>
                        </div>
                        <!--bg-->
                    </div>
                    <!--col-->
                </div>
                <!--row-->
            </div>
            <!--container-->
        </section>
        <!--================================END OFFERS=================================-->



        <!--================================START APP===============================-->
        <section class="app">
            <div class="row">
                <div class="col-md-7">
                    <h1>قم بتحميل التطبيق الخاص بنا الآن</h1>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-lg">
                            <h1>حمل الآن <i class="fab fa-android"></i></h1>
                        </button>
                    </div>
                </div>
                <!--col-->
                <div class="col-md-5 mb-0 pb-0">
                    <img src="{{asset('front/img/images/app mockup.png')}}" width="100%">
                </div>
                <!--col-->
            </div>
            <!--row-->
        </section>
        <!--================================END APP===============================-->





    </main>

@endsection
