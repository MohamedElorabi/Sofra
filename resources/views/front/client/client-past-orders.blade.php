@extends('front.master')
@section('content')

<section class="orders">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" href="{{url('user/client-current-orders')}}">
                    <h3>طلبات جديدة</h3>
                </a>
                <a class="nav-item nav-link active" href="{{url('user/client-past-orders')}}">
                    <h3>طلبات سابقة</h3>
                </a>
            </div>
        </nav>

        <div class="tab-content">
            <center>@include('flash::message')</center>

            <div class="tab-pane active">
                @if(count($records))
                @foreach($records as $record)
                        <div class="col-6 media">
                            <img src="{{asset('front/img/images/res-img.png')}}" class="mr-3" alt="res-img" width="30%">
                            <div class="media-body">
                                <h4>{{$record->name}}</h4>
                                <div class="restaurant-content">
                                    <h5>رقم الطلب : {{$record->id}}</h5>
                                    <h5>السعر : {{$record->net}} ريال</h5>
                                    <h5>التوصيل : {{$record->delivery_charge}} ريال</h5>
                                    <h5>الاجمالى : {{$record->total}} ريال</h5>
                                </div>
                                <!--restaurant-content-->
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
