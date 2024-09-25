<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">الاسم بالعربي </label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="firstnamear"
                    placeholder="{{ __('doctor.firstnamearabic') }}" />
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="lastnamear"
                    placeholder="{{ __('doctor.lastnamearabic') }}" />
            </div>

        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">الاسم بالانجليزي</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="firstnameen"
                    placeholder="{{ __('doctor.firstnameenglish') }}" />
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="lastnameen"
                    placeholder="{{ __('doctor.lastnameenglish') }}" />
            </div>

        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('driver.license_number') }}</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <input type='text' class="form-control" name="license_number"
                placeholder="{{ __('form.license_number') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.phone') }}</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <input type='text' class="form-control" name="phone" placeholder="{{ __('form.phone') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Bootstrap Select *</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                    <select class="form-control" id="select" name="ambulance">
                        <option disabled selected>Mustard</option>
                        @foreach ($ambulances as $ambulance)
                            <option value="{{ $ambulance->id }}">{{ $ambulance->car_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.dateofbirth') }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="date"
                    placeholder="{{ __('datatable.date_of_birth') }}" id='kt_datepicker' />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="la la-calendar-check-o"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
