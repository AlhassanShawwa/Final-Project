// Class definition

var KTFormWidgets = function () {
    var initWidgets = function () {
        // datepicker
        $('#kt_datepicker').datepicker({
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
        // bootstrap select
        $('#select_status').selectpicker();
        $('#select_department').selectpicker();
        $('#select').selectpicker();
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
