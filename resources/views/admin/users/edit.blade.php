@extends('layouts.app')
@section('page_title')
  Edit User
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit User</h3>

    </div>
    <div class="box-body">
      {!! Form::model($model,[
          'action'  => ['Admin\UserController@update',$model->id],
          'method'  => 'put'
        ]) !!}
        @include('flash::message')
      @include('partials.validation')
      @include('admin.users.form')
      {!! Form::close() !!}
      <div class="form-group">
        <button class="btn btn-primary" type="submit">@lang('lang.update')</button>
      </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
