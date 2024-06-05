@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar"> <!-- Ubah py-lg-15 menjadi 10 -->
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data User</h1>
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

                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
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
                            <th class="min-w-80px">Nomor</th>
                            <th class="min-w-100px">Nama</th>
                            <th class="min-w-100px">Username</th>
                            <th class="min-w-100px">Email</th>
                            <th class="min-w-100px">Group</th>
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

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Add User</h2>
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
                    <form id="kt_modal_add_user_form" class="form" action="{{ route('user.insert') }}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->
                            <input type="text" id="id" name="id" hidden  />
                            
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nomor ID User</label>
                                <input type="text" id="nomor" 
                                                    name="nomor" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Nomor / NIK User"  
                                                    required/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama</label>
                                <input type="text" id="nama" 
                                                    name="nama" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Nama"  />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <input type="email" id="email" 
                                                    name="email" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="example@domain.com"  />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Group Role</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-allow-clear="true"
                                    data-placeholder="Select an option" id="group_id" name="group_id">
                                    <option></option>
                                @foreach($listGroup as $group)
                                    <option value="{{$group->id}}">{{$group->nama}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Username</label>
                                <input type="text" id="username" 
                                                    name="username" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Username"  />
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Password</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" name="newpassword" id="  " class="form-control form-control-solid mb-3 mb-lg-0"  />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Re-Type Password</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" name="repassword" id="repassword" class="form-control form-control-solid mb-3 mb-lg-0"  />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-custom-purple" data-kt-users-modal-action="submit" id="buttonInsertUser">
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

    <div class="modal fade " id="kt_modal_update_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_user_header">
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
                    <form id="kt_modal_edit_user_form" class="form" action="{{url('/updateuser')}}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                            <input type="text" id="editID" name="editID" value="{{ old('editID') }}" hidden />
                            
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nomor</label>
                                <input type="text" id="editNomor" name="editNomor" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nomor" value="{{ old('editNomor') }}" Required/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama</label>
                                <input type="text" id="editNama" name="editNama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama" value="{{ old('editNama') }}" Required/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Username</label>
                                <input type="text" id="editUsername" name="editUsername" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Username" value="{{ old('editUsername') }}" Required/>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <input type="email" id="editEmail" name="editEmail" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="{{ old('editEmail') }}" Required/>
                                <!--end::Input-->
                            </div>
                        <div class="fv-row d-flex flex-column mb-7">
                            <label for="" class="form-label">Group Role</i></label>
                            <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_user_form" data-allow-clear="true"
                                data-placeholder="Select an option" id="editGroupID" name="editGroupID">
                                <option></option>
                            @foreach($listGroup as $group)
                                <option value="{{$group->id}}">{{$group->nama}}</option>
                            @endforeach
                            </select>
                        </div>

                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-usersedt-modal-action="cancel">Reset</button>
                            <button type="button" class="btn btn-custom-purple" data-kt-usersedt-modal-action="submit" id="buttonUpdateUser">
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

$(document).ready(function () {
    $('#kt_modal_add_user').modal({backdrop: 'static', keyboard: false})
    $('#kt_modal_update_user').modal({backdrop: 'static', keyboard: false})
});

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
                // order: [[2, 'desc']],
                stateSave: true,
                bDestroy: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                ajax: {
                    url: "{{ url('getuser') }}",
                    data: { nama: nama},
                },
                columns: [
                    // { data: 'id' },
                    { data: 'nomor' },
                    { data: 'nama' },
                    { data: 'username' },
                    { data: 'email' },
                    { data: 'nama_group' },
                    { data: 'id' },
                ],
                columnDefs: [
                    {
                        targets: 3,
                        orderable: false,
                        render: function (data) {
                            return `
                            <span class="far fa-envelope"></span> ${data}
                                `;
                        }
                    },
                    {
                        targets: 4,
                        orderable: false,
                        render: function (data) {
                            if (data == 'Superadmin'){
                                return `
                                <span class="badge badge-success badge">${data}</span>
                                `
                                ;
                            }else{
                                return `
                                    ${data}
                                `
                                ;
                            }
                        }
                    },
                    {
                        targets: 5,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <center>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="editUser(`+data+`)"><span class="fas fa-pen"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="deleteUser(`+data+`)"><span class="fas fa-trash"></span></i>
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

    function editUser(id){   
        $.ajax({
        url: "/getoneuser/"+id,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                $('#editID').val(item.id);
                $('#editNomor').val(item.nomor);
                $('#editUsername').val(item.username);
                $('#editNama').val(item.nama);
                $('#editEmail').val(item.email);
                $('#editGroupID').val(item.group_id).change();
                selectElement('editGroupID', val(item.group_id));
            });
        }
        });

        $('#kt_modal_update_user').modal('show');
    }
        
    function resetForm() {
        document.getElementById('kt_modal_add_user').reset();
    }
</script>

<script src="{{asset('assets/js/custom/apps/user-management/users/list/validation_add.js')}}"></script>

@endsection