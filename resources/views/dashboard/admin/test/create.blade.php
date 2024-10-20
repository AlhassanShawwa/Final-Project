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
                    <div class="row row-group">
                        <div class="form-group">
                            <label for="nameAr" class="form-control-label">{{ __('test.nameAr') }}</label>
                            <input type="text" name="nameAr" class="form-control" id="nameAr">
                        </div>
                        <div class="form-group">
                            <label for="nameEn" class="form-control-label">{{ __('test.nameEn') }}</label>
                            <input type="text" name="nameEn" class="form-control" id="nameEn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label">{{ __('test.code') }}</label>
                        <input type="text" name="code" class="form-control" id="code">
                    </div>

                    <div class="form-group">
                        <label for="descriptionAr" class="form-control-label">{{ __('test.descriptionAr') }}</label>
                        <textarea class="form-control" name="descriptionAr" id="descriptionAr"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descriptionEn" class="form-control-label">{{ __('test.descriptionEn') }}</label>
                        <textarea class="form-control" name="descriptionEn" id="descriptionEn"></textarea>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('test.close') }}</button>
                <button class="btn btn-primary" id="kt_blockui_4_4">{{ __('test.save') }}</button>
            </div>

        </div>
    </div>
</div>

<!--end::Modal-->
