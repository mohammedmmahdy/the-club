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
                <!-- text Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('text', __('models/appFeatures.fields.text').':') !!}
                    {!! Form::text($locale . '[text]', isset($appFeature)? $appFeature->translateOrNew($locale)->text : '' , ['class' => 'form-control', 'placeholder' => $name . ' text']) !!}
                </div>
                <!-- name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('description', __('models/appFeatures.fields.description').':') !!}
                    {!! Form::text($locale . '[description]', isset($appFeature)? $appFeature->translateOrNew($locale)->description : '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
                </div>

            </div>

            @endforeach

            <!-- Icon Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('icon', __('models/appFeatures.fields.icon').':') !!}
                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
                <a href="{{ route('adminPanel.appFeatures.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>


        </div>
    </div>
</div>
