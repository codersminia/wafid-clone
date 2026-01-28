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
            order: [[0, 'desc']], 
            responsive: true,
            ordering: true,
            searching: true,
            columns: [
                { data: 0 }, // ID
                { data: 1 }, // Name
                { data: 2 }, // Passport No
                { data: 3 }, // Mobile
                { data: 4 }, // Traveling Country
                { data: 5 }, // Payment Status
                { data: 9 }, // Date
                { data: 6 }, // Actions
                { data: 7, visible: false },  // hidden id
                { data: 8, visible: false }   // is_new
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
                    targets: 4, // traveling country
                    render: function (data) {
                        if (!data) return '';
                        return data
                            .split('-')
                            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                            .join(' ');
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
                    targets: 6, // The Date Column
                    orderable: true // Explicitly enable sorting (default is true, but good to be sure)
                },
                {
                    targets: 7,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full) {
                        return `                            
                            <a href="/admin/appointments/${full[7]}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">
                                <i class="la la-edit"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-appointment" data-id="${full[7]}" title="Delete">
                                <i class="la la-trash"></i>
                            </a>
                        `;
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                // Highlight new records
                if (data[8] == 1) { // 8th index = is_new column
                    $(row).addClass('new-record'); // add a CSS class
                }
            }
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

    $(document).on("click", ".delete-appointment", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "This appointment and its payment will be deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: `/admin/appointments/${id}`,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        Swal.fire(
                            "Deleted!",
                            "Appointment has been deleted.",
                            "success"
                        );

                        $('#kt_datatable').DataTable().ajax.reload();
                    },
                    error: function () {
                        Swal.fire("Error", "Failed to delete appointment", "error");
                    }
                });
            }
        });
    });

});