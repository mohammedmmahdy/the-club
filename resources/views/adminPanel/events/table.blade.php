<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/events.fields.icon')</th>
            <th>@lang('models/events.fields.title')</th>
        <th>@lang('models/events.fields.description')</th>
        <th>@lang('models/events.fields.date')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <td>
                    <img onerror="{{asset('uploads/images/original/default.png')}}"
                        src="{{$event->icon_original_path}}"
                        alt="{{$event->title}}"
                        width="60">
                </td>
                <td>{{ $event->title }}</td>
                <td>{!! Str::limit($event->description,150)  !!}</td>
                <td>{{ $event->date }}</td>

                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.events.destroy', $event->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('events view')
                        <a href="{{ route('adminPanel.events.show', [$event->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('events edit')
                        <a href="{{ route('adminPanel.events.edit', [$event->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('events destroy')
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
