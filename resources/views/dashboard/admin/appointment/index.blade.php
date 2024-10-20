@extends('dashboard.layouts.master')
@section('title', 'Appointments')
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
                        <a href="javascript:;"id="create" class="btn btn-brand btn-elevate btn-icon-sm">
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
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Appointment Date</th>
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

    @include('dashboard.admin.appointment.create')

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
                                        <select class="form-control" id="select" name="status">
                                            <option value="scheduled">Scheduled</option>
                                            <option value="postponed">Postponed</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
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
        // jQuery(document).ready(function() {
        //     var table = $('#kt_table_1');

        //     // تهيئة DataTable
        //     table.DataTable({
        //         responsive: true,
        //         ajax: {
        //             route: "{!! route('appointments.index') !!}",
        //             type: 'GET',
        //             data: {
        //                 pagination: {
        //                     perpage: 50,
        //                 },
        //             },
        //         },
        //         columns: [{
        //                 data: 'id',
        //                 title: "{{ __('datatable.id') }}"
        //             },
        //             {
        //                 data: 'patient_name',
        //                 title: "{{ __('datatable.patient_name') }}"
        //             },
        //             {
        //                 data: 'doctor_name',
        //                 title: "{{ __('datatable.doctor_name') }}"
        //             },
        //             {
        //                 data: 'appointment_date',
        //                 title: "{{ __('datatable.appointment_date') }}"
        //             },
        //             {
        //                 data: 'status',
        //                 title: "{{ __('datatable.status') }}"
        //             },
        //             {
        //                 data: 'actions',
        //                 title: "{{ __('datatable.actions') }}",
        //                 orderable: false,
        //                 searchable: false
        //             }
        //         ],
        //         columnDefs: [{
        //             targets: -2,
        //             render: function(data) {
        //                 var status = {
        //                     scheduled: '{{ __('datatable.scheduled') }}',
        //                     postponed: '{{ __('datatable.postponed') }}',
        //                     completed: '{{ __('datatable.completed') }}',
        //                     cancelled: '{{ __('datatable.cancelled') }}',
        //                 };

        //                 var statusClasses = {
        //                     scheduled: 'kt-badge--brand',
        //                     postponed: 'kt-badge--warning',
        //                     completed: 'kt-badge--success',
        //                     cancelled: 'kt-badge--danger',
        //                 };

        //                 return (status[data] !== undefined) ?
        //                     `<span class="kt-badge ${statusClasses[data]} kt-badge--inline kt-badge--pill">${status[data]}</span>` :
        //                     data;
        //             }
        //         }],
        //         order: [
        //             [0, 'desc']
        //         ],
        //         language: {
        //             "lengthMenu": "{{ __('datatable.lengthMenu') }}",
        //             "zeroRecords": "{{ __('datatable.zeroRecords') }}",
        //             "info": "{{ __('datatable.info') }}",
        //             "infoEmpty": "{{ __('datatable.infoEmpty') }}",
        //             "infoFiltered": "{{ __('datatable.infoFiltered') }}",
        //             "search": "{{ __('datatable.search') }}",
        //             "paginate": {
        //                 "first": "{{ __('datatable.paginate.first') }}",
        //                 "last": "{{ __('datatable.paginate.last') }}",
        //                 "next": "{{ __('datatable.paginate.next') }}",
        //                 "previous": "{{ __('datatable.paginate.previous') }}"
        //             },
        //             "loadingRecords": "{{ __('datatable.loadingRecords') }}",
        //             "processing": "{{ __('datatable.processing') }}",
        //         }
        //     });

        //     $(document).on('click', '#create', function() {
        //         $('.kt_form')[0].reset(); // Reset the form
        //         $('#kt_blockui_4_4_modal').modal('show'); // Show the modal
        //         $('#kt_blockui_4_4').data('id', ''); // Reset appointment id
        //         $('#select_patient').prop('disabled', false); // Enable patient field

        //         $.ajax({
        //             url: '/dashboard/admin/appointments/get-patients', // Ensure this path is correct
        //             method: 'GET',
        //             success: function(data) {
        //              },
        //             error: function(xhr) {
        //                 console.log('30526'); // Log error response
        //             }
        //         });
        //     });
        //     // فتح نافذة تعديل الموعد
        //     $(document).on('click', '#edit', function() {
        //         $('.form-control').removeClass('is-invalid'); // إزالة أي أخطاء سابقة
        //         $('.invalid-feedback').remove(); // إزالة الرسائل السابقة
        //         var appointmentId = $(this).data('id'); // الحصول على معرف الموعد
        //         var url = $(this).data('url');

        //         $.ajax({
        //             url: url,
        //             method: 'GET',
        //             success: function(data) {
        //                 $('#select_patient').empty().append(
        //                     `<option value="${data.patient.id}" selected>${data.patient.trans_full_name}</option>`
        //                 );
        //                 $('#select_patient').prop('disabled', true);
        //                 $('#select_department').val(data.department_id).change();
        //                 $('#select_doctor').val(data.doctor_id).change();
        //                 $('#kt_datepicker').val(data.appointment_date);
        //                 $('#kt_blockui_4_4').data('id', appointmentId);
        //                 $('#kt_blockui_4_4_modal').modal('show');
        //             },
        //             error: function() {
        //                 swal.fire({
        //                     position: 'top-right',
        //                     icon: 'error',
        //                     title: 'فشل في استرجاع بيانات الموعد',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //             }
        //         });
        //     });

        //     $('#select_department').change(function() {
        //         var selectedDepartment = $(this).val();
        //         $('#select_doctor').empty().append('<option disabled selected>اختر الطبيب</option>');

        //         if (selectedDepartment) {
        //             $.ajax({
        //                 url: `/dashboard/patient/appointments/get_doctors/${selectedDepartment}`,
        //                 method: 'GET',
        //                 success: function(response) {
        //                      response.doctors.forEach(function(doctor) {
        //                         $('#select_doctor').append(
        //                             `<option value="${doctor.id}">${doctor.name}</option>`
        //                         );
        //                     });
        //                  },
        //                 error: function() {
        //                     console.log('حدث خطأ أثناء جلب البيانات.');
        //                 }
        //             });
        //         }
        //     });


        //      $(document).on('click', '#kt_blockui_4_4', function(e) {
        //         e.preventDefault();
        //         var ajaxRoute = '{!! route('appointments.store') !!}'; // رابط إنشاء الموعد
        //         var appointmentId = $(this).data('id'); // الحصول على معرف الموعد
        //         var ajaxData = $('.kt_form').serialize(); // بيانات النموذج
        //         var ajaxMethod = 'POST';
        //         if (appointmentId) {
        //             ajaxRoute = '{!! route('appointments.update', ['appointment' => '__id__']) !!}';
        //             ajaxRoute = ajaxRoute.replace('__id__', appointmentId); // تغيير الرابط إلى تحديث
        //             ajaxData += '&_method=PUT'; // إضافة الطريقة PUT
        //         }

        //         $.ajax({
        //             url: ajaxRoute,
        //             method: ajaxMethod,
        //             dataType: "json",
        //             data: ajaxData,
        //             success: function() {
        //                 $('#kt_blockui_4_4_modal').modal('hide'); // إغلاق النافذة
        //                 $('.kt_form')[0].reset(); // إعادة تعيين النموذج
        //                 $('#kt_table_1').DataTable().ajax.reload(); // إعادة تحميل الجدول
        //                 swal.fire({
        //                     position: 'top-right',
        //                     icon: 'success',
        //                     title: 'تم حفظ البيانات بنجاح',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //             },
        //             error: function(xhr) {
        //                 if (xhr.responseJSON.errors) {
        //                     $.each(xhr.responseJSON.errors, function(key, errors) {
        //                         var input = $(
        //                             `input[name="${key}"], textarea[name="${key}"]`);
        //                         input.addClass('is-invalid').after(
        //                             `<div class="invalid-feedback">${errors[0]}</div>`
        //                         );
        //                     });
        //                 }
        //                 swal.fire({
        //                     position: 'top-right',
        //                     icon: 'error',
        //                     title: 'فشل في حفظ البيانات',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //             }
        //         });
        //     });

        //     // تحديث حالة الموعد
        //     $(document).on('click', '#updatestatus', function() {
        //         var appointmentId = $(this).data('id');

        //         $.ajax({
        //             url: `/dashboard/admin/appointments/${appointmentId}/get-status`,
        //             type: 'GET',
        //             success: function(response) {
        //                 $('select[name="status"]').val(response.status).change();
        //                 $('#saveStatusChanges').data('id', appointmentId);
        //                 $('#kt_modal_1').modal('show');
        //             },
        //             error: function() {
        //                 swal.fire({
        //                     type: 'error',
        //                     title: 'حدث خطأ في جلب الحالة الحالية',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //             }
        //         });
        //     });

        //     // حفظ تحديث الحالة
        //     $('#saveStatusChanges').on('click', function() {
        //         var appointmentId = $(this).data('id');
        //         var status = $('#select').val();

        //         $.ajax({
        //             url: `/dashboard/admin/appointments/${appointmentId}/update-status`,
        //             type: 'POST',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 status: status,
        //             },
        //             success: function() {
        //                 $('#kt_modal_1').modal('hide');
        //                 $('#kt_table_1').DataTable().ajax.reload(); // Refresh the DataTable
        //                 swal.fire({
        //                     position: 'top-right',
        //                     icon: 'success',
        //                     title: 'تم تحديث الحالة بنجاح',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //             },
        //             error: function() {
        //                 swal.fire({
        //                     type: 'error',
        //                     title: 'حدث خطأ في تحديث الحالة',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //             }
        //         });
        //     });

        //     // حذف الموعد
        //     $(document).on('click', '#delete', function() {
        //         var appointmentId = $(this).data('id');
        //         const swalWithBootstrapButtons = swal.mixin({
        //             confirmButtonClass: 'btn btn-success',
        //             cancelButtonClass: 'btn btn-danger',
        //             buttonsStyling: false,
        //         });

        //         swalWithBootstrapButtons.fire({
        //             title: '{{ __('datatable.confirm_delete_title') }}',
        //             text: '{{ __('datatable.confirm_delete_text') }}',
        //             type: 'warning',
        //             showCancelButton: true,
        //             confirmButtonText: '{{ __('datatable.confirm_delete') }}',
        //             cancelButtonText: '{{ __('datatable.cancel_delete') }}',
        //             reverseButtons: true
        //         }).then((result) => {
        //             if (result.value) {
        //                 $.ajax({
        //                     url: `/dashboard/admin/appointments/${appointmentId}`,
        //                     type: 'DELETE',
        //                     data: {
        //                         _token: '{{ csrf_token() }}'
        //                     },
        //                     success: function() {
        //                         $('#kt_table_1').DataTable().ajax
        //                             .reload(); // Reload the DataTable
        //                         swal.fire({
        //                             position: 'top-right',
        //                             icon: 'success',
        //                             title: '{{ __('datatable.deleted_successfully') }}',
        //                             showConfirmButton: false,
        //                             timer: 1500
        //                         });
        //                     },
        //                     error: function() {
        //                         swal.fire({
        //                             type: 'error',
        //                             title: 'حدث خطأ في حذف الموعد',
        //                             showConfirmButton: false,
        //                             timer: 1500
        //                         });
        //                     }
        //                 });
        //             } else if (result.dismiss === swal.DismissReason.cancel) {
        //                 swal.fire({
        //                     title: '{{ __('datatable.cancelled') }}',
        //                     text: '{{ __('datatable.cancel_delete') }}',
        //                     type: 'error',
        //                     timer: 1500
        //                 });
        //             }
        //         });
        //     });
        // });
    </script>

@endsection
