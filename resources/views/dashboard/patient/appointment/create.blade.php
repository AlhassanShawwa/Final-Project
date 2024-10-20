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
            @include('dashboard.patient.appointment._form')
            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="col-lg-9 ml-lg-auto">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>

    <!--end::Portlet-->
@endsection
@section('subheader')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ __('dashboard.add-new-appointment') }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('patient.dashboard') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.dashboard') }}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('patient.appointments.index') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.all-appointments') }}</a>

                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
@endsection
@section('scripts')
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/js/pages/crud/file-upload/ktavatar.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            $('#select_department').change(function() {
                var selectedDepartment = $(this).val();
                var doctorSelect = $('#select_doctor');
                var servicesTableBody = $('#services-table-body');
                doctorSelect.empty();
                $('#select-services').empty().append('<option value="">اختر خدمة</option>');
                servicesTableBody.empty();
                $('#total-price').text('');
                $('#services-table').hide();
                if (selectedDepartment) {
                    $.ajax({
                        url: `/dashboard/patient/appointments/get_doctors/${selectedDepartment}`, // ضبط URL
                        method: 'GET',
                        success: function(response) {
                            doctorSelect.empty().append(
                                '<option disabled selected>اختر الطبيب</option>'
                            );
                            if (response.doctors.length === 0) {
                                doctorSelect.append(
                                    '<option disabled>No doctors available</option>'
                                );
                            } else {
                                response.doctors.forEach(function(doctor) {
                                    doctorSelect.append(
                                        `<option value="${doctor.id}">${doctor.name}</option>`
                                    );
                                });
                            }
                            doctorSelect.selectpicker('refresh');
                        },
                        error: function() {
                            console.log('حدث خطأ أثناء جلب البيانات.');
                        }
                    });
                }
            });
            $('#select-service-type').change(function() {
                var serviceType = $(this).val();
                var servicesTableBody = $('#services-table-body');
                servicesTableBody.empty();
                $('#total-price').text('');
                $('#services-table').hide();
                var departmentId = $('#select_department').val();
                if (!departmentId) {

                    swal.fire({
                        type: 'warning',
                        title: 'يرجى اختيار القسم اولا',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#select-service-type').val('Select Service Type').selectpicker('refresh');
                    return;
                }
                var servicesSelect = $('#select-services');
                servicesSelect.empty();
                $.ajax({
                    url: "{{ route('patient.appointments.getServices', ':departmentId') }}".replace(
                        ':departmentId', departmentId), // تحديث URL
                    method: 'GET',
                    data: {
                        service_type: serviceType
                    },
                    success: function(response) {
                        servicesSelect.empty();
                        servicesSelect.append(
                            '<option disabled selected>Select Service</option>'
                        );
                        if (response.length === 0) {
                            servicesSelect.append(
                                '<option disabled>No services available</option>'
                            );
                        } else {
                            response.forEach(function(service) {
                                servicesSelect.append('<option value="' + service
                                    .id + '">' + service.name + '</option>');
                            });
                        }
                        servicesSelect.selectpicker('refresh');

                    },
                    error: function(xhr) {
                        console.error("Error status:", xhr.status);
                        console.error("Response text:", xhr.responseText);
                        servicesSelect.empty();
                        servicesSelect.append(
                            '<option disabled>An error occurred. Please try again.</option>'
                        );
                    }
                });
            });
            $('#select-services').change(function() {
                var serviceId = $(this).val();
                var serviceType = $('#select-service-type').val();
                var servicesTableBody = $('#services-table-body');
                servicesTableBody.empty();
                $('#total-price').text('');
                $.ajax({
                    url: `/dashboard/patient/appointments/get-service-details/${serviceId}`,
                    method: 'GET',
                    data: {
                        service_type: serviceType
                    },
                    success: function(response) {
                        servicesTableBody.empty();
                        var counter = 1;
                        if (serviceType === 'single') {
                            servicesTableBody.append(
                                `<tr><td>${counter}</td><td>${response.name}</td><td>${response.price} $</td></tr>`
                            );
                            $('#total-price').text(response.price);
                        } else if (serviceType === 'group' && Array.isArray(response
                                .services)) {
                            response.services.forEach(function(service) {
                                servicesTableBody.append(
                                    `<tr><td>${counter}</td><td>${service.name}</td><td>${service.price} $</td></tr>`
                                );
                                counter++;
                            });
                            $('#total-price').text(response.total_with_tax);
                        }
                        $('#services-table').show();
                    },
                    error: function(xhr) {
                        console.error("Error status:", xhr.status);
                        console.error("Response text:", xhr.responseText);
                    }
                });
            });
            $('#kt_form_1').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData();
                formData.append('_token', $('input[name="_token"]').val()); // التوكن
                formData.append('patient_id', $('input[name="patient_id"]').val()); // رقم المريض
                formData.append('doctor_id', $('select[name="doctor"]').val()); // رقم الطبيب
                formData.append('service_type', $('select[name="service-type"]').val()); // نوع الخدمة
                formData.append('service_id', $('select[name="services"]').val()); // رقم الخدمة
                formData.append('date', $('input[name="date"]').val()); // التاريخ
                $.ajax({
                    url: "{{ route('patient.appointments.store') }}", // ضبط URL
                    type: 'POST',
                    data: formData,
                    contentType: false, // يجب أن يكون false عند استخدام FormData
                    processData: false, // يجب أن يكون false لأن البيانات غير مسلسلة
                    dataType: "json",
                    success: function(response) {
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: 'تم حفظ الموعد بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(function() {
                            window.location.href =
                                "{{ route('patient.appointments.index') }}"; // إعادة التوجيه
                        }, 2000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            for (let key in errors) {
                                errorMessage += errors[key].join(
                                    '<br>');
                            }

                            Swal.fire({
                                type: 'warning',
                                title: '! تحذير',
                                html: errorMessage,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'خطأ',
                                text: 'حدث خطأ أثناء تنفيذ الطلب.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
