<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/playgroundTypes.fields.name')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($playgroundTypes as $playgroundType)
            <tr>
                <td>
                    <img
                    {{-- onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" --}}
                    src="{{$playgroundType->photo_thumbnail_path}}" alt="{{$playgroundType->name}}" style="width:80px">
                </td>
                <td>{{ $playgroundType->name }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.playgroundTypes.destroy', $playgroundType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{-- @can('playgroundTypes view')
                        <a href="{{ route('adminPanel.playgroundTypes.show', [$playgroundType->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
                        @can('playgroundTypes edit')
                            <a href="{{ route('adminPanel.playgroundTypes.edit', [$playgroundType->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('playgroundTypes destroy')
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
