<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/options.fields.id').':') !!}
    <b>{{ $option->id }}</b>
</div>


<!-- Min Model Year Field -->
<div class="form-group">
    {!! Form::label('min_model_year', __('models/options.fields.min_model_year').':') !!}
    <b>{{ $option->min_model_year }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/options.fields.created_at').':') !!}
    <b>{{ $option->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/options.fields.updated_at').':') !!}
    <b>{{ $option->updated_at }}</b>
</div>


