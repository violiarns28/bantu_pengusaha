//------------------------------ Update Group Access ---------------------------------------------
// Update button handler
$('#buttonUpdateGroupAccess').click(function(e) {
    e.preventDefault();
    // Prevent default button action

    Swal.fire({
        text: "Are you sure you want to update ?",
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, update!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only
            Swal.fire({
                text: "Updating ",
                icon: "info",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                const url = uri + "/updategroupaccess";
                fetch(url, {
                    method : "POST",
                    body: new FormData(document.getElementById("editgroupaccessform")),
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
                        });
                        $("#kt_modal_group_role").modal('hide');
                    }
                ).catch((error) => {
                console.error('Error:', error);
                });
               
            });
        } else if (result.dismiss === 'cancel') {
            Swal.fire({
                text: "Data was not update.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn fw-bold btn-custom-purple",
                }
            });
        }
    });
});
//------------------------------ End Update Group Access ---------------------------------------------