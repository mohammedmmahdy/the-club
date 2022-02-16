<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/offerCategories.fields.id').':') !!}
    <b>{{ $offerCategory->id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/offerCategories.fields.name').':') !!}
    <b>{{ $offerCategory->name }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/offerCategories.fields.created_at').':') !!}
    <b>{{ $offerCategory->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/offerCategories.fields.updated_at').':') !!}
    <b>{{ $offerCategory->updated_at }}</b>
</div>


