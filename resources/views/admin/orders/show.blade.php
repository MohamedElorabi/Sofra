@extends('layouts.app')
@section('content')


<br />
    <section class="content">

        <div class="box box-primary">
            <div class="box-body">

                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i>

                                @foreach($record->items as $item)
                                 # {{$item->pivot->order_id}}
                                <small class="pull-left"><i class="fa fa-calendar-o"></i>  {{$record->created_at}}
                                </small>
                                @endforeach
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            @lang('lang.Asked') 
                            <address>
                                <i class="fa fa-angle-left" aria-hidden="true"></i>  {{$record->client->name}}                        <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i>   @lang('lang.Phone') : {{$record->client->phone}}                                <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i>   @lang('lang.E-mail') : {{$record->client->email}}                                <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i>   @lang('lang.Address') : {{$record->client->block->city->name}}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <i class="fa fa-angle-left" aria-hidden="true"></i><strong>  @lang('lang.Restaurant Name') :{{$record->restaurant->name}} </strong><br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i>  <strong> @lang('lang.Address') : {{$record->restaurant->block->name}}</strong>                   <br>
                                <i class="fa fa-angle-left" aria-hidden="true"></i> <strong> @lang('lang.Phone') : {{$record->restaurant->restaurant_phone}}</strong>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b>
                            @lang('lang.Order Num')
                                @foreach($record->items as $item)
                                    # {{$item->pivot->order_id}}
                            </b><br>
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b>@lang('lang.Order Details') : {{$record->note}}  </b><br>

                            <i class="fa fa-angle-left" aria-hidden="true"></i><b>@lang('lang.Status') :
                                <i>{{$record->status}}</i>
                            </b><br>
                            <i class="fa fa-angle-left" aria-hidden="true"></i><b>@lang('lang.Total') :{{$record->total}}
                            </b>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('lang.Item Name')</th>
                                    <th>@lang('lang.Quantity')</th>
                                    <th>@lang('lang.Price')</th>
                                    <th>@lang('lang.Notes')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    @foreach($record->items as $i)
                                    <td>{{$i->name}}</td>
                                    @endforeach
                                    <td>{{$item->pivot->qty}}</td>
                                    <td>{{$record->price}}</td>
                                    <td>{{$item->pivot->note}}</td>

                                </tr>
                                <tr>
                                    <td>--</td>
                                    <td>@lang('lang.Delivery cost')</td>
                                    <td>-</td>
                                    <td>{{$record->delivery_cost}}</td>
                                    <td></td>
                                </tr>
                                <tr class="bg-success">
                                    <td>--</td>
                                    <td>@lang('lang.Total')</td>
                                    <td>-</td>
                                    <td>
                                        {{$record->total}}  @lang('lang.pound')
                                    </td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            @endforeach
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="" class="btn btn-default" id="print-all">
                                <i class="fa fa-print"></i> @lang('lang.Prient')</a>

                            <script>
                                //                                $('#myModal').on('shown.bs.modal', function () {
                                //                                    $('#myInput').focus()
                                //                                })
                            </script>
                        </div>
                    </div>
                </section><!-- /.content -->
                <div class="clearfix"></div>

            </div>
        </div>


    </section>

@endsection



