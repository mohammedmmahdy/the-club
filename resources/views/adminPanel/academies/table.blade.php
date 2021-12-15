<!--begin::Search Form-->
<div class="mb-7">
    <div class="row align-items-center">
        <div class="col-lg-9 col-xl-8">
            <div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..."
                            id="kt_datatable_search_query" />
                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                    </div>
                </div>
                {{-- <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                        <label class="mr-3 mb-0 d-none d-md-block">@lang('lang.status'):</label>
                        <select class="form-control" id="kt_datatable_search_status">
                            <option value="">@lang('lang.all')</option>
                            <option value="0">@lang('lang.inactive')</option>
                            <option value="1">@lang('lang.active')</option>
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/academies.fields.icon')</th>
            <th>@lang('models/academies.fields.name')</th>
            <th>@lang('models/academies.fields.about')</th>
            <th>@lang('models/academies.fields.team')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($academies as $academy)
            <tr>
                <td>
                    <img onError="this.onerror=null;this.src='{{ asset('uploads/images/original/default.png') }}';"
                        src="{{ $academy->icon_thumbnail_path }}" alt="" width="60">
                </td>
                <td>{{ $academy->name }}</td>
                <td>{!! Str::limit($academy->about, 50) !!}</td>
                <td>{!! Str::limit($academy->team, 50) !!}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.academies.destroy', $academy->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('academies view')
                            <a href="{{ route('adminPanel.academies.show', [$academy->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('academies edit')
                            <a href="{{ route('adminPanel.academies.edit', [$academy->id]) . '?languages=' . \App::getLocale() }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i
                                    class="fa fa-edit"></i></a>
                        @endcan
                        @can('academies destroy')
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
