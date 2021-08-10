<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/sliders.fields.id').':') !!}
    <p>{{ $slider->id }}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/sliders.fields.photo').':') !!}
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" width="400" src="{{ asset('uploads/images/thumbnail/'. $slider->photo) }}" alt="{{ $slider->title }}">
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/sliders.fields.title').':') !!}
    <p>{{ $slider->title }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/sliders.fields.description').':') !!}
    <p>{{ $slider->description }}</p>
</div>

<!-- Link Field -->
<div class="form-group">
    {!! Form::label('link', __('models/sliders.fields.link').':') !!}
    <p>{{ $slider->link }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/sliders.fields.status').':') !!}
    <p>{{ $slider->status }}</p>
</div>

<!-- Sort Field -->
<div class="form-group">
    {!! Form::label('sort', __('models/sliders.fields.sort').':') !!}
    <p>{{ $slider->sort }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/sliders.fields.created_at').':') !!}
    <p>{{ $slider->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/sliders.fields.updated_at').':') !!}
    <p>{{ $slider->updated_at }}</p>
</div>