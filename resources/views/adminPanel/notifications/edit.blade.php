@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">
        <a href="{!! route('adminPanel.notifications.index') !!}">@lang('models/notifications.singular')</a>
    </li>
    <li class="breadcrumb-item active">@lang('crud.edit')</li>
</ul>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class=" container ">
            @include('coreui-templates::common.errors')
			<div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Edit @lang('models/notifications.singular')</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::model($notification, ['route' => ['adminPanel.notifications.update', $notification->id], 'method' => 'patch', 'files' => true]) !!}
                              @include('adminPanel.notifications.fields')
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
		<!--end::Container-->
    </div>
@endsection
