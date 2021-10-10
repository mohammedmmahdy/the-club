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
            <th>@lang('models/newsletters.fields.email')</th>
            <th>@lang('models/newsletters.fields.created_at')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($newsletters as $newsletter)
        <tr>
            <td>{{ $newsletter->email }}</td>
            <td>{{ $newsletter->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
