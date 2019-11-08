@extends('front.master')

@section('content')

<main class="register-bg">
      <section class="register">
          <div class="form-section">
              <img src="{{asset('front/img/images/user.png')}}" width="30%">
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
                  'action' => 'Front\AuthController@registerRestaurant',
                  'method' => 'post',
                  'class'  => 'pt-3',
                  'files'  => true
              ]) !!}
              <div class="form-group">
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="الاسم">
              </div>
              @error('name')
              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
              @enderror


              <div class="form-group">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكترونى">
              </div>
              @error('email')
              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
              @enderror


              <div class="form-group">
                  <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="الجوال">
              </div>
              @error('phone')
              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
              @enderror

              @inject('city','App\Models\City')
              <div class="form-group">
                  {!!Form::select('city_id',$city->pluck('name','id')->toArray(),null,[
                      'class' => 'form-control',
                      'placeholder' => 'المدينة'
                  ])!!}
              </div>


              @inject('block','App\Models\Block')
              <div class="form-group">
                  {!!Form::select('block_id',$block->pluck('name','id')->toArray(),null,[
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
                  <input type="text" name="delivery_cost" class="form-control @error('delivery_cost') is-invalid @enderror" placeholder="رسوم التوصيل">
              </div>
              @error('delivery_cost')
              <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
              @enderror

              <div class="form-group">
                  <input type="text" name="min" class="form-control @error('min') is-invalid @enderror" placeholder="الحد الادنى للطلب">
              </div>
              @error('min')
              <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
              @enderror

              <div class="form-group">
                  <input type="text" name="restaurant_phone" class="form-control @error('restaurant_phone') is-invalid @enderror" placeholder="تواصل معانا">
              </div>
              @error('restaurant_phone')
              <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
              @enderror

              <div class="form-group">
                  <input type="text" name="whatsup" class="form-control @error('whatsup') is-invalid @enderror" placeholder="واتس">
              </div>
              @error('whatsup')
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
                  <h5>دخول</h5>
              </button>

              {!! Form::close() !!}
          </div>

      </section>
  </main>



@endsection
