@extends('layouts.app')
@section('page_title')
    @lang('lang.Settings') 
@endsection
@section('small_title')
    @lang('lang.Site Settings') 
@endsection
@section('content')
<section class="content">
​
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
        <form method="POST" action="" accept-charset="UTF-8" id="myForm" role="form" enctype="multipart/form-data">
            @csrf
​
            <div class="box-body">
​
                <!-- display errors of validation -->
​
                <h3>@lang('lang.Application Settings')</h3>
​ @foreach($records as $record)
                <h4>@lang('lang.Social Data')</h4>
                <label>@lang('lang.Facebook')</label>
                <input class="form-control" placeholder="فيس بوك" name="facebook" type="text" value="{{$record->facebook_url}}">
                <br>
                <label>@lang('lang.Twitter')</label>
                <input class="form-control" placeholder="تويتر" name="twitter" type="text" value="{{$record->twitter_url}}">
                <br>
                <label>@lang('lang.Instagram')</label>
                <input class="form-control" placeholder="انستجرام" name="instagram" type="text" value="{{$record->instgram_url}}">
                <hr>
                <label>@lang('lang.Application Commission')</label>
                <input class="form-control" placeholder="عمولة التطبيق" name="commission" type="number" value="{{$record->commission}}">
                <br>
                <label>@lang('lang.About Us')</label>
                <textarea class="form-control" placeholder="عن التطبيق" name="about_app" cols="50" rows="10">{{$record->about_us}}</textarea>
                <br>
                <label>@lang('lang.Terms and Conditions')</label>
                <textarea class="form-control" placeholder="الشروط والأحكام" name="terms" cols="50" rows="10">{{$record->terms}}</textarea>
                <hr>
                <h4>@lang('lang.Commission page data')</h4>
                <label>@lang('lang.Commission text')</label>
                <textarea class="form-control" placeholder="نص العمولة" name="commissions_text" cols="50" rows="10">{{$record->text}}</textarea>
                <br>
                <label>@lang('lang.Bank Accounts')</label>
                <textarea class="form-control" placeholder="الحسابات البنكية" name="bank_accounts" cols="50" rows="10">{{$record->contact}}</textarea>
​
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('lang.Save')</button>
                </div>
            </div>
            @endforeach
        </form>
    </div><!-- /.box -->
​
</section>
@endsection