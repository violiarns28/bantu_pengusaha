@extends('layouts.parent')

@section('content')

<style>
.M{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
			background-color: #32CD32;
		}

		.M:hover{
            background: rgb(72,170,43);
            background: linear-gradient(45deg, rgba(72,170,43,0.9002451322325805) 0%, rgba(99,194,71,0.8890406504398635) 0%, rgba(100,190,74,0.8554272050617122) 0%);
			color: white;	
		}

        .L{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
            background: rgb(255,201,65);
            background: linear-gradient(90deg, rgba(255,201,65,1) 0%, rgba(224,154,41,1) 100%);
			color: white;
		}

		.L:hover{
			background: rgb(237,192,79);
            background: linear-gradient(38deg, rgba(237,192,79,0.9086484935771183) 0%, rgba(224,184,53,0.8498249641653537) 50%, rgba(252,197,69,0.8190126392353816) 100%);
			color: white;	
		}

        .I{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
            background: rgb(255,201,65);
            background: linear-gradient(90deg, rgba(255,201,65,1) 0%, rgba(224,154,41,1) 100%);
			color: white;
		}

		.I:hover{
			background: rgb(237,192,79);
            background: linear-gradient(38deg, rgba(237,192,79,0.9086484935771183) 0%, rgba(224,184,53,0.8498249641653537) 50%, rgba(252,197,69,0.8190126392353816) 100%);
			color: white;	
		}

        .S{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
            background: rgb(255,201,65);
            background: linear-gradient(90deg, rgba(255,201,65,1) 0%, rgba(224,154,41,1) 100%);
			color: white;
		}

		.S:hover{
			background: rgb(237,192,79);
            background: linear-gradient(38deg, rgba(237,192,79,0.9086484935771183) 0%, rgba(224,184,53,0.8498249641653537) 50%, rgba(252,197,69,0.8190126392353816) 100%);
			color: white;	
		}

        .C{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
            background: rgb(255,201,65);
            background: linear-gradient(90deg, rgba(255,201,65,1) 0%, rgba(224,154,41,1) 100%);
			color: white;
		}

		.C:hover{
			background: rgb(237,192,79);
            background: linear-gradient(38deg, rgba(237,192,79,0.9086484935771183) 0%, rgba(224,184,53,0.8498249641653537) 50%, rgba(252,197,69,0.8190126392353816) 100%);
			color: white;	
		}

        .A{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
            background: rgb(209,30,51);
            background: linear-gradient(11deg, rgba(209,30,51,0.8274160005799195) 0%, rgba(233,10,26,0.8498249641653537) 43%);
			color: white;
		}

		.A:hover{
			background: rgb(175,26,44);
            background: linear-gradient(97deg, rgba(175,26,44,1) 0%, rgba(179,48,57,1) 43%);
			color: white;	
		}
