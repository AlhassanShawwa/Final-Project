<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->

<head>
    <base href="../../../">
    <meta charset="utf-8" />
    <title>Metronic | Login Page 1</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ asset('adminassets/assets/css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <link href="{{ asset('adminassets/assets/plugins/general/bootstrap-select/dist/css/bootstrap-select.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminassets/assets/plugins/general/plugins/flaticon2/flaticon.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="shortcut icon" href="{{ asset('adminassets/assets/media/logos/favicon.ico') }}" />
    <style>
        .kt-login.kt-login--v1 .kt-login__aside .kt-login__logo {
            justify-content: center;
        }
    </style>
    @if (app()->currentLocale() == 'ar')
        <link href="{{ asset('adminassets/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .kt-grid.kt-grid--ver-desktop.kt-grid--desktop {
                flex-direction: row-reverse !important;
            }
        </style>
    @else
        <link href="{{ asset('adminassets/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif

    @yield('style')
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div
                class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

                <!--begin::Aside-->
                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                    style="background-image: url({{ asset('adminassets/assets/media/bg/bg-4.jpg') }});">
                    <div class="kt-grid__item">
                        <a href="{{ asset('adminassets/#') }}" class="kt-login__logo">
                            <img src="{{ asset('adminassets/assets/media/logos/logo-4.png') }}">
                        </a>
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                        <div class="kt-grid__item kt-grid__item--middle">
                            <h3 class="kt-login__title">Welcome to HIMS!</h3>
                            <h4 class="kt-login__subtitle">The ultimate Bootstrap & Angular 6 admin theme framework for
                                next generation web apps.</h4>
                        </div>
                    </div>
                </div>

                <!--begin::Aside-->

                <!--begin::Content-->
                @yield('content')
                <!--end::Body-->
            </div>

            <!--end::Content-->
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->

    <!--begin:: Vendor Plugins -->
    <script src="{{ asset('adminassets/assets/plugins/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/plugins/general/popper.js/dist/umd/popper.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/plugins/general/bootstrap/dist/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/plugins/general/bootstrap-select/dist/js/bootstrap-select.js') }}"
        type="text/javascript"></script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('adminassets/assets/js/pages/custom/login/login-1.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
    </script>
    <!--end::Page Scripts -->
    @yield('script')
</body>

<!-- end::Body -->

</html>
