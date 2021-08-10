<!DOCTYPE html>
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
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{asset('metronic/assets/css/pages/login/login-1.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

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
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{\App\Models\Option::first()->logo_thumbnail_path}}" />

    <style>
        .overlay {
            position: fixed;
            /* Sit on top of the page content */
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
            z-index: 2;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
            /* Add a pointer on hover */
        }
    </style>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white overlay" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-column flex-row-auto " style="background-color: rgba(0,0,0,0.5);opacity:0.8;background-image: url({{asset('img/admin-login.jpg')}});background-size:cover;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <a href="{{ route('home') }}" class="text-center mb-10">
                        <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{\App\Models\Option::first()->logo_thumbnail_path}}" class="max-h-70px" alt="" />
                    </a>
                    <!--end::Aside header-->

                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #fff;">
                        AdminPanel<br />
                        with great build tools
                    </h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->

                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style=""></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-signin">

                        <!--begin::Form-->
                        <form action="{{ route('adminPanel.postLogin') }}" method="POST">
                            @csrf
                            <!--begin::Title-->
                            <div class="pb-13 pt-lg-0 pt-5">
                                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to {{env('APP_NAME')}}

                                </h3>
                            </div>
                            <!--begin::Title-->
                            @include('flash::message')
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">@lang('auth.email')</label>
                                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg {{ $errors->has('email')?'is-invalid':'' }}" type="email" name="email" autocomplete="off" />
                                @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!--end::Form group-->

                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">@lang('auth.password')</label>
                                </div>

                                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg {{ $errors->has('password')?'is-invalid':'' }}" type="password" name="password" autocomplete="off" />
                                @if ($errors->has('password'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!--end::Form group-->

                            <!--begin::Action-->
                            <div class="pb-lg-0 pb-5">
                                <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Content body-->

                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <a href="https://www.techvillageco.com/" class="text-primary ml-10 font-weight-bolder font-size-h5">TechVillage</a>
                    <a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">{{date('Y')}}&copy; {{env('APP_NAME')}}</a>
                </div>
                <!--end::Content footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->


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

    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{asset('metronic/assets/js/pages/custom/login/login-general.js?v=7.0.6')}}"></script> --}}
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
