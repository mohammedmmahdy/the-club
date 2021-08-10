@extends('adminPanel.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('adminPanel.appFeatures.index') !!}">@lang('models/appFeatures.singular')</a>
    </li>
    <li class="breadcrumb-item active">@lang('crud.edit')</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit fa-lg"></i>
                        <strong>Edit @lang('models/appFeatures.singular')</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::model($appFeature, ['route' => ['adminPanel.appFeatures.update', $appFeature->id], 'method' => 'patch']) !!}

                        @include('adminPanel.app_features.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
