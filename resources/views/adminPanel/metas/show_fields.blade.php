<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/metas.fields.id').':') !!}
    <b>{{ $meta->id }}</b>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/metas.fields.title').':') !!}
    <b>{{ $meta->title }}</b>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/metas.fields.description').':') !!}
    <b>{{ $meta->description }}</b>
</div>

<!-- Keywords Field -->
<div class="form-group">
    {!! Form::label('keywords', __('models/metas.fields.keywords').':') !!}
    <b>{{ $meta->keywords }}</b>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/metas.fields.status').':') !!}
    <b>{{ $meta->status }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/metas.fields.created_at').':') !!}
    <b>{{ $meta->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/metas.fields.updated_at').':') !!}
    <b>{{ $meta->updated_at }}</b>
</div>
