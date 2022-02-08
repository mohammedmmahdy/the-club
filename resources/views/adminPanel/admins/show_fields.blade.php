<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/admins.fields.id').':') !!}
    <span>{{ $admin->id }}</span>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/admins.fields.name').':') !!}
    <span>{{ $admin->name }}</span>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    <span>{{ $admin->email }}</span>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/admins.fields.status').':') !!}
    <span>{{ $admin->status == '1' ? 'Active' : 'Inactive'}}</span>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/admins.fields.created_at').':') !!}
    <span>{{ $admin->created_at }}</span>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/admins.fields.updated_at').':') !!}
    <span>{{ $admin->updated_at }}</span>
</div>

