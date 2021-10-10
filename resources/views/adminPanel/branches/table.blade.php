<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/branches.fields.name')</th>
        <th>@lang('models/branches.fields.address')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($branches as $branch)
            <tr>
                <td>{{ $branch->name }}</td>
            <td>{!! $branch->address !!}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.branches.destroy', $branch->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    {{-- @can('branches view')
                        <a href="{{ route('adminPanel.branches.show', [$branch->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
                    @can('branches edit')
                        <a href="{{ route('adminPanel.branches.edit', [$branch->id]). "?languages=" . \App::getLocale()  }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('branches destroy')
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
