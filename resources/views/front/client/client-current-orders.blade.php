@extends('front.master')
@section('content')

<section class="orders">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" href="{{url('user/client-current-orders')}}">
                    <h3>طلبات جديدة</h3>
                </a>
                <a class="nav-item nav-link" href="{{url('user/client-past-orders')}}">
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
                            <div class="media-body row">
                                <div class="restaurant-content col-9">
                                    <h4>{{$record->name}}</h4>
                                    <h5>رقم الطلب : {{$record->id}}</h5>
                                    <h5>المجموع : {{$record->total}} ريال</h5>
                                </div>
                                <!--restaurant-content-->
                                <div class="button-orders col" style="display: grid">
                                    <button class="confirm h6 btn btn-lg"><a href="{{url('user/client-delivered',$record->id)}}">استلام</a></button>
                                    <button class="refuse h6 btn btn-lg"><a href="{{url('user/client-declined',$record->id)}}">رفض</a></button>
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
