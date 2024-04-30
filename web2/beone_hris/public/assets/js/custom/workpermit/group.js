"use strict";

// Phone
Inputmask({
    "mask" : "(999) 999-999999"
}).mask("#nomorperusahaanx");


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
                                    message: "Nama position is required"
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

$('#desc').maxlength({
    threshold: 255,
    warningClass: "badge badge-primary",
    limitReachedClass: "badge badge-success"
});

function doalert(checkboxElem,id) {
    var elems = document.querySelectorAll("[id^='GroupID[]-menu["+id+"]']"), i;
    if (checkboxElem.checked) {
        for (i = 0; i < elems.length; ++i) {
            elems[i].checked = true;
        }
    } else {
    elems.forEach(function() {
        for (i = 0; i < elems.length; ++i) {
            elems[i].checked = false;
        }
    });
    }
  }

function selectElement(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
}

$('#menu')

function edit(id) {
    var currentLocation = window.location;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: uri + "/getonegroup" ,
        data: { id: id },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            $('#idedit').val(res['group']['idgroup']);
            $('#namay').val(res['group']['namagroup']);

            
            var isAvailableMenu = false;
            var isChecked = false;
            var listmenu = res['menu'];
            var listaccess = res['access'];
            var listmenuaccess  = res['groupaccess'];
            $('#parentrow').empty();
            var appendtable = '';
                    // $('#parentrow').append(
                        appendtable +=
                        '<table class="table table-rounded table-striped border gy-7 gs-7">' +
                            '<thead>' +
                            '<tr style="text-align: center">' +
                                '<th style="width: 15%"></th>' +
                                // '<th style="width: 15%">Menu ID</th>' +
                                '<th style="text-align: left">Menu Name</th>' +
                                '<th>Show</th>' +
                                '<th>Add</th>' +
                                '<th>Update</th>' +
                                '<th>Delete</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                    // );


                    //listmenu,listaccess,listmenuaccess
                    listmenu.forEach(function(menu) {
                        // $('#parentrow').append('' +
                        appendtable += '<tr>' +
                            '<td style="text-align: center">' +
                            '<input class="form-check-input" onchange="doalert(this,'+menu["idmenu"]+')" type="checkbox" name="group_menu_access[]" id="menu['+menu["idmenu"]+']" value="GroupID[]-menu['+menu["idmenu"]+']">' +
                            '</td>' + 
                            // '<td style="text-align: center">'+ menu["idmenu"] + '</td>' +
                            '<td>'+menu["namamenu"]+'</td>';
                        // );
                        isAvailableMenu = false;
                        isChecked = false;

                        listaccess.forEach(function(access) {
                            // listmenuaccess.forEach(function(menuaccess) {
                            for (const menuaccess of listmenuaccess) {
                                if (menuaccess['idmenu'] == menu['idmenu'] && menuaccess['idakses'] == access['idakses']) {
                                    isAvailableMenu = true;
                                    break;
                                } else {
                                    isAvailableMenu = false;
                                }
                                // console.log(menu['MenuName'] + ' - ' + access['AccessName'] + ' : ' + isAvailableMenu);
                            }
                            // });

                            // res.forEach(function(groupaccess) {
                            for (const groupaccess of listmenuaccess) {
                                if (groupaccess['idmenu'] == menu['idmenu'] && groupaccess['idakses'] == access['idakses']) {
                                    isChecked = true;
                                    break;
                                }
                                else {
                                    isChecked = false;
                                }
                                // console.log(groupaccess['GroupID'] + ' - ' + groupaccess['MenuID'] + ' : ' + isChecked);
                            }
                            // });

                            if ( isAvailableMenu == true && isChecked == true ) {
                                // $('#parentrow').append(
                                appendtable +=
                                    '<td style="text-align: center">' +
                                    '<input class="form-check-input" type="checkbox" name="group_menu_access[]" id="GroupID[]-menu['+menu["idmenu"]+']-access['+access["idakses"]+']" value="GroupID[]-menu['+menu["idmenu"]+']-access['+access["idakses"]+']" checked>' +
                                    '</td>';
                                // );
                            }
                            else  {
                                // $('#parentrow').append(
                                appendtable +=
                                    '<td style="text-align: center">' +
                                    '<input class="form-check-input" type="checkbox" name="group_menu_access[]"  id="GroupID[]-menu['+menu["idmenu"]+']-access['+access["idakses"]+']" value="GroupID[]-menu['+menu["idmenu"]+']-access['+access["idakses"]+']">' +
                                    '</td>';
                                // );
                            }
                        });
                        // $('#parentrow').append(
                            appendtable +=
                                '</tr>';
                        // );

                    });

                    $('#parentrow').append(appendtable +
                            '</tbody>' +
                        '</table>'
                    ); //end of append

            $('#kt_modal_update_user').modal('show');
        }
    });
}

function insert(){
    const t = document.getElementById("kt_modal_add_user");
    const i = t.querySelector('[data-kt-users-modal-action="submit"]');
    const url = uri + "/insertgroup";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_modal_add_user_form")),
    }).then(
        response => response.text()// .json(), etc.
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
                    text: "Sorry, looks like there are some errors detected, please try again.",
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
                                    message: "Nama position is required"
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
    const url = uri + "/insertgroup";
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