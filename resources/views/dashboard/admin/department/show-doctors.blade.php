@extends('dashboard.layouts.master')
@section('title', 'doctor')
@section('styles')
    <style>
        .modal-footer {
            justify-content: space-between;
        }

        #statusForm .form-group {
            flex-direction: row-reverse;
            align-items: center;
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




                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            New Record
                        </a>
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
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
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
                                        <select class="form-control" id="select" name="status">
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
@endsection
@section('subheader')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{ $department->trans_name }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('dashboard') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.dashboard') }}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('admin.departments.index') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.departments') }}</a>
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

            // begin first table
            table.DataTable({
                responsive: true,
                ajax: {
                    route: "{!! route('admin.doctors.index') !!}",
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
                        data: 'email',
                        title: "{{ __('datatable.email') }}"
                    },
                    {
                        data: 'phone',
                        title: "{{ __('datatable.phone') }}"
                    },
                    {
                        data: 'date_of_birth',
                        title: "{{ __('datatable.date_of_birth') }}"
                    },
                    {
                        data: 'gender',
                        title: "{{ __('datatable.gender') }}"
                    },
                    {
                        data: 'status',
                        title: "{{ __('datatable.status') }}"
                    },
                    {
                        data: 'actions',
                        title: "{{ __('datatable.actions') }}",
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    targets: -3, // Assuming gender is in the 5th column
                    render: function(data, type, full, meta) {
                        var gender = {
                            male: '{{ __('datatable.male') }}',
                            female: '{{ __('datatable.female') }}',
                        };
                        return gender[data] || data;
                    },
                }, {
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

             $(document).on('click', '#updatestatus', function() {
                var doctorId = $(this).data('id');
                $.ajax({
                    url: '/dashboard/admin/doctors/' + doctorId + '/get-status',
                    type: 'GET',
                    success: function(response) {
                        $('select[name="status"]').val(response.status).change();
                        $('select[name="status"] option').each(function() {
                            if ($(this).val() === response.status) {
                                $(this).prop('selected', true);
                            }
                        });
                        $('#saveStatusChanges').data('id', doctorId);
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
                $('#saveStatusChanges').data('id', doctorId);
                $('#kt_modal_1').modal('show');
            });
            $('#saveStatusChanges').on('click', function() {
                var doctorId = $(this).data('id'); // Get the data-id attribute
                var status = $('#select').val();
                $.ajax({
                    url: '/dashboard/admin/doctors/' + doctorId + '/update-status',
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
