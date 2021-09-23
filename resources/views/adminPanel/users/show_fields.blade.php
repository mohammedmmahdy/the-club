<!-- id Field -->
<div class="form-group show">
    {!! Form::label('id', __('models/users.fields.id').':') !!}
    <b>{{ $user->id }}</b>
</div>

<!-- first_name Field -->
<div class="form-group show">
    {!! Form::label('first_name', __('models/users.fields.first_name').':') !!}
    <b>{{ $user->first_name }}</b>
</div>

<!-- last_name Field -->
<div class="form-group show">
    {!! Form::label('last_name', __('models/users.fields.last_name').':') !!}
    <b>{{ $user->last_name }}</b>
</div>

<!-- member_id Field -->
<div class="form-group show">
    {!! Form::label('member_id', __('models/users.fields.member_id').':') !!}
    <b>{{ $user->member_id }}</b>
</div>

<!-- email Field -->
<div class="form-group show">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <b>{{ $user->email }}</b>
</div>

<!-- phone Field -->
<div class="form-group show">
    {!! Form::label('phone', __('models/users.fields.phone').':') !!}
    <b>{{ $user->phone }}</b>
</div>

<!-- social_status Field -->
<div class="form-group show">
    {!! Form::label('social_status', __('models/users.fields.social_status').':') !!}
    <b>
        @switch($user->social_status)
        @case(1)
        Single
        @break
        @case(2)
        Married
        @break
        @default

        @endswitch
    </b>
</div>

<!-- num_of_children Field -->
<div class="form-group show">
    {!! Form::label('num_of_children', __('models/users.fields.num_of_children').':') !!}
    <b>{{ $user->num_of_children }}</b>
</div>

<!-- status Field -->
<div class="form-group show">
    {!! Form::label('status', __('models/users.fields.status').':') !!}
    <b>{{ $user->status_text }}</b>
</div>

<!-- created_at Field -->
<div class="form-group show">
    {!! Form::label('created_at', __('models/users.fields.created_at').':') !!}
    <b>{{ $user->created_at}}</b>
</div>

<!-- updated_at Field -->
<div class="form-group show">
    {!! Form::label('updated_at', __('models/users.fields.updated_at').':') !!}
    <b>{{ $user->updated_at}}</b>
</div>
