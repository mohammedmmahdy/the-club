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

            <th>@lang('models/faqs.fields.id')</th>
            <th>@lang('models/faqs.fields.question')</th>
            <th>@lang('models/faqs.fields.answer')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faqs as $faq)
        <tr>
            <td>{{$faq->id}}</td>
            <td>{{$faq->question}}</td>
            <td>{{$faq->answer}}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.faqs.destroy', $faq->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('faqs view')
                    <a href="{{ route('adminPanel.faqs.show', [$faq->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('faqs edit')
                    <a href="{{ route('adminPanel.faqs.edit', [$faq->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('faqs destroy')
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
