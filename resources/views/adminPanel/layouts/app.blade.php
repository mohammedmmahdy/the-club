<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" dir="{{request()->segment(1) == 'ar'? 'rtl': 'ltr'}}">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    @if (request()->segment(1) == 'ar')

    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700&display=swap" rel="stylesheet">
    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('metronic/assets/plugins/custom/datatables/datatables.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('metronic/assets/plugins/global/plugins.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/style.bundle.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('metronic/assets/css/themes/layout/header/base/light.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/themes/layout/header/menu/light.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/themes/layout/brand/dark.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/themes/layout/aside/dark.rtl.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />

    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.table').DataTable( {
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json'
                    }
                } );
        } );
    </script>
    @else

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('metronic/assets/plugins/global/plugins.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/style.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('metronic/assets/css/themes/layout/header/base/light.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/themes/layout/header/menu/light.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/themes/layout/brand/dark.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('metronic/assets/css/themes/layout/aside/dark.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />
    @endif
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{\App\Models\Option::first()->fav_icon_thumbnail_path}}" />


    {{-- ckeditor --}}
    <script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center  header-mobile-fixed ">
        <!--begin::Logo-->
        <a href="index.html">
            {{-- <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';"alt="Logo" src="{{asset('metronic/assets/media/logos/logo-light.png')}}"/> --}}
            <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" alt="Logo" src="{{asset('img/4go-white.png')}}" width="50px" />
        </a>
        <!--end::Logo-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->

            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Aside-->
            @include('adminPanel.layouts.sidebar')
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header header-fixed">
                    <!--begin::Container-->
                    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        </div>
                        <!--end::Header Menu Wrapper-->

                        <!--begin::Topbar-->
                        <div class="topbar">
                            <!--begin::Languages-->
                            <div class="dropdown">
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                        @if (request()->segment(1)=='en')
                                        <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" class="h-20px w-20px rounded-sm" src="{{asset('flags/226-united-states.svg')}}" alt="" />
                                        @else
                                        <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" class="h-20px w-20px rounded-sm" src="{{asset('flags/026-qatar.svg')}}" alt="" />
                                        @endif
                                    </div>
                                </div>
                                <!--end::Toggle-->

                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="navi navi-hover py-4">
                                        @php
                                        $url = url()->full();
                                        if (Route::currentRouteName() == 'website.home' ) {
                                        $ar = str_replace('en','ar',$url);
                                        $en = str_replace('ar','en',$url);
                                        }else {
                                        $ar = str_replace('/en'.'/','/ar'.'/',$url);
                                        $en = str_replace('/ar'.'/','/en'.'/',$url);
                                        }
                                        @endphp
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{$en}}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{asset('flags/226-united-states.svg')}}" alt="" />
                                                </span>
                                                <span class="navi-text">English</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{$ar}}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{asset('flags/026-qatar.svg')}}" alt="" />
                                                </span>
                                                <span class="navi-text">Arabic</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->


                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Languages-->
                            <!--begin::User-->
                            <div class="dropdown">
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    @php
                                    $admin = auth('admin')->user()->name??'Username';
                                    @endphp
                                    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ $admin }}</span>
                                        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">{{ucfirst(substr($admin ,0,1))}}</span>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Toggle-->

                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="navi navi-hover py-4">
                                        @can('options edit')
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{route('adminPanel.options.edit', 1)}}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Settings4.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M18.6225,9.75 L18.75,9.75 C19.9926407,9.75 21,10.7573593 21,12 C21,13.2426407 19.9926407,14.25 18.75,14.25 L18.6854912,14.249994 C18.4911876,14.250769 18.3158978,14.366855 18.2393549,14.5454486 C18.1556809,14.7351461 18.1942911,14.948087 18.3278301,15.0846699 L18.372535,15.129375 C18.7950334,15.5514036 19.03243,16.1240792 19.03243,16.72125 C19.03243,17.3184208 18.7950334,17.8910964 18.373125,18.312535 C17.9510964,18.7350334 17.3784208,18.97243 16.78125,18.97243 C16.1840792,18.97243 15.6114036,18.7350334 15.1896699,18.3128301 L15.1505513,18.2736469 C15.008087,18.1342911 14.7951461,18.0956809 14.6054486,18.1793549 C14.426855,18.2558978 14.310769,18.4311876 14.31,18.6225 L14.31,18.75 C14.31,19.9926407 13.3026407,21 12.06,21 C10.8173593,21 9.81,19.9926407 9.81,18.75 C9.80552409,18.4999185 9.67898539,18.3229986 9.44717599,18.2361469 C9.26485393,18.1556809 9.05191298,18.1942911 8.91533009,18.3278301 L8.870625,18.372535 C8.44859642,18.7950334 7.87592081,19.03243 7.27875,19.03243 C6.68157919,19.03243 6.10890358,18.7950334 5.68746499,18.373125 C5.26496665,17.9510964 5.02757002,17.3784208 5.02757002,16.78125 C5.02757002,16.1840792 5.26496665,15.6114036 5.68716991,15.1896699 L5.72635306,15.1505513 C5.86570889,15.008087 5.90431906,14.7951461 5.82064513,14.6054486 C5.74410223,14.426855 5.56881236,14.310769 5.3775,14.31 L5.25,14.31 C4.00735931,14.31 3,13.3026407 3,12.06 C3,10.8173593 4.00735931,9.81 5.25,9.81 C5.50008154,9.80552409 5.67700139,9.67898539 5.76385306,9.44717599 C5.84431906,9.26485393 5.80570889,9.05191298 5.67216991,8.91533009 L5.62746499,8.870625 C5.20496665,8.44859642 4.96757002,7.87592081 4.96757002,7.27875 C4.96757002,6.68157919 5.20496665,6.10890358 5.626875,5.68746499 C6.04890358,5.26496665 6.62157919,5.02757002 7.21875,5.02757002 C7.81592081,5.02757002 8.38859642,5.26496665 8.81033009,5.68716991 L8.84944872,5.72635306 C8.99191298,5.86570889 9.20485393,5.90431906 9.38717599,5.82385306 L9.49484664,5.80114977 C9.65041313,5.71688974 9.7492905,5.55401473 9.75,5.3775 L9.75,5.25 C9.75,4.00735931 10.7573593,3 12,3 C13.2426407,3 14.25,4.00735931 14.25,5.25 L14.249994,5.31450877 C14.250769,5.50881236 14.366855,5.68410223 14.552824,5.76385306 C14.7351461,5.84431906 14.948087,5.80570889 15.0846699,5.67216991 L15.129375,5.62746499 C15.5514036,5.20496665 16.1240792,4.96757002 16.72125,4.96757002 C17.3184208,4.96757002 17.8910964,5.20496665 18.312535,5.626875 C18.7350334,6.04890358 18.97243,6.62157919 18.97243,7.21875 C18.97243,7.81592081 18.7350334,8.38859642 18.3128301,8.81033009 L18.2736469,8.84944872 C18.1342911,8.99191298 18.0956809,9.20485393 18.1761469,9.38717599 L18.1988502,9.49484664 C18.2831103,9.65041313 18.4459853,9.7492905 18.6225,9.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path d="M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon--></span>
                                                </span>
                                                <span class="navi-text">@lang('lang.options')</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        @endcan
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{route('adminPanel.logout')}}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Sign-out.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
                                                                <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1" />
                                                                <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                <span class="navi-text">@lang('auth.sign_out')</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
                        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-1">

                                <!--begin::Page Heading-->
                                <div class="d-flex align-items-baseline flex-wrap mr-5">
                                    <!--begin::Page Title-->
                                    {{-- <h5 class="text-dark font-weight-bold my-1 mr-5"> Dashboard </h5> --}}
                                    <!--end::Page Title-->
                                    <!--begin::Breadcrumb-->
                                    @yield('breadcrumb')
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page Heading-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Subheader-->

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class=" container ">
                            <!--begin::Dashboard-->
                            @yield('content')
                            <!--end::Dashboard-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                <div class="footer bg-white py-4 d-flex flex-lg-column " id="kt_footer">
                    <!--begin::Container-->
                    <div class=" container-fluid  d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">{{date('Y')}}&copy;</span>
                            <a href="{{ route('home') }}" target="_blank" class="text-dark-75 text-hover-primary">4GO</a>
                        </div>
                        <!--end::Copyright-->

                        <!--begin::Nav-->
                        <div class="nav nav-dark">
                            <a href="https://www.techvillageco.com/" target="_blanck" class="nav-link pl-0 pr-5">Tech Village</a>
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->

    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
                    "breakpoints": {
                        "sm": 576,
                        "md": 768,
                        "lg": 992,
                        "xl": 1200,
                        "xxl": 1400
                    },
                    "colors": {
                        "theme": {
                            "base": {
                                "white": "#ffffff",
                                "primary": "#3699FF",
                                "secondary": "#E5EAEE",
                                "success": "#1BC5BD",
                                "info": "#8950FC",
                                "warning": "#FFA800",
                                "danger": "#F64E60",
                                "light": "#E4E6EF",
                                "dark": "#181C32"
                            },
                            "light": {
                                "white": "#ffffff",
                                "primary": "#E1F0FF",
                                "secondary": "#EBEDF3",
                                "success": "#C9F7F5",
                                "info": "#EEE5FF",
                                "warning": "#FFF4DE",
                                "danger": "#FFE2E5",
                                "light": "#F3F6F9",
                                "dark": "#D6D6E0"
                            },
                            "inverse": {
                                "white": "#ffffff",
                                "primary": "#ffffff",
                                "secondary": "#3F4254",
                                "success": "#ffffff",
                                "info": "#ffffff",
                                "warning": "#ffffff",
                                "danger": "#ffffff",
                                "light": "#464E5F",
                                "dark": "#ffffff"
                            }
                        },
                        "gray": {
                            "gray-100": "#F3F6F9",
                            "gray-200": "#EBEDF3",
                            "gray-300": "#E4E6EF",
                            "gray-400": "#D1D3E0",
                            "gray-500": "#B5B5C3",
                            "gray-600": "#7E8299",
                            "gray-700": "#5E6278",
                            "gray-800": "#3F4254",
                            "gray-900": "#181C32"
                        }
                    },
                    "font-family": "Poppins"
                };
    </script>
    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{asset('metronic/assets/plugins/global/plugins.bundle.js?v=7.0.6')}}"></script>
    <script src="{{asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6')}}"></script>
    <script src="{{asset('metronic/assets/js/scripts.bundle.js?v=7.0.6')}}"></script>
    <!--end::Global Theme Bundle-->

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6')}}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('metronic/assets/js/pages/widgets.js?v=7.0.6')}}"></script>
    <!--end::Page Scripts-->

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('metronic/assets/js/pages/crud/ktdatatable/base/html-table.js?v=7.0.6')}}"></script>
    {{-- <script src="{{asset('metronic/assets/js/pages/crud/ktdatatable/base/data-ajax.js?v=7.0.6')}}"></script> --}}

    {{-- <script src="{{asset('metronic/assets/js/pages/crud/ktdatatable/base/html-table.js?v=7.0.6')}}"></script> --}}
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{asset('metronic/assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.6')}}"></script> --}}
    <!--end::Page Scripts-->

    <script src="{{asset('metronic/assets/js/pages/crud/file-upload/image-input.js?v=7.0.6')}}"></script>

    <script src="{{asset("js/ahmed-back-end-developer.js")}}"></script>

    <script>
        $('.check_inputs').click(function() {
                var targetClasses = $(this).val();
                if ($(this).is(':checked')) {
                    $(targetClasses).attr('checked', true);
                } else {
                    $(targetClasses).attr('checked', false);
                }
            });

    </script>
    @yield('scripts')
    {{-- @if (request()->segment(1) == 'ar')
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

                $('.table-dataTables').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json'
                    },
                    sort: false
                });

            });

    </script>
    @else
    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

                $('.table-dataTables').DataTable({
                    sort: false
                });

            });

    </script>

    @endif --}}
</body>


<!--end::Body-->
@stack('scripts')

</html>
