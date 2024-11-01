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
                        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            {{ __('dashboard.all-appointments') }}
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
                        <th>{{ __('datatable.id') }}</th>
                        <th>{{ __('datatable.patient-name') }}</th>
                        <th>{{ __('datatable.appointment-date') }}</th>
                        <th>{{ __('datatable.status') }}</th>
                        <th>{{ __('datatable.actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>


    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تشخيص الحالة</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="kt_form_2">
                        @csrf
                        <div class="row-group row">
                            <div class="form-group">
                                <label for="diagnosisAr" class="form-control-label">{{ __('patient.diagnosisAr') }}</label>
                                <textarea class="form-control" name="diagnosisAr" id="diagnosisAr"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="diagnosisEn" class="form-control-label">{{ __('patient.diagnosisEn') }}</label>
                                <textarea class="form-control" name="diagnosisEn" id="diagnosisEn"></textarea>
                            </div>
                        </div>

                        <div class="kt-portlet__body">
                            <a href="javascript:;" style="width: 100% ; margin-bottom: 12px "
                                class="btn btn-brand btn-elevate btn-icon-sm add-medicine-btn">
                                <i class="la la-plus"></i>إضافة دواء</a> <!-- تم تعديل نص الزر هنا -->
                            <div class="kt-section">
                                <div class="kt-section__content">
                                    <table class="table medicines-table">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('dashboard.medicine') }}</th>
                                                <th>dosage</th>
                                                <th>frequency</th>
                                                <th>description</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="new-medicine">
                                                <th scope="row" class="medicine-count">1</th>
                                                <td>
                                                    <div class="bootstrap-select-wrapper">
                                                        <div
                                                            class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                                                            <select class="form-control medicine" id="select_medicine"
                                                                name="medicine" data-live-search="true">
                                                                <option disabled selected>Select Doctor</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td><input type="number" style="width: 150px;" class="form-control"
                                                        name="dosage" id="dosage"></td>
                                                <td><input type="text" class="form-control frequency"
                                                        placeholder="frequency" /></td>
                                                <td><input type="text" class="form-control description"
                                                        placeholder="description" /></td>
                                                <td>
                                                    <button
                                                        class="btn btn-sm btn-icon btn-icon-md btn-primary confirm-medicine"><i
                                                            class="la la-check"></i></button>
                                                    <button
                                                        class="btn btn-sm btn-icon btn-icon-md btn-danger remove-medicine"><i
                                                            class="la la-close"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="saveDiagnosisChanges" type="button" data-patient-id="" data-appointment-id=""
                        class="btn btn-primary">Save
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
                <h3 class="kt-subheader__title">{{ __('dashboard.daily-appointments') }}</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('doctor.dashboard') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.dashboard') }}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('doctor.appointments.index') }}"
                        class="kt-subheader__breadcrumbs-link">{{ __('dashboard.all-appointments') }}</a>
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
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
    </script>
    <script
        src="{{ asset('adminassets/assets/plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>

    <script src="{{ asset('adminassets/assets/js/pages/components/extended/blockui.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>

    <script>
        $(document).ready(function() {
            var doctorSelect = $('.kt-selectpicker');
            loadMedicines();
            doctorSelect.selectpicker('refresh');
            var table = $('#kt_table_1');
            table.DataTable({
                responsive: true,
                ajax: {
                    route: "{!! route('doctor.appointments.dailyAppointments') !!}",
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
                        data: 'patient_name',
                        title: "{{ __('datatable.patient-name') }}"
                    },
                    {
                        data: 'date',
                        title: "{{ __('datatable.appointment-date') }}"
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
                    }
                ],
                columnDefs: [{
                    targets: -2,
                    render: function(data) {
                        var status = {
                            scheduled: '{{ __('datatable.scheduled') }}',
                            hanging: '{{ __('datatable.hanging') }}',
                            completed: '{{ __('datatable.completed') }}',
                            cancelled: '{{ __('datatable.cancelled') }}',
                        };

                        var statusClasses = {
                            scheduled: 'kt-badge--brand',
                            hanging: 'kt-badge--warning',
                            completed: 'kt-badge--success',
                            cancelled: 'kt-badge--danger',
                        };

                        return (status[data] !== undefined) ?
                            `<span class="kt-badge ${statusClasses[data]} kt-badge--inline kt-badge--pill">${status[data]}</span>` :
                            data;
                    }
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
            $(document).on('click', '#diagnosis', function() {
                const patientId = $(this).data('patient-id');
                const appointmentId = $(this).data('id');
                $('#saveDiagnosisChanges').data('patient-id', patientId);
                $('#saveDiagnosisChanges').data('appointment-id', appointmentId);
            });
            $('#kt_modal_4_2').on('hidden.bs.modal', function() {
                $('#saveDiagnosisChanges').removeData('patient-id');
                $('#saveDiagnosisChanges').removeData('appointment-id');
                $('#diagnosisAr').val('');
                $('#diagnosisEn').val('');
                $('.medicines-table tbody').empty();
            });

            function loadMedicines() {
                $.ajax({
                    url: '{{ route('doctor.medicines.get') }}',
                    type: 'GET',
                    success: function(response) {
                        $('select[name="medicine"]').each(function() {
                            const medicineSelect = $(this);
                            medicineSelect.empty();
                            medicineSelect.append(
                                '<option selected disabled >اختر دواء</option>');
                            response.forEach(function(medicine) {
                                medicineSelect.append(
                                    `<option value="${medicine.id}">${medicine.name}</option>`
                                );
                            });
                            medicineSelect.selectpicker('refresh');
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: 'حدث خطأ أثناء تحميل الأدوية!',
                            confirmButtonText: 'موافق'
                        });
                    }
                });
            }
            let medicineCount = 0;

            $('.add-medicine-btn').click(function() {
                if ($('tr.new-medicine').length > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'تحذير',
                        text: 'يرجى تأكيد الخدمة الحالية أولاً!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }

                let newRow = `
                        <tr class="new-medicine">
                            <th scope="row" class="medicine-count"></th>
                            <td>
                                <div class="bootstrap-select-wrapper">
                                    <div class="dropdown bootstrap-select form-control kt-bootstrap-select dropup">
                                            <select class="form-control medicine" id="select_medicine"
                                                                                name="medicine" data-live-search="true">
                                            <option disabled selected>Select Doctor</option>
                                        </select>
                                    </div>
                                </div>
                            </td>~ْؤرلا ى
                            <td><input type="number" style="width: 150px;" class="form-control" name="dosage" id="dosage"></td>
                            <td><input type="text" class="form-control frequency" placeholder="frequency" /></td>
                            <td><input type="text" class="form-control description" placeholder="description" /></td>
                            <td>
                                <button class="btn btn-sm btn-icon btn-icon-md btn-primary confirm-medicine"><i class="la la-check"></i></button>
                                <button class="btn btn-sm btn-icon btn-icon-md btn-danger remove-medicine"><i class="la la-close"></i></button>
                            </td>
                        </tr>`;

                $('table.medicines-table tbody').append(newRow);
                $('select[name="medicine"]').selectpicker('refresh');
                loadMedicines();
                updateRowNumbers();
            });


            $(document).on('click', '.confirm-medicine', function(e) {
                e.preventDefault();

                const row = $(this).closest('tr');
                const select = row.find('.medicine');
                const selectedOption = select.find('option:selected');

                if (!selectedOption.val()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'يرجى اختيار دواء!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }

                const dosage = row.find('input[name="dosage"]').val();
                if (!dosage || dosage <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'يرجى إدخال الجرعة بشكل صحيح!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }

                const frequency = row.find('input.frequency').val();
                if (!frequency || frequency.trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'يرجى إدخال التكرار!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }

                const description = row.find('input.description').val();
                if (!description || description.trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'يرجى إدخال الوصف!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }
                const medicineName = select.find('option:selected').text();
                const medicineId = select.find('option:selected').val();
                const readOnlyInput =
                    `<input type="text" class="form-control" name="medicine" data-id="${medicineId}" value="${medicineName}" readonly disabled />`;
                row.find('td').first().html(readOnlyInput);
                row.find('.medicine').remove();
                row.find('.confirm-medicine').remove();
                row.removeClass('new-medicine').addClass('medicine');
                updateRowNumbers();
            });
            $(document).on('click', '.remove-medicine', function(event) {
                event.preventDefault();
                const row = $(this).closest('tr');

                const rowCount = $('table.medicines-table tbody tr').length;

                if (rowCount === 1) {
                    Swal.fire({
                        title: 'إفراغ البيانات',
                        text: 'هذا هو الصف الوحيد المتبقي. هل تريد إفراغ الجدول؟',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، إفراغ!',
                        cancelButtonText: 'لا، إلغاء'
                    }).then((result) => {
                        row.find('select.medicine').val(null).selectpicker('refresh');
                        row.find('input[name="dosage"]').val('');
                        row.find('input.frequency').val('');
                        row.find('input.description').val('');

                        const buttonsHtml = `
                        <button class="btn btn-sm btn-icon btn-icon-md btn-primary confirm-medicine"><i class="la la-check"></i></button>
                        <button class="btn btn-sm btn-icon btn-icon-md btn-danger remove-medicine"><i class="la la-close"></i></button>
                        `;
                        row.find('td').last().html(buttonsHtml);
                        const newSelect = `
                            <select class="form-control medicine" name="medicine" data-live-search="true">
                                <option disabled selected>اختر دواء</option>
                            </select>
                            `;
                        row.find('td').first().html(
                            newSelect);
                        loadMedicines();
                    });
                } else {
                    Swal.fire({
                        title: 'تأكيد الحذف',
                        text: 'هل أنت متأكد أنك تريد حذف هذا الدواء؟',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'نعم، حذف!',
                        cancelButtonText: 'لا، إلغاء'
                    }).then((result) => {

                        row.remove();

                        if ($('table.medicines-table tbody tr').length === 0) {
                            $('table.medicines-table tbody').empty();
                            $('table.medicines-table tbody').append(
                                '<tr><td colspan="6" class="text-center">لا توجد أدوية مضافة بعد.</td></tr>'
                            );
                        }

                        updateRowNumbers();
                    });
                }
            });


            function updateRowNumbers() {
                let rowIndex = 1;
                $('table.medicines-table tbody tr').not('.new-medicine-template').each(function() {
                    $(this).find('.medicine-count').text(rowIndex);
                    rowIndex++;
                });
            }

            $('#saveDiagnosisChanges').click(function(e) {
                e.preventDefault();

                let diagnosisData = {
                    _token: $('input[name="_token"]').val(),
                    diagnosis_ar: $('#diagnosisAr').val(),
                    diagnosis_en: $('#diagnosisEn').val(),
                    patient_id: $(this).data('patient-id'),
                    appointment_id: $(this).data('appointment-id'),
                    medicines: []
                };


                $('.medicines-table tbody tr').each(function() {
                    const medicineRow = $(this);
                    const medicineId = medicineRow.find('input[name="medicine"]').data('id');
                    const dosage = medicineRow.find('input[name="dosage"]').val();
                    const frequency = medicineRow.find('.frequency').val();
                    const description = medicineRow.find('.description').val();

                    if (medicineId) {
                        diagnosisData.medicines.push({
                            medicine: medicineId,
                            dosage: dosage,
                            frequency: frequency,
                            description: description
                        });
                    }
                });


                $.ajax({
                    url: '{{ route('doctor.diagnoses.store') }}',
                    type: 'POST',
                    data: diagnosisData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم الحفظ!',
                            text: 'تم حفظ التشخيص والأدوية بنجاح.',
                            confirmButtonText: 'موافق'
                        });
                        $('#kt_modal_4_2').modal('hide');
                        $('#kt_table_1').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: 'حدث خطأ أثناء حفظ البيانات!',
                            confirmButtonText: 'موافق'
                        });
                    }
                });
            });
        });
    </script>

@endsection
