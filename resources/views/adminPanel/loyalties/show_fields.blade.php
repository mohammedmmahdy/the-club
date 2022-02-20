<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/loyalties.fields.id').':') !!}
    <b>{{ $loyalty->id }}</b>
</div>


<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/loyalties.fields.photo').':') !!}
    <b>{{ $loyalty->photo }}</b>
</div>


<!-- Discount Value Field -->
<div class="form-group">
    {!! Form::label('discount_value', __('models/loyalties.fields.discount_value').':') !!}
    <b>{{ $loyalty->discount_value }}</b>
</div>


<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/loyalties.fields.title').':') !!}
    <b>{{ $loyalty->title }}</b>
</div>


<!-- Brief Field -->
<div class="form-group">
    {!! Form::label('brief', __('models/loyalties.fields.brief').':') !!}
    <b>{{ $loyalty->brief }}</b>
</div>


<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/loyalties.fields.description').':') !!}
    <b>{{ $loyalty->description }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/loyalties.fields.created_at').':') !!}
    <b>{{ $loyalty->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/loyalties.fields.updated_at').':') !!}
    <b>{{ $loyalty->updated_at }}</b>
</div>


