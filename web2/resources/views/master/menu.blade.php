@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Menu</h1>
                <!-- {{ Breadcrumbs::render('dataUser') }} -->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="" class="text-white text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Menu Configuration</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Data Menu</li>
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
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_menu">
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
                            <th class="min-w-100px">Nama Menu</th>
                            <th class="min-w-80px">Route menu</th>
                            <th class="min-w-100px">Parent</th>
                            <th class="min-w-125px">Icon</th>
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

    <!------------------------------------ MODAL INSERT DATA ----------------------------------------->

    <div class="modal fade" id="kt_modal_add_menu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_menu_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Add Menu</h2>
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
                    <form id="kt_modal_add_menu_form" class="form" action="{{ route('menu.insert') }}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_menu_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_menu_header" data-kt-scroll-wrappers="#kt_modal_add_menu_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->
                            <input type="text" id="id" name="id" hidden  />
                            
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama Menu</label>
                                <input type="text" id="nama" 
                                                    name="nama" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Nama Menu"  
                                                    required/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Route Menu</label>
                                <input type="text" id="route" 
                                                    name="route" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Isikan # Apabila Tidak Ada Child Menu"  />
                                <!--end::Input-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Parent</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_menu" data-allow-clear="true"
                                    data-placeholder="Kosong = Is Parent" id="parent_id" name="parent_id">
                                    <option></option>
                                @foreach($listMenu as $menu)
                                    <option value="{{$menu->id}}">{{$menu->nama}}</option>
                                @endforeach
                                </select>
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Icon</label>
                                <input type="text" id="icon" 
                                                    name="icon" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Icon Menu"  />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-menus-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-custom-purple" data-kt-menus-modal-action="submit" id="buttonInsertMenu">
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

    <div class="modal fade" id="kt_modal_update_menu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_menu_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Edit Menu</h2>
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
                    <form id="kt_modal_edit_menu_form" class="form" action="{{url('/updatemenu')}}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_menu_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_menu_header" data-kt-scroll-wrappers="#kt_modal_add_menu_scroll" data-kt-scroll-offset="300px">

                            <input type="text" id="editID" name="editID" value="{{ old('editID') }}" hidden />
                            
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nama Menu</label>
                                <input type="text" id="editNama" name="editNama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Menu" value="{{ old('editNama') }}" Required/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Route Menu</label>
                                <input type="text" id="editRoute" name="editRoute" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Isikan # Apabila Tidak Ada Child Menu" value="{{ old('editRoute') }}" Required/>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Parent <i>(Kosong = Is Parent)</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_menu_form" data-allow-clear="true"
                                    data-placeholder="Kosong = Is Parent" id="editParent" name="editParent">
                                    <option></option>
                                @foreach($listMenu as $menu)
                                    <option value="{{$menu->id}}">{{$menu->nama}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Icon</label>
                                <input type="text" id="editIcon" name="editIcon" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Icon" value="{{ old('editIcon') }}" Required/>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-menuedt-modal-action="cancel">Reset</button>
                            <button type="button" class="btn btn-custom-purple" data-kt-menuedt-modal-action="submit" id="buttonUpdateMenu">
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

@endsection

@section('scripts')

<script>
$(document).ready(function () {
    $('#kt_modal_add_menu').modal({backdrop: 'static', keyboard: false})
    $('#kt_modal_update_menu').modal({backdrop: 'static', keyboard: false})
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
                order: [[1, 'desc']],
                stateSave: true,
                bDestroy: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    className: 'row-selected'
                },
                ajax: {
                    url: "{{ url('getMenu') }}",
                    data: { nama: nama},
                },
                columns: [
                    { data: 'nama' },
                    { data: 'route_menu' },
                    { data: 'parent_id' },
                    { data: 'icon' },
                    { data: 'id' },
                ],
                columnDefs: [
                    {
                        targets: 2,
                        orderable: false,
                        render: function (data) {
                            if (data == 0){
                                return `
                                <span class="badge badge-success badge-lg"> Is Parent </span>
                                `;
                            }else{
                                return `
                                <span class="badge badge-danger badge-lg"> Is Not Parent </span>
                                `;
                            }
                        }
                    },
                    {
                        targets: 3,
                        orderable: false,
                        render: function (data) {
                                return `
                                <span class="badge badge-light badge-lg"><i class="icon-xl `+data+`"></i></span> `+data+`
                                `;
                        }
                    },
                    {
                        targets: 4,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <center>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="editMenu(`+data+`)"><span class="fas fa-pen"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="deleteMenu(`+data+`)"><span class="fas fa-trash"></span></i>
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

    function editMenu(id){   
        $.ajax({
        url: "/getonemenu/"+id,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                $('#editID').val(item.id);
                $('#editNama').val(item.nama);
                $('#editRoute').val(item.route_menu);
                $('#editIcon').val(item.icon);
                $('#editParent').val(item.parent_id).change();
                selectElement('editParent', val(item.parent_id));
            });
        }
        });

        $('#kt_modal_update_menu').modal('show');
    }
        
    function resetForm() {
        document.getElementById('kt_modal_add_menu').reset();
    }

</script>

<script src="{{asset('assets/js/custom/apps/user-management/menu/validation_menu.js')}}"></script>

@endsection