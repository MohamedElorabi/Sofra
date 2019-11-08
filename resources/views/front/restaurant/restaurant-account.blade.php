@extends('front.master')
@section('content')

<main>

    <section class="account">
        <div class="form-section">
            @if($profile->image == null)
                <i class="fas fa-user-circle"></i>
            @else
                <img src="{{asset($profile->image)}}" width="30%">
            @endif
            <center>@include('flash::message')</center>

            {!! Form::open([
                'action' => 'Front\MainController@PostRestaurantAccount',
                'method' => 'post',
                'class'  => 'pt-3',
                'files'  => 'true'
            ]) !!}
            <div class="form-group">
                <input type="text" name="name" value="{{$profile->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="الاسم">
            </div>
            @error('name')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror


            <div class="form-group">
                <input type="email" name="email" value="{{$profile->email}}" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكترونى">
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror


            <div class="form-group">
                <input type="text" name="phone" value="{{$profile->phone}}" class="form-control @error('phone') is-invalid @enderror" placeholder="الجوال">
            </div>
            @error('phone')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror


            @inject('district','App\Models\District')
            <div class="form-group">
                {!!Form::select('district_id',$district->pluck('name','id')->toArray(),null,[
                    'class' => 'form-control',
                    'placeholder' => 'الحى'
                ])!!}
            </div>


            @inject('category','App\Models\Category')
            <div class="form-group">
                {!!Form::select('category_id',$category->pluck('name','id')->toArray(),null,[
                    'class' => 'form-control',
                    'placeholder' => 'الفئة'
                ])!!}
            </div>

            <div class="form-group">
                <input type="text" name="delivery_charge" value="{{$profile->delivery_charge}}" class="form-control @error('delivery_charge') is-invalid @enderror" placeholder="رسوم التوصيل">
            </div>
            @error('delivery_charge')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

            <div class="form-group">
                <input type="text" name="minimum_charge" value="{{$profile->minimum_charge}}" class="form-control @error('minimum_charge') is-invalid @enderror" placeholder="الحد الادنى للطلب">
            </div>
            @error('minimum_charge')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

            <div class="form-group">
                <input type="text" name="contact_phone" value="{{$profile->contact_phone}}" class="form-control @error('contact_phone') is-invalid @enderror" placeholder="تواصل معانا">
            </div>
            @error('contact_phone')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

            <div class="form-group">
                <input type="text" name="whats" value="{{$profile->whats}}" class="form-control @error('whats') is-invalid @enderror" placeholder="واتس">
            </div>
            @error('whats')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

            <div class="form-group">
                {!!Form::file('image',[
                    'class' => 'form-control'
                ])!!}
            </div>


            <div class="form-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="كلمة السر">
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror


            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="تأكيد كلمة السر">
            </div>
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror


            <button type="submit" class="btn btn-primary btn-lg m-3">
                <h5>تعديل</h5>
            </button>

            {!! Form::close() !!}
        </div>

    </section>


</main>
@endsection
