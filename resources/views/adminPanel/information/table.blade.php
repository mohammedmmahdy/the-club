<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/metas.fields.id')</th>
            <th>@lang('models/information.fields.name')</th>
            <th>@lang('models/information.fields.value')</th>
            <th>@lang('models/information.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>

    <tbody>

        @foreach($information as $info)
        <tr>
            <td>{{ $info->id }}</td>
            <td>{{ $info->name }}</td>
            <td>{{ $info->value }}</td>
            <td>{{ $info->status ? __('lang.active') : __('lang.inactive') }}</td>

            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.information.destroy', $info->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    {{-- @can('information view')
                    <a href="{{ route('adminPanel.information.show', [$info->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
                    @can('information edit')
                    <a href="{{ route('adminPanel.information.edit', [$info->id]) . "?languages=". \App::getLocale() }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    {{-- @can('information destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
