<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/admins.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
 
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/admins.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'password']) !!}
</div>

<!-- Password Confirmation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', __('models/admins.fields.password_confirmation').':') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'password confirmation']) !!}
</div>

<div class="form-group col-sm-6">
    
    {!! Form::label('role', __('models/admins.fields.roles').':') !!}
    
    <select name="role" class="form-control">
        <option value="">Select Role</option>
        @foreach ($roles as $key => $value)
            <option value="{{ $key }}" {{ isset($admin->roles) && $admin->roles[0]->id == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.admins.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
