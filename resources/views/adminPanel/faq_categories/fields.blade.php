<div class="row">
    <div class="col nav-tabs-boxed">

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
                <div class="form-group col-sm-12">
                    {!! Form::label('name', __('models/faqCategories.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($faqCategory)? $faqCategory->translateOrNew($locale)->name : '' ,
                    ['class' =>
                    'form-control', 'placeholder' => $name . ' name']) !!}
                </div>
            </div>

            @php $i = 0; @endphp
            @endforeach

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.faqCategories.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>


        </div>
    </div>
</div>
