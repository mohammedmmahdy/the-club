<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/branches.fields.id').':') !!}
    <b>{{ $branch->id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/branches.fields.name').':') !!}
    <b>{{ $branch->name }}</b>
</div>


<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', __('models/branches.fields.address').':') !!}
    <b>{{ $branch->address }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/branches.fields.created_at').':') !!}
    <b>{{ $branch->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/branches.fields.updated_at').':') !!}
    <b>{{ $branch->updated_at }}</b>
</div>


