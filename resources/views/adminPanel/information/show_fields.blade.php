
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/information.fields.name').':') !!}
    <span>{{ $information->name }}</span>
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', __('models/information.fields.value').':') !!}
    <span>{!! $information->value !!}</span>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/information.fields.status').':') !!}
    <span>{{ $information->status ? 'Active' : 'Inactive' }}</span>
</div>

