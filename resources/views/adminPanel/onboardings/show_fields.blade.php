<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/onboardings.fields.id').':') !!}
    <b>{{ $onboarding->id }}</b>
</div>


<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', __('models/onboardings.fields.text').':') !!}
    <b>{{ $onboarding->text }}</b>
</div>


<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/onboardings.fields.photo').':') !!}
    <b>{{ $onboarding->photo }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/onboardings.fields.created_at').':') !!}
    <b>{{ $onboarding->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/onboardings.fields.updated_at').':') !!}
    <b>{{ $onboarding->updated_at }}</b>
</div>


