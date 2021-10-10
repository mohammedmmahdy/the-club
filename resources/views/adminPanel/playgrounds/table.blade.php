<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/playgrounds.fields.type_id')</th>
            <th>@lang('models/playgrounds.fields.name')</th>
            <th>@lang('models/playgrounds.fields.description')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($playgrounds as $playground)
            <tr>
                <td>{{ $playground->playgroundType->name ?? '' }}</td>
                <td>{{ $playground->name }}</td>
                <td>{!! Str::limit($playground->description, 150) !!}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.playgrounds.destroy', $playground->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('playgrounds view')
                            <a href="{{ route('adminPanel.playgrounds.show', [$playground->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('playgrounds edit')
                            <a href="{{ route('adminPanel.playgrounds.edit', [$playground->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('playgrounds destroy')
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("' . __('crud.are_you_sure') . '")']) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
