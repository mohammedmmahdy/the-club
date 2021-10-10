<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/admins.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/admins.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/admins.fields.password').':') !!}
    {!! Form::password('password', ['class' => 'form-control','minlength' => 6,'maxlength' => 191]) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', __('models/admins.fields.password_confirmation').':') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control','minlength' => 6,'maxlength' => 191]) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', __('models/admins.fields.status').':') !!}
    <div class="radio-inline">
        <label class="radio">
            {!! Form::radio('status', "1", 'Active') !!}
            <span></span>
            @lang('lang.active')
        </label>

        <label class="radio">
            {!! Form::radio('status', " 0", null) !!}
            <span></span>
            @lang('lang.inactive')
        </label>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.admins.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
