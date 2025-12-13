"use strict";

var KTDatatablesAdvancedColumnRendering = function () {

    var init = function () {
        var table = $('#kt_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/special-appointments/data", // Ensure this route is correct in web.php
                type: "GET"
            },
            order: [[0, 'desc']], 
            responsive: true,
            // Define all columns explicitly including hidden ones
            columns: [
                { data: 0 }, // ID
                { data: 1 }, // Name
                { data: 2 }, // Passport
                { data: 3 }, // Phone
                { data: 4 }, // City
                { data: 5 }, // Medical Center
                { data: 6 }, // Country
                { data: 7 }, // Payment Status
                { data: 8 }, // Date
                { data: 9, orderable: false, searchable: false }, // Actions
                { data: 10, visible: false }, // Hidden ID
                { data: 11, visible: false }  // Hidden is_new
            ],
            columnDefs: [
                {
                    targets: 1, // Name
                    render: function (data) {
                        return `<strong>${data}</strong>`;
                    }
                },
                {
                    targets: 3, // Phone
                    render: function (data) {
                        return `<a href="tel:${data}" class="text-primary">${data}</a>`;
                    }
                },
                {
                    targets: 6, // Country
                    render: function (data) {
                        if (!data) return '';
                        // Capitalize logic
                        return data.split('-').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
                    }
                },
                {
                    targets: 7, // Payment Status (Was incorrectly set to 5)
                    render: function (data) {
                        // data is 0 or 1
                        var status = {
                            0: { 'title': 'Pending', 'class': 'label-light-warning' },
                            1: { 'title': 'Paid', 'class': 'label-light-success' }
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    }
                },
                {
                    targets: 9, // Actions (Was incorrectly set to 7)
                    render: function (data, type, full, meta) {
                        // full[10] is the hidden ID we added in controller
                        var id = full[10]; 
                        return `
                            <a href="/admin/special-appointments/${id}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">
                                <i class="la la-edit"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-appointment" data-id="${id}" title="Delete">
                                <i class="la la-trash"></i>
                            </a>
                        `;
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                // Check hidden column index 11 for 'is_new'
                if (data[11] == 1) { 
                    $(row).addClass('new-record');
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
                    url: `/admin/special-appointments/${id}`,
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