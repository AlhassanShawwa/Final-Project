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
    <link href="https://unpkg.com/cropperjs/dist/cropper.min.css" rel="stylesheet">
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
            @include('dashboard.admin.pharmacist._form')
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
    <!-- end:: Subheader -->
@endsection
@section('scripts')
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/js/pages/crud/file-upload/ktavatar.js') }}" type="text/javascript"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script>
        var cropper;
        var imageInput = document.querySelector('input[name="image"]');
        var imageToCrop = document.getElementById('imageToCrop');

        imageInput.addEventListener('change', function(e) {
            var files = e.target.files;
            if (files && files.length > 0) {
                var file = files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    imageToCrop.src = e.target.result;
                    $('#cropImageModal').modal('show');
                };
                reader.readAsDataURL(file);
            }
        });

        $('#cropImageModal').on('shown.bs.modal', function() {
            cropper = new Cropper(imageToCrop, {
                aspectRatio: 1,
                viewMode: 3
            });
        }).on('hidden.bs.modal', function() {
            if (!imageInput.files.length || !cropper) {
                imageInput.value = "";
                document.querySelector('.kt-avatar__holder').style.backgroundImage =
                    `url('{{ asset('adminassets/assets/media/users/default.jpg') }}')`;
            }
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });

        document.getElementById('cropImage').addEventListener('click', function() {
            if (cropper) {
                var canvas = cropper.getCroppedCanvas({
                    width: 200,
                    height: 200,
                });

                if (!canvas) {
                    alert('حدث خطأ أثناء إنشاء الصورة، يرجى المحاولة مرة أخرى.');
                    imageInput.value = "";
                    document.querySelector('.kt-avatar__holder').style.backgroundImage =
                        `url('{{ asset('adminassets/assets/media/users/default.jpg') }}')`;
                    return;
                }

                canvas.toBlob(function(blob) {
                    var url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        var dataTransfer = new DataTransfer();
                        var file = dataURLtoFile(base64data, 'cropped-image.png');
                        dataTransfer.items.add(file);
                        imageInput.files = dataTransfer.files;
                        $('#cropImageModal').modal('hide');
                        document.querySelector('.kt-avatar__holder').style.backgroundImage =
                            `url(${base64data})`;
                    };
                }, 'image/png');
            }
        });

        function dataURLtoFile(dataURL, filename) {
            var arr = dataURL.split(',');
            var mime = arr[0].match(/:(.*?);/)[1];
            var bstr = atob(arr[1]);
            var n = bstr.length;
            var u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], filename, {
                type: mime
            });
        }

        jQuery(document).ready(function() {
            $('#kt_datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                orientation: 'bottom auto',
                todayHighlight: true,
            });

            $('#kt_form_1').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{!! route('admin.pharmacists.store') !!}",
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        setTimeout(function() {
                            window.location.href = "{!! route('admin.pharmacists.index') !!}";
                        }, 2000);
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: 'تم حفظ العمل بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr) {
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.errors) {
                                $.each(response.errors, function(key, errors) {
                                    var input = $('input[name="' + key +
                                        '"], textarea[name="' + key + '"]');
                                    if (key === 'date') {
                                        var dateInput = $('input[name="date"]');
                                        dateInput.addClass('is-invalid');
                                        dateInput.closest('.input-group').last(
                                            '.form-text').append(
                                            '<div class="invalid-feedback">' +
                                            errors[0] + '</div>');
                                    } else {
                                        input.addClass('is-invalid');
                                        input.after('<div class="invalid-feedback">' +
                                            errors[0] + '</div>');
                                    }
                                });
                            } else {
                                swal.fire({
                                    position: 'top-right',
                                    type: 'error',
                                    title: 'حدث خطأ',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        } catch (e) {
                            swal.fire({
                                position: 'top-right',
                                type: 'error',
                                title: 'حدث خطأ غير متوقع',
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
