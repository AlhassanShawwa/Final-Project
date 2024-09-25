'use strict';
var KTDatatablesDataSourceAjaxClient = function () {

    var initTable1 = function () {
        var table = $('#kt_table_1');

        // begin first table
        table.DataTable({
            responsive: true,
            ajax: {
                route: "{!! route('doctors.index') !!}",
                type: 'GET',
                data: {
                    pagination: {
                        perpage: 50,
                    },
                },
            },
            columns: [
                { data: 'id', title: 'ID' },
                { data: 'name', title: 'Name' },
                { data: 'email', title: 'Email' },
                { data: 'phone', title: 'Phone' },
                { data: 'gendar', title: 'Gender' },
                { data: 'status', title: 'Status' },
                { data: 'actions', title: 'Actions', orderable: false, searchable: false },
            ],
            columnDefs: [
                {
                    targets: -2,
                    render: function (data, type, full, meta) {
                        var status = {
                            disaple: { 'title': 'disaple', 'state': 'danger' },
                            active: { 'title': 'active', 'state': 'success' },
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
                            '<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
                    },
                },
            ],
        });
    };

    return {

        //main function to initiate the module
        init: function () {
            initTable1();
        },

    };

}();

jQuery(document).ready(function () {
    KTDatatablesDataSourceAjaxClient.init();
});
