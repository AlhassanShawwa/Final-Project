@extends('layouts.app')
@section('style')
    <style>
        .kt-form {
            display: none;
        }
    </style>
    @if (app()->currentLocale() == 'ar')
        <link href="{{ asset('adminassets/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .kt-login__form .kt-login__title .col-lg-12 {
                text-align: right;
            }

            .filter-option-inner-inner {
                text-align: right;
            }

            .bootstrap-select>.dropdown-toggle:after {
                left: -100%;
            }

            .kt-login.kt-login--v1 .kt-login__wrapper .kt-login__head {
                text-align: left;
            }

            .kt-login.kt-login--v1 .kt-login__wrapper .kt-login__body .kt-login__form .kt-form .form-group .form-control {
                text-align: right;
            }

            .kt-login__actions {
                flex-direction: row-reverse;
            }
        </style>
    @else
        <link href="{{ asset('adminassets/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <style>
            .kt-login__form .kt-login__title .col-lg-12 {
                text-align: left;
            }
        </style>
    @endif
@endsection

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
        <!--begin::Head-->
        <div class="kt-login__head">
            <span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
            <a href="{{ asset('adminassets/#') }}" class="kt-link kt-login__signup-link">Sign Up!</a>
        </div>
        <!--end::Head-->
        <div class="kt-login__body" style="flex-direction: column">
            <div class="kt-login__form">
                <div class="kt-login__title">
                    <label class="col-lg-12">حدد طريقة الدخول </label>
                    <select class="form-control kt-selectpicker" id="sectionChooser" tabindex="-1">
                        <option selected disabled>اختار من القائمة</option>
                        <option value="admin">الدخول كمدير</option>
                        <option value="doctor">الدخول كطبيب</option>
                        <option value="patient">الدخول كمريض</option>
                    </select>
                </div>
                <!--begin::Form-->
                <form class="kt-form" method="POST" action="{{ route('login.admin') }}" novalidate="novalidate"
                    id="admin">
                    @csrf
                    <div class="kt-login__title">
                        <h3>Sign In To Admin</h3>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email" name="email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="password"
                            autocomplete="off">
                    </div>
                    <!--begin::Action-->
                    <div class="kt-login__actions">
                        <a href="{{ asset('adminassets/#') }}" class="kt-link kt-login__link-forgot">
                            Forgot Password ?
                        </a>
                        <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign
                            In</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
                <!--begin::Form-->
                <form class="kt-form" method="POST" action="{{ route('login.doctor') }}" novalidate="novalidate"
                    id="doctor">
                    @csrf
                    <div class="kt-login__title">
                        <h3>Sign In To Doctor</h3>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Username" name="username"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="password"
                            autocomplete="off">
                    </div>
                    <!--begin::Action-->
                    <div class="kt-login__actions">
                        <a href="{{ asset('adminassets/#') }}" class="kt-link kt-login__link-forgot">
                            Forgot Password ?
                        </a>
                        <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign
                            In</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
                <!--begin::Form-->
                <form class="kt-form" method="POST" action="{{ route('login.patient') }}" novalidate="novalidate"
                    id="patient">
                    @csrf
                    <div class="kt-login__title">
                        <h3>Sign In To Patient</h3>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Username" name="username"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="password"
                            autocomplete="off">
                    </div>
                    <!--begin::Action-->
                    <div class="kt-login__actions">
                        <a href="{{ asset('adminassets/#') }}" class="kt-link kt-login__link-forgot">
                            Forgot Password ?
                        </a>
                        <button id="kt_login_signin_submit" type="submit"
                            class="btn btn-primary btn-elevate kt-login__btn-primary">Sign
                            In</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#sectionChooser').change(function() {
            var myID = $(this).val();
            $('.kt-form').each(function() {
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endsection
