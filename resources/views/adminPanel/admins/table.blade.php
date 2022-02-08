<div class="table-responsive-sm">
    <table class="table table-striped " id="admins-table">
        <thead>
            <th>@lang('models/admins.fields.name')</th>
            <th>@lang('models/admins.fields.email')</th>
            <th>@lang('crud.action')</th>
        </thead>
        <tbody>

            @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    {!! Form::open(['route' => ['adminPanel.admins.destroy', $admin->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminPanel.admins.show', [$admin->id]) }}" class='btn btn-ghost-success'><i
                                class="fa fa-eye"></i></a>
                        @can('admins edit')
                        <a href="{{ route('adminPanel.admins.edit', [$admin->id]) }}" class='btn btn-ghost-info'><i
                                class="fa fa-edit"></i></a>
                        @endcan

                        @can('admins destroy')
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn
                        btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>