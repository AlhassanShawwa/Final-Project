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
                        <label for="car_model" class="form-control-label">{{ __('service.car_model') }}</label>
                        <input type="text" name="car_model" class="form-control" id="car_model">
                    </div>
                    <div class="form-group">
                        <label for="car_number" class="form-control-label">{{ __('service.car_number') }}</label>
                        <input type="text" name="car_number" class="form-control" id="car_number">
                    </div>
                    <div class="form-group">
                        <label for="car_year_made" class="form-control-label">{{ __('service.car_year_made') }}</label>
                        <input type="text" name="car_year_made" class="form-control" id="car_year_made">
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
