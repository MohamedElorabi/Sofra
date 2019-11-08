@extends('front.master')
@section('content')
<section class="register add-offer">
      <h3 style="text-align: center;margin-bottom: 3rem">إضافة عرض جديد</h3>

      <center>@include('flash::message')</center>
      <div class="form-section">
          {!! Form::open([
              'action' =>'Front\MainController@PostAddOffer',
              'method' => 'post',
              'class' => 'pt-2',
              'files'  => 'true'
          ]) !!}
              <div class="form-group">
                  <div class="image-upload mb-2">
                      <h4 style="color: #230040;margin-bottom: 2rem">صورة العرض</h4>
                      <label for="image">
                              {!!Form::file('image',[
                                  'class' => 'form-control'
                              ])!!}
                      </label>
                  </div>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="اسم العرض">
              </div>
              <div class="form-group">
                  <textarea rows="5" class="form-control" name="description" placeholder="وصف مختصر"></textarea>
              </div>

              <div class="form-row">
                  <h6 style="color: #230040;align-self: center;" class="px-2">من</h6>
                  <input type="text" name="start" id="demo-3_1" class="form-control-sm px-1">
                  <h6 style="color: #230040;align-self: center;" class="px-2">إلى</h6>
                  <input type="text" name="end" id="demo-3_2" class="form-control-sm px-1">
              </div>
              <button type="submit" class="btn btn-primary">
                  <a style="display: inline" href="#">إضافة</a>
              </button>
          {!! Form::close() !!}
      </div>
      <!--form-section-->

      @push('script')
          <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
          <script src="{{asset('front/js/lightpick.js')}}"></script>
          <script>
              var picker = new Lightpick({
                  field: document.getElementById('demo-3_1'),
                  secondField: document.getElementById('demo-3_2'),
                  singleDate: false,
                  onSelect: function(start, end) {
                      var str = '';
                      str += start ? start.format('Do MMMM YYYY') + ' to ' : '';
                      str += end ? end.format('Do MMMM YYYY') : '...';
                      document.getElementById('result-3').innerHTML = str;
                  }
              });

          </script>
          <script src="{{asset('front/js/main.js')}}"></script>
      @endpush
  </section>
@endsection
