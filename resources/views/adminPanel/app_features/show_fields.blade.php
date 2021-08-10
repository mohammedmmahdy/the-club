<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/appFeatures.fields.id').':') !!}
    <b>{{ $appFeature->id }}</b>
</div>

<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/appFeatures.fields.icon').':') !!}
    <b>{{ $appFeature->icon }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/appFeatures.fields.created_at').':') !!}
    <b>{{ $appFeature->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/appFeatures.fields.updated_at').':') !!}
    <b>{{ $appFeature->updated_at }}</b>
</div>


<hr>
<br>
@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('text', __('models/appFeatures.fields.text').':') !!}
    <b>{{ $appFeature->translateOrNew($locale)->text }}</b>
</div>
<div class="form-group">
    {!! Form::label('description', __('models/appFeatures.fields.description').':') !!}
    <b>{{ $appFeature->translateOrNew($locale)->description }}</b>
</div>
@endforeach
