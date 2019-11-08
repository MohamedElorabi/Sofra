@extends('front.master')
@section('content')
<section class="register">
      <div class="form-section">
          <center>@include('flash::message')</center>
              {!! Form::open([
                  'action' =>'Front\MainController@PostAddItem',
                  'method' => 'post',
                  'class' => 'pt-3',
                  'files'  => 'true'
              ]) !!}
              <div class="form-group">
                  <div class="image-upload mb-2">
                      <h4 style="color: #230040;margin-bottom: 2rem">صورة المنتج</h4>
                      <label for="image">
                          {!!Form::file('image',[
                              'class' => 'form-control'
                          ])!!}
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="اسم المنتج">
              </div>
              <div class="form-group">
                  <textarea rows="5" class="form-control" name="description" placeholder="وصف مختصر"></textarea>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" name="price" placeholder="السعر">
              </div>

              <div class="form-group">
                  <input type="text" class="form-control" name="duration" placeholder="مدة التجهيز">
              </div>
              <button type="submit" class="btn btn-primary">
                  <a style="display: inline">إضافة</a>
              </button>
          {!! Form::close() !!}
      </div>
      <!--form-section-->
  </section>
@endsection
