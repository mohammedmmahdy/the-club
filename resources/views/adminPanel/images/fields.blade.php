@if (isset($images))
<img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{asset('uploads/images/original/'. $images->photo)}}" alt="{{$images->page->name}}">
@endif

<!-- Photo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo', __('models/images.fields.photo').':') !!}

    <br>
    <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
        <div class="image-input-wrapper" style="background-image: url({{isset($images) ? asset('uploads/images/original/'. $images->photo) : ''}})"></div>

        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change photo">
            <i class="fa fa-pen icon-sm text-muted"></i>
            <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="photo_remove" />
        </label>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel photo">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove photo">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.pages.images.index',isset($images) ? $images->page_id : $page->id) }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
