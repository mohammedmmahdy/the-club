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
                <!-- Title Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('title', __('models/metas.fields.title').':') !!}
                    {!! Form::text($locale . '[title]', isset($meta)? $meta->translate($locale)->title : '' , ['class'
                    => 'form-control', 'placeholder' => $name . ' title']) !!}
                </div>

                <!-- Description Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('description', __('models/metas.fields.description').':') !!}
                    {!! Form::textarea($locale . '[description]', isset($meta)? $meta->translate($locale)->description :
                    '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
                </div>

                <!-- Keywords Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('keywords', __('models/metas.fields.keywords').':') !!}
                    {!! Form::textarea($locale . '[keywords]', isset($meta)? $meta->translate($locale)->keywords : '' ,
                    ['class' => 'form-control', 'placeholder' => $name . ' keywords']) !!}
                </div>
            </div>

            @endforeach
            {{--  Page Id Field  --}}
            <div class="form-group col-sm-6">
                {!! Form::label('page', __('models/metas.fields.page').':') !!}
                {!! Form::text('page', null, ['class' => 'form-control']) !!}
            </div>


            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
                <a href="{{ route('adminPanel.metas.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>
        </div>
    </div>
</div>
