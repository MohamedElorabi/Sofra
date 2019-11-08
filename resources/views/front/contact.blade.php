@extends('front.master')
@section('content')
<main>

        <section class="contact">
            <div class="form-section">
                <h4>تواصل معنا</h4>
                {!! Form::open([
                    'action' => 'Front\MainController@postContact',
                    'method' => 'post',
                    'class' => 'pt-3'
                ]) !!}
                    <center>@include('flash::message')</center>

                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="الاسم كاملاً">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="البريد الإلكترونى">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="الجوال">
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="ماهى رسالتك ؟" rows="4"></textarea>
                    </div>
                    <div class="form-group radio">
                        شكوى<input type="radio" name="type" value="complain">
                        إقتراح<input type="radio" name="type" value="suggest">
                        إستعلام<input type="radio" name="type" value="enquiry">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg m-3">
                        <h5>إرسال</h5>
                    </button>

                {!! Form::close() !!}
            </div>

        </section>


    </main>
@endsection
