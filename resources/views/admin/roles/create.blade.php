@extends('layouts.app')
@inject('model','App\Models\Role')
@section('page_title')
  Create Roles
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Create Roles</h3>

    </div>
    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\RoleController@store'
        ]) !!}
      @include('partials.validation')
      @include('admin.roles.form')
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
