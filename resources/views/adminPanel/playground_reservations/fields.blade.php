<!-- Playground Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('playground_id', __('models/playgroundReservations.fields.playground_id').':') !!}
    {!! Form::text('playground_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/playgroundReservations.fields.date').':') !!}
    {!! Form::text('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', __('models/playgroundReservations.fields.time').':') !!}
    {!! Form::text('time', null, ['class' => 'form-control']) !!}
</div>

<!-- Number Of People Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_of_people', __('models/playgroundReservations.fields.number_of_people').':') !!}
    {!! Form::text('number_of_people', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.playgroundReservations.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
