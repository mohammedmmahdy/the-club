<!--begin::Search Form-->
<div class="mb-7">
    <div class="row align-items-center">
        <div class="col-lg-9 col-xl-8">
            <div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->
<!--end: Search Form-->
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/appFeatures.fields.icon')</th>
            <th>@lang('models/appFeatures.fields.text')</th>
            <th>@lang('models/appFeatures.fields.description')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appFeatures as $appFeature)
        <tr>
            <td>{{ $appFeature->icon }}</td>
            <td>{{ $appFeature->text }}</td>
            <td>{{ Str::limit($appFeature->description, 40) }}</td>
            <td>
                {!! Form::open(['route' => ['adminPanel.appFeatures.destroy', $appFeature->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    <a href="{{ route('adminPanel.appFeatures.show', [$appFeature->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    <a href="{{ route('adminPanel.appFeatures.edit', [$appFeature->id]) . '?languages=' . \App::getLocale() }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
