//------------------------------ Update User ---------------------------------------------
// Update button handler
$('#buttonDeleteSchedule').click(function(e) {
    e.preventDefault();
    // Prevent default button action

    Swal.fire({
        text: "Are you sure you want to delete ? ",
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
                const t = document.getElementById("kt_modal_info_schedule");
                const i = t.querySelector('[data-kt-scheduleedt-modal-action="submit"]');
                const url = uri + "/deleteschedulesummary";
                fetch(url, {
                    method : "POST",
                    body: new FormData(document.getElementById("kt_modal_info_schedule_form")),
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
                                $("#kt_modal_info_schedule").modal('hide');
                                // $('#kt_datatable_example_1').DataTable().ajax.reload();
                                document.getElementById("kt_modal_info_schedule_form").reset();

                                var queryParams = new URLSearchParams(window.location.search);
                                var tgl1 = queryParams.get("from_date");
                                var tgl2 = queryParams.get("to_date");
                                
                                    if (tgl1 == null || tgl2 == null){
                                        location.reload();
                                    }else{
                                        window.location.href = "/summarySchedule?from_date="+ tgl1 +"&to_date="+ tgl2;
                                    }
                                }
                            }
                            ))
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

    
});
//------------------------------ End Update User ---------------------------------------------