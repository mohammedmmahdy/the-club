<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/notifications.fields.id')</th>
            <th>@lang('models/notifications.fields.title')</th>
            <th>@lang('models/notifications.fields.brief')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->brief }}</td>
                <td nowrap>
                        {!! Form::open(['route' => ['adminPanel.notifications.destroy', $notification->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                        @can('notifications view')
                            <a href="{{ route('adminPanel.notifications.show', [$notification->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('notifications edit')
                            <a href="{{ route('adminPanel.notifications.edit', [$notification->id]) . "?languages=en"  }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('notifications destroy')
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
