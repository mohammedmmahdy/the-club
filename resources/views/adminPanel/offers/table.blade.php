<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/offers.fields.title')</th>
        <th>@lang('models/offers.fields.description')</th>
        <th>@lang('models/offers.fields.discount_value')</th>
        <th>@lang('models/offers.fields.offer_category_id')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offers as $offer)
            <tr>
                <td>{{ $offer->title }}</td>
            <td>{{ $offer->description }}</td>
            <td>{{ $offer->discount_value }}</td>
            <td>{{ $offer->category->name ?? '' }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.offers.destroy', $offer->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('offers view')
                        <a href="{{ route('adminPanel.offers.show', [$offer->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('offers edit')
                        <a href="{{ route('adminPanel.offers.edit', [$offer->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('offers destroy')
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
