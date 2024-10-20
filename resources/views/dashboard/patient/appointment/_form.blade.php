<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Select Department *</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                    <select class="form-control" id="select_department" name="department">
                        <option disabled selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->trans_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                    <select class="form-control" id="select_doctor" name="doctor" data-live-search="true">
                        <option disabled selected>Select Doctor</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Select Service *</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                    <select class="form-control" id="select-service-type" name="service-type">
                        <option disabled selected>Select Service Type</option>
                        <option value="single">Single Service</option>
                        <option value="group">Group Services</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                    <select class="form-control" id="select-services" name="services">
                        <option disabled selected>Select Service</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.date') }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="date" placeholder="dd/mm/yyyy" id='kt_datepicker' />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="la la-calendar-check-o"></i>
                    </span>
                </div>
            </div>

        </div>
    </div>


    <div class="form-group row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <table class="table table-bordered" id="services-table" style="display: none;">

                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>

                        <th>اسم الخدمة</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody id="services-table-body">
                </tbody>
                <tfoot>
                    <tr>
                        <td style="border: none"></td>
                        <td>السعر شامل الضريبة : </td>
                        <td id="total-price"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
