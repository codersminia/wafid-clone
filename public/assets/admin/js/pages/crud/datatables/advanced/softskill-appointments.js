"use strict";

var SoftSkillTable = function () {
    var init = function () {
        var table = $('#softskill_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: { url: "/admin/softskill-appointments/data", type: "GET" },
            order: [[0, 'desc']],
            columns: [
                { data: 0 }, { data: 1 }, { data: 2 }, { data: 3 }, { data: 4 }, 
                { data: 5, visible: false }, { data: 6, visible: false }
            ],
            columnDefs: [
                {
                    targets: 1, // WhatsApp
                    render: function (data) {
                        let clean = data.replace(/\D/g, '');
                        if (clean.startsWith('0')) clean = '92' + clean.substring(1);
                        return `<a href="https://wa.me/${clean}" target="_blank" class="text-success"><i class="fab fa-whatsapp mr-1"></i> ${data}</a>`;
                    }
                },
                {
                    targets: 2, // Status
                    render: function (data) {
                        var s = { 0: { t: 'Pending', c: 'label-light-warning' }, 1: { t: 'Paid', c: 'label-light-success' } };
                        return `<span class="label label-lg font-weight-bold ${s[data].c} label-inline">${s[data].t}</span>`;
                    }
                },
                {
                    targets: 4, // Actions
                    render: function (data, type, full) {
                        var id = full[5];
                        return `<a href="/admin/softskill-appointments/${id}/edit" class="btn btn-sm btn-clean btn-icon"><i class="la la-edit"></i></a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon delete-btn" data-id="${id}"><i class="la la-trash"></i></a>`;
                    }
                }
            ],
            createdRow: function(row, data) { if (data[6] == 1) $(row).addClass('new-record'); }
        });
    };
    return { init: function () { init(); } };
}();

$(document).ready(function () {
    SoftSkillTable.init();
    $(document).on("click", ".delete-btn", function () {
        let id = $(this).data("id");
        Swal.fire({ title: "Delete Record?", text: "This will remove the registration.", icon: "warning", showCancelButton: true }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/softskill-appointments/${id}`,
                    type: "DELETE",
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function () { $('#softskill_datatable').DataTable().ajax.reload(); }
                });
            }
        });
    });
});