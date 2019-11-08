@extends('layouts.app')
@inject('model','App\Models\City')
@section('page_title')
  @lang('lang.Create City')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">

    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\CityController@store'
        ]) !!}
      @include('partials.validation')
      @include('admin.cities.form')
      <div class="form-group">
        <button class="btn btn-primary" type="submit">@lang('lang.submit')</button>
      </div>
      {!! Form::close() !!}

    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
