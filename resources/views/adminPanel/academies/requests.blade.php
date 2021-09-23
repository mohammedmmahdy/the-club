@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">@lang('models/academies.plural')</li>
</ul>
@endsection
@section('content')
    @include('flash::message')
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    @lang('models/academies.plural')
                    <span class="d-block text-muted pt-2 font-size-sm">Descriptions</span>
                </h3>
            </div>
        </div>

        <div class="card-body">

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
                    @foreach ($requests as $request)
                    <tr>
                        <td>
                            <a href="{{route('adminPanel.users.show',$request->user->id)}}">
                                {{$request->user->first_name ?? ''}} {{$request->user->last_name ?? ''}}
                            </a>
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
    </div>
<!--end::Card-->
@endsection
