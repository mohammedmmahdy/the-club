<ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">
    @php $i = 1; @endphp
    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{$i?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ $i ? 'true' : 'false'}}">{{$name}}</a>
    </li>

    @php $i = 0; @endphp
    @endforeach
</ul>
<div class="tab-content mt-5" id="myTabContent">
    @php $i = 1; @endphp
    @foreach ( config('langs') as $locale => $name)

    <div class="tab-pane fade {{$i?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', __('models/sliders.fields.title').':') !!}
            {!! Form::text($locale . '[title]', isset($slider)? $slider->translate($locale)->title : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' title']) !!}
        </div>

        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('subtitle', __('models/sliders.fields.subtitle').':') !!}
            {!! Form::text($locale . '[subtitle]', isset($slider)? $slider->translate($locale)->subtitle : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' subtitle']) !!}
        </div>

        <!-- Button text Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', __('models/sliders.fields.button_text').':') !!}
            {!! Form::text($locale . '[button_text]', isset($slider)? $slider->translate($locale)->button_text : '' ,
            ['class'
            => 'form-control', 'placeholder' => $name . ' Button Text']) !!}
        </div>


        <!-- content Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('content', __('models/sliders.fields.content').':') !!}

            {!! Form::textarea($locale . '[content]', isset($slider)? $slider->translate($locale)->content : ''
            , ['class' => 'form-control', 'placeholder' => $name . ' content']) !!}
        </div>

        {{--

        <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[description]' }}", {
        filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
        });
        </script> --}}

    </div>

    @php $i = 0; @endphp
    @endforeach

    <div class="form-group col-sm-6">
        {{-- @if (isset($slider))
        <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{asset('uploads/images/thumbnail/'. $slider->photo)}}" class="" style="width: 200px" alt="">
        @endif --}}
        {!! Form::label('photo', __('models/sliders.fields.photo').':') !!}
        <br>
        <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
            <div class="image-input-wrapper" style="background-image: url({{$slider->photo_original_path ?? ''}})"></div>

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

    <!-- Link Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('link', __('models/sliders.fields.link').':') !!}
        {!! Form::text('link', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Sort Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('sort', __('models/sliders.fields.sort').':') !!}
        {!! Form::number('in_order_to', 1, ['class' => 'form-control']) !!}
    </div>

    <!-- Status Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('status', __('models/services.fields.status').':') !!}
        <div class="radio-inline">
            <label class="radio">
                {!! Form::radio('status', "1", 'Active') !!}
                <span></span>
                @lang('lang.active')
            </label>

            <label class="radio">
                {!! Form::radio('status', " 0", null) !!}
                <span></span>
                @lang('lang.inactive')
            </label>
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
        <a href="{{ route('adminPanel.sliders.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>

</div>
