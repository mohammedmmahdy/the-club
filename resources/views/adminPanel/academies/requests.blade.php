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
                @lang('models/academies.singular') Requests
                <span class="d-block text-muted pt-2 font-size-sm">Descriptions</span>
            </h3>
        </div>
    </div>

    <div class="card-body">

        <!--begin::Search Form-->
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">

                    {{-- Date Filter --}}
                    <div class="date-filter">
                        <h5>Date Filter</h5>

                        {!! Form::open(['route' => 'adminPanel.academies.requestDateFilter']) !!}
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" placeholder="From" data-target="#kt_datetimepicker_1" name="academy_request_from" value="{{old('academy_request_from', request('academy_request_from'))}}" />
                                    <div class=" input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" placeholder="To" data-target="#kt_datetimepicker_2" name="academy_request_to" value="{{old('academy_request_to', request('academy_request_to'))}}" />
                                    <div class="input-group-append" data-target="#kt_datetimepicker_2" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                {!! Form::submit('Filter', ['class' => 'form-control btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{-- End Date Filter --}}
                    <div class="clearfix"></div>
                    <hr>
                    <h5>Quick Filter</h5>

                    <div class="row align-items-center d-flex">
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search Keyword..." id="kt_datatable_search_query" />
                                <span><i class="flaticon2-search-1 text-muted"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">@lang('lang.status'):</label>
                                <select class="form-control" id="kt_datatable_search_status">
                                    <option value="">@lang('lang.all')</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <hr>
            </div>
        </div>
        <!--end::Search Form-->
        <!--begin: Datatable-->
        <table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Academy</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                <tr>
                    <td>
                        @if ($request->user)
                            <a href="{{route('adminPanel.users.show',$request->user->id)}}">
                                {{$request->user->strMemberName}}
                            </a>
                        @endif
                    </td>
                    <td>{{$request->member_mobile}}</td>
                    <td>{{$request->academy->name ?? ''}}</td>
                    <td>{{$request->status}}</td>
                    <td>{{$request->created_at}}</td>
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





@section('scripts')
<script>
    var KTDatatableHtmlTableDemo = function() {
    // Private functions

    // demo initializer
    var demo = function() {

        var datatable = $('#kt_datatable').KTDatatable({
            data: {
                saveState: { cookie: false },
            },
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            columns: [{
                    field: 'DepositPaid',
                    type: 'number',
                },
                {
                    field: 'OrderDate',
                    type: 'date',
                    format: 'YYYY-MM-DD',
                }, {
                    field: 'Status',
                    title: 'Status',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            0: {
                                'title': 'Inactive',
                                'class': ' label-light-danger'
                            },
                            1: {
                                'title': 'Active',
                                'class': ' label-light-success'
                            },

                        };
                        return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
                    },
                }, {
                    field: 'Type',
                    title: 'Type',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {
                                'title': 'Online',
                                'state': 'danger'
                            },
                            2: {
                                'title': 'Retail',
                                'state': 'primary'
                            },
                            3: {
                                'title': 'Direct',
                                'state': 'success'
                            },
                        };
                        return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
                    },
                },
            ],
        });



        $('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
        },
    };
}();


</script>
@endsection
