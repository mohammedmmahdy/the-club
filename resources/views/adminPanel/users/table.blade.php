        <!--begin::Search Form-->
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">

                    {{-- Date Filter --}}
                    <div class="date-filter">
                        <h5>Date Filter</h5>

                        {!! Form::open(['route' => 'adminPanel.users.dateFilter']) !!}
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" placeholder="From" data-target="#kt_datetimepicker_1" name="users_from" value="{{old('users_from', request('users_from'))}}" />
                                    <div class=" input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" placeholder="To" data-target="#kt_datetimepicker_2" name="users_to" value="{{old('users_to', request('users_to'))}}" />
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
                                    <option value="Hold">Hold</option>
                                    <option value="Active">Active</option>
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
            <th>@lang('models/users.fields.id')</th>
            <th>@lang('models/users.fields.member_id')</th>
            <th>@lang('models/users.fields.name')</th>
            <th>@lang('models/users.fields.phone')</th>
            <th>@lang('models/users.fields.email')</th>
            <th>@lang('models/users.fields.status')</th>
            <th>@lang('models/users.fields.created_at')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>

            <td>{{ $user->iMemberId ?? 'Lead' }}</td>

            <td>{{ $user->strMemberName }}</td>
            <td>{{ $user->member_mobile }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->boolMemberStatus == 1 ? 'Active' : 'Hold' }}</td>
            <td>{{ $user->created_at }}</td>

            <td nowrap>
                @can('users view')
                <a href="{{ route('adminPanel.users.show', [$user->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->




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
                    field: 'boolMemberStatus',
                    title: 'Status',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            Hold: {
                                'title': 'Hold',
                                'class': ' label-light-danger'
                            },
                            Active: {
                                'title': 'Active',
                                'class': ' label-light-info'
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
