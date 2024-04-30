//------------------------------ Validasi Modal Add Pengajuan ---------------------------------------------
// Define form element
const form = document.getElementById('kt_modal_add_lembur');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'jenis_lembur': {
                validators: {
                    notEmpty: {
                        message: 'Jenis Lembur is required'
                    }
                }
            },
            'tanggal': {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Lembur is required'
                    }
                }
            },
            'dari_jam': {
                validators: {
                    notEmpty: {
                        message: 'Jam Lembur is required'
                    }
                }
            },
            'sampai_jam': {
                validators: {
                    notEmpty: {
                        message: 'Jam Lembur is required'
                    }
                }
            },
            'keterangan': {
                validators: {
                    notEmpty: {
                        message: 'Detail Pekerjaan Lembur is required'
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


//------------------------------ End Validasi Modal Add Lembur ---------------------------------------------

//------------------------------ Add Lembur ---------------------------------------------
// Insert button handler
$('#buttonInsertLembur').click(function(e) {
    e.preventDefault();
    // Prevent default button action

// Validate form before submit
if (validator) {
    validator.validate().then(function (status) {
        console.log('validated!');

        if (status == 'Valid') {
    const t = document.getElementById("kt_modal_add_lembur");
    const i = t.querySelector('[data-kt-lembur-modal-action="submit"]');
    const url = uri + "/insertlembur";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_lembur_form")),
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
                    $("#kt_modal_add_lembur").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_lembur_form").reset();
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

//------------------------------ End Add Lembur ---------------------------------------------



//------------------------------ Update Lembur ---------------------------------------------
// Update button handler
$('#buttonUpdateLembur').click(function(e) {
    e.preventDefault();
    // Prevent default button action
    
    const t = document.getElementById("kt_modal_update_lembur");
    const i = t.querySelector('[data-kt-lemburedt-modal-action="submit"]');
    const url = uri + "/updatelembur";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_edit_lembur_form")),
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
                    $("#kt_modal_update_lembur").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_edit_lembur_form").reset();
                    }
                }
                ))
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
});
//------------------------------ End Update Lembur ---------------------------------------------

//------------------------------ Delete Lembur ---------------------------------------------
// Delete button handler
function deleteLembur(id){ 
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
                const url = uri + "/deletelembur/"+id;
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
//------------------------------ End Delete Lembur ---------------------------------------------
