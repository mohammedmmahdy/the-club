<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/news.fields.id').':') !!}
    <b>{{ $news->id }}</b>
</div>


<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/news.fields.photo').':') !!}
    <b>{{ $news->photo }}</b>
</div>


<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/news.fields.title').':') !!}
    <b>{{ $news->title }}</b>
</div>


<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', __('models/news.fields.body').':') !!}
    <b>{{ $news->body }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/news.fields.created_at').':') !!}
    <b>{{ $news->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/news.fields.updated_at').':') !!}
    <b>{{ $news->updated_at }}</b>
</div>


