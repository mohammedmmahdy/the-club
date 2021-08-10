<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/notifications.fields.id')</th>
            <th>@lang('models/metas.fields.language')</th>
            <th>@lang('models/notifications.fields.title')</th>
            <th>@lang('models/notifications.fields.type')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notifications as $notification)
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>{{ $name }}</td>
                <td>{{ $notification->translate($locale)->title }}</td>
                <td>{{ config('customestatus.type_notification.'.$notification->type) }}</td>
                <td nowrap>
                        {!! Form::open(['route' => ['adminPanel.notifications.destroy', $notification->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                        @can('notifications view')
                            <a href="{{ route('adminPanel.notifications.show', [$notification->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('notifications edit')
                            <a href="{{ route('adminPanel.notifications.edit', [$notification->id]) . "?languages=$locale"  }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('notifications destroy')
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                        @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
            </tr>
            @php $i = 0; @endphp
            @endforeach
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
