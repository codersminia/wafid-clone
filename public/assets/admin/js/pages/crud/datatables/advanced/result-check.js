"use strict";

var KTCheckResultsTable = function () {

    var init = function () {
        $('#kt_check_results').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/check-results/data",
                type: "GET"
            },
            order: [[0, "desc"]], 
            responsive: true,
            ordering: true,
            searching: true,

            columns: [
                { data: 0 }, // id
                { data: 1 }, // passport_no
                { data: 2 }, // nationality
                { data: 3 }, // phone
                { data: 4 }, // created_at
                { data: 5 }  // actions
            ],

            columnDefs: [
                {
                    targets: 1,
                    render: function (data) {
                        return `<strong>${data}</strong>`;
                    }
                },
                {
                    targets: 2,
                    render: function (data) {
                        return data ? `<span class="badge badge-light-primary">${data}</span>` : '-';
                    }
                },
                {
                    targets: 3,
                    render: function (data) {
                        var clean = data ? data.replace(/\D/g, '') : '';
                        var waUrl = 'https://wa.me/' + clean;
                        return `<a href="tel:${data}" class="text-primary mr-2">${data}</a>` +
                               `<a href="${waUrl}" target="_blank" class="btn btn-sm btn-success btn-icon" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>`;
                    }
                },
                {
                    targets: 5,
                    orderable: false,
                    searchable: false
                }
            ],

            rowCallback: function (row, data) {
                $(row).off('click').on('click', function () {

                    // If row is blue (new), mark as read
                    if ($(this).hasClass('new-record')) {
                        let id = data[0]; // ID is first column
                        $.post("/admin/check-results/read/" + id, {}, function(response) {
                            if(response.success){
                                $(row).removeClass('new-record'); // remove blue
                            }
                        });
                    }
                });
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
    KTCheckResultsTable.init();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // DELETE RECORD
    $(document).on("click", ".delete-result", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "This record will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then(function (result) {
            if (result.isConfirmed) {

                $.ajax({
                    url: "/admin/check-results/" + id,
                    type: "DELETE",
                    success: function (response) {

                        Swal.fire("Deleted!", response.message, "success");

                        $('#kt_check_results').DataTable().ajax.reload(null, false);
                    },
                    error: function (xhr) {
                        Swal.fire("Error!", "Unable to delete.", "error");
                        console.log(xhr.responseText);
                    }
                });

            }
        });
    });

});