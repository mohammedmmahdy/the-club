<!--begin: Datatable-->
{{-- <table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable1"> --}}
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">


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
                <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{$slider->photo_thumbnail_path}}" alt="{{$slider->name}}" style="width:150px">
            </td>
            <td>{{$slider->title }}</td>
            <td>{{$slider->status ? __('lang.active'): __('lang.inactive') }}</td>
            <td>{{$slider->in_order_to }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.sliders.destroy', $slider->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    {{-- @can('sliders view')
                    <a href="{{ route('adminPanel.sliders.show', [$slider->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
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
