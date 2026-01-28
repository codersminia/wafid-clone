"use strict";

var TasheerTable = function () {
    var init = function () {
        var table = $('#tasheer_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: { url: "/admin/tasheer-appointments/data", type: "GET" },
            order: [[0, 'desc']],
            responsive: true,
            columns: [
                { data: 0 }, { data: 1 }, { data: 2 }, { data: 3 }, { data: 4 }, { data: 5 }, { data: 6 }, 
                { data: 7, visible: false }, { data: 8, visible: false } // Shifted hidden indices
            ],
            columnDefs: [
                {
                    targets: 3, // WhatsApp (was 2)
                    render: function (data) {
                        let clean = data.replace(/\D/g, '');
                        if (clean.startsWith('0')) clean = '92' + clean.substring(1);
                        return `<a href="https://wa.me/${clean}" target="_blank" class="text-success"><i class="fab fa-whatsapp mr-1"></i> ${data}</a>`;
                    }
                },
                {
                    targets: 4, // Status (was 3)
                    render: function (data) {
                        var s = { 0: { t: 'Pending', c: 'label-light-warning' }, 1: { t: 'Paid', c: 'label-light-success' } };
                        return `<span class="label label-lg font-weight-bold ${s[data].c} label-inline">${s[data].t}</span>`;
                    }
                },
                {
                    targets: 6, // Actions (was 5)
                    render: function (data, type, full) {
                        var id = full[7]; // Shifted from 6
                        return `<a href="/admin/tasheer-appointments/${id}/edit" class="btn btn-sm btn-clean btn-icon"><i class="la la-edit"></i></a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-tasheer" data-id="${id}"><i class="la la-trash"></i></a>`;
                    }
                }
            ],
            createdRow: function(row, data) { if (data[8] == 1) $(row).addClass('new-record'); } // Shifted from 7
        });
    };
    return { init: function () { init(); } };
}();

$(document).ready(function () {
    TasheerTable.init();
    $(document).on("click", ".delete-tasheer", function () {
        let id = $(this).data("id");
        Swal.fire({ title: "Move to Trash?", text: "This will soft delete the record.", icon: "warning", showCancelButton: true }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/tasheer-appointments/${id}`,
                    type: "DELETE",
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function () { $('#tasheer_datatable').DataTable().ajax.reload(); }
                });
            }
        });
    });
});