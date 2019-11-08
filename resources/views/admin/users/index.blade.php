@extends('layouts.app')

@section('page_title')
  Users
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of Users</h3>


    </div>
    <div class="box-body">
      <a href="{{url('admin/users/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Users</a>
      @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>prem</th>
              <th class="text-center">Edit</th>
              <th class="text-center">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$record->name}}</td>
              <td>{{$record->email}}</td>
              <td>
                @foreach($record->roles as $role)
                  <span class="label label-success">{{$role->display_name}}</span>
                @endforeach
              </td>
              <td class="text-center">
                  <a href="{{url(route('users.edit' , $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
              </td>
              <td class="text-center">
                {!! Form::open([
                  'action' => ['Admin\UserController@destroy',$record->id],
                  'method' => 'delete'
                  ])!!}
                  <button type="submit" class="delete_link btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        @else
        <div class="alert alert-danger" role="alert">
          No Data
        </div>
      @endif
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
