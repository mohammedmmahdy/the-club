<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/events.fields.id').':') !!}
    <b>{{ $event->id }}</b>
</div>


<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/events.fields.title').':') !!}
    <b>{{ $event->title }}</b>
</div>

<!-- icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/events.fields.icon').':') !!}
    <img
    src="{{$event->icon_original_path}}"
    alt="{{$event->title}}"
    onerror=this.src="{{asset('uploads/images/original/default.png')}}"
    width="100" >
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/events.fields.photo').':') !!}
    <img
    onerror=this.src="{{asset('uploads/images/original/default.png')}}"
    src="{{$event->photo_original_path}}"
    alt="{{$event->title}}"
    width="200" >
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', __('models/events.fields.date').':') !!}
    <b>{{ $event->date }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/events.fields.created_at').':') !!}
    <b>{{ $event->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/events.fields.updated_at').':') !!}
    <b>{{ $event->updated_at }}</b>
</div>


<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/events.fields.description').':') !!}
    <b>{!! $event->description !!}</b>
</div>


