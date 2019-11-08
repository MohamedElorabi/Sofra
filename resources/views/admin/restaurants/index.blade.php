@extends('layouts.app')

@section('page_title')
  @lang('lang.Restaurants')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">

    <div class="box-body">
    @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">@lang('lang.Restaurant Name')</th>
              <th class="text-center">@lang('lang.City Name')</th>
              <th class="text-center">@lang('lang.Accrued commissions')</th>
              <th class="text-center">@lang('lang.Status')</th>
              <th class="text-center">@lang('lang.Activate / Stop')</th>
              <th class="text-center">@lang('lang.Delete')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td class="text-center">{{$record->name}}</td>
              <td class="text-center">
              {{$record->block->name}}
              {{$record->block->city->name}}
              </td>
              <td class="text-center">{{$record->total_commission - $record->total_payments}}</td>
              @if($record->is_active == 1)
                  <td class="text-center">
                      مفتوح
                  </td>
                  <td class="text-center">
                      <a href="active/{{$record->id}}">
                          <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> نشط</button>
                      </a>
                  </td>
              @else
                  <td class="text-center">
                      مغلق
                  </td>
                  <td class="text-center">
                      <a href="disactive/{{$record->id}}">
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-edit"></i>غير نشط</button>
                      </a>
                  </td>
              @endif
              <td class="text-center">
                {!! Form::open([
                  'action' => ['Admin\RestaurantsController@destroy',$record->id],
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
          @lang('lang.No Data')
        </div>
      @endif
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
