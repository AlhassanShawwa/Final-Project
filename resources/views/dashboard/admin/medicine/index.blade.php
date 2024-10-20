@extends('dashboard.layouts.master')
@section('title', 'medicines')
@section('styles')
    <style>
        .modal-footer {
            justify-content: space-between;
        }

        #statusForm .form-group {
            flex-direction: row-reverse;
            align-items: center;
        }

        .row-group {
            justify-content: space-between !important;
            margin: 0 !important;
        }

        .row-group .form-group {
            width: calc(50% - 5px);
        }

        .row-group .form-group:first-child {
            margin-right: 10px
        }

        .dropup .btn.dropdown-toggle:after {
            rotate: 180deg;
        }
    </style>
@endsection
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Column Rendering
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-upload"></i> Import
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="javascript:;" class="kt-nav__link" data-toggle="modal"
                                            data-target="#kt_modal_6">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="javascript:;" type="button" id="create" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>{{ __('dashboard.add-new-medicine') }} </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>code</th>
                        <th>manufacturer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <!--begin::Modal -->
    @include('dashboard.admin.medicine.create')
    <!--end::Modal -->
    <!--begin::Modal -->
    <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="POST" class="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">اختر ملف</label>
                            <div class="error-message text-danger mt-2" style="display: none;"></div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal -->
@endsection
@section('subheader')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ __('dashboard.doctors') }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('dashboard') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.dashboard') }}</a>

                </div>
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->
@endsection
@section('scripts')
    <script src="{{ asset('adminassets/assets/plugins/custom/datatables.net/js/jquery.dataTables.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('adminassets/assets/plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/js/pages/components/extended/blockui.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function() {
            var table = $('#kt_table_1');
            table.DataTable({
                responsive: true,
                ajax: {
                    route: "{!! route('admin.medicines.index') !!}",
                    type: 'GET',
                    data: {
                        pagination: {
                            perpage: 50,
                        },
                    },
                },
                columns: [{
                        data: 'id',
                        title: "{{ __('datatable.id') }}"
                    },
                    {
                        data: 'name',
                        title: "{{ __('datatable.name') }}"
                    },
                    {
                        data: 'code',
                        title: "{{ __('datatable.code') }}"
                    },
                    {
                        data: 'manufacturer',
                        title: "{{ __('datatable.manufacturer') }}"
                    },
                    {
                        data: 'actions',
                        title: "{{ __('datatable.actions') }}",
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ],
                language: {
                    "lengthMenu": "{{ __('datatable.lengthMenu') }}",
                    "zeroRecords": "{{ __('datatable.zeroRecords') }}",
                    "info": "{{ __('datatable.info') }}",
                    "infoEmpty": "{{ __('datatable.infoEmpty') }}",
                    "infoFiltered": "{{ __('datatable.infoFiltered') }}",
                    "search": "{{ __('datatable.search') }}",
                    "paginate": {
                        "first": "{{ __('datatable.paginate.first') }}",
                        "last": "{{ __('datatable.paginate.last') }}",
                        "next": "{{ __('datatable.paginate.next') }}",
                        "previous": "{{ __('datatable.paginate.previous') }}"
                    },
                    "loadingRecords": "{{ __('datatable.loadingRecords') }}",
                    "processing": "{{ __('datatable.processing') }}",
                }
            });
            $(document).on('click', '#create', function() {
                $('.kt_form')[0].reset();
                $('#kt_blockui_4_4_modal').modal('show');
                $('#kt_blockui_4_4').data('id', '');
            });
            $(document).on('click', '#edit', function() {
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                var medicineid = $(this).data('id');
                var url = $(this).data('url');
                console.log(url);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#name').val(data.name);
                        $('#code').val(data.code);
                        $('#manufacturer').val(data.manufacturer);
                        $('#kt_blockui_4_4').data('id', medicineid);
                        $('#kt_blockui_4_4_modal').modal('show');
                    }
                });
            });
            $(document).on('click', '#kt_blockui_4_4', function(e) {
                e.preventDefault(medicineid);
                var ajaxRoute = '{!! route('admin.medicines.store') !!}';
                var medicineid = $(this).data('id');
                var ajaxData = $('.kt_form').serialize();
                var ajaxMethod = 'POST';
                if (medicineid) {
                    ajaxRoute = '{!! route('admin.medicines.update', ['medicine' => '__id__']) !!}';
                    ajaxRoute = ajaxRoute.replace('__id__',
                        medicineid);
                    ajaxData += '&_method=PUT';
                }
                $.ajax({
                    url: ajaxRoute,
                    method: ajaxMethod,
                    dataType: "json",
                    data: ajaxData,
                    success: function(response) {
                        $('#kt_blockui_4_4_modal').modal('hide');
                        $('.kt_form')[0].reset();
                        $('#kt_table_1').DataTable().ajax.reload();
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON);

                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, errors) {
                                var input = $('input[name="' + key +
                                    '"], textarea[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + errors[
                                    0] + '</div>');
                            });
                        }
                        swal.fire({
                            position: 'top-right',
                            type: 'error',
                            title: 'Failed to save your work',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
            $('#customFile').on('change', function(event) {
                const file = event.target.files[0];
                const fileName = file ? file.name : '';
                const fileExtension = fileName.split('.').pop().toLowerCase();

                // Hide error message initially
                $('.error-message').hide().text('');

                if (file && (fileExtension === 'xls' || fileExtension === 'xlsx')) {
                    $(this).next('.custom-file-label').html(fileName);
                } else {
                    // Show error message under the input field
                    $('.error-message').text('يرجى اختيار ملف Excel (.xls أو .xlsx)').show();
                    $(this).val(''); // Clear the file input
                    $(this).next('.custom-file-label').html('اختر ملف');
                }
            });

            $('#saveChangesBtn').on('click', function() {
                const formData = new FormData($('.uploadForm')[0]);
                $.ajax({
                    url: 'dashboard/admin/medicines/import',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#kt_modal_6').modal('hide');
                        $('#kt_table_1').DataTable().ajax.reload();

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        const errorMessage = JSON.parse(jqXHR.responseText).error ||
                            'An error occurred';
                        $('#kt_modal_6').modal('hide');
                        Swal.fire({
                            position: 'top-right',
                            type: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
            // trash
            $(document).on('click', '#trash', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من التراجع عن هذا!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم، احذفه!',
                    cancelButtonText: 'إلغاء'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {

                                swal.fire({
                                    position: 'top-right',
                                    type: 'success',
                                    title: 'تم حذف العنصر بنجاح.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#kt_table_1').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                swal.fire(
                                    'خطأ!',
                                    'حدث خطأ أثناء محاولة الحذف.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection
