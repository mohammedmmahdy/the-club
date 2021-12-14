
<!-- first_name Field -->
<div class="form-group show">
    {!! Form::label('strMemberName', __('models/users.fields.name').':') !!}
    <b>{{ $user->strMemberName }}</b>
</div>

<!-- id Field -->
<div class="form-group show">
    {!! Form::label('id', __('models/users.fields.id').':') !!}
    <b>{{ $user->id }}</b>
</div>

<!-- phone Field -->
<div class="form-group show">
    {!! Form::label('member_mobile', __('models/users.fields.phone').':') !!}
    <b>{{ $user->member_mobile }}</b>
</div>

<!-- member_id Field -->
<div class="form-group show">
    {!! Form::label('iMemberId', __('models/users.fields.member_id').':') !!}
    <b>{{ $user->iMemberId }}</b>
</div>


<!-- email Field -->
<div class="form-group show">
    {!! Form::label('email', __('models/users.fields.email').':') !!}
    <b>{{ $user->email }}</b>
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

<!-- status Field -->
<div class="form-group show">
    {!! Form::label('status', __('models/users.fields.status').':') !!}
    <b>{{ $user->status_text }}</b>
</div>

<!-- num_of_children Field -->
<div class="form-group show">
    {!! Form::label('num_of_children', __('models/users.fields.num_of_children').':') !!}
    <b>{{ $user->num_of_children }}</b>
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
                <th>Academy</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Progress (%)</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->academies as $request)
            <tr>
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
                    {!! Form::open(['route' => ['adminPanel.academies.updateProgress',$request->id], 'method' => 'patch', 'class' => 'd-flex']) !!}

                    {!! Form::number('status', $request->progress, ['class' => 'form-control mx-2']) !!}
                    {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary']) !!}

                    {!! Form::close() !!}
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
