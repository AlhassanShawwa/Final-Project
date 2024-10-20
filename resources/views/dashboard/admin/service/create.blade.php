<!--begin::Modal-->
<div class="modal fade" aria-hidden="true" id="kt_blockui_4_4_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <label for="nameAr" class="form-control-label">{{ __('service.nameAr') }}</label>
                            <input type="text" name="nameAr" class="form-control" id="nameAr">
                        </div>
                        <div class="form-group">
                            <label for="nameEn" class="form-control-label">{{ __('service.nameEn') }}</label>
                            <input type="text" name="nameEn" class="form-control" id="nameEn">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="form-control-label">{{ __('service.department') }}</label>
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
                        <label for="price" class="form-control-label">{{ __('service.price') }}</label>
                        <input type="text" name="price" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <label for="descriptionAr" class="form-control-label">{{ __('service.descriptionAr') }}</label>
                        <textarea class="form-control" name="descriptionAr" id="descriptionAr"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="descriptionEn" class="form-control-label">{{ __('service.descriptionEn') }}</label>
                        <textarea class="form-control" name="descriptionEn" id="descriptionEn"></textarea>
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
