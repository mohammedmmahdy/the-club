<!-- icon Field -->
<div class="form-group">
    {{-- {!! Form::label('icon', __('models/notifications.fields.icon').':') !!} --}}
    <img onerror=this.src="{{ asset('uploads/images/original/default.png') }}"
    src="{{ asset('uploads/images/original/'. $notification->icon) }}" alt="icon" width="150">
</div>

<!-- Photo Field -->
<div class="form-group">
    {{-- {!! Form::label('photo', __('models/notifications.fields.photo').':') !!} --}}
    <img onerror=this.src="{{ asset('uploads/images/original/default.png') }}"
    src="{{ asset('uploads/images/original/'. $notification->photo) }}" alt="photo" width="300">
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/notifications.fields.created_at').':') !!}
    <b>{{ $notification->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/notifications.fields.updated_at').':') !!}
    <b>{{ $notification->updated_at }}</b>
</div>
<div class="clearfix"></div>
<br><hr><br>
<div class="row">
    @foreach ( config('langs') as $locale => $name)
        <div class="col-12">
            <h2 class="my-4 text-center text-danger">{{ $name }}</h2>
            <!-- Title Field -->
            <div class="form-group">
                {!! Form::label('title', __('models/notifications.fields.title').':') !!}
                <b>{{ $notification->translate($locale)->title }}</b>
            </div>


            <!-- Brief Field -->
            <div class="form-group">
                {!! Form::label('brief', __('models/notifications.fields.brief').':') !!}
                <b>{{ $notification->translate($locale)->brief }}</b>
            </div>


            <!-- Description Field -->
            <div class="form-group">
                {!! Form::label('description', __('models/notifications.fields.description').':') !!}
                <b>{{ $notification->translate($locale)->description }}</b>
            </div>
        </div>
    @endforeach
</div>
