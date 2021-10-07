<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/playgroundTypes.fields.id').':') !!}
    <b>{{ $playgroundType->id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/playgroundTypes.fields.name').':') !!}
    <b>{{ $playgroundType->name }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/playgroundTypes.fields.created_at').':') !!}
    <b>{{ $playgroundType->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/playgroundTypes.fields.updated_at').':') !!}
    <b>{{ $playgroundType->updated_at }}</b>
</div>


