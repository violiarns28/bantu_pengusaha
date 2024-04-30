//------------------------------ Validasi Modal Add Schedule ---------------------------------------------
// Define form element
const form = document.getElementById('kt_modal_add_schedule');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'nomor[]': {
                validators: {
                    notEmpty: {
                        message: 'List User is required'
                    }
                }
            },
            'tipe_schedule': {
                validators: {
                    notEmpty: {
                        message: 'Tipe schedule is required'
                    }
                }
            },
            'tanggal': {
                validators: {
                    notEmpty: {
                        message: 'Tanggal Schedule is required'
                    }
                }
            },
            'schedule_clock_in': {
                validators: {
                    notEmpty: {
                        message: 'Clock In is required'
                    }
                }
            },
            'schedule_clock_out': {
                validators: {
                    notEmpty: {
                        message: 'Clock Out is required'
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


//------------------------------ End Validasi Modal Add Schedule ---------------------------------------------

//------------------------------ Add Schedule ---------------------------------------------
// Insert button handler
$('#buttonInsertSchedule').click(function(e) {
    e.preventDefault();
    // Prevent default button action

// Validate form before submit
if (validator) {
    validator.validate().then(function (status) {
        console.log('validated!');

        if (status == 'Valid') {
    const t = document.getElementById("kt_modal_add_schedule");
    const i = t.querySelector('[data-kt-schedule-modal-action="submit"]');
    const url = uri + "/insertschedule";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_schedule_form")),
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
                    $("#kt_modal_add_schedule").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_schedule_form").reset();
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

//------------------------------ End Add Schedule ---------------------------------------------



//------------------------------ Update User ---------------------------------------------
// Update button handler
$('#buttonUpdateSchedule').click(function(e) {
    e.preventDefault();
    // Prevent default button action

    const t = document.getElementById("kt_modal_update_schedule");
    const i = t.querySelector('[data-kt-scheduleedt-modal-action="submit"]');
    const url = uri + "/updateschedule";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_edit_schedule_form")),
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
                    $("#kt_modal_update_schedule").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_edit_schedule_form").reset();
                    }
                }
                ))
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
});
//------------------------------ End Update User ---------------------------------------------

//------------------------------ Delete User ---------------------------------------------
// Delete button handler
function deleteSchedule(id){ 
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
                const url = uri + "/deleteschedule/"+id;
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
//------------------------------ End Delete User ---------------------------------------------

//------------------------------ Delete Batch User ---------------------------------------------
// Delete button handler
function deleteBatchSchedule(id){ 
    Swal.fire({
        text: "Are you sure you want to delete schedule batch?",
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
                const url = uri + "/deletebatchschedule/"+id;
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
//------------------------------ End Delete User ---------------------------------------------