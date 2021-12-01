<!--begin::Search Form-->
<div class="mb-7">
    <div class="row align-items-center">
        <div class="col-lg-9 col-xl-8">
            <div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                    </div>
                </div>
                <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                        <label class="mr-3 mb-0 d-none d-md-block">@lang('lang.status'):</label>
                        <select class="form-control" id="kt_datatable_search_status">
                            <option value="">@lang('lang.all')</option>
                            <option value="0">Inactive</option>
                            <option value="1">Lead</option>
                            <option value="2">Member</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
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
                            false: {
                                'title': 'Hold',
                                'class': ' label-light-danger'
                            },
                            true: {
                                'title': 'Active',
                                'class': ' label-light-info'
                            },
                            null: {
                                'title': 'Lead',
                                'class': ' label-light-info'
                            }

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
