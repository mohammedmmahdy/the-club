<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/options.fields.min_model_year')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($options as $option)
            <tr>
                <td>{{ $option->min_model_year }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.options.destroy', $option->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('options view')
                        <a href="{{ route('adminPanel.options.show', [$option->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('options edit')
                        <a href="{{ route('adminPanel.options.edit', [$option->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('options destroy')
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
