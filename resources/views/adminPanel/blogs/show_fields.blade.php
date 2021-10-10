<!-- Photo Field -->
<div class="form-group show">
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ $blog->photo_original_path }}" alt="{{ $blog->name }}" class="image-thumbnail" width="300">
</div>

<!-- Created At Field -->
<div class="form-group show">
    {!! Form::label('created_at', __('models/blogs.fields.created_at').':') !!}
    <p>{{ $blog->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group show">
    {!! Form::label('updated_at', __('models/blogs.fields.updated_at').':') !!}
    <p>{{ $blog->updated_at }}</p>
</div>

@foreach ( config('langs') as $locale => $name)
<!-- name Field -->
<div class="form-group show">
    {!! Form::label('title', $name . ' ' . __('models/blogs.fields.title').':') !!}
    <span>{{ $blog->translate($locale)->title }}</span>
</div>
<!-- name Field -->
<div class="form-group show">
    {!! Form::label('brief', $name . ' ' . __('models/blogs.fields.brief').':') !!}
    <span>{!! $blog->translate($locale)->brief !!}</span>
</div>
<!-- name Field -->
<div class="form-group show">
    {!! Form::label('description', $name . ' ' . __('models/blogs.fields.description').':') !!}
    <span>{!! $blog->translate($locale)->description !!}</span>
</div>

@endforeach