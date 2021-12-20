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
            <th>@lang('models/events.fields.icon')</th>
            <th>@lang('models/events.fields.title')</th>
            <th>@lang('models/events.fields.description')</th>
            <th>@lang('models/events.fields.date')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>
                    <img onerror=this.src="{{ asset('uploads/images/original/default.png') }}"
                        src="{{ $event->icon_original_path }}" alt="{{ $event->title }}" width="60">
                </td>
                <td>{{ $event->title }}</td>
                <td>{!! Str::limit($event->description, 80) !!}</td>
                <td>{{ $event->date }}</td>

                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.events.destroy', $event->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('events view')
                            <a href="{{ route('adminPanel.events.show', [$event->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('events edit')
                            <a href="{{ route('adminPanel.events.edit', [$event->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('events destroy')
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
