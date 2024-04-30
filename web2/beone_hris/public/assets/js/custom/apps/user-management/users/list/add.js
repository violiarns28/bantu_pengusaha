"use strict";
var KTUsersAddUser = function() {
    const t = document.getElementById("kt_modal_add_user")
      , e = t.querySelector("#kt_modal_add_user_form")
      , n = new bootstrap.Modal(t);
    return {
        init: function() {
            (()=>{
                var o = FormValidation.formValidation(e, {
                    fields: {
                        fullname: {
                            validators: {
                                notEmpty: {
                                    message: "Full name is required"
                                }
                            }
                        },
                        username: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        newpassword: {
                            validators: {
                                notEmpty: {
                                    message: "Password is required"
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
                        }
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
                            i.removeAttribute("data-kt-indicator"),
                            i.disabled = !1,
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
                        t.value ? (e.reset(),
                        n.hide()) : "cancel" === t.dismiss && Swal.fire({
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
                        t.value ? (e.reset(),
                        n.hide()) : "cancel" === t.dismiss && Swal.fire({
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

function insert(){
    const t = document.getElementById("kt_modal_add_user");
    const i = t.querySelector('[data-kt-users-modal-action="submit"]');
    const url = uri + "/insertuser";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_user_form")),
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
                    $("#kt_modal_add_user").modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                    document.getElementById("kt_modal_add_user_form").reset();
                }
                ))
            }
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
};

function selectElement(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
}

function edituser(iduser) {
    var currentLocation = window.location;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: uri + "/getoneuser" ,
        data: { iduser: iduser },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            $('#iduseredit').val(res['iduser']);
            $('#fullnameedit').val(res['fullnameuser']);
            $('#usernameedit').val(res['nameuser']);
            $('#nomoredit').val(res['nouser']);
            $('#emailuseredit').val(res['emailuser']);
            $("#idsectionedit").val(res['idsection']).change();
            selectElement('idsectionedit',res['idsection']);
            $("#idgroupedit").val(res['idgroup']).change();
            selectElement('idgroupedit',res['idgroup']);
            $('#edtavatar').css('background-image', "url('"+ res['avatar'] +"')");
            
            $('#kt_modal_update_user').modal('show');
        }
    });
}

var KTUsersEditUser = function() {
    const t = document.getElementById("kt_modal_update_user")
      , e = t.querySelector("#kt_modal_edit_user_form")
      , n = new bootstrap.Modal(t);
      var iduser;
    return {
        init: function() {
            (()=>{
                var o = FormValidation.formValidation(e, {
                    fields: {
                        fullname: {
                            validators: {
                                notEmpty: {
                                    message: "Full name is required"
                                }
                            }
                        },
                        username: {
                            validators: {
                                notEmpty: {
                                    message: "Username is required"
                                }
                            }
                        },
                        emailuser: {
                            validators: {
                                notEmpty: {
                                    message: "Valid email address is required"
                                },
                                emailAddress: {
                                    message: 'The value is not a valid email address'
                                },
                            }
                        },
                        newpassword: {
                            validators: {
                                stringLength: {
                                    min: 6,
                                    message: 'Password must be more than 6 characters'
                                }
                            }
                        },
                        repassword: {
                            validators: {
                                identical: {
                                    compare: function () {
                                        return e.querySelector('[name="newpassword"]').value;
                                    },
                                    message: 'The password and its confirm are not the same'
                                }
                            }
                        },
                        avatar: {
                            validators: {
                                file: {
                                    extension: 'jpg,jpeg,png',
                                    type: 'image/jpeg,image/png',
                                    message: 'The selected file is not valid'
                                },
                            }
                        }
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
                        t.value ? (
                        iduser = document.getElementById("iduseredit").value,
                        e.reset(),
                        edituser(iduser)
                        ) : "cancel" === t.dismiss && Swal.fire({
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
                        t.value ? (e.reset(),
                        n.hide()) : "cancel" === t.dismiss && Swal.fire({
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
    const url = uri + "/insertuser";
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