<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/champs.fields.photo')</th>
            <th>@lang('models/champs.fields.title')</th>
            <th>@lang('models/champs.fields.body')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($champs as $champ)
            <tr>
                <td>
                    <img onerror=this.src="{{ asset('uploads/images/original/default.png') }}"
                        src="{{ $champ->photo_original_path }}" alt="{{ $champ->title }}" width="60">
                </td>
                <td>{{ $champ->title }}</td>
                <td>{!! Str::limit($champ->body, 80) !!}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.champs.destroy', $champ->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{-- @can('champs view')
                            <a href="{{ route('adminPanel.champs.show', [$champ->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan --}}
                        @can('champs edit')
                            <a href="{{ route('adminPanel.champs.edit', [$champ->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('champs destroy')
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
