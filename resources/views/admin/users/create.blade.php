@extends('layouts.app')

@section('page_title')
  Create User
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Create User</h3>

    </div>
    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\UserController@store'
        ]) !!}
      @include('partials.validation')
      @include('admin.users.form')
      {!! Form::close() !!}
      <div class="form-group">
        <button class="btn btn-primary" type="submit">@lang('lang.submit')</button>
      </div>
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
