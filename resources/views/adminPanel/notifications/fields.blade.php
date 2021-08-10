

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

        <!-- Title Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('title', __('models/notifications.fields.title').':') !!}
            {!! Form::text($locale . '[title]', isset($notification)? $notification->translate($locale)->title : '' , ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
        </div>

        <!-- Brief Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('brief', __('models/notifications.fields.brief').':') !!}
            {!! Form::text($locale . '[brief]', isset($notification)? $notification->translate($locale)->brief : '' , ['class' => 'form-control', 'placeholder' => $name . ' brief']) !!}
        </div>

        <!-- Description Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description', __('models/notifications.fields.description').':') !!}
            {!! Form::textarea($locale . '[description]', isset($notification)? $notification->translate($locale)->description : '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
        </div>

    </div>

    @endforeach

    <!-- Btn To Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('btn_to', __('models/notifications.fields.btn_to').':') !!}
        {!! Form::select('btn_to', ['' => 'Without Button', 'home' => 'Home', 'about' => 'About'], null, ['class' => 'form-control']) !!}
    </div>

    <!-- Photo Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('photo', __('models/notifications.fields.photo').':') !!}

        <br>
        <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
            <div class="image-input-wrapper" style="background-image: url({{isset($notification) ? asset('uploads/images/original/'. $notification->photo) : ''}})"></div>

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

    <!-- Type Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('type', __('models/notifications.fields.type').':') !!}
        {!! Form::select('type', ['1' => 'All', '2' => 'Driver', '3' => 'Customer'], null, ['class' => 'form-control']) !!}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('adminPanel.notifications.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>

</div>
