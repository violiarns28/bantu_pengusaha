"use strict";

// Phone
// Inputmask({
//     "mask" : "(999) 999-999999"
// }).mask("#nomorpic");


var KTUsersAddUser = function() {
    const t = document.getElementById("kt_modal_add_user")
      , e = t.querySelector("#kt_modal_add_user_form")
      , n = new bootstrap.Modal(t);
    return {
        init: function() {
            (()=>{
                var o = FormValidation.formValidation(e, {
                    fields: {
                        namax: {
                            validators: {
                                notEmpty: {
                                    message: "Nama pic is required"
                                }
                            }
                        },
                        usernamex: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        alamatpicx: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        idcompanyx: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        idposx: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        emailuserx: {
                            validators: {
                                notEmpty: {
                                    message: "Valid email address is required"
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
                                },
                            }
                        },
                        newpasswordx: {
                            validators: {
                                notEmpty: {
                                    message: "Valid email address is required"
                                },
                                stringLength: {
                                    min: 6,
                                    message: 'Password must be more than 6 characters'
                                }
                            }
                        },
                        repassword: {
                            validators: {
                                notEmpty: {
                                    message: 'The password confirmation is required'
                                },
                                identical: {
                                    compare: function () {
                                        return e.querySelector('[name="newpassword"]').value;
                                    },
                                    message: 'The password and its confirm are not the same'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });
                const i = t.querySelector('[data-kt-users-modal-action="submit"]');
                i.addEventListener("click", (t=>{
                    t.preventDefault(),
                    o && o.validate().then((function(t) {
                        console.log("validated!"),
                        "Valid" == t ? (i.setAttribute("data-kt-indicator", "on"),
                        i.disabled = !0,
                        setTimeout((function() {
                            
                            insert()
                           
                        }
                        ), 2e3)) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
                    ))
                }
                )),
                t.querySelector('[data-kt-users-modal-action="cancel"]').addEventListener("click", (t=>{
                    t.preventDefault(),
                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then((function(t) {
                        t.value ? (e.reset()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
                    ))
                }
                )),
                t.querySelector('[data-kt-users-modal-action="close"]').addEventListener("click", (t=>{
                    t.preventDefault(),
                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then((function(t) {
                         t.value ? (n.hide(),e.reset()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
                    ))
                }
                ))
            }
            )()
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTUsersAddUser.init()
}
));

$('#desc').maxlength({
    threshold: 255,
    warningClass: "badge badge-primary",
    limitReachedClass: "badge badge-success"
});


function selectElement(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
}

function edit(id) {
    var currentLocation = window.location;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: uri + "/getonePIC" ,
        data: { id: id },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            $('#idy').val(res['idpic']);
            $('#namay').val(res['namapic']);
            $('#usernamey').val(res['username']);
            $('#idposy').val(res['idpos']).change();
            selectElement('idposy',res['idpos']);
            $('#idcompanyy').val(res['idperusahaan']).change();
            selectElement('idcompanyy',res['idperusahaan']);
            $('#nomorpicy').val(res['nomorpic']);
            $('#emailusery').val(res['emailpic']);
            $('#alamatpicy').val(res['alamatpic']);
            res['isaktif'] == '1' ?  $('#isaktif').prop( "checked", true ) :  $('#isaktif').prop( "checked", false ) ;
            res['emergency'] == '1'?  $('#emergency').prop( "checked", true ) : $('#emergency').prop( "checked", false );
            $('#kt_modal_update_user').modal('show');
        }
    });
}

function insert(){
    const t = document.getElementById("kt_modal_add_user");
    const i = t.querySelector('[data-kt-users-modal-action="submit"]');
    const url = uri + "/insertPIC";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_user_form")),
    }).then(
        response => response.json()// .json(), etc.
    ).then(
        (result) => {
            if(result == 'true' || result == true){
                Swal.fire({
                    text: "Form has been successfully submitted!",
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then((function(t) {
                    t.isConfirmed
                    i.removeAttribute("data-kt-indicator"),
                    i.disabled = !1;
                    $("#kt_modal_add_user").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_user_form").reset();
                }
                ))
            }else{
                Swal.fire({
                    text: result.message,
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }),
                i.removeAttribute("data-kt-indicator"),
                i.disabled = !1
            }
        }
    ).catch((error) => {
        console.error('Error:', error);
    });
};


var KTUsersEditUser = function() {
    const t = document.getElementById("kt_modal_update_user")
      , e = t.querySelector("#kt_modal_edit_user_form")
      , n = new bootstrap.Modal(t);
    return {
        init: function() {
            (()=>{
                var o = FormValidation.formValidation(e, {
                    fields: {
                        namay: {
                            validators: {
                                notEmpty: {
                                    message: "Nama pic is required"
                                }
                            }
                        },
                        usernamey: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        alamatpicy: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        idcompanyy: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        idposy: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        emailusery: {
                            validators: {
                                notEmpty: {
                                    message: "Valid email address is required"
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
                                },
                            }
                        },
                        newpasswordy: {
                            validators: {
                                stringLength: {
                                    min: 6,
                                    message: 'Password must be more than 6 characters'
                                }
                            }
                        },
                        repasswordy: {
                            validators: {
                                identical: {
                                    compare: function () {
                                        return e.querySelector('[name="newpassword"]').value;
                                    },
                                    message: 'The password and its confirm are not the same'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });
                const i = t.querySelector('[data-kt-usersedt-modal-action="submit"]');
                i.addEventListener("click", (t=>{
                    t.preventDefault(),
                    o && o.validate().then((function(t) {
                        console.log("validated!"),
                        "Valid" == t ? (i.setAttribute("data-kt-indicator", "on"),
                        i.disabled = !0,
                        setTimeout((function() {
                            i.removeAttribute("data-kt-indicator"),
                            i.disabled = !1,

                            update()

                        }
                        ), 2e3)) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
                    ))
                }
                )),
                t.querySelector('[data-kt-usersedt-modal-action="cancel"]').addEventListener("click", (t=>{
                    t.preventDefault(),
                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then((function(t) {
                         t.value ? (e.reset()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
                    ))
                }
                )),
                t.querySelector('[data-kt-usersedt-modal-action="close"]').addEventListener("click", (t=>{
                    t.preventDefault(),
                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then((function(t) {
                         t.value ? (e.reset(),n.hide()) : "cancel" === t.dismiss && Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
                    ))
                }
                ))
            }
            )()
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTUsersEditUser.init()
}
));

function update(){
    const t = document.getElementById("kt_modal_update_user");
    const i = t.querySelector('[data-kt-usersedt-modal-action="submit"]');
    const url = uri + "/insertPIC";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_edit_user_form")),
    }).then(
        response => response.text()// .json(), etc.
    ).then(
        (result) => {
            console.log(result)
            if(result == 'false'){
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                })
            }else{
                Swal.fire({
                    text: "Form has been successfully submitted!",
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then((function(t) {
                    t.isConfirmed
                    $("#kt_modal_update_user").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_edit_user_form").reset();
                }
                ))
            }
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
};