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
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/images.fields.page_id')</th>
            <th>@lang('models/images.fields.photo')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($images as $images)
        <tr>
            <td>{{ $images->page->name }}</td>
            <td>
                <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{$images->photo}}" alt="{{$images->page->name}}" width="150">
            </td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.images.destroy', $images->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    <a href="{{ route('adminPanel.images.show', [$images->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    <a href="{{ route('adminPanel.images.edit', [$images->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
