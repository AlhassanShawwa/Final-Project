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

        .input-group {
            flex-direction: row-reverse;
        }

        .input-group .form-control {
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

        .dropup .btn.dropdown-toggle:after {
            rotate: 180deg;
        }

        @media (max-width: 1024px) {
            .form-group .col-lg-4:last-child {
                margin-top: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Edit Driver
                </h3>
            </div>
        </div>

        <form method="POST" class="kt-form kt-form--label-right" id="edit_form">
            @csrf
            @method('PUT')
            @include('dashboard.admin.driver._form')
            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="col-lg-9 ml-lg-auto">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('subheader')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ __('dashboard.edit doctor') }}</h3>
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
    <!-- end:: Subheader -->
@endsection
@section('scripts')
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>
    <script>
        $(document).ready(function() {
            $('#kt_datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                orientation: 'bottom auto',
                todayHighlight: true,
            });

            function formatToDatepicker(dateStr) {
                const [year, month, day] = dateStr.split('-');
                return `${day}/${month}/${year}`;
            }

            $.ajax({
                url: "{{ route('admin.drivers.edit', $driver->id) }}",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    $('input[name="firstnamear"]').val(response.data.firstnamear);
                    $('input[name="lastnamear"]').val(response.data.lastnamear);
                    $('input[name="firstnameen"]').val(response.data.firstnameen);
                    $('input[name="lastnameen"]').val(response.data.lastnameen);
                    $('input[name="license_number"]').val(response.data.license_number);
                    $('input[name="phone"]').val(response.data.phone);
                    $('select[name="ambulance"]').val(response.data.ambulance).change();
                    $('select[name="ambulance"] option').each(function() {
                        if ($(this).val() === response.data.ambulance) {
                            $(this).prop('selected', true);
                        }
                    });
                    const dateOfBirth = response.data.date_of_birth;
                    const formattedDate = formatToDatepicker(dateOfBirth);
                    $('input[name="date"]').val(formattedDate);

                },
                error: function(xhr, status, error) {
                    alert('Failed to fetch data');
                }
            });

            $('#edit_form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.drivers.update', $driver->id) }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        setTimeout(function() {
                            window.location.href = "{{ route('admin.drivers.index') }}";
                        }, 2000);
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: '{{ __('alert.driver.updated') }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr, status, error) {
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, errors) {
                                var input = $('input[name="' + key +
                                    '"], textarea[name="' + key + '"]');
                                if (key === 'date') {
                                    var dateInput = $('input[name="date"]');
                                    dateInput.addClass('is-invalid');
                                    dateInput.closest('.input-group').next(
                                        '.form-text')
                                    append(
                                        '<div class="invalid-feedback">' +
                                        errors[
                                            0] + '</div>');
                                }
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' +
                                    errors[
                                        0] + '</div>');
                            });
                        } else {
                            swal.fire({
                                position: 'top-right',
                                type: 'error',
                                title: '{{ __('alert.driver.error') }}',
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
