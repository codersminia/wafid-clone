"use strict";

var KTDatatablesAdvancedColumnRendering = function () {

    var init = function () {
        $('#kt_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/appointments/data",
                type: "GET"
            },
            responsive: true,
            ordering: true,
            searching: true,
            columns: [
                { data: 0 }, // appointment_no
                { data: 1 }, // name
                { data: 2 }, // passport_no
                { data: 3 }, // phone
                { data: 4 }, // traveling country
                { data: 5 }, // payment status (0/1)
                { data: 6 },  // actions
                { data: 7, visible: false }  // hidden id
            ],
            columnDefs: [
                {
                    targets: 1,
                    render: function (data) {
                        return `<strong>${data}</strong>`;
                    }
                },
                {
                    targets: 3,
                    render: function (data) {
                        return `<a href="tel:${data}" class="text-primary">${data}</a>`;
                    }
                },
                {
                    targets: 5,
                    render: function (data) {
                        let map = {
                            0: { title: "Pending", class: "label-light-warning" },
                            1: { title: "Paid", class: "label-light-success" }
                        };
                        return `
                            <span class="label label-lg font-weight-bold ${map[data].class} label-inline">
                                ${map[data].title}
                            </span>`;
                    }
                },
                {
                    targets: 6,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full) {
                        return `
                            <a href="/admin/appointments/${full[7]}" class="btn btn-sm btn-clean btn-icon" title="View">
                                <i class="la la-eye"></i>
                            </a>
                            <a href="/admin/appointments/${full[7]}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">
                                <i class="la la-edit"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-appointment" data-id="${full[7]}" title="Delete">
                                <i class="la la-trash"></i>
                            </a>
                        `;
                    }
                }
            ]
        });
    };

    return {
        init: function () {
            init();
        }
    };
}();

jQuery(document).ready(function () {
    KTDatatablesAdvancedColumnRendering.init();
});