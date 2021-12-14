
<!-- Fav Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fav_icon', __('models/options.fields.fav_icon').':') !!}

    <br>
    <div class="image-input image-input-outline" id="kt_image_2" style="background-image: url({{asset('uploads/images/original/default.png')}})">
        <div class="image-input-wrapper" style="background-image: url({{isset($option) ? asset('uploads/images/original/'. $option->fav_icon) : ''}})"></div>

        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Fav Icon">
            <i class="fa fa-pen icon-sm text-muted"></i>
            <input type="file" name="fav_icon" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="fav_icon_remove" />
        </label>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Fav Icon">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Fav Icon">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
</div>
<div class="clearfix"></div>

<!-- logo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('logo', __('models/options.fields.logo').':') !!}

    <br>
    <div class="image-input image-input-outline" id="kt_image_3" style="background-image: url({{asset('uploads/images/original/default.png')}})">
        <div class="image-input-wrapper" style="background-image: url({{isset($option) ? asset('uploads/images/original/'. $option->logo) : ''}})"></div>

        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
            <i class="fa fa-pen icon-sm text-muted"></i>
            <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="logo_remove" />
        </label>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel logo">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove logo">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
</div>
<div class="clearfix"></div>


<!-- wifi_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wifi_name', __('models/options.fields.wifi_name').':') !!}
    {!! Form::text('wifi_name', null, ['class' => 'form-control']) !!}
</div>

<!-- wifi_password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wifi_password', __('models/options.fields.wifi_password').':') !!}
    {!! Form::text('wifi_password', null, ['class' => 'form-control']) !!}
</div>

<!-- safety_ratio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('safety_ratio', __('models/options.fields.safety_ratio').':') !!}
    {!! Form::number('safety_ratio', null, ['class' => 'form-control', 'min' => 0, 'max' => 100]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.options.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
