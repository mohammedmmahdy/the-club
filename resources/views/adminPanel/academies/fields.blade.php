<ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
    </li>

    @endforeach
</ul>
<div class="tab-content mt-5" id="myTabContent">
    @foreach ( config('langs') as $locale => $name)
    <div class="tab-pane fade {{request('languages') == $locale?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', __('models/academies.fields.name').':') !!}
            {!! Form::text($locale . '[name]', isset($academy)? $academy->translate($locale)->name : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' name']) !!}
        </div>

        <!-- about Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('about', __('models/academies.fields.about').':') !!}
            {!! Form::textarea($locale . '[about]', isset($academy)? $academy->translate($locale)->about : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' about']) !!}
        </div>
        <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[about]' }}", {
                filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>

        <!-- team Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('team', __('models/academies.fields.team').':') !!}
            {!! Form::textarea($locale . '[team]', isset($academy)? $academy->translate($locale)->team : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' team']) !!}
        </div>
        <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[team]' }}", {
                filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    </div>
    @endforeach

    <!-- academy Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('branch_id', __('models/academies.fields.branch_id').':') !!}
        {!! Form::select('branch_id', $branches, null, ['class' => 'form-control', 'placeholder' => 'Select Branch']) !!}
    </div>

    <!-- icon Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('icon', __('models/academies.fields.icon').':') !!}

        <br>
        <div class="image-input image-input-outline" id="kt_image_3" style="background-image: url({{asset('uploads/images/original/default.png')}})">
            <div class="image-input-wrapper" style="background-image: url({{isset($academy) ? asset('uploads/images/original/'. $academy->icon) : ''}})"></div>

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
    <div class="clearfix"></div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
        <a href="{{ route('adminPanel.academies.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>


</div>
