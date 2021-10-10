<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/playgroundReservations.fields.id').':') !!}
    <b>{{ $playgroundReservation->id }}</b>
</div>


<!-- Playground Id Field -->
<div class="form-group">
    {!! Form::label('playground_id', __('models/playgroundReservations.fields.playground_id').':') !!}
    <b>{{ $playgroundReservation->playground_id }}</b>
</div>


<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', __('models/playgroundReservations.fields.date').':') !!}
    <b>{{ $playgroundReservation->date }}</b>
</div>


<!-- Time Field -->
<div class="form-group">
    {!! Form::label('time', __('models/playgroundReservations.fields.time').':') !!}
    <b>{{ $playgroundReservation->time }}</b>
</div>


<!-- Number Of People Field -->
<div class="form-group">
    {!! Form::label('number_of_people', __('models/playgroundReservations.fields.number_of_people').':') !!}
    <b>{{ $playgroundReservation->number_of_people }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/playgroundReservations.fields.created_at').':') !!}
    <b>{{ $playgroundReservation->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/playgroundReservations.fields.updated_at').':') !!}
    <b>{{ $playgroundReservation->updated_at }}</b>
</div>


