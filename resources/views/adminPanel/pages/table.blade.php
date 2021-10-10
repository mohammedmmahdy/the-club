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
        <th>@lang('models/pages.fields.id')</th>
        <th>@lang('models/pages.fields.language')</th>
        <th>@lang('models/pages.fields.name')</th>
        <th>@lang('models/paragraphs.plural')</th>
        <th>@lang('models/images.plural')</th>
        <th>@lang('crud.action')</th>
    </thead>
    <tbody>
        @foreach($pages as $page)
        @php $i = 1; @endphp
        @foreach ( config('langs') as $locale => $name)
        <tr>
            <td>{{ $page->id }}</td>
            <td>{{ $name }}</td>
            <td>{{ $page->translate($locale)->name ?? '' }}</td>

            <td>
                <a href="{{ route('adminPanel.pages.paragraphs.index', $page->id) }}">
                    {{ $page->paragraph_count }}
                </a>
            </td>
            <td>
                <a href="{{ route('adminPanel.pages.images.index', $page->id) }}">
                    {{ $page->image_count }}
                </a>
            </td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.pages.destroy', $page->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    @can('pages view')
                    <a href="{{ route('adminPanel.pages.show', [$page->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'>
                        <i class="fa fa-eye"></i>
                    </a>
                    @endcan
                    @can('pages edit')
                    <a href="{{ route('adminPanel.pages.edit', [$page->id]) . "?languages=$locale" }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'>
                        <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('pages destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @php $i = 0; @endphp
        @endforeach
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
