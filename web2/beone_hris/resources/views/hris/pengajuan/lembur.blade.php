@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Lembur</h1>
                <!-- {{ Breadcrumbs::render('dataUser') }} -->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-white opacity-75">
                        <a href="" class="text-white text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">HRIS</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-white opacity-75">Data Lembur</li>
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
                            <div class="input-group input-group-sm" style="margin-right: 2px;">
                                <input class="form-control form-control" placeholder="Filter Date" id="search1" name="tanggal" tabindex="2"/>
                            </div>

                            <button type="button" class="btn btn-custom-light-purple btn-sm" onclick="search()">
                                <span class="fas fa-search"></span>
                            </button>
                        </div>

                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_lembur">
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
                            <th class="min-w-80px">Jenis Lembur</th>
                            <th class="min-w-80px">Tanggal</th>
                            <th class="min-w-50px">Dari Jam</th>
                            <th class="min-w-50px">Sampai Jam</th>
                            <th class="min-w-100px">Pekerjaan</th>
                            <th class="min-w-50px">Total Jam</th>
                            <th class="min-w-50px">Status</th>
                            <th class="min-w-50px">Approve By</th>
                            <th class="min-w-80px">Approve At</th>
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

    <div class="modal fade" id="kt_modal_add_lembur" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_lembur_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Add Lembur</h2>
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
                    <form id="kt_modal_add_lembur_form" class="form" action="{{ route('lembur.insert') }}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_lembur_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_lembur_header" data-kt-scroll-wrappers="#kt_modal_add_lembur_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="required form-label">Jenis Lembur</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Jenis Lembur" data-dropdown-parent="#kt_modal_add_lembur_form" data-allow-clear="true"
                                                                              name="jenis_lembur" id="jenis_lembur">
                                    <option></option>
                                    <option value="HARI KERJA">HARI KERJA</option>
                                    <option value="HARI LIBUR">HARI LIBUR</option>
                                </select>
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="required fw-semibold fs-6 mb-2">Tanggal Lembur</label>
                                    <input class="form-control form-control-solid" placeholder="Tanggal Lembur" 
                                                                                    id="kt_daterangepicker_1" 
                                                                                    name="tanggal" 
                                                                                    tabindex="6"/>
                                <!--end::Notice-->
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="required d-flex align-items-center form-label mb-3">Dari Jam</label>
                                <input class="form-control form-control-solid" placeholder="Waktu (Jam)" id="kt_daterangepicker_2" name="dari_jam" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="required d-flex align-items-center form-label mb-3">Sampai Jam</label>
                                <input class="form-control form-control-solid" placeholder="Waktu (Jam)" id="kt_daterangepicker_3" name="sampai_jam" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="required form-label">Pekerjaan Yang Dilakukan</label>
                                <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="keterangan"></textarea>
                            </div>
                            
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-pengajuan-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-custom-purple" data-kt-pengajuan-modal-action="submit" id="buttonInsertLembur">
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



    <div class="modal fade " id="kt_modal_update_lembur" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_lembur_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Edit Lembur</h2>
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
                    <form id="kt_modal_edit_lembur_form" class="form" action="{{url('/updatelembur')}}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_lembur_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_lembur_header" data-kt-scroll-wrappers="#kt_modal_add_lembur_scroll" data-kt-scroll-offset="300px">

                            <input type="text" id="editID" name="editID" value="{{ old('editID') }}" hidden />

                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="required form-label">Jenis Lembur</label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_lembur_form" data-allow-clear="true"
                                    data-placeholder="Select an option" id="editJenisLembur" name="editJenisLembur">
                                    <option></option>
                                    <option value="HARI KERJA">HARI KERJA</option>
                                    <option value="HARI LIBUR">HARI LIBUR</option>
                                </select>
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Tanggal Lembur </label>
                                <input class="form-control form-control-solid" placeholder="Tanggal" id="kt_datepicker_edit_1" name="editTanggal" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Dari Jam </label>
                                <input class="form-control form-control-solid" placeholder="Waktu (Jam)" id="kt_datepicker_edit_2" name="editDariJam" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Sampai Jam</label>
                                <input class="form-control form-control-solid" placeholder="Waktu (Jam)" id="kt_datepicker_edit_3" name="editSampaiJam" tabindex="2"/>
                                <!--end::Notice-->
                            </div>
                            
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="required form-label">Pekerjaan Yang Dilakukan</label>
                                <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" id="editKeterangan" name="editKeterangan">{{ old('editKeterangan') }}</textarea>
                            </div>

                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-lemburnedt-modal-action="cancel">Reset</button>
                            <button type="button" class="btn btn-custom-purple" data-kt-lemburedt-modal-action="submit" id="buttonUpdateLembur">
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
        $('#kt_modal_add_lembur').modal({backdrop: 'static', keyboard: false})
        $('#kt_modal_update_lembur').modal({backdrop: 'static', keyboard: false})
    });

    $("#search1").flatpickr();
    $("#kt_daterangepicker_1").flatpickr();
    $("#kt_daterangepicker_2").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
    $("#kt_daterangepicker_3").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    $("#kt_datepicker_edit_1").flatpickr();
    $("#kt_datepicker_edit_2").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
    $("#kt_datepicker_edit_3").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
    

    function search(){
    KTDatatablesServerSide.init();
    }

    var KTDatatablesServerSide = function () {
        var table;
        var dt;
        var filterPayment;

        var initDatatable = function () {
        var tanggal = document.getElementById("search1").value;

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
                    url: "{{ url('getlembur') }}",
                    data: { tanggal: tanggal},
                },
                columns: [
                    { data: 'jenis_lembur' },
                    { data: 'tanggal' },
                    { data: 'waktu' },
                    { data: 'waktu2' },
                    { data: 'keterangan' },
                    { data: 'total_jam_lembur' },
                    { data: 'status_approve' },
                    { data: 'approve_by' },
                    { data: 'approve_at' },
                    { data: 'id' },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data) {
                            if (data == 'HARI KERJA'){
                                return `
                                <span class="badge badge-light badge-sm"> HARI KERJA </span>
                                `;
                            }else{
                                return `
                                <span class="badge badge-secondary badge-sm"> HARI LIBUR </span>
                                `;
                            }
                        }
                    },
                    {
                        targets: 6,
                        orderable: false,
                        render: function (data) {
                            if (data == 0){
                                return `
                                <span class="badge badge-info badge-sm"> Pengajuan </span>
                                `;
                            }else if(data == 1){
                                return `
                                <span class="badge badge-success badge-sm"> Approved </span>
                                `;
                            }else if(data == 2){
                                return `
                                <span class="badge badge-danger badge-sm"> Reject </span>
                                `;
                            }
                        }
                    },
                    {
                        targets: 9,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <center>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="editLembur(`+data+`)"><span class="fas fa-pen"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="deleteLembur(`+data+`)"><span class="fas fa-trash"></span></i>
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

    function editLembur(id){   
        $.ajax({
        url: "/getonelembur/"+id,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                $('#editID').val(item.id);
                $('#kt_datepicker_edit_1').val(item.tanggal);
                // $('#kt_datepicker_edit_2').val(item.waktu);
                // $('#kt_datepicker_edit_3').val(item.waktu2);
                $('#editKeterangan').val(item.keterangan);
                $('#editJenisLembur').val(item.jenis_lembur).change();
                selectElement('editJenisLembur', val(item.jenis_lembur));
            });
        }
        });

        $('#kt_modal_update_lembur').modal('show');
    }
</script>

<script src="{{asset('assets/js/custom/apps/hris/validation_lembur.js')}}"></script>
@endsection