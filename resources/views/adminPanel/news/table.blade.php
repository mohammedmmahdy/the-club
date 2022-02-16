<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/news.fields.photo')</th>
            <th>@lang('models/news.fields.title')</th>
            <th>@lang('models/news.fields.body')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($news as $news)
            <tr>
                <td>
                    <img onerror=this.src="{{ asset('uploads/images/original/default.png') }}"
                        src="{{ $news->photo_original_path }}" alt="{{ $news->title }}" width="60">
                </td>
                <td>{{ $news->title }}</td>
                <td>{!! Str::limit($news->body, 80) !!}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.news.destroy', $news->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('news view')
                            <a href="{{ route('adminPanel.news.show', [$news->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('news edit')
                            <a href="{{ route('adminPanel.news.edit', [$news->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('news destroy')
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
