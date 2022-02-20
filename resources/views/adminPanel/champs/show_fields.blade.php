<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/champs.fields.id').':') !!}
    <b>{{ $champ->id }}</b>
</div>


<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/champs.fields.photo').':') !!}
    <b>{{ $champ->photo }}</b>
</div>


<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/champs.fields.title').':') !!}
    <b>{{ $champ->title }}</b>
</div>


<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', __('models/champs.fields.body').':') !!}
    <b>{{ $champ->body }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/champs.fields.created_at').':') !!}
    <b>{{ $champ->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/champs.fields.updated_at').':') !!}
    <b>{{ $champ->updated_at }}</b>
</div>


