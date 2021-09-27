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
<div class="clearfix"></div>

<br>
<hr>
<h3 class="d-block w-100">User Academies</h3>
<br>
<div class="user-academies w-100">
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Phone</th>
                <th>Branch</th>
                <th>Academy</th>
                <th>Age</th>
                <th>Gender</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->academies as $request)
            <tr>
                <td>
                    {{$request->user->first_name ?? ''}} {{$request->user->last_name ?? ''}}
                </td>
                <td>{{$request->phone}}</td>
                <td>{{$request->academy->branch->name ?? ''}}</td>
                <td>{{$request->academy->name ?? ''}}</td>
                <td>{{$request->age}}</td>
                <td>
                    @switch($request->gender)
                    @case(1)
                    Male
                    @break
                    @case(2)
                    Female
                    @break
                    @default

                    @endswitch
                </td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.academies.changeRequestStatus',$request->id], 'method' => 'patch', 'class' => 'd-flex']) !!}

                    {!! Form::select('status', [1 => 'Active', 0 => 'Inactive '], $request->status, ['class' => 'form-control mx-2']) !!}
                    {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) !!}

                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
