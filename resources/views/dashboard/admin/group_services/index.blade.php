@extends('dashboard.layouts.master')
@section('title', 'services')
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
                        <a href="{{ route('admin.group-services.create') }}" type="button" id="create"
                            class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>{{ __('dashboard.add-new-service') }} </a>
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
                        <th>Department</th>
                        <th>Description</th>
                        <th>total_before_discount</th>
                        <th>discount</th>
                        <th>total_after_discount</th>
                        <th>tax_rate</th>
                        <th>total</th>
                        <th>created_at</th>
                        <th>status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>


    <!--begin::Modal update status-->
    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">تحديث الحالة</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="bootstrap-select-wrapper">
                                    <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                                        <select class="form-control" id="select_status" name="status">
                                            <option value="active">Active</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="saveStatusChanges" type="button" data-id="" class="btn btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
    <!--end::Modal update status-->
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
                    <a href="{{ route('admin.dashboard') }}"
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
    <script src="{{ asset('adminassets/assets/js/pages/components/extended/blockui.js') }}" type="text/javascript">
    </script>
    <script>
        jQuery(document).ready(function() {
            // KTDatatablesDataSourceAjaxClient.init();
            var table = $('#kt_table_1');
            table.DataTable({
                responsive: true,
                ajax: {
                    route: "{!! route('admin.group-services.index') !!}",
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
                        data: 'department',
                        title: "{{ __('datatable.department') }}"
                    },
                    {
                        data: 'description',
                        title: "{{ __('datatable.description') }}"
                    },
                    {
                        data: 'total_before_discount',
                        title: "{{ __('datatable.total_before_discount') }}"
                    },
                    {
                        data: 'discount',
                        title: "{{ __('datatable.discount') }}"
                    },
                    {
                        data: 'total_after_discount',
                        title: "{{ __('datatable.total_after_discount') }}"
                    },
                    {
                        data: 'tax_rate',
                        title: "{{ __('datatable.tax_rate') }}"
                    },
                    {
                        data: 'total_with_tax',
                        title: "{{ __('datatable.total') }}"
                    },

                    {
                        data: 'created_at',
                        title: "{{ __('datatable.created_at') }}"
                    },

                    {
                        data: 'status',
                        title: "{{ __('datatable.status') }}",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        title: "{{ __('datatable.actions') }}",
                        orderable: false,
                        searchable: false
                    },
                ],

                columnDefs: [{
                    targets: -2, // Assuming status is in the 6th column
                    render: function(data, type, full, meta) {
                        var status = {
                            active: '{{ __('datatable.active') }}',
                            disable: '{{ __('datatable.disable') }}',
                        };
                        return '<span class="kt-badge kt-badge--' + (data === 'active' ?
                                'success' : 'danger') +
                            ' kt-badge--dot"></span>&nbsp;' +
                            '<span class="kt-font-bold kt-font-' + (data === 'active' ?
                                'success' : 'danger') + '">' +
                            (status[data] || data) + '</span>';
                    },
                }],

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
            //     $(document).on('click', '#create', function() {
            //         $('.kt_form')[0].reset();
            //         $('#kt_blockui_4_4_modal').modal('show');
            //         $('#kt_blockui_4_4').data('id', '');
            //     });
            //     $(document).on('click', '#edit', function() {
            //         $('.form-control').removeClass('is-invalid');
            //         $('.invalid-feedback').remove();
            //         var serviceid = $(this).data('id');
            //         var url = $(this).data('url');
            //         $.ajax({
            //             url: url,
            //             method: 'GET',
            //             success: function(data) {
            //                 $('#nameAr').val(data.nameAr);
            //                 $('#nameEn').val(data.nameEn);
            //                 $('select[name="department"]').val(data.department).change();
            //                 $('select[name="department"] option').each(function() {
            //                     if ($(this).val() === data.department) {
            //                         $(this).prop('selected', true);
            //                     }
            //                 });
            //                 $('#price').val(data.price);
            //                 $('#descriptionAr').val(data.descriptionAr);
            //                 $('#descriptionEn').val(data.descriptionEn);
            //                 $('#kt_blockui_4_4').data('id', serviceid);
            //                 $('#kt_blockui_4_4_modal').modal('show');
            //             }
            //         });
            //     });
            //     $(document).on('click', '#kt_blockui_4_4', function(e) {
            //         e.preventDefault();
            //         var ajaxRoute = '{!! route('admin.services.store') !!}';
            //         var serviceid = $(this).data('id');
            //         var ajaxData = $('.kt_form').serialize();
            //         var ajaxMethod = 'POST';
            //         if (serviceid) {
            //             ajaxRoute = '{!! route('admin.services.update', ['service' => '__id__']) !!}';
            //             ajaxRoute = ajaxRoute.replace('__id__',
            //                 serviceid);
            //             ajaxData += '&_method=PUT';
            //         }
            //         $.ajax({
            //             url: ajaxRoute,
            //             method: ajaxMethod,
            //             dataType: "json",
            //             data: ajaxData,
            //             success: function(response) {
            //                 $('#kt_blockui_4_4_modal').modal('hide');
            //                 $('.kt_form')[0].reset();
            //                 $('#kt_table_1').DataTable().ajax.reload();
            //                 swal.fire({
            //                     position: 'top-right',
            //                     type: 'success',
            //                     title: 'Your work has been saved',
            //                     showConfirmButton: false,
            //                     timer: 1500
            //                 });
            //             },
            //             error: function(xhr) {
            //                 if (xhr.responseJSON.errors) {
            //                     $.each(xhr.responseJSON.errors, function(key, errors) {
            //                         var input = $('input[name="' + key +
            //                             '"], textarea[name="' + key + '"]');
            //                         input.addClass('is-invalid');
            //                         input.after('<div class="invalid-feedback">' + errors[
            //                             0] + '</div>');
            //                     });
            //                 }
            //                 swal.fire({
            //                     position: 'top-right',
            //                     type: 'error',
            //                     title: 'Failed to save your work',
            //                     showConfirmButton: false,
            //                     timer: 1500
            //                 });
            //             }
            //         });
            //     });
            //     // update-status
            $(document).on('click', '#updatestatus', function() {
                var groupId = $(this).data('id');
                $.ajax({
                    url: '/dashboard/admin/group-services/' + groupId + '/get-status',
                    type: 'GET',
                    success: function(response) {
                        $('select[name="status"]').val(response.status).change();
                        $('select[name="status"] option').each(function() {
                            if ($(this).val() === response.status) {
                                $(this).prop('selected', true);
                            }
                        });
                        $('#saveStatusChanges').data('id', groupId);
                        $('#kt_modal_1').modal('show');
                    },
                    error: function(xhr) {
                        swal.fire({
                            type: 'error',
                            title: 'حدث خطأ في جلب الحالة الحالية',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
                $('#saveStatusChanges').data('id', groupId);
                $('#kt_modal_1').modal('show');
            });
            $('#saveStatusChanges').on('click', function() {
                var groupId = $(this).data('id'); // Get the data-id attribute
                var status = $('#select_status').val();
                $.ajax({
                    url: '/dashboard/admin/group-services/' + groupId + '/update-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                    },
                    success: function(response) {
                        $('#kt_modal_1').modal('hide');
                        $('#kt_table_1').DataTable().ajax.reload(); // Refresh the DataTable
                        swal.fire({
                            position: 'top-right',
                            type: 'success',
                            title: '. تم تحديث الحالة بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(xhr) {
                        swal.fire({
                            type: 'error',
                            title: '. حدث خطأ في تحديث الحالة',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
            //     // trash
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
