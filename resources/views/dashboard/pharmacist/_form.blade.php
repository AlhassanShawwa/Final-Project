<div class="kt-portlet__body">
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('doctor.photo') }}</label>
        <div class="col-lg-9 col-xl-6">
            <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                <div class="kt-avatar__holder"
                    style="background-image: url({{ asset('adminassets/assets/media/users/default.jpg') }})">
                </div>
                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                    data-original-title="Change avatar">
                    <i class="fa fa-pen"></i>
                    <input type="file" name="image" accept=".png, .jpg, .jpeg">
                </label>
                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title=""
                    data-original-title="Cancel avatar">
                    <i class="fa fa-times"></i>
                </span>
            </div>
            {{-- <span class="form-text text-muted"></span> --}}
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">الاسم بالعربي </label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="firstnamear"
                    placeholder="{{ __('doctor.firstnamearabic') }}" />
            </div>
            {{-- <span class="form-text text-muted">Select a date time</span> --}}
        </div>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="lastnamear"
                    placeholder="{{ __('doctor.lastnamearabic') }}" />
            </div>
            {{-- <span class="form-text text-muted">Select a
                date time</span> --}}
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
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.phone') }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='input-group'>
                <input type='text' class="form-control" name="phone" placeholder="{{ __('datatable.phone') }}" />
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Bootstrap Select *</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="bootstrap-select-wrapper">
                <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">

                    <select class="form-control" id="select" name="pharmacy">
                        <option disabled selected>Mustard</option>
                        @foreach ($pharmacies as $pharmacy)
                            <option value="{{ $pharmacy->id }}">{{ $pharmacy->trans_name }}</option>
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

    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">{{ __('form.gender') }}</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class='kt-radio-inline'>
                <label class="kt-radio">
                    <input type="radio" checked name="gender" value="male">
                    {{ __('pharmacist.male') }}
                    <span></span>
                </label>
                <label class="kt-radio">
                    <input type="radio" name="gender" value="female"> {{ __('pharmacist.female') }}
                    <span></span>
                </label>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cropImageModal" tabindex="-1" role="dialog" aria-labelledby="cropImageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropImageModalLabel">تعديل الصورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="overflow: hidden" class="img-container">
                    <img id="imageToCrop" src="" alt="Picture">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" id="cropImage">حفظ الصورة</button>
            </div>
        </div>
    </div>
</div>
