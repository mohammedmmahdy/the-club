@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">@lang('models/users.plural')</li>
</ul>
@endsection
@section('content')
@include('flash::message')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                @lang('models/users.plural')
                <span class="d-block text-muted pt-2 font-size-sm">Descriptions</span>
            </h3>
        </div>
        <div class="card-toolbar">

        </div>
    </div>

    <div class="card-body">
        @include('adminPanel.users.table')
    </div>
</div>
<!--end::Card-->
@endsection
