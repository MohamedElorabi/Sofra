@extends('front.master')
@section('content')

<main class="register-bg">
        <section class="register">
            <div class="form-section">
                <img src="{{asset('front/img/images/user.png')}}" width="30%">
                @include('flash::message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open([
                    'action' => 'Front\AuthController@PostClientLogin',
                    'method' => 'post',
                    'class'  => 'pt-3'
                ]) !!}
                    <div class="form-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكترونى">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="كلمة السر">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg m-3">
                        <span>دخول</span>
                    </button>
                    <div class="links py-5">
                        <a href="{{url('client-register')}}" class="newUser">
                            <h5>مستخدم جديد ؟</h5>
                        </a>
                        <a href="#" class="forgetPass">
                            <h5>نسيت كلمة السر ؟</h5>
                        </a>
                    </div>
                <a href="{{url('restaurant-login')}}" class="btn btn-primary btn-lg m-3">تسجيل الدخول كمطعم</a>
                    {!! Form::close() !!}
            </div>

        </section>
    </main>
@endsection
