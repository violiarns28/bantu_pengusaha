//------------------------------ Validasi Modal Add Pengajuan ---------------------------------------------
// Define form element
const form = document.getElementById('kt_modal_add_pengajuan');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'jenis_pengajuan': {
                validators: {
                    notEmpty: {
                        message: 'Jenis Pengajuan is required'
                    }
                }
            },
            'tanggal': {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Pengajuan is required'
                    }
                }
            },
            'tanggal2': {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Pengajuan is required'
                    }
                }
            }
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    }
);


//------------------------------ End Validasi Modal Add Pengajuan ---------------------------------------------

//------------------------------ Add Pengajuan ---------------------------------------------
// Insert button handler
$('#buttonInsertPengajuan').click(function(e) {
    e.preventDefault();
    // Prevent default button action

// Validate form before submit
if (validator) {
    validator.validate().then(function (status) {
        console.log('validated!');

        if (status == 'Valid') {
    const t = document.getElementById("kt_modal_add_pengajuan");
    const i = t.querySelector('[data-kt-pengajuan-modal-action="submit"]');
    const url = uri + "/insertpengajuan";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_pengajuan_form")),
    }).then(
        response => response.text()// .json(), etc.
    ).then(
        (result) => {
            console.log(result)
            const obj = JSON.parse(result); //success, message, code, icon
                Swal.fire({
                    text: obj.message,
                    icon: obj.icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-custom-purple"
                    }
                }).then((function(t) {
                    if(obj.success == true){
                    t.isConfirmed
                    $("#kt_modal_add_pengajuan").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_pengajuan_form").reset();
                    }
                }
                ))
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
}

});
}
});

//------------------------------ End Add Pengajuan ---------------------------------------------



//------------------------------ Update Pengajuan ---------------------------------------------
// Update button handler
$('#buttonUpdatePengajuan').click(function(e) {
    e.preventDefault();
    // Prevent default button action

    const t = document.getElementById("kt_modal_update_pengajuan");
    const i = t.querySelector('[data-kt-pengajuanedt-modal-action="submit"]');
    const url = uri + "/updatepengajuan";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_edit_pengajuan_form")),
    }).then(
        response => response.text()// .json(), etc.
    ).then(
        (result) => {
            console.log(result)
            const obj = JSON.parse(result); //success, message, code, icon
                Swal.fire({
                    text: obj.message,
                    icon: obj.icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-custom-purple"
                    }
                }).then((function(t) {
                    if(obj.success == true){
                    t.isConfirmed
                    $("#kt_modal_update_pengajuan").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_edit_pengajuan_form").reset();
                    }
                }
                ))
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
});
//------------------------------ End Update Pengajuan ---------------------------------------------

//------------------------------ Delete Pengajuan ---------------------------------------------
// Delete button handler
function deletePengajuan(id){ 
    Swal.fire({
        text: "Are you sure you want to delete ?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only
            Swal.fire({
                text: "Deleting ",
                icon: "info",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                const url = uri + "/deletepengajuan/"+id;
                fetch(url, {
                    method : "GET",
                }).then(
                    response => response.text()// .json(), etc.
                ).then(
                    (result) => {

                        console.log(result)
                        const obj = JSON.parse(result); //success, message, code, icon

                        Swal.fire({
                            text: obj.message,
                            icon: obj.icon,
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-custom-purple",
                            }
                        }).then(function () {
                            if(obj.success == true){
                            // delete row data from server and re-draw datatable
                            $('#kt_datatable_example_1').DataTable().ajax.reload();
                            }
                        });
                    }
                ).catch((error) => {
                console.error('Error:', error);
                });
               
            });
        } else if (result.dismiss === 'cancel') {
            Swal.fire({
                text: "Data was not deleted.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-custom-purple",
                }
            });
        }
    });
}
//------------------------------ End Delete Pengajuan ---------------------------------------------
