<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/roles.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">

    <table class="table table-hover" id="admins-table">
        <thead>
            <th>
                <label class="checkbox checkbox-outline checkbox-primary">
                    <input type="checkbox" class="check_inputs" value=".inputs-permmission">
                    <span class="mx-2"></span>
                    @lang('models/roles.fields.bulck_select')
                </label>
            </th>
            {{-- <th>@lang('models/admins.fields.name')</th> --}}
            <th></th>
            <th>Control</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>

            @php $page = null @endphp

            @forelse ($permissions as $permission)
            @if ($page != $permission->page)
            <tr>
                <td>

                    {{-- <label class="checkbox checkbox-outline checkbox-primary">
                        <input type="checkbox" name="Checkboxes15" />
                        <span></span>
                        Default
                    </label> --}}

                    <label class="checkbox checkbox-outline checkbox-primary">
                        <input type="checkbox" class="check_inputs inputs-permmission" value=".{{ $permission->page }}">
                        <span></span>
                        <strong class="m-2">{{ $permission->page }}:</strong>
                    </label>
                </td>
                {{-- <td>
                        <strong>{{ $permission->page }}:</strong>
                </td> --}}
                @endif
                <td>
                    @php
                    $checked = old('permissions['. $permission->name .']', isset($roles) ? $roles->hasPermissionTo($permission->name): false );
                    @endphp

                    <label class="checkbox checkbox-outline checkbox-primary">
                        <input type="checkbox" name="{{ 'permissions['. $permission->name .']' }}" value="{{ $permission->name }}" {{ $checked ? 'checked' : '' }} class="inputs-permmission {{ $permission->page }}">
                        <span></span>
                        <code class="ml-2">{{ $permission->action }}</code>
                    </label>
                </td>
                @php $page = $permission->page @endphp
                {{$page != $permission->page ? '</tr>':''}}
                @empty
                <h3 class="text-danger">No Permission Found</h3>
                @endforelse
        </tbody>
    </table>



</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.roles.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
