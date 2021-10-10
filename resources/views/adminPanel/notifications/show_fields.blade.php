<!-- Photo Field -->
<div class="form-group">
    {{-- {!! Form::label('photo', __('models/notifications.fields.photo').':') !!} --}}
    <img src="{{ asset('uploads/images/original/'. $notification->photo) }}" alt="photo" width="300">
</div>

<!-- Btn To Field -->
<div class="form-group">
    {!! Form::label('btn_to', __('models/notifications.fields.btn_to').':') !!}
    <b>{{ config('customestatus.btn_notification.'.$notification->btn_to) }}</b>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', __('models/notifications.fields.type').':') !!}
    <b>{{ config('customestatus.type_notification.'.$notification->type) }}</b>
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

<div class="row">
    @foreach ( config('langs') as $locale => $name)
        <div class="col-6">
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
