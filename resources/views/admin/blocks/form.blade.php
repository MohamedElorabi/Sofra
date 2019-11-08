



    <div class="form-group">
      <label for="name">@lang('lang.Block Name')</label>
      {!! Form::text('name',null,[
          'class' => 'form-control'
      ])!!}

    </div>

    <div class="form-group">
      <label for="city_id">@lang('lang.City Name')</label>
      {!! Form::select('city_id',App\Models\City::pluck('name','id'),old('city_id'),[
          'class' => 'form-control','placeholder'=>'..........'
      ])!!}

    </div>
