<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>سفرة</title>
    <!--title icon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('front/img/images/sofra logo-1.png')}}">
    <!--fontawesome css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lemonada&display=swap" rel="stylesheet">
    <!--css bootstrap-->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <!--my style-->
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/mainStyle.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/pagesStyle.css')}}">
</head>
<!--fontawesome js-->
<script src="{{asset('front/js/all.min.js')}}"></script>



<body>

  <!--================================START NAVBAR=================================-->
<nav class="navbar navbar-light bg-light row">

    <div class="navbar-search col-5">

        <a href="cart.html" class="cart-link"><i class="fas fa-shopping-cart mx-2"></i></a>


        <div class="dropdown mx-2">
                <span class="btn dropdown-toggle m-0" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                </span>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                @if(auth()->guard('web-restaurant')->check())

                @else

                    <a class="dropdown-item" href="{{url('restaurants')}}" style="display: inline-block">
                        <i class="fas fa-gift"></i>
                        المطاعم
                    </a>

                    <a class="dropdown-item" href="{{url('offers')}}" style="display: inline-block">
                        <i class="fas fa-gift"></i>
                        العروض
                    </a>

                @endif

                @if(auth()->guard('web-client')->check())
                    <a class="dropdown-item" href="{{url('client-current-orders')}}" style="display: inline-block">
                        <i class="fas fa-clipboard-list"></i>
                        طلباتى
                    </a>

                    <a href="{{url('client-account')}}" class="dropdown-item" style="display: inline-block">
                        <i class="far fa-user"></i>
                        حسابى
                    </a>

                    <a href="{{url('client-logout')}}" class="dropdown-item" style="display: inline-block">
                        <i class="fas fa-sign-out-alt"></i>
                        تسجيل الخروج
                    </a>


                @elseif(auth()->guard('web-restaurant')->check())

                    <a class="dropdown-item" href="{{url('restaurant-new-orders')}}" style="display: inline-block">
                        <i class="fas fa-clipboard-list"></i>
                        طلباتى
                    </a>

                    <a class="dropdown-item" href="{{url('restaurant-offers')}}" style="display: inline-block">
                        <i class="fas fa-gift"></i>
                        العروض
                    </a>

                    <a href="{{url('restaurant-account')}}" class="dropdown-item" style="display: inline-block">
                        <i class="far fa-user"></i>
                        حسابى
                    </a>

                    <a href="{{url('restaurant-logout')}}" class="dropdown-item" style="display: inline-block">
                        <i class="fas fa-sign-out-alt"></i>
                        تسجيل الخروج
                    </a>

                @endif

                <a href="{{url('contact')}}" class="dropdown-item" style="display: inline-block">
                    <i class="fas fa-envelope-square"></i>
                    تواصل معنا
                </a>

            </div>
            <!--dropdown-menu-->
        </div>
        <!--dropdown-->



        <div class="search_box">
            <input type="search" class="form-control mr-sm-2">
            <i class="fas fa-search"></i>
        </div>

    </div>
    <!--navbar-search-->




    <a class="navbar-brand col-2" href="{{route('index')}}"><img src="{{asset('front/img/images/sofra logo-1.png')}}"></a>





    <button class="navbar-toggler col-4" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-hamburger"></i>
    </button>


    <div class="collapse navbar-collapse" id="navbarsExample01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('index')}}">الرئيسية</a>
            </li>
            @if(auth()->guard('web-client')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{url('client-logout')}}">تسجيل الخروج</a>
                </li>
            @elseif(auth()->guard('web-restaurant')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{url('restaurant-logout')}}">تسجيل الخروج</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('client-register')}}">حساب جديد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('client-login')}}">تسجيل الدخول</a>
                </li>
            @endif
        </ul>
    </div>
    <!--collapse-->

</nav>
<!--================================END NAVBAR=================================-->

@yield('content')

<!--================================START FOOTER=================================-->

<footer>
    <div class="row m-0">
        <div class="col-md-4">
            <img src="{{asset('front/img/images/edit.png')}}">
            <h2>من نحن</h2>
            <p class="h5 mt-3"> ويُستخدم في صناعات المطابع ودور النشر. منذ القرن الخامس عشر عندما قامت مطبعة مجهولة برص مجموعة من الأحرف بشكل عشوائي أخذتها من نص، لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون من الزمن لم تقضي على هذا النص</p>
            <div class="social">
                <a href="#"><i class="fab fa-instagram fa-2x m-3"></i></a>
                <a href="#"><i class="fab fa-twitter fa-2x m-3"></i></a>
                <a href="#"><i class="fab fa-facebook-square fa-2x m-3"></i></a>
            </div>
            <!--social-->
        </div>
        <!--col-->
        <div class="offset-md-4"></div>
        <div class="col-md-4">
            <img src="{{asset('front/img/images/sofra logo-1@2x.png')}}" width="100%">
        </div>
        <!--col-->
    </div>
    <!--row-->
</footer>

<!--================================END FOOTER=================================-->
<script src="{{asset('front/JS/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('front/JS/myJquery.js')}}"></script>
<script src="{{asset('front/JS/popper.min.js')}}"></script>
<script src="{{asset('front/JS/bootstrap.min.js')}}"></script>
@stack('js')
<script src="{{asset('front/JS/main.js')}}"></script>

</body>

</html>
