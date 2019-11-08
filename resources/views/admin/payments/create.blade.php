@extends('layouts.app')
@inject('model','App\Models\PaymentMethod')
@section('page_title')
  @lang('lang.Create Payment Method')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">

    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\PaymentController@store'
        ]) !!}
      @include('partials.validation')
      @include('admin.payments.form')
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
