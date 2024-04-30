//------------------------------ Validasi Modal Add Menu ---------------------------------------------
// Define form element
const form = document.getElementById('kt_modal_add_site');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'kode': {
                validators: {
                    notEmpty: {
                        message: 'Kode Site is required'
                    }
                }
            },
            'nama': {
                validators: {
                    notEmpty: {
                        message: 'Nama Site is required'
                    }
                }
            },
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

//------------------------------ End Validasi Modal Add User ---------------------------------------------

//------------------------------ Add User ---------------------------------------------
// Insert button handler
$('#buttonInsertSite').click(function(e) {
    e.preventDefault();
    // Prevent default button action

// Validate form before submit
if (validator) {
    validator.validate().then(function (status) {
        console.log('validated!');
    if (status == 'Valid') {

    const t = document.getElementById("kt_modal_add_site");
    const i = t.querySelector('[data-kt-site-modal-action="submit"]');
    const url = uri + "/insertsite";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_site_form")),
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
                        confirmButton: "btn btn-primary"
                    }
                }).then((function(t) {
                    if(obj.success == true){
                    t.isConfirmed
                    $("#kt_modal_add_site").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_site_form").reset();
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

//------------------------------ End Add User ---------------------------------------------


//------------------------------ Validasi Modal Add Menu ---------------------------------------------
// Define form element
const formUpdate = document.getElementById('kt_modal_update_menu');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validatorUpdate = FormValidation.formValidation(
    formUpdate,
    {
        fields: {
            'editNama': {
                validators: {
                    notEmpty: {
                        message: 'Nama is required'
                    }
                }
            },
            'editRoute': {
                validators: {
                    notEmpty: {
                        message: 'Route is required'
                    }
                }
            },
            'editIcon': {
                validators: {
                    notEmpty: {
                        message: 'Icon is required'
                    }
                }
            },
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

//------------------------------ End Validasi Modal Add User ---------------------------------------------
//------------------------------ Update User ---------------------------------------------
// Update button handler
$('#buttonUpdateMenu').click(function(e) {
    e.preventDefault();
    // Prevent default button action
// Validate form before submit
if (validatorUpdate) {
    validatorUpdate.validate().then(function (status) {
        console.log('validated!');

    if (status == 'Valid') {
    const t = document.getElementById("kt_modal_update_menu");
    const i = t.querySelector('[data-kt-menuedt-modal-action="submit"]');
    const url = uri + "/updatemenu";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_edit_menu_form")),
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
                        confirmButton: "btn btn-primary"
                    }
                }).then((function(t) {
                    if(obj.success == true){
                    t.isConfirmed
                    $("#kt_modal_update_menu").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_edit_menu_form").reset();
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
//------------------------------ End Update User ---------------------------------------------

//------------------------------ Delete User ---------------------------------------------
// Delete button handler
function deleteMenu(id){ 
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
                const url = uri + "/deletemenu/"+id;
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
                                confirmButton: "btn fw-bold btn-primary",
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
                    confirmButton: "btn fw-bold btn-primary",
                }
            });
        }
    });
}
//------------------------------ End Delete User ---------------------------------------------