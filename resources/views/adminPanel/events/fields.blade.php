







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
        <!-- title Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', __('models/events.fields.title').':') !!}
            {!! Form::text($locale . '[title]', isset($event)? $event->translate($locale)->title : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' title']) !!}
        </div>


        <!-- description Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description', __('models/events.fields.description').':') !!}

            {!! Form::textarea($locale . '[description]', isset($event)? $event->translate($locale)->description : ''
            , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
        </div>

        <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[description]' }}", {
        filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
        });
        </script>

    </div>

    @php $i = 0; @endphp
    @endforeach

    <!-- Photo -->
    <div class="form-group col-sm-6">
        {!! Form::label('photo', __('models/events.fields.photo').':') !!}
        <br>
        <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
            <div class="image-input-wrapper" style="background-image: url({{$event->photo_original_path ?? ''}})"></div>

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

    <!-- icon -->
    <div class="form-group col-sm-6">
        {!! Form::label('icon', __('models/events.fields.icon').':') !!}
        <br>
        <div class="image-input image-input-outline" id="kt_image_3" style="background-image: url({{asset('uploads/images/original/default.png')}})">
            <div class="image-input-wrapper" style="background-image: url({{$event->icon_original_path ?? ''}})"></div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change icon">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="icon" accept=".png, .jpg, .jpeg" />
                <input type="hidden" name="icon_remove" />
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel icon">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove icon">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
        </div>
    </div>


    {{-- Date --}}
    <div class="form-group col-sm-12">
        <div class="col-sm-4">
            <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" placeholder="Date" data-target="#kt_datetimepicker_1" name="date" value="{{isset($event) ? $event->date :old('date', request('date'))}}" />
                <div class=" input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                    <span class="input-group-text">
                        <i class="ki ki-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>





<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.events.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
