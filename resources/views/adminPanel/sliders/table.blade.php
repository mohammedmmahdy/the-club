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
                <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                        <label class="mr-3 mb-0 d-none d-md-block">@lang('lang.status'):</label>
                        <select class="form-control" id="kt_datatable_search_status">
                            <option value="">@lang('lang.all')</option>
                            <option value="1">@lang('lang.active')</option>
                            <option value="0">@lang('lang.inactive')</option>
                        </select>
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
            <th>@lang('models/sliders.fields.photo')</th>
            <th>@lang('models/sliders.fields.title')</th>
            <th>@lang('models/sliders.fields.status')</th>
            <th>@lang('models/sliders.fields.sort')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sliders as $slider)
        <tr>
            <td>
                <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{$slider->photo_thumbnail_path}}" alt="{{$slider->name}}" style="width:40px">
            </td>
            <td>{{$slider->title }}</td>
            <td>{{$slider->status }}</td>
            <td>{{$slider->in_order_to }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.sliders.destroy', $slider->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    @can('sliders view')
                    <a href="{{ route('adminPanel.sliders.show', [$slider->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('sliders edit')
                    <a href="{{ route('adminPanel.sliders.edit', [$slider->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('sliders destroy')
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
