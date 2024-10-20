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
        }

        .input-group .input-group-append .input-group-text {
            border-radius: 4px 0 0 4px !important;
        }

        th:empty,
        td:empty,
        table,
        table-bordered {
            border: none !important;
        }

        .kt-section {
            margin-top: 20px;
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
                <h3 class="kt-portlet__head-title">Form Widgets Validation Examples</h3>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" class="kt-form kt-form--label-right" id="kt_form_1">
            @csrf
            @method('PUT')
            @include('dashboard.admin.group_services._form')
            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="col-lg-9 ml-lg-auto">
                        <button type="submit" id="submit-form" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('subheader')
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container kt-container--fluid">
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
@endsection

@section('scripts')
    <script src="{{ asset('adminassets/assets/js/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
    </script>
    <script>
        $(document).ready(function() {

            $.ajax({
                url: "{{ route('admin.group-services.edit', $group->id) }}",
                method: 'GET',
                success: function(response) {
                    let groupData = response.data;

                    $('.namear').val(groupData.namear);
                    $('.nameen').val(groupData.nameen);
                    $('.descriptionar').val(groupData.descriptionar);
                    $('.descriptionen').val(groupData.descriptionen);
                    $('select[name="department"]').val(groupData.department).change();
                    $('.discount').val(groupData.discount);
                    $('.tax_rate').val(groupData.tax_rate);
                    let serviceTableBody = $('table tbody');
                    if (groupData.services.length > 0) {
                        groupData.services.forEach(function(service, index) {
                            let newRow = $('.new-service-template').clone();
                            newRow.removeClass('new-service-template d-none').addClass(
                                'new-service');
                            newRow.attr('data-index', index + 1);
                            newRow.find('.service-count').text(index + 1);
                            newRow.find('.service-select').append(`
                                <option selected value="${service.service_id}" data-price="${service.price}">${service.name}</option>
                            `);
                            newRow.find('.price').text(service.price);
                            newRow.find('.service-quantity').val(service.quantity);
                            newRow.find('.service-price').text(service.quantity * service
                                .price);
                            serviceTableBody.append(newRow);
                        });
                    }
                    updateTotal();
                },
                error: function(response) {
                    alert('حدث خطأ أثناء جلب بيانات المجموعة.');
                }
            });


            $('.department').change(function() {
                var selectedDepartment = $(this).val();
                $('tbody tr').not('.new-service-template').remove();
                $('.service-select').empty();
                $('.service-select').append('<option disabled selected>اختر خدمة</option>');

                if (selectedDepartment) {
                    $.ajax({
                        url: `/dashboard/admin/group-services/get_services/${selectedDepartment}`,
                        method: 'GET',
                        success: function(response) {
                            response.services.forEach(function(service) {
                                $('.service-select').append(
                                    `<option value="${service.id}" data-price="${service.price}">${service.name}</option>`
                                );
                            });
                        },
                        error: function() {
                            console.log('حدث خطأ أثناء جلب البيانات.');
                        }
                    });
                }
            });

            let serviceCount = 0;

            $('.add-service-btn').click(function() {
                if ($('tr.new-service').length > 0) {
                    Swal.fire({
                        type: 'warning',
                        title: 'تحذير',
                        text: 'يرجى تأكيد الخدمة الحالية أولاً!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }
                serviceCount++;
                const newRow = $('.new-service-template').clone();
                newRow.removeClass('new-service-template d-none').addClass('new-service');
                newRow.attr('data-index', serviceCount); // استخدام data-index بدلًا من data-id
                newRow.find('.service-count').text(serviceCount); // استخدام serviceCount لعرض رقم الصف
                newRow.attr('id', `service-${serviceCount}`); // إضافة معرف فريد للصف
                $('table tbody').append(newRow);
                updateRowNumbers(); // تحديث أرقام الصفوف
                updateTotal_after_discount();
            });

            $(document).on('change', '.service-select', function() {
                const row = $(this).closest('tr');
                const selectedOption = $(this).find('option:selected');
                const servicePrice = selectedOption.data('price');
                const quantity = row.find('.service-quantity').val();
                const total = quantity * servicePrice;
                row.find('.price').text(servicePrice);
                row.find('.service-price').text(total);
                updateTotal();
            });

            $(document).on('click', '.confirm-service', function(event) {
                event.preventDefault();

                const row = $(this).closest('tr');
                const select = row.find('.service-select');
                const selectedOption = select.find('option:selected');

                if (!selectedOption.val()) {
                    Swal.fire({
                        type: 'error',
                        title: 'خطأ',
                        text: 'يرجى اختيار خدمة!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                } else {
                    row.find('.error-message').remove();
                }

                const servicePrice = selectedOption.data('price');
                const quantity = row.find('.service-quantity').val();
                const total = quantity * servicePrice;

                if (!servicePrice || isNaN(servicePrice)) {
                    Swal.fire({
                        type: 'error',
                        title: 'خطأ',
                        text: 'يرجى اختيار خدمة صحيحة تحتوي على سعر!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }
                row.find('td').first().html(selectedOption.text());
                row.find('.service-price').text(total);
                select.find(`option[value="${selectedOption.val()}"]`).remove();
                row.find('.service-quantity').prop('disabled', true);
                select.remove();
                row.find('.confirm-service').remove();
                row.removeClass('new-service');
                row.attr('data-service-id', selectedOption
                    .val()); // إضافة service-id إلى البيانات الخاصة بالصف
                row.attr('data-service-name', selectedOption
                    .text()); // إضافة service-name إلى البيانات الخاصة بالصف
                updateTotal();
                updateRowNumbers();
            });

            $(document).on('change', '.service-select', function() {
                const row = $(this).closest('tr');
                row.find('.error-message').remove();
            });

            $(document).on('input', '.service-quantity', function() {
                const row = $(this).closest('tr');
                const quantity = $(this).val();
                const servicePrice = row.find('.service-select option:selected').data('price');
                const total = quantity * servicePrice;
                row.find('.service-price').text(total);
                updateTotal();
            });

            $(document).on('click', '.remove-service', function(event) {
                event.preventDefault();
                const row = $(this).closest('tr');
                Swal.fire({
                    title: 'تأكيد الحذف',
                    text: 'هل أنت متأكد أنك تريد حذف هذه الخدمة؟',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم، حذف!',
                    cancelButtonText: 'لا، إلغاء'
                }).then((result) => {
                    if (result.value) {
                        row.remove();
                        updateTotal();
                        updateRowNumbers();
                    }
                });
            });

            function updateTotal() {
                let total = 0;
                $('.service-price').each(function() {
                    total += parseFloat($(this).text());
                });
                $('tfoot .total').text(total);
                updateTotal_after_discount();
            }

            function updateTotal_after_discount() {
                let total = parseFloat($('tfoot .total').text());
                let discount = parseFloat($('input[name="discount"]').val()) || 0; // Get discount value
                let taxRate = parseFloat($('input[name="tax_rate"]').val()) ||
                    0; // Get tax rate value (as a percentage)

                // Apply discount
                let totalAfterDiscount = total - discount;

                // Apply tax
                let totalWithTax = totalAfterDiscount + (totalAfterDiscount * (taxRate / 100));

                // Update the fields for total after discount and total with tax
                $('tfoot .total_after_discount').text(totalAfterDiscount.toFixed(2));
                $('tfoot .total_with_tax').text(totalWithTax.toFixed(2));
            }
            $('input[name="discount"], input[name="tax_rate"]').on('input', function() {
                updateTotal_after_discount();
            });

            function updateRowNumbers() {
                let rowIndex = 1; // نبدأ العد من 1
                $('table tbody tr').not('.new-service-template').each(function() {
                    $(this).find('.service-count').text(
                        rowIndex); // تحديث رقم الصف بناءً على ترتيبه في الجدول
                    rowIndex++; // زيادة العدد لكل صف
                });
            }

            $('#submit-form').click(function(event) {
                event.preventDefault();

                let services = [];
                let hasUnconfirmedServices = false;
                let servicesAdded = false;

                $('tbody tr').not('.new-service-template').each(function() {
                    if ($(this).find('.service-select').length) {
                        hasUnconfirmedServices = true;
                        return;
                    }
                    let serviceId = $(this).data('service-id');
                    let serviceName = $(this).data('service-name');
                    let quantity = $(this).find('.service-quantity').val();
                    let price = $(this).find('.price').text();
                    let totalPrice = $(this).find('.service-price').text();
                    if (serviceId && serviceName) {
                        servicesAdded = true;
                        services.push({
                            service_id: serviceId,
                            service_name: serviceName,
                            quantity: quantity,
                            price: price,
                            total: totalPrice
                        });
                    }
                });
                if (hasUnconfirmedServices) {
                    Swal.fire({
                        type: 'warning',
                        title: 'تحذير',
                        text: 'يرجى تأكيد جميع الخدمات قبل الإرسال!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }

                if (!servicesAdded) {
                    Swal.fire({
                        type: 'warning',
                        title: 'تحذير',
                        text: 'يرجى إضافة خدمات قبل الإرسال!',
                        confirmButtonText: 'موافق'
                    });
                    return;
                }


                $.ajax({
                    url: '{{ route('admin.group-services.update', $group->id) }}',
                    method: 'PUT',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        namear: $('input[name="namear"]').val(),
                        nameen: $('input[name="nameen"]').val(),
                        department: $('select[name="department"]').val(),
                        descriptionar: $('textarea[name="descriptionar"]').val(),
                        descriptionen: $('textarea[name="descriptionen"]').val(),
                        discount: $('input[name="discount"]').val(),
                        tax_rate: $('input[name="tax_rate"]').val(),
                        services: services
                    },
                    success: function(response) {
                        console.log(services);
                        setTimeout(function() {
                            window.location.href = "{!! route('group-services.index') !!}";
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
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '<ul>';
                        // Collect and format error messages
                        $.each(errors, function(key, value) {
                            errorMessages += `<li>${value}</li>`;
                        });

                        errorMessages += '</ul>';

                        Swal.fire({
                            type: 'error',
                            title: 'خطأ!',
                            html: errorMessages,
                            confirmButtonText: 'موافق'
                        });
                    }
                });
            });
        });
    </script>
@endsection
