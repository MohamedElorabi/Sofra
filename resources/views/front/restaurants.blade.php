@extends('front.master')
@section('content')

<main>


        <!--================================START HEADER===============================-->
        <header>
            <h1 class="main-heading">سُفرة</h1>
            <h1 class="sub-heading">بتشترى .. بتبيع ؟ كله عند أم ربيع</h1>
            <button type="button" class="btn btn-primary btn-lg">
                <a style="display: inline" class="h2" href="{{url('client-login')}}">سجل الان</a>
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
                    @foreach($records as $record)
                        <div class="col-md-6">
                            <div class="media">
                                <img src="{{asset('front/img/images/res-img.png')}}" class="mr-3" alt="res-img" width="40%">
                                <div class="media-body">
                                   <a href="{{url('restaurant-details',$record->id)}}"> <h4>{{$record->name}}</h4></a>
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
                                            {{$record->state}}</h5>
                                        <p class="mt-3">الحد الأدنى للطلب : {{$record->minimum_charge}} ريال</p>
                                        <p>رسوم التوصيل : {{$record->delivery_charge}} ريال</p>
                                    </div>
                                    <!--restaurant-content-->
                                </div>
                                <!--media-body-->
                            </div>
                            <!--media-->
                        </div>
                    @endforeach
                </div>
                <!--row-->
            </div>
            <!--container-->
        </section>

    </main>

@endsection
