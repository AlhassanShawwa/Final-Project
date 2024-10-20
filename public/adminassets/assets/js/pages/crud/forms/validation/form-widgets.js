// Class definition

var KTFormWidgets = function () {
    var initWidgets = function () {
        // datepicker
        $('#kt_datepicker').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
            orientation: 'bottom auto',
            todayHighlight: true,
        });
        // bootstrap select
        $('#select_status').selectpicker();
        $('#select_medicine').selectpicker();
        $('#select_department').selectpicker();
        $('#select_doctor').selectpicker();
        $('#select_patient').selectpicker();
        $('#select').selectpicker();
        $('#select-service-type').selectpicker();
        $('#select-services').selectpicker();
        $('#service-select').selectpicker();
    }
    return {
        // public functions
        init: function () {
            initWidgets();
        }
    };
}();

jQuery(document).ready(function () {
    KTFormWidgets.init();
});
