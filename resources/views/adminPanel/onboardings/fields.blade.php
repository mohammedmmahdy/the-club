<ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">
    @php $i = 1; @endphp
    @foreach (config('langs') as $locale => $name)

        <li class="nav-item">
            <a class="nav-link {{ $i ? 'active' : '' }}" id="{{ $name }}-tab" data-toggle="pill"
                href="#{{ $name }}" role="tab" aria-controls="{{ $name }}"
                aria-selected="{{ $i ? 'true' : 'false' }}">{{ $name }}</a>
        </li>

        @php $i = 0; @endphp
    @endforeach
</ul>
<div class="tab-content mt-5" id="myTabContent">
    @php $i = 1; @endphp
    @foreach (config('langs') as $locale => $name)

        <div class="tab-pane fade {{ $i ? 'show active' : '' }}" id="{{ $name }}" role="tabpanel"
            aria-labelledby="{{ $name }}-tab">

            <!-- text Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('text', __('models/onboardings.fields.text') . ':') !!}
                {!! Form::text($locale . '[text]', isset($onboarding) ? $onboarding->translate($locale)->text : '', ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
            </div>

        </div>

        @php $i = 0; @endphp
    @endforeach



    <div class="form-group col-sm-6 float-right d-flex">
        <p class="p-4 text-center align-middle bg-warning  text-white rounded"><strong>Photo Hint:</strong> 9:20 like 375*812 </p>
    </div>

    <!-- Photo -->
    <div class="form-group col-sm-6">
        {!! Form::label('photo', __('models/onboardings.fields.photo') . ':') !!}
        <br>
        <div class="image-input image-input-outline" id="kt_image_4"
            style="background-image: url({{ asset('uploads/images/original/default.png') }})">
            <div class="image-input-wrapper"
                style="background-image: url({{ $onboarding->photo_original_path ?? '' }})">
            </div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="change" data-toggle="tooltip" title="" data-original-title="Change photo">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="photo_remove" />
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="cancel" data-toggle="tooltip" title="Cancel photo">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="remove" data-toggle="tooltip" title="Remove photo">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
        </div>
    </div>


    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('adminPanel.onboardings.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>
