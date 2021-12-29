<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/offerCategories.fields.name')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offerCategories as $offerCategory)
            <tr>
                <td>{{ $offerCategory->name }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.offerCategories.destroy', $offerCategory->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    {{-- @can('offerCategories view')
                        <a href="{{ route('adminPanel.offerCategories.show', [$offerCategory->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
                    @can('offerCategories edit')
                        <a href="{{ route('adminPanel.offerCategories.edit', [$offerCategory->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('offerCategories destroy')
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
