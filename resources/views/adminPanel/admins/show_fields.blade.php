<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/admins.fields.name').':') !!}
    <b>{{ $admin->name }}</b>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    <b>{{ $admin->email }}</b>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/admins.fields.status').':') !!}
    <b>{{ $admin->status==0?__('lang.inactive'):__('lang.active') }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/admins.fields.created_at').':') !!}
    <b>{{ $admin->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/admins.fields.updated_at').':') !!}
    <b>{{ $admin->updated_at }}</b>
</div>
