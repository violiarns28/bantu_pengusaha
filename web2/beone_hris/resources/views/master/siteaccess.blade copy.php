@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Site Access</h1>
                <!-- {{ Breadcrumbs::render('dataUser') }} -->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="" class="text-white text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Master Data</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Data User</li>
                    <li class="breadcrumb-item">
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center py-3 py-md-1">

            </div>
        </div>
    </div>
<!-- End Title & Breadcrumbs -->

    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <div class="d-flex flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative my-1">
                        </div>

                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3"  data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                <span class="svg-icon svg-icon-2"></span>
                                Filter
                            </button>
                            <!--end::Filter-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Group actions-->
                        <!-- <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
                            </div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div> -->
                        <!--end::Group actions-->
                    </div>
                    <!--end::Wrapper-->

                    <div class="accordion" id="kt_accordion_1">
                        <div class="accordion-item">
                            <div id="kt_accordion_1_body_1" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    <div class="fv-row row mb-7">
                                    <div class="fv-row px-5 col-lg-3">
                                        <label class=" fw-semibold fs-6 mb-2">Nama</label>
                                        <input type="text" id="search1" name="nama" class="form-control form-control-solid mb-7 mb-lg-5" placeholder="Nama User"  />
                                    </div>
                                
                                    <div class="fv-row col-lg-3">
                                        <label class=" fw-semibold fs-6 mb-2"> </label>
                                        <button type="button" class="btn btn-light-primary me-3 form-control" onclick="search()">
                                            <span class="svg-icon svg-icon-2"></span>
                                            Search
                                        </button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--begin::Datatable-->
                    <table id="kt_datatable_example_1" class="table table-sm table-hover align-middle table-row-dashed">
                        <thead>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Nomor</th>
                            <th class="min-w-125px">Nama</th>
                            <th class="min-w-125px">Site Access</th>
                            <th class="text-end min-w-100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                    <!--end::Datatable-->
                </div>
                <!--end::Card body-->
                
            </div>
            <!--end::Card-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->
    
    @include('layouts.footer')

    <div class="modal fade" id="kt_modal_update_siteaccess" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_siteaccess_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Edit User</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"  data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_edit_siteaccess_form" class="form" action="{{url('/updatesiteaccess')}}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_siteaccess_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_siteaccess_header" data-kt-scroll-wrappers="#kt_modal_add_siteaccess_scroll" data-kt-scroll-offset="300px">

                        <table id="siteaccess-table" class="table table-sm table-hover align-middle table-row-dashed">
                            <thead>
                                <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">User ID</th>
                                    <th class="min-w-125px">Site ID</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                            </tbody>
                        </table>

                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-usersedt-modal-action="cancel">Reset</button>
                            <button type="button" class="btn btn-primary" data-kt-usersedt-modal-action="submit" id="buttonUpdateUser">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection

@section('scripts')
<script>

// $(document).ready(function () {
//     $('#kt_modal_add_user').modal({backdrop: 'static', keyboard: false})
//     $('#kt_modal_update_user').modal({backdrop: 'static', keyboard: false})
// });

function search(){
    KTDatatablesServerSide.init();
}

    var KTDatatablesServerSide = function () {
        var table;
        var dt;
        var filterPayment;

        var initDatatable = function () {
        var nama = document.getElementById("search1").value;

        dt = $("#kt_datatable_example_1").DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [[2, 'desc']],
                stateSave: true,
                bDestroy: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                ajax: {
                    url: "{{ url('getsiteaccess') }}",
                    data: { nama: nama},
                },
                columns: [
                    { data: 'nomor' },
                    { data: 'nama' },
                    { data: 'sites' },
                    { data: 'id' },
                ],
                columnDefs: [
                    {
                        targets: 3,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <a href="#" class="btn btn-light-warning btn-active-warning btn-sm" 
                                                    data-kt-menu-trigger="click" 
                                                    data-kt-menu-placement="bottom-end" 
                                                    onclick="editSiteAccess(`+data+`)"><i class="icon-xl fas fa-pen"></i></a>
                                <a href="#" class="btn btn-light-danger btn-active-danger btn-sm" 
                                                    data-kt-menu-trigger="click" 
                                                    data-kt-menu-placement="bottom-end" 
                                                    onclick="deleteUser(`+data+`)"><i class="icon-xl fas fa-trash-alt"></i></a>
                            `;
                        },
                    },
                ],
            });

            table = dt.$;
    
            // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
            dt.on('draw', function () {
                // initToggleToolbar();
                // toggleToolbars();
                // handleDeleteRows();
                KTMenu.createInstances();
            });
        }
    
        // Public methods
        return {
            init: function () {
                initDatatable();
            }
        }
    }();
    
     // On document ready
     KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });

    function editSiteAccess(id){   
        var table_clear = document.getElementById("siteaccess-table"); // Replace "myTable" with the ID of your table
        var rowCount = table_clear.rows.length;
        // Remove all rows from the table
        for (var i = rowCount - 1; i > 0; i--) {
            table_clear.deleteRow(i);
        }

        $.ajax({
            url: "/getonesiteaccess/"+id,
            method: 'GET',
            dataType: 'json',
            data: { id: id }, // pass the ID as a data object
            success: function(siteaccess) {
            var table = $('#siteaccess-table tbody');
            
            $.each(siteaccess, function(index, access) {
                table.append('<tr><td>' + access.nama_user + '</td><td>' + access.nama_site + '</td><td><a href="#" class="btn btn-light-danger btn-active-danger btn-sm" onclick="deleteSiteAccess('+access.id+')"><i class="icon-xl fas fa-trash-alt"></i></a></td></tr>');
            });
            },
            error: function(xhr, status, error) {
            console.log(error);
            // handle the error here
            }
        });


        $('#kt_modal_update_siteaccess').modal('show');
    }
        
    // function resetForm() {
    //     document.getElementById('kt_modal_add_user').reset();
    // }
</script>

<script src="{{asset('assets/js/custom/apps/user-management/users/list/validation_add.js')}}"></script>

@endsection