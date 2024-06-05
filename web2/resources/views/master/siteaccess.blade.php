@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
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
                            <div class="input-group input-group-sm">
                                <input type="text" id="search1" name="nama" class="form-control" placeholder="Search Nama Here"  />
                            </div>

                            <button type="button" class="btn btn-custom-light-purple btn-sm" onclick="search()">
                                <span class="fas fa-search"></span>
                            </button>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Wrapper-->
                    
                    <!--begin::Datatable-->
                    <table id="kt_datatable_example_1" class="table table-sm table-hover align-middle table-row-dashed">
                        <thead>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Nomor</th>
                            <th class="min-w-125px">Nama</th>
                            <th class="min-w-125px">Site Access</th>
                            <th class="text-end min-w-100px"><center>Actions</center></th>
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

    <!------------------------------------ Site Access DATA ----------------------------------------->

    <div class="modal fade" id="kt_modal_update_siteaccess" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_siteaccess_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Site Access</h2>
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
                    <form action="{{url('/updatesiteaccess')}}" id="editsiteaccessform" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="editUserID" id="editUserID" values="{{ old('editUserID') }}">

                        <div class="row" id="parentrow">

                        </div>

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->

                <!-- Modal footer -->
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary" form="editgroupaccessform">
                        Submit
                    </button> -->

                    <!-- <button type="reset" class="btn btn-light me-3" data-kt-groupaccess-modal-action="cancel">Reset</button> -->
                    <button type="button" class="btn btn-custom-purple" data-kt-menuedt-modal-action="submit" id="buttonUpdateSiteAccess">
                        <span class="indicator-label">Grant Access</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <!------------------------------------ END Site Access DATA ----------------------------------------->

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
                scrollY: 300,
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
                                <center>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="editSiteAccess(`+data+`)"><span class="icon-sm fas fa-key"></span> Grand Access</i>
                                    </a>
                                </span>
                                </center>
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

    $(document).ready(function () {
        $('#kt_modal_update_siteaccess').modal({backdrop: 'static', keyboard: false})
    });

    var listSiteAccess = {!! json_encode($listSiteAccess) !!};
    listSiteAccess = Object.values(listSiteAccess);
    var listSite = {!! json_encode($listSite) !!};
    listSite = Object.values(listSite);

    function editSiteAccess(id){
            console.info("user_id : " + id);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/getonesiteaccess/"+id,
                data: { },
                dataType: 'json',
                success: function(res) {

                    $('#editUserID').val(id);
                    $('#parentrow').empty();

                    var appendtable = '';
                        appendtable +=
                        '<table class="table table-sm table-hover align-middle table-row-dashed table-striped">' +
                            '<thead>' +
                            '<tr style="text-align: center">' +
                                '<th style="text-align: left">Nama Site</th>' +
                                '<th style="text-align: left">Access</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                    var isChecked = false;

                    listSite.forEach(function(site) {

                    // $('#parentrow').append('' +
                    appendtable += '<tr>' +
                        '<td>'+site["nama"]+'</td>';
                    // );

                    isChecked = false;

                        // res.forEach(function(groupaccess) {
                        for (const listSiteAccess of res) {
                            if (listSiteAccess['site_id'] == site['id']) {
                                isChecked = true;
                                break;
                            }
                            else {
                                isChecked = false;
                            }
                            // console.log(groupaccess['GroupID'] + ' - ' + groupaccess['MenuID'] + ' : ' + isChecked);
                        }
                        // });

                        if ( isChecked == true ) {
                            // $('#parentrow').append(
                            appendtable +=
                                '<td style="text-align: left">' +
                                '<input class="form-check-input" type="checkbox" name="site_access[]" value="'+site["id"]+'" checked>' +
                                '</td>';
                            // );
                        }
                        else{
                            // $('#parentrow').append(
                            appendtable +=
                                '<td style="text-align: left">' +
                                '<input class="form-check-input" type="checkbox" name="site_access[]" value="'+site["id"]+'">' +
                                '</td>';
                            // );
                        }
                    // $('#parentrow').append(
                        appendtable +=
                            '</tr>';
                    // );

                    });

                    $('#parentrow').append(appendtable +
                        '</tbody>' +
                    '</table>'
                    ); //end of append

                    $('#kt_modal_update_siteaccess').modal('show');
                }
            });

        }
        
</script>

<script src="{{asset('assets/js/custom/apps/user-management/site/validation_siteaccess.js')}}"></script>

@endsection