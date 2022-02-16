<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/onboardings.fields.photo')</th>
            <th>@lang('models/onboardings.fields.text')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($onboardings as $onboarding)
            <tr>
                <td>
                    <img onerror=this.src="{{ asset('uploads/images/original/default.png') }}"
                        src="{{ $onboarding->photo_original_path }}" alt="{{ $onboarding->text }}" width="150">
                </td>
                <td>{{ $onboarding->text }}</td>
                <td nowrap>
                    <div class='btn-group'>
                        @can('onboardings edit')
                            <a href="{{ route('adminPanel.onboardings.edit', [$onboarding->id]) . '?languages=' . \App::getLocale() }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                    </div>
                    {{-- {!! Form::open(['route' => ['adminPanel.onboardings.destroy', $onboarding->id], 'method' => 'delete']) !!}
                        @can('onboardings view')
                            <a href="{{ route('adminPanel.onboardings.show', [$onboarding->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('onboardings destroy')
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("' . __('crud.are_you_sure') . '")']) !!}
                        @endcan
                    {!! Form::close() !!} --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
