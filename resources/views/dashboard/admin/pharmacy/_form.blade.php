<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">: الاسم</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="namear"
                    placeholder="{{ __('doctor.firstnamearabic') }}" />
            </div>
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="nameen"
                    placeholder="{{ __('doctor.lastnamearabic') }}" />
            </div>

        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">الايميل</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <input type='email' class="form-control" name="email" placeholder="{{ __('form.email') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.phone') }}</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <input type='text' class="form-control" name="phone" placeholder="{{ __('form.phone') }}" />
        </div>
    </div>
    <div class="form-group row">

        <label class="col-form-label col-lg-3 col-sm-12" for="location">{{ __('form.location') }}</label>
        <div class="col-lg-8 col-md-9 col-sm-12">
            <input type="text" id="location" name="location" placeholder="{{ __('form.location') }}"
                class="form-control" readonly>
            <div id="map" style="height: 400px;"></div>
        </div>


    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.type') }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='kt-radio-inline'>
                <label class="kt-radio">
                    <input type="radio" checked name="type" value="internal">
                    {{ __('pharmacy.internal') }}
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" name="type" value="external"> {{ __('pharmacy.external') }}
                    <span></span>
                </label>
            </div>
        </div>
    </div>
</div>
