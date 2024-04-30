// Define form element
const form = document.getElementById('kt_sign_in_form');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'username': {
                validators: {
                    notEmpty: {
                        message: 'Username is required'
                    }
                }
            },
            'password': {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
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


// Login button handler
$('#kt_sign_in_submit').click(function(e) {
    e.preventDefault();
    // Prevent default button action


    // Validate form before submit
    if (validator) {
        validator.validate().then(function (status) {
            console.log('validated!');

            if (status == 'Valid') {

    const url = uri + "/dologin";
    fetch(url, {
        method : "POST",
        body: new FormData(document.getElementById("kt_sign_in_form")),
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
                    confirmButtonText: "<span class='text-white'> Ok, got it!</span>",
                    customClass: {
                        confirmButton: "btn btn-custom-purple"
                    }
                }).then((function(t) {
                    if(obj.success == true){
                        window.location.href = "/dashboard";
                    }
                }
                ))
        }
    ).catch((error) => {
    console.error('Error:', error);
    });
    }else{
        Swal.fire({
            text: 'Validasi tidak lengkap',
            icon: 'error',
            buttonsStyling: !1,
            confirmButtonText: "<span class='text-white'> Ok, got it!</span>",
            customClass: {
                confirmButton: "btn btn-custom-purple"
            }
        })
    }

    });
    }
});