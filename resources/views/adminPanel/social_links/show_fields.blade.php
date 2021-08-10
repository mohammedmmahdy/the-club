<!-- Id Field -->
<div class="form-group show">
    {!! Form::label('id', __('models/socialLinks.fields.id').':') !!}
    <b>{{ $socialLink->id }}</b>
</div>

<!-- Name Field -->
<div class="form-group show">
    {!! Form::label('name', __('models/socialLinks.fields.name').':') !!}
    <b>{{ $socialLink->name }}</b>
</div>

<!-- Link Field -->
<div class="form-group show">
    {!! Form::label('link', __('models/socialLinks.fields.link').':') !!}
    <b>{{ $socialLink->link }}</b>
</div>

<!-- Status Field -->
<div class="form-group show">
    {!! Form::label('status', __('models/socialLinks.fields.status').':') !!}
    <b>{{ $socialLink->status }}</b>
</div>
