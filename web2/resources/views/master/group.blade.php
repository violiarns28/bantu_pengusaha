@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Group</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Data Group</li>
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

                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_group">
                                <span class="fas fa-plus"></span>
                                Add New</button>
                        </div>
                        <!--end::Toolbar-->

                    </div>
                    <!--end::Wrapper-->
                    
                    <!--begin::Datatable-->
                    <table id="kt_datatable_example_1" class="table table-sm table-hover align-middle table-row-dashed">
                        <thead>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-80px">Nama Group</th>
                            <th class="min-w-100px"><center>Actions</center></th>
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

    <!------------------------------------ MODAL INSERT DATA ----------------------------------------->

    <div class="modal fade" id="kt_modal_add_group" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_group_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Add Group</h2>
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
                    <form id="kt_modal_add_group_form" class="form" action="{{ route('group.insert') }}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_group_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_group_header" data-kt-scroll-wrappers="#kt_modal_add_group_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->
                            <input type="text" id="id" name="id" hidden  />
                            
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama Group</label>
                                <input type="text" id="nama" 
                                                    name="nama" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Nama Group"  
                                                    required/>
                                <!--end::Input-->
                            </div>

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-groups-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-primary" data-kt-groups-modal-action="submit" id="buttonInsertGroup">
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

    <!------------------------------------ END MODAL INSERT DATA ----------------------------------------->

    <!------------------------------------ MODAL UPDATE DATA ----------------------------------------->

    <div class="modal fade" id="kt_modal_update_group" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_group_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Edit Group</h2>
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
                    <form id="kt_modal_edit_group_form" class="form" action="{{url('/updategroup')}}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_group_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_group_header" data-kt-scroll-wrappers="#kt_modal_add_group_scroll" data-kt-scroll-offset="300px">

                            <input type="text" id="editID" name="editID" value="{{ old('editID') }}" hidden />
                            
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama Group</label>
                                <input type="text" id="editNama" name="editNama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Group" value="{{ old('editNama') }}" Required/>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-groupedt-modal-action="cancel">Reset</button>
                            <button type="button" class="btn btn-custom-purple" data-kt-groupedt-modal-action="submit" id="buttonUpdateGroup">
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

    <!------------------------------------ END MODAL UPDATE DATA ----------------------------------------->



    <!------------------------------------ GROUP ROLE DATA ----------------------------------------->

    <div class="modal fade" id="kt_modal_group_role" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_group_role_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Group Role</h2>
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
                    <form action="{{url('/updategroupaccess')}}" id="editgroupaccessform" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="editGroupID" id="editGroupID" values="{{ old('editgroupID') }}">

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
                    <button type="button" class="btn btn-custom-purple" data-kt-menuedt-modal-action="submit" id="buttonUpdateGroupAccess">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <!------------------------------------ END GROUP ROLE DATA ----------------------------------------->

@endsection

@section('scripts')

<script> 
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
                order: [[0, 'desc']],
                stateSave: true,
                bDestroy: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                ajax: {
                    url: "{{ url('getgroup') }}",
                    data: { nama: nama},
                },
                columns: [
                    { data: 'nama' },
                    { data: 'id' },
                ],
                columnDefs: [
                    {
                        targets: 1,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <center>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="editGroup(`+data+`)"><span class="fas fa-pen"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="deleteGroup(`+data+`)"><span class="fas fa-trash"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="roleGroup(`+data+`)">Group Role</span></i>
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

    function editGroup(id){   
        $.ajax({
        url: "/getonegroup/"+id,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                $('#editID').val(item.id);
                $('#editNama').val(item.nama);
            });
        }
        });

        $('#kt_modal_update_group').modal('show');
    }
        
    function resetForm() {
        document.getElementById('kt_modal_add_group').reset();
    }
</script>

<script>
        var listaccess = {!! json_encode($listaccess) !!};
        listaccess = Object.values(listaccess);
        var listmenuaccess = {!! json_encode($listmenuaccess) !!};
        listmenuaccess = Object.values(listmenuaccess);
        var listmenu = {!! json_encode($listmenu) !!};
        listmenu = Object.values(listmenu);

        $(document).ready(function () {
            $('#kt_modal_group_role').modal({backdrop: 'static', keyboard: false})
            $('#kt_modal_update_group').modal({backdrop: 'static', keyboard: false})
            $('#kt_modal_add_group').modal({backdrop: 'static', keyboard: false})

            // show the alert
            // setTimeout(function () {
            //     $(".alert").alert('close');
            // }, 500000);
        });

        function roleGroup(GroupID){
            console.info("group id : " + GroupID);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ url('getonegroupaccess') }}" + "/" +GroupID,
                data: { },
                dataType: 'json',
                success: function(res) {

                    $('#editGroupID').val(GroupID);
                    $('#parentrow').empty();

                    var appendtable = '';
                        appendtable +=
                        '<table class="table table-sm table-hover align-middle table-row-dashed table-striped">' +
                            '<thead>' +
                            '<tr style="text-align: center">' +
                                '<th style="text-align: left">Menu Name</th>' +
                                '@foreach($listaccess as $access)' +
                                '<th>{{ $access->nama }}</th>' +
                                '@endforeach' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                    var isAvailableMenu = false;
                    var isChecked = false;

                    //listmenu,listaccess,listmenuaccess
                    listmenu.forEach(function(menu) {

                    // $('#parentrow').append('' +
                    appendtable += '<tr>' +
                        '<td>'+menu["nama"]+'</td>';
                    // );
                    isAvailableMenu = false;
                    isChecked = false;

                    listaccess.forEach(function(access) {
                        // listmenuaccess.forEach(function(menuaccess) {
                        for (const menuaccess of listmenuaccess) {
                            if (menuaccess['menu_id'] == menu['id'] && menuaccess['access_id'] == access['id']) {
                                isAvailableMenu = true;
                                break;
                            } else {
                                isAvailableMenu = false;
                            }
                            // console.log(menu['MenuName'] + ' - ' + access['AccessName'] + ' : ' + isAvailableMenu);
                        }
                        // });

                        // res.forEach(function(groupaccess) {
                        for (const groupaccess of res) {
                            if (groupaccess['menu_id'] == menu['id'] && groupaccess['access_id'] == access['id']) {
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
                                '<input class="form-check-input" type="checkbox" name="group_menu_access[]" value="'+GroupID+'-'+menu["id"]+'-'+access["id"]+'" checked>' +
                                '</td>';
                            // );
                        }
                        else if ( isAvailableMenu == true ) {
                            // $('#parentrow').append(
                            appendtable +=
                                '<td style="text-align: center">' +
                                '<input class="form-check-input" type="checkbox" name="group_menu_access[]" value="'+GroupID+'-'+menu["id"]+'-'+access["id"]+'">' +
                                '</td>';
                            // );
                        }
                        else {
                            // $('#parentrow').append(
                            appendtable +=
                                '<td style="background-color: white"> &nbsp; </td>';
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

                    $('#kt_modal_group_role').modal('show');
                }
            });

        }

    </script>

<script src="{{asset('assets/js/custom/apps/user-management/group/validation_group.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/user-management/groupaccess/validation_groupaccess.js')}}"></script>

@endsection