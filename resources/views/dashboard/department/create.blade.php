
<!--begin::Modal-->
<div class="modal fade" id="kt_blockui_4_4_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                    <div class="row row-group">
                        <div class="form-group">
                            <label for="nameAr" class="form-control-label">{{ __('department.nameAr') }}</label>
                            <input type="text" name="nameAr" class="form-control" id="nameAr">
                        </div>
                        <div class="form-group">
                            <label for="nameEn" class="form-control-label">{{ __('department.nameEn') }}</label>
                            <input type="text" name="nameEn" class="form-control" id="nameEn">
                        </div>
                    </div>
                    <div class="row row-group">
                        <div class="form-group">
                            <label for="addressAr" class="form-control-label">{{ __('department.addressAr') }}</label>
                            <input type="text" name="addressAr" class="form-control" id="addressAr">
                        </div>
                        <div class="form-group">
                            <label for="addressEn" class="form-control-label">{{ __('department.addressEn') }}</label>
                            <input type="text" name="addressEn" class="form-control" id="addressEn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descriptionAr"
                            class="form-control-label">{{ __('department.descriptionAr') }}</label>
                        <textarea class="form-control" name="descriptionAr" id="descriptionAr"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descriptionEn"
                            class="form-control-label">{{ __('department.descriptionEn') }}</label>
                        <textarea class="form-control" name="descriptionEn" id="descriptionEn"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('department.close') }}</button>
                <button class="btn btn-primary" id="kt_blockui_4_4">{{ __('department.save') }}</button>
            </div>

        </div>
    </div>
</div>

<!--end::Modal-->
