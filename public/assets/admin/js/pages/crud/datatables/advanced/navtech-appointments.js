"use strict";

var NavtechTable = function () {
    var init = function () {
        var table = $('#navtech_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: { url: "/admin/navttc-appointments/data", type: "GET" },
            order: [[0, 'desc']],
            responsive: true,
            columns: [
                { data: 0 }, // ID
                { data: 1 }, // Occupation
                { data: 2 }, // WhatsApp
                { data: 3 }, // Country (Shifted up)
                { data: 4 }, // Status (Shifted up)
                { data: 5 }, // Date (Shifted up)
                { data: 6 }, // Actions (Shifted up)
                { data: 7, visible: false }, // Hidden ID
                { data: 8, visible: false }  // Hidden New Check
            ],
            columnDefs: [
                {
                    targets: 2, // WhatsApp Link
                    render: function (data) {
                        let cleanNumber = data.replace(/\D/g, '');
                        if (cleanNumber.startsWith('0')) cleanNumber = '92' + cleanNumber.substring(1);
                        return `<a href="https://wa.me/${cleanNumber}" target="_blank" class="text-success"><i class="fab fa-whatsapp mr-1"></i> ${data}</a>`;
                    }
                },
                {
                    targets: 4, // Payment Status (Changed from 5 to 4)
                    render: function (data) {
                        var status = {
                            0: { 'title': 'Pending', 'class': 'label-light-warning' },
                            1: { 'title': 'Paid', 'class': 'label-light-success' }
                        };
                        return '<span class="label label-lg font-weight-bold ' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    }
                },
                {
                    targets: 6, // Actions (Changed from 7 to 6)
                    render: function (data, type, full) {
                        var id = full[7]; // ID is now at index 7
                        return `
                            <a href="/admin/navttc-appointments/${id}/edit" class="btn btn-sm btn-clean btn-icon"><i class="la la-edit"></i></a>
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-navtech" data-id="${id}"><i class="la la-trash"></i></a>
                        `;
                    }
                }
            ],
            createdRow: function(row, data) {
                // is_new is now at index 8
                if (data[8] == 1) $(row).addClass('new-record');
            }
        });
    };
    return { init: function () { init(); } };
}();

$(document).ready(function () {
    NavtechTable.init();
    $(document).on("click", ".delete-navtech", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "This appointment will be deleted!",
            icon: "warning",
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/navttc-appointments/${id}`,
                    type: "DELETE",
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        Swal.fire("Deleted!", "Appointment has been deleted.", "success");
                        $('#navtech_datatable').DataTable().ajax.reload();
                    }
                });
            }
        });
    });
});