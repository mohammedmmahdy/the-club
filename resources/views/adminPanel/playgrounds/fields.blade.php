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
        <!-- name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', __('models/playgrounds.fields.name').':') !!}
            {!! Form::text($locale . '[name]', isset($playground)? $playground->translate($locale)->name : '' , ['class' =>
            'form-control', 'placeholder' => $name . ' name']) !!}
        </div>


        <!-- description Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description', __('models/playgrounds.fields.description').':') !!}

            {!! Form::textarea($locale . '[description]', isset($playground)? $playground->translate($locale)->description : ''
            , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
        </div>

        {{-- <script type="text/javascript">
            CKEDITOR.replace("{{ $locale . '[description]' }}", {
        filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
        });
        </script> --}}

    </div>

    @php $i = 0; @endphp
    @endforeach

    <!-- Type Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('playground_type_id', __('models/playgrounds.fields.type_id').':') !!}
        {!! Form::select('playground_type_id', $playgroundTypes, null, ['class' => 'form-control','placeholder' => 'Select Type']) !!}
    </div>

    <!-- Price Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('price', __('models/playgrounds.fields.price').':') !!}
        {!! Form::number('price', null, ['class' => 'form-control']) !!}
    </div>


    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('adminPanel.playgrounds.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
    </div>
