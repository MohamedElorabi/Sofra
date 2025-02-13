@extends('layouts.app')

@section('page_title')
  @lang('lang.Financial Operations')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('lang.List of Financial Operations')</h3>


    </div>
    <div class="box-body">
      <a href="{{url('admin/financial-operations/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('lang.Create Financial Operations')</a>
      @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">@lang('lang.Restaurant Name')</th>
              <th class="text-center">@lang('lang.Price')</th>
              <th class="text-center">@lang('lang.Process statement')</th>
              <th class="text-center">@lang('lang.Edit')</th>
              <th class="text-center">@lang('lang.Delete')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td class="text-center">{{$record->restaurant->name}}</td>
              <td class="text-center">{{$record->amount}}</td>
              <td class="text-center">{{$record->note}}</td>
              <td class="text-center">
                  <a href="financial-operations/{{$record->id}}/edit" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
              </td>
              <td class="text-center">
                {!! Form::open([
                  'action' => ['Admin\FinancialOperationsController@destroy',$record->id],
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
