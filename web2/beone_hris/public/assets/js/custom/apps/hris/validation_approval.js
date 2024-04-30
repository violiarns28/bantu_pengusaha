//------------------------------ Approve Pengajuan ---------------------------------------------
// Delete button handler
function approve(id, jenis_pengajuan){ 
    Swal.fire({
        text: "Are you sure you want to approve ?",
        icon: "info",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, approve!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-custom-purple",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only
            Swal.fire({
                text: "Proses Approve ",
                icon: "info",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                const url = uri + "/approve/"+id+"/"+jenis_pengajuan;
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
                text: "Data was not approve.",
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
//------------------------------ End Approve Pengajuan ---------------------------------------------


//------------------------------ Approve Pengajuan ---------------------------------------------
// Delete button handler
function reject(id, jenis_pengajuan){ 
    Swal.fire({
        text: "Are you sure you want to reject ?",
        icon: "info",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: "Yes, reject!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    }).then(function (result) {
        if (result.value) {
            // Simulate delete request -- for demo purpose only
            Swal.fire({
                text: "Proses Reject ",
                icon: "info",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                const url = uri + "/reject/"+id+"/"+jenis_pengajuan;
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
                            $('.badgeApproval').text(data);
                            }
                        });
                    }
                ).catch((error) => {
                console.error('Error:', error);
                });
               
            });
        } else if (result.dismiss === 'cancel') {
            Swal.fire({
                text: "Data was not reject.",
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
//------------------------------ End Approve Pengajuan ---------------------------------------------
