"use strict";

let wp = '';
let jmlhariexist = 0;
let totalhari= -1;


var KTCreateAccount = function() {
    
    var e, t, i, o, a, r, s= [];
    var x = document.getElementById('submitbtn');
    return {
        init: function() {
            (e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e), (t = document.querySelector("#kt_create_account_stepper")) && (i = t.querySelector("#kt_create_account_form"), o = t.querySelector('[data-kt-stepper-action="submit"]'), a = t.querySelector('[data-kt-stepper-action="next"]'), 
            r = new KTStepper(t), r.on("kt.stepper.changed", (function(e) {
            4 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), a.classList.add("d-none")) : 5 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), a.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), a.classList.remove("d-none"))
            })), r.on("kt.stepper.next", (function(e) {
                console.log("stepper.next");
                console.log("stepper.next : " + e.getCurrentStepIndex() );
                var t = s[e.getCurrentStepIndex() - 1];
                if(e.getCurrentStepIndex() == 2){
                    document.getElementById("submitbtn").visibility = 'show';
                    // t.querySelector('[data-kt-stepper-action="previous"]').innerHTML = "Back";
                    t ? t.validate().then((function(t) {
                        console.log("validated!"), "Valid" == t ? (
                            insert(), 
                                e.goNext()) : Swal.fire({  // insert(),insert(),
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                        }).then((function() {
                            KTUtil.scrollTop()
                        }))
                    })) : (e.goNext(), KTUtil.scrollTop())
               }else if(e.getCurrentStepIndex() == 3){
                    x.style.visibility = 'show';
                    t ? t.validate().then((function(t) {
                        
                        if(document.getElementById("tgldw").value == ''){
                            getdw()
                        }else{
                            console.log("validated!"), "Valid" == t ? (
                                insertdw()) : Swal.fire({  // insert(), insertdw(),
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                            }).then((function() {
                                KTUtil.scrollTop()
                            }))
                        }
                        
                    })) : (e.goNext(), KTUtil.scrollTop())
               }
               else{
                    t ? t.validate().then((function(t) {
                        console.log("validated!"), "Valid" == t ? (
                            e.goNext(), 
                            KTUtil.scrollTop()) : Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                        }).then((function() {
                            KTUtil.scrollTop()
                        }))
                    })) : (e.goNext(), KTUtil.scrollTop())
                }
            })), r.on("kt.stepper.previous", (function(e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), s.push(FormValidation.formValidation(i, {
                fields: {
                    account_type: {
                        validators: {
                            notEmpty: {
                                message: "Account type is required"
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
            })), s.push(FormValidation.formValidation(i, {
                fields: {
                    jumlahworker: {
                        validators: {
                            notEmpty: {
                                message: "Jumlah Tim harus diisi"
                            }
                        }
                    },
                    shesubcont: {
                        validators: {
                            notEmpty: {
                                message: "Nama Subcont SHE harus diisi"
                            }
                        }
                    },
                    noshe: {
                        validators: {
                            notEmpty: {
                                message: "Nomor Subcont SHE harus diisi"
                            }
                        }
                    },
                    tggjwbforeman: {
                        validators: {
                            notEmpty: {
                                message: "Team Leader/Forman harus diisi"
                            }
                        }
                    },
                    noforeman: {
                        validators: {
                            notEmpty: {
                                message: "Nomor Team Leader/Forman harus diisi"
                            }
                        }
                    },
                    'idperusahaan': {
                        validators: {
                            notEmpty: {
                                message: 'Nama perusahaan harus diisi'
                            }
                        }
                    },
                    'tanggal': {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal Workpermit harus diisi'
                            }
                        }
                    },
                    'section': {
                        validators: {
                            notEmpty: {
                                message: 'Section owner harus diisi'
                            }
                        }
                    },
                    'owner': {
                        validators: {
                            notEmpty: {
                                message: 'Project owner harus diisi'
                            }
                        }
                    },
                    'areas': {
                        validators: {
                            notEmpty: {
                                message: 'Area harus diisi'
                            },
                            stringLength: {
                                min: 3,
                                message: 'Area Harus ada',
                            },
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
            })), s.push(FormValidation.formValidation(i, {
                fields: {
                    'namapekerjaan': {
                        validators: {
                            notEmpty: {
                                message: 'nama pekerjaan harus diisi'
                            }
                        }
                    },
                    business_name: {
                        validators: {
                            notEmpty: {
                                message: "Busines name is required"
                            }
                        }
                    },
                    business_descriptor: {
                        validators: {
                            notEmpty: {
                                message: "Busines descriptor is required"
                            }
                        }
                    },
                    business_type: {
                        validators: {
                            notEmpty: {
                                message: "Busines type is required"
                            }
                        }
                    },
                    business_email: {
                        validators: {
                            notEmpty: {
                                message: "Busines email is required"
                            },
                            emailAddress: {
                                message: "The value is not a valid email address"
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
            })), s.push(FormValidation.formValidation(i, {
                fields: {
                    card_name: {
                        validators: {
                            notEmpty: {
                                message: "Name on card is required"
                            }
                        }
                    },
                    card_number: {
                        validators: {
                            notEmpty: {
                                message: "Card member is required"
                            },
                            creditCard: {
                                message: "Card number is not valid"
                            }
                        }
                    },
                    card_expiry_month: {
                        validators: {
                            notEmpty: {
                                message: "Month is required"
                            }
                        }
                    },
                    card_expiry_year: {
                        validators: {
                            notEmpty: {
                                message: "Year is required"
                            }
                        }
                    },
                    card_cvv: {
                        validators: {
                            notEmpty: {
                                message: "CVV is required"
                            },
                            digits: {
                                message: "CVV must contain only digits"
                            },
                            stringLength: {
                                min: 3,
                                max: 4,
                                message: "CVV must contain 3 to 4 digits only"
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
            })), o.addEventListener("click", (function(e) {
                s[3].validate().then((function(t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), 
                        setTimeout((function() {
                        o.removeAttribute("data-kt-indicator"), o.disabled = !1, window.location.href = uri + "/workpermit"
                    }), 2e3)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))
                }))
            })), $(i.querySelector('[name="card_expiry_month"]')).on("change", (function() {
                s[3].revalidateField("card_expiry_month")
            })), $(i.querySelector('[name="card_expiry_year"]')).on("change", (function() {
                s[3].revalidateField("card_expiry_year")
            })), $(i.querySelector('[name="business_type"]')).on("change", (function() {
                s[2].revalidateField("business_type")
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTCreateAccount.init()
    handleValueChange('');
}));

function insert(){
    var e, t, i, o, a, r, s = [];
    e = document.querySelector("#kt_modal_create_account");
    const url = uri + "/insertwp";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_create_account_form")),
    }).then(
        response => response.json()// .json(), etc.
    ).then(
        (result) => {
            console.log(result)
            const input = document.querySelector('#idworkpermit')

            if(result.status == 'true' || result.status == true){
                
                // ✔️ This will only set the value if the input exists
                if (input) {
                    input.value = result.idworkpermit
                    handleValueChange(result.idworkpermit);
                    console.log(wp)
                }

                Swal.fire({
                    text: "Form has been successfully submitted!",
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then((function() {
                    // e.goNext()
                    KTUtil.scrollTop()
                    console.log(result.idworkpermit)
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
                })
                // ,i.removeAttribute("data-kt-indicator"),
                // i.disabled = !1
            }
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
};

function insertdw(){
    var e, t, i, o, a, r, s = [];
    e = document.querySelector("#kt_modal_create_account");
    const url = uri + "/insertdw";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_create_account_form")),
    }).then(
        response => response.json()// .json(), etc.
    ).then(
        (result) => {
            console.log(result)
            const input = document.querySelector('#idworkpermit')

            if(result.status == 'true' || result.status == true){
                // ✔️ This will only set the value if the input exists
                if (input) {
                    input.value = result.idworkpermit
                    handleValueChange(result.idworkpermit);
                    console.log(wp)
                }

                Swal.fire({
                    text: "Form has been successfully submitted!",
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then((function() {
                    console.log(result.idworkpermit)
                    document.getElementById("formgowp").submit();
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
                })
                // ,i.removeAttribute("data-kt-indicator"),
                // i.disabled = !1
            }
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
};

function resetarea(){
    $("#area").val('').trigger('change') ;
    document.getElementById("area").value = "";
    $("#spesifik").val('').trigger('change') ;
    document.getElementById("spesifik").value = "";
    $("#detail").val('').trigger('change') ;
    document.getElementById("detail").value = "";
}

function resetpekerja(){
    $("#namapekerja").val('').trigger('change') ;
    document.getElementById("namapekerja").value = "";
    $("#skillpekerja").val('').trigger('change') ;
    document.getElementById("skillpekerja").value = "";
}

function resetstop6(){
    document.getElementById("kerjaan").value = "";
    document.getElementById("picpic").value = "";
    document.getElementById("plan").value = "";
    $("#plan").val('').trigger('change') ;
    document.getElementById("stop6").value = "";
    $("#stop6").val('').trigger('change') ;
    document.getElementById("resiko").value = "";
    document.getElementById("rankstop6").value = "";
    $("#rankstop6").val('').trigger('change') ;
    document.getElementById("penangganan").value = "";
}

function resetwork(){
    document.getElementById("stepwork").value = "";
    document.getElementById("safetykey").value = "";
    document.getElementById("pointcall").value = "";
    document.getElementById("prepare").value = "";
}

function resetlingkungan(){
    document.getElementById("dampaklingkungan").value = "";
    document.getElementById("pengendalian").value = "";
    document.getElementById("statusdampak").value = "";
}

function resetformdw(){
    document.getElementById("spesifikdw").value = "";
    // document.getElementById("namapekerjaandw").value = "";
    document.getElementById("apd").value = "";
    $("#apd").val('').trigger('change') ;
    document.getElementById("utility").value = "";
    $("#utility").val('').trigger('change') ;
    document.getElementById("peralatan").value = "";
    $("#peralatan").val('').trigger('change') ;

    document.getElementById("namapekerja").value = "";
    document.getElementById("skillpekerja").value = "";
    $("#skillpekerja").val('').trigger('change') ;
    document.getElementById("listpekerja").value = "";
    $("#tablepekerja tbody tr").remove();

    document.getElementById("kategori").value = "";
    document.getElementById("kerjaan").value = "";
    document.getElementById("picpic").value = "";
    document.getElementById("plan").value = "";
    $("#plan").val('').trigger('change') ;
    document.getElementById("stop6").value = "";
    $("#stop6").val('').trigger('change') ;
    document.getElementById("resiko").value = "";
    document.getElementById("rankstop6").value = "";
    $("#rankstop6").val('').trigger('change') ;
    document.getElementById("penangganan").value = "";
    document.getElementById("liststop6").value = "";
    $("#tablestop tbody tr").remove();

    document.getElementById("planimg").value = "";

    document.getElementById("stepwork").value = "";
    document.getElementById("safetykey").value = "";
    document.getElementById("pointcall").value = "";
    document.getElementById("prepare").value = "";
    document.getElementById("listitemkerja").value = "";
    $("#tablekerja tbody tr").remove();

    document.getElementById("dampaklingkungan").value = "";
    document.getElementById("pengendalian").value = "";
    document.getElementById("listdampak").value = "";
    document.getElementById("statusdampak").value = "";
    $("#tabledampak tbody tr").remove();
}

function handleValueChange(vallue){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.spesifikdw').select2({
        multiple: true,
        tags:true,
        ajax: {
            url:  uri +  "/getspesifikwp",
            data: {idwork: document.getElementById("idworkpermit").value,"_token": $('meta[name="csrf-token"]').attr('content'),}, //vallue
            dataType: 'json',
            method: 'POST',
            processResults: function (response) {
                var datax = $.map(response, function (obj) {
                obj.id = obj.id || obj.iddetail; // replace pk with your identifier

                return obj;
                });
            return {
                results: datax
            };
            },
        }
    });

};

$(".tgldw").change(function() {
    gettgl($(".tgldw").val());

    $('.owner').select2({
    ajax: {
        url: "{{ url('getbysection') }}",
        data: {area:$(".section").val(),"_token": "{{csrf_token() }}",},
        dataType: 'json',
        method: 'POST',
        processResults: function (response) {
            var datax = $.map(response, function (obj) {
            obj.id = obj.id || obj.iduser; // replace pk with your identifier

            return obj;
            });
         return {
             results: datax
         };
        },
    }
    });
  
});

function getdw(){
    var table = document.getElementById('tabledw');
    var tbody = table.querySelector('tbody');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: uri + "/getonedw" ,
        data: { idwp: document.getElementById("idworkpermit").value },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            // Create an empty <tr> element and add it to the 1st position of the table:
            res['results'].forEach(function(data, index) {
                console.log(data);
                var row = tbody.insertRow(data);

                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
    
                // Add some text to the new cells:
                cell1.innerHTML = index + 1;
                cell2.innerHTML = getFormattedDate(data['tglwp']);
                cell3.innerHTML = "<td class=\"text-center\"><a type=\"button\"  class=\"btn btn-sm btn-success\" href=\"" + uri + '/addworkpermitstep1/' +data['idworkpermit']+"\"><i class=\"bi bi-search\"></i></a></td>";
                if( data['namapekerjaandw'] == null){
                    cell4.innerHTML = "<td class=\"text-center\"><a type=\"button\"  class=\"btn btn-sm btn-warning\" href=\"" + uri + '/addworkpermitstep1/' +data['idworkpermit']+"\"><i class=\"bi bi-pencil\"></i></a></td>";
                }else{
                    cell4.innerHTML = '<td class=\"text-center\"><button type="button"  class="btn btn-sm btn-success" onclick="editdw({{$kkk->id}},{{$kkk->tanggal}})"><i class=\"bi bi-pencil-square\"></i></a></td>';
                }
                cell5.innerHTML = "<td class=\"text-center\"><a type=\"button\"  class=\"btn btn-sm btn-success\"  onclick=\"printdw("+data['idworkpermit']+")\"><i class=\"bi bi-printer\"></i></a></td>";
                cell6.innerHTML = "<td class=\"text-center\"><a type=\"button\"  class=\"btn btn-sm btn-success\"  onclick=\"printdw("+data['idworkpermit']+")\"><i class=\"bi bi-download\"></i></a></td>";
                
                
            });
           
        }
    });
}

function getFormattedDate(date) {
    var date = new Date(date);  
    let year = date.getFullYear();
    let month = (1 + date.getMonth()).toString().padStart(2, '0');
    let day = date.getDate().toString().padStart(2, '0');
  
    return day + '-' + month + '-' + year;
}

function gettgl() {
    var a,t,x,b = [];
    t = document.querySelector("#kt_create_account_stepper");
    a = t.querySelector('[data-kt-stepper-action="next"]');
    b = t.querySelector('[data-kt-stepper-action="previous"]');
    x = document.getElementById('submitbtn');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: uri + "/gettglwpone" ,
        data: { idwork: document.getElementById("idworkpermit").value },
        dataType: 'json',
        success: function(res) {
            console.log(res);
            $('#jml').text(res['recordstotal']);
            jmlhariexist = res['recordstotal'];
            $('#isi').text(res['results']);
            totalhari = res['results'];
            if(totalhari > 0) {
                b.innerHTML = 'Isi dewancho lainnya';
            }else{
                a.style.visibility = 'show';
                x.style.visibility = 'show';
            }
        }
    });
}

function insertParam(key, value) {
    key = encodeURIComponent(key);
    value = encodeURIComponent(value);

    // kvp looks like ['key1=value1', 'key2=value2', ...]
    var kvp = document.location.search.substr(1).split('&');
    let i=0;

    for(; i<kvp.length; i++){
        if (kvp[i].startsWith(key + '=')) {
            let pair = kvp[i].split('=');
            pair[1] = value;
            kvp[i] = pair.join('=');
            break;
        }
    }

    if(i >= kvp.length){
        kvp[kvp.length] = [key,value].join('=');
    }

    // can return this or...
    let params = kvp.join('&');

    // reload page with new params
    document.location.search = params;
}