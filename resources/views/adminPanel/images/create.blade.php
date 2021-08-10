@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">
        <a href="{!! route('adminPanel.pages.images.index', $page->id) !!}">{{$page->name}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{!! route('adminPanel.pages.images.index', $page->id) !!}">@lang('models/images.singular')</a>
    </li>
    <li class="breadcrumb-item active">@lang('crud.add_new')</li>
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
                        <h3 class="card-title">Create @lang('models/images.singular')</h3>
                    </div>
                    <div class="card-body">

                        {!! Form::open(['route' => ['adminPanel.pages.images.store', $page->id], 'files' => true]) !!}
                        @include('adminPanel.images.fields')
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
