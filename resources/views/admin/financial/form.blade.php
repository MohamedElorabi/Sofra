



    <div class="form-group">
      <label for="restaurant_id">@lang('lang.Restaurant Name')</label>
      {!! Form::text('restaurant_id',null,[
          'class' => 'form-control'
      ])!!}

    </div>

    <div class="form-group">
      <label for="note">@lang('lang.Note')</label>
      {!! Form::text('note',null,[
          'class' => 'form-control'
      ])!!}

    </div>

    <div class="form-group">
      <label for="amount">@lang('lang.Amount')</label>
      {!! Form::text('amount',null,[
          'class' => 'form-control'
      ])!!}

    </div>
