@extends('dashboard.layouts.master')
@section('title', 'departments')
@section('styles')
    <style>
        .modal-footer {
            justify-content: space-between;
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
    </style>
    {{-- @if (app()->currentLocale() == 'ar')
        <style>
            table.table-bordered.dataTable th,
            table.table-bordered.dataTable td {
                border-right-width: 0;
                border-left-width: 1px !important;
            }

            #kt_table_1 {
                direction: rtl;
            }

            table.dataTable thead .sorting:before,
            table.dataTable thead .sorting_asc:before,
            table.dataTable thead .sorting_desc:before,
            table.dataTable thead .sorting_asc_disabled:before,
            table.dataTable thead .sorting_desc_disabled:before {
                right: auto !important;
                left: 1em !important;
            }

            table.dataTable thead .sorting:after,
            table.dataTable thead .sorting_asc:after,
            table.dataTable thead .sorting_desc:after,
            table.dataTable thead .sorting_asc_disabled:after,
            table.dataTable thead .sorting_desc_disabled:after {
                right: auto !important;
                left: 0.5em !important;
            }

            table.dataTable thead>tr>th.sorting_asc,
            table.dataTable thead>tr>th.sorting_desc,
            table.dataTable thead>tr>th.sorting,
            table.dataTable thead>tr>td.sorting_asc,
            table.dataTable thead>tr>td.sorting_desc,
            table.dataTable thead>tr>td.sorting {
                padding-right: 5px !important;
            }

            div.dataTables_wrapper div.dataTables_info {
                text-align: left;
            }

            .modal-footer {
                flex-direction: row-reverse;
            }

            table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child,
            table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child {
                padding: 0 30px 0 0 !important;

            }

            .kt-portlet .kt-portlet__head,
            .kt-portlet__head-label,
            .modal-header,
            #kt_table_1_wrapper .row:last-child,
            #kt_table_1_wrapper .row:first-child {
                flex-direction: row-reverse;
            }

            /* #kt_table_1_wrapper .row:first-child .col-sm-12 .dataTables_length {
                                                        justify-content: flex-end;
                                                    } */

            div.dataTables_wrapper div.dataTables_filter {
                text-align: left !important;
            }

            div.dataTables_wrapper div.dataTables_info {
                text-align: right;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                margin: 0 !important;
                padding-left: 0;
                flex-direction: row-reverse;
            }
        </style>
    @endif --}}
@endsection
@section('content')
    <!-- begin:: Content -->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Column Visibility
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
                        <a href="javascript:;" type="button" id="create" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>{{ __('dashboard.add-new-department') }} </a>
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
                        <th>Name</th>
                        <th>Address</th>
                        <th>description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>

    <!-- end:: Content -->
    @include('dashboard.department.create')
@endsection
@section('subheader')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ __('dashboard.departments') }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">{{ __('dashboard.dashboard') }}</a>
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
    {{-- <script src="{{ asset('adminassets/assets/js/pages/crud/datatables/advanced/column-visibility.js') }}"
        type="text/javascript"></script> --}}
    <script src="{{ asset('adminassets/assets/js/pages/components/extended/blockui.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('adminassets/assets/js/pages/components/extended/sweetalert2.js') }}" type="text/javascript"></script> --}}

    <script>
        jQuery(document).ready(function() {
            var table = $('#kt_table_1').DataTable({
                responsive: true,
                ajax: {
                    route: "{!! route('departments.index') !!}",
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
                        data: 'address',
                        title: "{{ __('datatable.address') }}"
                    },
                    {
                        data: 'description',
                        title: "{{ __('datatable.description') }}"
                    },
                    {
                        data: 'created_at',
                        title: "{{ __('datatable.created_at') }}"
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
                var departmentId = $(this).data('id');
                var url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#nameAr').val(data.nameAr);
                        $('#nameEn').val(data.nameEn);
                        $('#addressAr').val(data.addressAr);
                        $('#addressEn').val(data.addressEn);
                        $('#descriptionAr').val(data.descriptionAr);
                        $('#descriptionEn').val(data.descriptionEn);
                        $('#kt_blockui_4_4').data('id', departmentId);
                        $('#kt_blockui_4_4_modal').modal('show');
                    }
                });
            });
            $(document).on('click', '#kt_blockui_4_4', function(e) {
                e.preventDefault();
                var ajaxRoute = '{!! route('departments.store') !!}';
                var departmentId = $(this).data('id');
                var ajaxData = $('.kt_form').serialize();
                var ajaxMethod = 'POST';
                if (departmentId) {
                    ajaxRoute = '{!! route('departments.update', ['department' => '__id__']) !!}';
                    ajaxRoute = ajaxRoute.replace('__id__',
                        departmentId);
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
