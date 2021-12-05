<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/eventCategories.fields.id').':') !!}
    <b>{{ $eventCategory->id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/eventCategories.fields.name').':') !!}
    <b>{{ $eventCategory->name }}</b>
</div>


<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/eventCategories.fields.price').':') !!}
    <b>{{ $eventCategory->price }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/eventCategories.fields.created_at').':') !!}
    <b>{{ $eventCategory->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/eventCategories.fields.updated_at').':') !!}
    <b>{{ $eventCategory->updated_at }}</b>
</div>


