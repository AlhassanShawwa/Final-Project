@extends('layouts.app')
@section('style')
    <style>
        .kt-login.kt-login--v1 .kt-login__wrapper .kt-login__body .kt-login__form .kt-login__actions .kt-login__btn-primary {
            padding: 1rem 2.75rem;
        }

        .kt-login__desc {
            margin-top: 20px
        }

        .kt-login.kt-login--v1 .kt-login__wrapper .kt-login__body .kt-login__form .kt-login__title {
            margin-bottom: 0 !important;
        }

        .kt-form {
            margin: 1.8rem 0 0 0 !important;
        }

        .kt-login__actions {
            margin: 1.8rem 0 0 0 !important;
        }

        .col-form-label {
            margin-bottom: -15px;
            padding-left: 0;
            padding-right: 0;
        }
    </style>
    @if (app()->currentLocale() == 'ar')
        <style>
            .form-group {
                flex-direction: row-reverse !important;
                text-align: right
            }

            .form-group .form-control {

                text-align: right
            }

            .kt-login__actions {
                flex-direction: row-reverse !important;
            }

            .kt-radio-inline .kt-radio:first-child {
                margin-left: 0px;
            }

            .kt-radio-inline .kt-radio:last-child {
                margin-left: 15px;
            }
        </style>
    @endif
@endsection
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

        <div class="kt-login__body" style="flex-direction: column">
            <div class="kt-login__form">
                <div class="kt-login__title">
                    <h3>Sign Up To Patient</h3>
                    <div class="kt-login__desc">Enter your details to create your account:</div>
                </div>
                <!--begin::Form-->
                <form class="kt-form" action="" novalidate="novalidate">
                    <div class="form-group" style="display: flex">
                        <input class="form-control" type="text" placeholder="First Name Arabic" name="fNameArabic">
                        <span style="padding:0 3px"></span>
                        <input class="form-control" type="text" placeholder="Last Name Arabic" name="lNameArabic">
                    </div>
                    <div class="form-group" style="display: flex">
                        <input class="form-control" type="text" placeholder="First Name English" name="fNameEnglish">
                        <span style="padding:0 3px"></span>
                        <input class="form-control" type="text" placeholder="Last Name English" name="lNameEnglish">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email" name="email">
                    </div>
                    <div class="form-group" style="display: flex">
                        <input class="form-control" type="password" placeholder="Password" name="password">
                        <span style="padding:0 3px"></span>
                        <input class="form-control" type="password" placeholder="Confirm Password" name="password">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="" placeholder="Phone" name="Phone">
                    </div>
                    <div class="form-group" style="display: flex; align-items: center;">
                        <label for="example-date-input" class="col-3 col-form-label">Date Of Birth</label>
                        <input class="form-control" type="date" id="example-date-input">
                    </div>
                    <div class="form-group" style="display: flex; justify-content: space-between; margin-top: 10px">
                        <label> Gendar</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio">
                                <input type="radio" name="gendar" value="male"> Male
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="gendar" value="female"> Female
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="kt-login__actions">
                        <a href="{{ asset('adminassets/#') }}" class="btn btn-primary btn-elevate kt-login__btn-primary">
                            Sign IN </a>
                        <button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign
                            UP</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
@endsection
