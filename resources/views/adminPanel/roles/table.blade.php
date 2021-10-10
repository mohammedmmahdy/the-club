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
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <th>@lang('models/roles.fields.name')</th>
        <th>@lang('crud.action')</th>
    </thead>
    <tbody>
        @foreach($roles as $roles)
        <tr>
            <td>{{ $roles->name }}</td>
            @if($roles->id != 1)
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.roles.destroy', $roles->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    {{-- <a href="{{ route('adminPanel.roles.show', [$roles->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a> --}}
                    @can('roles edit')
                    <a href="{{ route('adminPanel.roles.edit', [$roles->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('roles destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
            @else
            <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
