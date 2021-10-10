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
            {!! Form::label('name', __('models/branches.fields.name').':') !!}
            {!! Form::text($locale . '[name]', isset($branch)? $branch->translate($locale)->name : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' name']) !!}
        </div>

        <!-- address Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('address', __('models/branches.fields.address').':') !!}
            {!! Form::textarea($locale . '[address]', isset($branch)? $branch->translate($locale)->address : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' address']) !!}
        </div>
        <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[address]' }}", {
                filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    </div>
    @endforeach

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
        <a href="{{ route('adminPanel.branches.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>


</div>
