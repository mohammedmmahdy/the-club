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
            <th>@lang('models/playgrounds.fields.name')</th>
            <th>@lang('models/playgrounds.fields.description')</th>
            <th>@lang('models/playgrounds.fields.type_id')</th>
            <th>@lang('models/playgrounds.fields.price')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($playgrounds as $playground)
            <tr>
                <td>{{ $playground->name }}</td>
                <td>{!! Str::limit($playground->description, 80) !!}</td>
                <td>{{ $playground->playgroundType->name ?? '' }}</td>
                <td>{{ $playground->price }} @lang('lang.currency')</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.playgrounds.destroy', $playground->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('playgrounds view')
                            <a href="{{ route('adminPanel.playgrounds.show', [$playground->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('playgrounds edit')
                            <a href="{{ route('adminPanel.playgrounds.edit', [$playground->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('playgrounds destroy')
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
