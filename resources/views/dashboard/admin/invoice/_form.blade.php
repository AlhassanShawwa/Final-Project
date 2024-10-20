<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">اختر المريض : *</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select form-control kt-bootstrap-select dropup">
                    <select class="form-control" id="select_patient" name="patient" data-live-search="true">
                        <option disabled selected>اختر المريض</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->trans_full_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="date" placeholder="dd/mm/yyyy" id='kt_datepicker'
                    readonly disabled />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="la la-calendar-check-o"></i>
                    </span>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">معلومات الطبيب</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="doctor" placeholder="اسم الطبيب" readonly disabled />
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="firstnameen" placeholder="اسم القسم" readonly
                    disabled />
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">اختر الخدمة : *</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input type="text" class="form-control" id="service-name" name="service-name" placeholder="اسم الخدمة"
                readonly disabled />
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <input class="form-control" name="service-price" value="السعر" disabled readonly type="text">
        </div>
    </div>

    <!-- جدول عرض الخدمات -->
    <div class="form-group row">
        <div class="col-lg-12">
            <table class="table  kt-datatable__table">
                <thead class="kt-datatable__head">
                    <tr class="kt-datatable__row">
                        <th class="kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check">#</th>
                        <th class="kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check">اسم الخدمة
                        </th>
                        <th class="kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check">السعر</th>
                        <th class="kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check">quantity
                        </th>
                    </tr>
                </thead>
                <tbody id="services-table-body" class="kt-datatable__body">
                </tbody>
            </table>
        </div>
    </div>
</div>
