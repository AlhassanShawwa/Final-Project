<!--begin::Modal-->
<div class="modal fade" aria-hidden="true" id="kt_blockui_4_4_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="kt_form">
                    @csrf
                    <div class="form-group">
                        <label for="select_patient" class="form-control-label">{{ __('appointment.patient') }}</label>
                        <div class="bootstrap-select-wrapper">
                            <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                                <select class="form-control" id="select_patient" name="patient">
                                    <option disabled selected>{{ __('appointment.select_patient') }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="department" class="form-control-label">{{ __('appointment.department') }}</label>
                        <div class="bootstrap-select-wrapper">
                            <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                                <select class="form-control" id="select_department" name="department">
                                    <option disabled selected>Mustard</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->trans_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label col-lg-3 col-sm-12">{{ __('appointment.doctor') }}</label>
                        <div class="bootstrap-select-wrapper">
                            <div class="dropdown bootstrap-select  form-control kt-bootstrap-select dropup">
                                <select class="form-control" id="select_doctor" name="doctor">
                                    <option disabled selected>Mustard</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kt_datepicker" class="form-control-label">{{ __('form.date') }}</label>
                        <div class='input-group'>
                            <input type='text' class="form-control" name="date" placeholder="dd/mm/yyyy"
                                id='kt_datepicker' />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('service.close') }}</button>
                <button class="btn btn-primary" id="kt_blockui_4_4">{{ __('service.save') }}</button>
            </div>

        </div>
    </div>
</div>
<!--end::Modal-->
