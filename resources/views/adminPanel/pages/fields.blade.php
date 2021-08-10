<div class="row">
    <div class="col nav-tabs-boxed">

        <ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

            @foreach ( config('langs') as $locale => $name)

            <li class="nav-item">
                <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
            </li>


            @endforeach
        </ul>

        <div class="tab-content mt-5" id="myTabContent">


            @foreach ( config('langs') as $locale => $name)

            <div class="tab-pane fade {{request('languages') == $locale ?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
                <!-- name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('title', __('models/pages.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($page)? $page->translate($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
                </div>

                <!-- Content Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('Content', __('models/pages.fields.content').':') !!}
                    {!! Form::textarea($locale . '[content]', isset($page)? $page->translate($locale)->content : '' , ['class' => 'form-control', 'placeholder' => $name . ' content']) !!}
                </div>
                <script type="text/javascript">
                    CKEDITOR.replace("{{ $locale . '[content]' }}", {
                filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
                </script>
            </div>

            @endforeach
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
                <a href="{{ route('adminPanel.pages.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>
        </div>
    </div>
</div>
