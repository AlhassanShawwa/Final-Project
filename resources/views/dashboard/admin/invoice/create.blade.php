@extends('dashboard.layouts.master')

@section('styles')
    <style>
        .text-muted {
            font-size: 80% !important;
            font-weight: 400 !important;
            color: #fd397a !important;
        }

        .kt-form .kt-portlet__body .row:first-child {
            align-items: center;
        }

        .dropup .btn.dropdown-toggle:after {
            rotate: 180deg;
        }

        .input-group {
            flex-direction: row-reverse;
        }



        .input-group #kt_datepicker {
            border-radius: 0 4px 4px 0 !important;
            -webkit-border-radius: 0 4px 4px 0 !important;
            -moz-border-radius: 0 4px 4px 0 !important;
            -ms-border-radius: 0 4px 4px 0 !important;
            -o-border-radius: 0 4px 4px 0 !important;
        }

        .input-group .input-group-append .input-group-text {
            border-radius: 4px 0 0 4px !important;
            -webkit-border-radius: 4px 0 0 4px !important;
            -moz-border-radius: 4px 0 0 4px !important;
            -ms-border-radius: 4px 0 0 4px !important;
            -o-border-radius: 4px 0 0 4px !important;
        }

        @media (max-width: 1024px) {
            .form-group .col-lg-4:last-child {
                margin-top: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Form Widgets Validation Examples</h3>
            </div>
        </div>

        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" class="kt-form kt-form--label-right" id="kt_form_1">
            @csrf
            @include('dashboard.admin.invoice._form')
            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="col-lg-9 ml-lg-auto">
                        <button id="submit_button" type="submit" class="btn btn-primary"
                            data-appointment-id="">Save</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>

    <!--end::Portlet-->
@endsection
@section('subheader')
    {{-- <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ __('dashboard.add-new-doctor') }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('dashboard') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.dashboard') }}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('doctors.index') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.doctors') }}</a>

                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader --> --}}
@endsection
@section('scripts')
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/js/pages/crud/file-upload/ktavatar.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            $('#select_patient').on('change', function() {
                var patientId = $(this).val();
                if (patientId) {
                    $.ajax({
                        url: '/dashboard/admin/invoices/get-patient-data/' + patientId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $('input[name="doctor"]').val(response.doctor);
                            $('input[name="firstnameen"]').val(response.department);
                            $('input[name="date"]').val(response.appointment_date);
                            $('#services-table-body').empty();
                            $('#submit_button').data('appointment-id', response.appointment_id);

                            let rowIndex = 1;

                            if (response.service_price) {
                                $('input#service-name').val(response.service_name);
                                $('input[name="service-price"]').val(response.service_price);
                                $('#services-table-body').append(`
                                    <tr>
                                        <td>${rowIndex++}</td>
                                        <td>${response.service_name}</td>
                                        <td>${response.service_price}</td>
                                        <td>1</td>
                                    </tr>
                                `);
                            } else if (response.sub_services) {

                                response.sub_services.forEach(function(subService) {
                                    $('#services-table-body').append(`
                                        <tr>
                                            <td>${rowIndex++}</td>
                                            <td>${subService.service_name}</td>
                                            <td>${subService.service_price}</td>
                                            <td>${subService.quantity}</td>
                                            <td>${subService.quantity * subService.service_price}</td>
                                        </tr>
                                    `);
                                });
                                $('input[name="service-price"]').val(response.total_price);
                                $('input#service-name').val(response.group_name);

                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            swal.fire({
                                position: 'top-right',
                                type: 'error',
                                title: 'حدث خطأ عند جلب بيانات المريض',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            });

            $('#kt_form_1').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{!! route('admin.invoices.store') !!}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        patient_id: $('select[name="patient"]').val(),
                        appointment_id: $('#submit_button').data('appointment-id'),
                    },
                    success: function(response) {
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: 'تم حفظ الفاتورة بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr) {
                        swal.fire({
                            position: 'top-right',
                            type: 'error',
                            title: 'حدث خطأ أثناء حفظ الفاتورة',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>
@endsection
