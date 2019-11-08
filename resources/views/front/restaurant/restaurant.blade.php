@extends('front.master')
@section('content')

<!-- start header-->
<header class="restuarent-header">

   <div class="container text-center">
        <div class="header-content">
              <img src="./images/res-img.png" alt="" class="img-fluid">
              <h1>hs</h1>
              <ul class="list-unstyled stars-rate mx-auto">
                <li class="star"><i class="fas fa-star"></i></li>
                <li class="star"><i class="fas fa-star"></i></li>
                <li class="star"><i class="fas fa-star"></i></li>
                <li class="star"><i class="fas fa-star"></i></li>
                <li class="star"><i class="fas fa-star"></i></li>
            </ul>
        </div>
   </div>
</header>
<!-- end header-->

<!-- start  meal-->
<section class="meal">
    <div class="container">
        <div class="row">
          @foreach($items as $item)
            <div class="col-lg-4">
                 <div class="card">
                   <img src="./images/burger.jpg" alt="" class="img-fluid card-img-top">
                   <div class="card-body">
                       <h4 class="card-title text-center">{{$item->name}}</h4>
                       <h6 class="card-subtitle mb-2 text-muted  text-center">{{$item->descrbtion}}</h6>
                       <p class="card-text">
                           <span><i class="fas fa-truck"></i>{{$item->name}}</span>
                           <span><i class="fas fa-money-bill"></i> {{$item->price}} ريال</span>
                       </p>
                       <a href="mealPage.html" class="card-link"><button class="btn mx-auto">اضغط للتفاصيل</button></a>
                   </div>
                 </div>

            </div>
          @endforeach
        </div>
    </div>

</section>
<!-- end  meal-->
<script src="{{asset('front/JS/myJquery.js')}}"></script>
@endsection
