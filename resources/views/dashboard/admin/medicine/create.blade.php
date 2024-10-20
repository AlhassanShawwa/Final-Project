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
                        <label for="name" class="form-control-label">{{ __('medicine.name') }}</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label">{{ __('medicine.code') }}</label>
                        <input type="text" name="code" class="form-control" id="code">
                    </div>
                    <div class="form-group">
                        <label for="manufacturer" class="form-control-label">{{ __('medicine.manufacturer') }}</label>
                        <input type="text" name="manufacturer" class="form-control" id="manufacturer">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('medicine.close') }}</button>
                <button class="btn btn-primary" id="kt_blockui_4_4">{{ __('medicine.save') }}</button>
            </div>

        </div>
    </div>
</div>

<!--end::Modal-->
