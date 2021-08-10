<!-- Page Id Field -->
<div class="form-group show">
    {!! Form::label('page_id', __('models/images.fields.page_id').':') !!}
    <b>{{ $images->page->name }}</b>
</div>

<!-- Photo Field -->
<div class="form-group show">
    {!! Form::label('photo', __('models/images.fields.photo').':') !!}
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{$images->photo}}" alt="{{$images->page->name}}" width="300">
</div>
