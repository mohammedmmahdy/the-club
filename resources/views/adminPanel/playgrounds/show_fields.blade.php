<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/playgrounds.fields.id').':') !!}
    <b>{{ $playground->id }}</b>
</div>


<!-- Type Id Field -->
<div class="form-group">
    {!! Form::label('type_id', __('models/playgrounds.fields.type_id').':') !!}
    <b>{{ $playground->type_id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/playgrounds.fields.name').':') !!}
    <b>{{ $playground->name }}</b>
</div>


<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/playgrounds.fields.description').':') !!}
    <b>{{ $playground->description }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/playgrounds.fields.created_at').':') !!}
    <b>{{ $playground->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/playgrounds.fields.updated_at').':') !!}
    <b>{{ $playground->updated_at }}</b>
</div>


