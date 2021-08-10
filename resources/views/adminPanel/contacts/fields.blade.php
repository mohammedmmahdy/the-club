<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/contacts.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/contacts.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', __('models/contacts.fields.subject').':') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message', __('models/contacts.fields.message').':') !!}
    {!! Form::text('message', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.contacts.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
