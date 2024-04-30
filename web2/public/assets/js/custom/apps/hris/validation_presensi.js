//------------------------------ Validasi Modal Add Presensi ---------------------------------------------
// Define form element
const form = document.getElementById('kt_modal_add_presensi');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'lokasi_presensi': {
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
            // 'clock_in': {
            //     validators: {
            //         notEmpty: {
            //             message: 'Clock In is required'
            //         }
            //     }
            // },
            // 'clock_out': {
            //     validators: {
            //         notEmpty: {
            //             message: 'Clock Out is required'
            //         }
            //     }
            // },
            'latitude': {
                validators: {
                    notEmpty: {
                        message: 'Latitude is required'
                    }
                }
            },
            'longitude': {
                validators: {
                    notEmpty: {
                        message: 'Longitude is required'
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


//------------------------------ End Validasi Modal Add Presensi ---------------------------------------------

//------------------------------ Add Presensi ---------------------------------------------
// Insert button handler
$('#buttonInsertPresensi').click(function(e) {
    e.preventDefault();
    // Prevent default button action

// Validate form before submit
if (validator) {
    validator.validate().then(function (status) {
        console.log('validated!');
        if (status == 'Valid') {
    const t = document.getElementById("kt_modal_add_presensi");
    const i = t.querySelector('[data-kt-presensi-modal-action="submit"]');
    const url = uri + "/insertpresensi";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_presensi_form")),
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
                    $("#kt_modal_add_presensi").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_presensi_form").reset();
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

//------------------------------ End Add Presensi --------------------------------------------- 

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