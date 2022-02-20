<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            {{-- <th>@lang('models/loyalties.fields.photo')</th> --}}
            <th>@lang('models/loyalties.fields.discount_value')</th>
            <th>@lang('models/loyalties.fields.title')</th>
            <th>@lang('models/loyalties.fields.brief')</th>
            <th>@lang('models/loyalties.fields.description')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loyalties as $loyalty)
            <tr>
                {{-- <td>{{ $loyalty->photo }}</td> --}}
                <td>{{ $loyalty->discount_value }}</td>
                <td>{{ $loyalty->title }}</td>
                <td>{{ $loyalty->brief }}</td>
                <td>{!! $loyalty->description !!}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.loyalties.destroy', $loyalty->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('loyalties view')
                            <a href="{{ route('adminPanel.loyalties.show', [$loyalty->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('loyalties edit')
                            <a href="{{ route('adminPanel.loyalties.edit', [$loyalty->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('loyalties destroy')
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
