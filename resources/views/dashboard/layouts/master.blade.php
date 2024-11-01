<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
    <base href="../../">
    <meta charset="utf-8" />
    <title>@yield('title', 'dashboard | ' . config('app.name'))</title>
    <meta name="description" content="Page with empty content">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('dashboard.layouts.head')
    @yield('styles')

</head>

<!-- end::Head -->
<!-- begin::Body -->

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    @include('dashboard.layouts.header-mobile')
    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Aside -->
            @include('dashboard.layouts.aside')
            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                @include('dashboard.layouts.header')
                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <!-- begin:: Subheader -->
                    @yield('subheader')
                    <!-- end:: Subheader -->
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                        @yield('content')
                    </div>
                    <!-- end:: Content -->
                </div>
                @include('dashboard.layouts.footer')
            </div>
        </div>
    </div>
    <!--ENd:: Chat-->
    @include('dashboard.layouts.footer-scripts')
    @yield('scripts')
</body>

<!-- end::Body -->

</html>
