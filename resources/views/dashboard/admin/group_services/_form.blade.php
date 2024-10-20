<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">الاسم الخدمة </label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control namear" name="namear"
                    placeholder="{{ __('doctor.namearabic') }}" />
            </div>
        </div>
        <div class="invalid col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control nameen" name="nameen"
                    placeholder="{{ __('doctor.namearabic') }}" />
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">description</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <textarea class="form-control descriptionar" name="descriptionar" rows="3"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">description</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <textarea class="form-control descriptionen" name="descriptionen" rows="3"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">القسم</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                    <select class="form-control department" id="select" name="department">
                        <option disabled selected>Mustard</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->trans_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <a href="javascript:;" class="btn btn-brand btn-elevate btn-icon-sm add-service-btn">
            <i class="la la-plus"></i>إضافة خدمة فرعية</a>
        <div class="kt-section">
            <div class="kt-section__content">
                <table class="table table-bordered">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>{{ __('dashboard.services') }}</th>
                            <th>السعر</th>
                            <th>العدد</th>
                            <th>السعر الاجمالي</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="new-service-template d-none">
                            <th scope="row" class="service-count">1</th>
                            <td>
                                <select class="form-control service-select">
                                    <option selected>اختر خدمة</option>
                                </select>
                            </td>
                            <td class="price">0</td>
                            <td><input type="number" value="1" class="form-control service-quantity" /></td>
                            <td class="service-price">0</td>
                            <td>
                                <button class="btn btn-sm btn-icon btn-icon-md btn-primary confirm-service"><i
                                        class="la la-check"></i></button>
                                <button class="btn btn-sm btn-icon btn-icon-md btn-danger remove-service"><i
                                        class="la la-close"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total</th>
                            <th class="total">---</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>discount</th>
                            <th><input style="width: 100px" type="number" min="0" name="discount"
                                    class="form-control discount" /></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>total_after_discount</th>
                            <th class="total_after_discount">---</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>tax_rate</th>
                            <th><input style="width: 100px" type="number" min="0" max="100" value="1"
                                    name="tax_rate" class="form-control tax_rate" /></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>total_with_tax</th>
                            <th class="total_with_tax">---</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
