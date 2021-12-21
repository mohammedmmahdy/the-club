<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/socialLinks.fields.name')</th>
            <th>@lang('models/socialLinks.fields.link')</th>
            <th>@lang('models/socialLinks.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($socialLinks as $socialLink)
        <tr>
            <td>{{ $socialLink->name }}</td>
            <td>{{ $socialLink->link }}</td>
            <td>{{ $socialLink->status ? __('lang.active') : __('lang.inactive') }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.socialLinks.destroy', $socialLink->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    {{-- @can('socialLinks view')
                    <a href="{{ route('adminPanel.socialLinks.show', [$socialLink->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
                    @can('socialLinks edit')

                    <a href="{{ route('adminPanel.socialLinks.edit', [$socialLink->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan

                    {{-- {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!} --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
