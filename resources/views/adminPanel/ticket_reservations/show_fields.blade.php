<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/ticketReservations.fields.id').':') !!}
    <b>{{ $ticketReservation->id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('first_name', __('models/ticketReservations.fields.name').':') !!}
    <b>{{ $ticketReservation->strMemberName }}</b>
</div>


<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/ticketReservations.fields.phone').':') !!}
    <b>{{ $ticketReservation->member_mobile }}</b>
</div>


<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', __('models/ticketReservations.fields.date').':') !!}
    <b>{{ $ticketReservation->date }}</b>
</div>


<!-- Number Of People Field -->
<div class="form-group">
    {!! Form::label('number_of_people', __('models/ticketReservations.fields.number_of_people').':') !!}
    <b>{{ $ticketReservation->number_of_people }}</b>
</div>


<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/ticketReservations.fields.price').':') !!}
    <b>{{ $ticketReservation->price }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/ticketReservations.fields.created_at').':') !!}
    <b>{{ $ticketReservation->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/ticketReservations.fields.updated_at').':') !!}
    <b>{{ $ticketReservation->updated_at }}</b>
</div>