</style>

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Schedule Presensi</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Data Schedule Presensi</li>
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
                                <input type="text" id="search1" name="nama" class="form-control" placeholder="Search Nomor Here"  />
                            </div>

                            <button type="button" class="btn btn-custom-light-purple btn-sm" onclick="search()">
                                <span class="fas fa-search"></span>
                            </button>
                        </div>

                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
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
                            <th class="min-w-100px">Created At</th>
                            <th class="min-w-100px">Nama</th>
                            <th class="min-w-100px">Nomor</th>
                            <th class="min-w-50px">Tipe</th>
                            <th class="min-w-100px">Tanggal</th>
                            <th class="min-w-100px">Clock In</th>
                            <th class="min-w-100px">Clock Out</th>
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

    <div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_schedule_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Add Schedule</h2>
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
                    <form id="kt_modal_add_schedule_form" class="form" action="{{ route('schedule.insert') }}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_schedule_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_schedule_header" data-kt-scroll-wrappers="#kt_modal_add_schedule_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->
                            <input type="text" id="id" name="id" hidden  />
                            
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Tipe Schedule</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Tipe Schedule" name="tipe_schedule" id="tipe_schedule" onchange="hideJam()">
                                    <option></option>
                                @foreach($listkodepresensi as $kdpresensi)
                                    <option value="{{$kdpresensi->kode_presensi}}">{{$kdpresensi->keterangan}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Nomor User</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_schedule" 
                                        data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true" multiple="multiple" id="nomor" name="nomor[]">
                                <!-- <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_schedule" data-allow-clear="true"
                                    data-placeholder="Select an option" id="nomor" name="nomor"> -->
                                @foreach($listuser as $user)
                                    <option value="{{$user->nomor}}">{{$user->nama}} ( {{$user->nomor}} )</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Tanggal Schedule 
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="List Tanggal Berapa Yang Akan Dibuat Schedule"></i></label>
                                <input class="form-control form-control-solid" placeholder="Tanggal" id="kt_daterangepicker_1" name="tanggal" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Jam Masuk
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Schedule Jam Masuk"></i></label>
                                <input class="form-control form-control-solid" placeholder="Jam Masuk" id="kt_daterangepicker_2" name="schedule_clock_in" tabindex="2"/>
                                <!--end::Notice-->
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Jam Pulang
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Schedule Jam Pulang"></i></label>
                                <input class="form-control form-control-solid" placeholder="Jam Pulang" id="kt_daterangepicker_3" name="schedule_clock_out" tabindex="2"/>
                                <!--end::Notice-->
                            </div>
                            
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-schedule-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-custom-purple" data-kt-schedule-modal-action="submit" id="buttonInsertSchedule">
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


    <div class="modal fade" id="kt_modal_update_schedule" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_schedule_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Edit Schedule</h2>
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
                    <form id="kt_modal_edit_schedule_form" class="form" action="{{url('/updateschedule')}}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_schedule_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_schedule_header" data-kt-scroll-wrappers="#kt_modal_add_schedule_scroll" data-kt-scroll-offset="300px">

                            <input type="text" id="editID" name="editID" value="{{ old('editID') }}" hidden />
                            
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Tipe Schedule</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Tipe Schedule" name="editTipeSchedule" id="editTipeSchedule" data-dropdown-parent="#kt_modal_update_schedule" data-allow-clear="true" onchange="hideJamEdit()">
                                    <option></option>
                                @foreach($listkodepresensi as $kdpresensi)
                                    <option value="{{$kdpresensi->kode_presensi}}">{{$kdpresensi->keterangan}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Nomor User</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_edit_schedule_form" data-allow-clear="true"
                                    data-placeholder="Select an option" id="editNomor" name="editNomor">
                                    <option></option>
                                @foreach($listuser as $user)
                                     <option value="{{$user->nomor}}">{{$user->nama}} ( {{$user->nomor}} )</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Select Date Schedule 
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Masukkan Tanggal Jadwal"></i></label>
                                <input class="form-control form-control-solid" placeholder="Tanggal" id="kt_daterangepicker_edit_1" name="editTanggal" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7" id="clock-in">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Jam Masuk
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Schedule Jam Masuk"></i></label>
                                <input class="form-control form-control-solid" placeholder="Jam Masuk" id="kt_daterangepicker_edit_2" name="editClockIn" tabindex="2"/>
                                <!--end::Notice-->
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Jam Pulang
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Schedule Jam Pulang"></i></label>
                                <input class="form-control form-control-solid" placeholder="Jam Pulang" id="kt_daterangepicker_edit_3" name="editClockOut" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-usersedt-modal-action="cancel">Reset</button>
                            <button type="button" class="btn btn-custom-purple" data-kt-usersedt-modal-action="submit" id="buttonUpdateSchedule">
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
        $('#kt_modal_add_schedule').modal({backdrop: 'static', keyboard: false})
        $('#kt_modal_update_schedule').modal({backdrop: 'static', keyboard: false})
    });

    $("#kt_daterangepicker_1").flatpickr({
        enableTime: false,
        mode: "multiple",
        dateFormat: "Y-m-d",
        onClose: function(selectedDates, dateStr, instance) {
        let daysInRange = document.getElementsByClassName('selected');
        // let daysLengthTotal = daysInRange.length;
        // document.getElementById('jmlhari').value = daysLengthTotal;
        // document.getElementById('jml').innerHTML = daysLengthTotal;
        }
    });

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

    $("#kt_daterangepicker_edit_1").flatpickr();

    $("#kt_daterangepicker_edit_2").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    $("#kt_daterangepicker_edit_3").flatpickr({
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
        var nomor_user = document.getElementById("search1").value;

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
                    url: "{{ url('getschedule') }}",
                    data: { nomor_user: nomor_user},
                },
                columns: [
                    { data: 'created_at' },
                    { data: 'nama' },
                    { data: 'nomor_user' },
                    { data: 'tipe_schedule' },
                    { data: 'tanggal' },
                    { data: 'clock_in' },
                    { data: 'clock_out' },
                    { data: 'id' },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data) {
                            return data.substring(0,10);
                        }
                    },
                    {
                        targets: 3,
                        orderable: false,
                        render: function (data) {
                            return `
                                    <span class="badge badge-circle `+data+` badge-sm">${data}</span>
                                `;
                        }
                    },
                    {
                        targets: 7,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <center>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="editSchedule(`+data+`)"><span class="fas fa-pen"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="deleteSchedule(`+data+`)"><span class="fas fa-trash"></span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge-lg">
                                    <a href="#" class="text-purple" 
                                        onclick="deleteBatchSchedule(`+data+`)">Delete Batch</i>
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

    function editSchedule(id){   
        $.ajax({
        url: "/getoneschedule/"+id,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                $('#editID').val(item.id);
                $('#editNomor').val(item.nomor);
                $('#kt_daterangepicker_edit_1').val(item.tanggal);
                $('#kt_daterangepicker_edit_2').val(item.clock_in);
                $('#kt_daterangepicker_edit_3').val(item.clock_out);
                $('#editTipeSchedule').val(item.tipe_schedule);
                $('#editNomor').val(item.nomor_user).change();
                selectElement('editNomor', val(item.nomor_user));
                $('#editTipeSchedule').val(item.kode_presensi).change();
                selectElement('editTipeSchedule', val(item.kode_presensi));
            });
        }
        });

        $('#kt_modal_update_schedule').modal('show');
    }

    function hideJamEdit(){
       var kode_presensi = document.getElementById('editTipeSchedule').value;

       $.ajax({
        url: "/getonekodepresensi/"+kode_presensi,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                if (item.hitung_hari_kerja == 0){
                    document.getElementById('kt_daterangepicker_edit_2').value = '00:00';
                    document.getElementById('kt_daterangepicker_edit_3').value = '00:00';
                }
            });
        }
        });
    }

    function hideJam(){
       var kode_presensi = document.getElementById('tipe_schedule').value;

       $.ajax({
        url: "/getonekodepresensi/"+kode_presensi,
        type: 'GET',
        success: function(data) {
            $.each(data, function(index, item) {
                if (item.hitung_hari_kerja == 0){
                    document.getElementById('kt_daterangepicker_2').value = '00:00';
                    document.getElementById('kt_daterangepicker_3').value = '00:00';
                }
            });
        }
        });
    }
</script>

<script src="{{asset('assets/js/custom/apps/hris/validation_schedule.js')}}"></script>
@endsection