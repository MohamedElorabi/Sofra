@extends('front.master')
@section('content')
<main class="offer-bg">
    <h3>العروض المتاحة الآن</h3>
    <div class="row">
        @foreach($offers as $offer)
            <div class="col-md">
                <img src="{{asset($offer->image)}}">
            </div>
        @endforeach
    </div>
</main>
@endsection
