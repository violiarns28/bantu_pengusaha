"use strict";var KTSigninGeneral=function(){var e,t,i;return{init:function(){e=document.querySelector("#kt_sign_in_form"),
t=document.querySelector("#kt_sign_in_submit"),
i=FormValidation.formValidation(e,{fields:{username:{validators:{notEmpty:{message:"The username is required"}}},password:{validators:{notEmpty:{message:"The password is required"}}}},
plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row",eleInvalidClass:"",eleValidClass:""})}}),
t.addEventListener("click",(function(n){n.preventDefault(),i.validate().then((function(i){"Valid"==i?(t.setAttribute("data-kt-indicator","on"),
t.disabled=!0,
// alert('test'),

login()
// setTimeout((function(){t.removeAttribute("data-kt-indicator"),
// t.disabled=!1,



// }),2e3)
):Swal.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();KTUtil.onDOMContentLoaded((function(){
    KTSigninGeneral.init();
}));

function login(){
    // let xhr = new XMLHttpRequest();
    // xhr.open("POST", "http://127.0.0.1:8000/dologin");

    // xhr.setRequestHeader("Accept", "application/json");
    // xhr.setRequestHeader("Content-Type", "application/json");
    // xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    // var data = new FormData();
    // data.append('user', 'person');
    // data.append('pwd', 'password');
    // data.append('organization', 'place');
    // data.append('requiredkey', 'key');

    // xhr.onload = () => console.log(xhr.responseText);
    // var params = 'orem=ipsum&name=binny';
    // // let data = `{
    // // "username": 78912,
    // // "password": "Jason Sweet",
    // // }`;

    // xhr.send(data);
    var t;
    t=document.querySelector("#kt_sign_in_submit");
    const url = uri + "/dologin";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_sign_in_form")),
        // -- or --
        // body : JSON.stringify({
            // user : document.getElementById('user').value,
            // ...
        // })
    }).then(
        response => response.text()// .json(), etc.

        // same as function(response) {return response.text();}
    ).then(
        (result) => {
            console.log(result)
            if(result == 'false'){
                setTimeout((function(){
                    t.removeAttribute("data-kt-indicator")})),
                t.disabled=!1
                Swal.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})
            }else{
                setTimeout((function(){
                    t.removeAttribute("data-kt-indicator")})),
                t.disabled=!1
                
                $("#kt_modal_otp").modal({backdrop: 'static', keyboard: false});
                $("#kt_modal_otp").modal('show');
            }
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
};