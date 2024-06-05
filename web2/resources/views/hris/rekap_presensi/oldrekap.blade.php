@extends('layouts.parent')

@section('content')
<style>
        th:first-child, td:first-child{
            position: sticky;
            left: 0px;
            z-index: 1;
        }
        th:nth-child(2), td:nth-child(2){
            position: sticky;
            left: 100px;
            z-index: 1;
        }

        .issunday{
            /* background: rgb(251,63,63) !important;
            background: linear-gradient(315deg, rgba(251,63,63,0.771393591616334) 0%, rgba(252,70,107,0.5417017148656338) 100%) !important; */

            background-color: #F5DBD5 !important;
        }

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

        .X{
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
            background: rgb(196,196,205);
            background: linear-gradient(20deg, rgba(196,196,205,0.9618697820925245) 0%, rgba(223,223,227,0.9310574571625525) 35%);
			color: white;
		}

		.X:hover{
			background: rgb(177,177,186);
            background: linear-gradient(0deg, rgba(177,177,186,0.8498249641653537) 0%, rgba(197,197,208,1) 100%);
			color: white;	
		}

        
</style>

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Rekap Presensi</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Data Rekap Presensi</li>
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
                <form method="GET" action="/rekappresensi">
                    <div class="d-flex align-items-center position-relative my-1">
                        <div class="input-group input-group-sm" style="margin-right: 2px;">
                            <input class="form-control form-control" placeholder="From Date" id="kt_daterangepicker_1" name="from_date" tabindex="2"/>
                        </div>

                        <div class="input-group input-group-sm" style="margin-right: 2px;">
                            <input class="form-control form-control" placeholder="To Date" id="kt_daterangepicker_2" name="to_date" tabindex="2"/>
                        </div>
                        <button type="submit" class="btn btn-custom-light-purple btn-sm">
                            <span class="fas fa-search"></span>
                        </button>
                    </div>
                </form>
                    <!--end::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_rekap">
                                <span class="fas fa-sync-alt"></span>
                                Rekap Presensi</button>
                        </div>
                </div>

                    
                    <?php 
                        $start_date = new DateTime($from_date);
                        $end_date = new DateTime($to_date);
                        $end_date->modify('+1 day');
                        $interval = DateInterval::createFromDateString('1 day');
                        $date_range = new DatePeriod($start_date, $interval, $end_date);
            
                        $list_nama_bulan = array();

                        foreach($date_range as $date){
                            array_push($list_nama_bulan, $date->format('F'));
                        }
                    ?>
                    
                    <!--begin::Datatable-->
                    <table id="kt_datatable_example_1" class="table table-sm table-hover align-middle table-row-dashed">
                        <thead>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th></th>
                            <th></th>
                            <?php 
                                foreach(array_count_values($list_nama_bulan) as $k => $v){
                            ?>
                            <th colspan="<?php echo $v;?>"><center><?php echo $k;?></center></th>
                            <?php 
                                }
                            ?>
                        </tr>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th style="background-color: #F5DBD5 !important; color: #9E2C11 !important;"></th>
                            <th style="background-color: #F5DBD5 !important; color: #9E2C11 !important;"></th>
                            @foreach ($date_range as $date)
                                @if ($date->format('l') == 'Sunday')
                                    <th class="issunday" style="font-size: 12px !important; padding: 1px !important; background-color: #F5DBD5 !important; color: #9E2C11 !important;"><center>{{ $date->format('D') }}</center></th>
                                @else
                                    <th style="font-size: 12px !important; padding: 1px !important; background-color: #F5DBD5 !important; color: #9E2C11 !important;"><center>{{ $date->format('D') }}</center></th>
                                @endif
                            @endforeach
                        </tr>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-100px" style="background-color: #F5DBD5 !important; color: #9E2C11 !important;">Nomor</th>
                            <th class="min-w-125px" style="background-color: #F5DBD5 !important; color: #9E2C11 !important;">Nama</th>
                            @foreach ($date_range as $date)
                                @if ($date->format('l') == 'Sunday')
                                    <th class="issunday"><center>{{ $date->format('d') }}</center></th>
                                @else
                                    <th><center>{{ $date->format('d') }}</center></th>
                                @endif
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-semibold">
                        @foreach($listuser as $user)
                            <tr>
                                <td class="bg-light">{{ $user->nomor }}</td>
                                <td class="bg-light">{{ $user->nama }}</td>
                                @foreach ($date_range as $date)
                                    @if ($date->format('l') == 'Sunday')
                                        <td class="issunday">
                                    @else
                                        <td>
                                    @endif
                                    @foreach($listrekap as $rekap)
                                        @if ($rekap->nomor_user == $user->nomor && $rekap->tanggal == $date->format('Y-m-d'))
                                                <span class="badge badge-circle {{$rekap->class_badge}} badge-sm">
                                                    <a href="#" class="text-gray-200" 
                                                        onclick="infoSchedule('{{ $rekap->id }}')">{{$rekap->tipe_schedule}}</i>
                                                    </a>
                                                </span>
                                        @endif
                                    @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
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

    <div class="modal fade" id="kt_modal_add_rekap" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_rekap_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Kalkulasi Rekap Presensi</h2>
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
                    <form id="kt_modal_add_rekap_form" class="form" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_rekap_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_rekap_header" data-kt-scroll-wrappers="#kt_modal_add_rekap_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->                            
                            <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">From Date Rekap</label>
                            <div class="input-group input-group-sm" style="margin-right: 2px;">
                                <input class="form-control form-control" placeholder="From Date" id="kt_daterangepicker_3" name="from_date_rekap" tabindex="2"/>
                            </div>
                            <!--end::Input-->
                            </div>
                            <!--begin::Input-->                            
                            <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">To Date Rekap</label>
                            <div class="input-group input-group-sm" style="margin-right: 2px;">
                                <input class="form-control form-control" placeholder="From Date" id="kt_daterangepicker_4" name="to_date_rekap" tabindex="2"/>
                            </div>
                            <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-rekap-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-custom-purple" data-kt-users-modal-action="submit" id="buttonInsertRekap">
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

    <div class="modal fade" id="kt_modal_info_schedule" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_info_schedule_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Info Schedule</h2>
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
                    <form id="kt_modal_info_schedule_form" class="form" action="#" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_info_schedule_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_info_schedule_header" data-kt-scroll-wrappers="#kt_modal_info_schedule_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <input type="text" id="schedule_id" name="schedule_id" value="{{ old('schedule_id') }}" hidden/>
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon3">Nama User</span>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" aria-describedby="basic-addon3" readonly/>
                            </div>
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon3">Tanggal</span>
                                <input type="text" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" aria-describedby="basic-addon3" readonly/>
                            </div>
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon3">Schedule Clock In</span>
                                <input type="text" class="form-control" id="clock_in" name="clock_in" value="{{ old('clock_in') }}" aria-describedby="basic-addon3" readonly/>
                            </div>
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon3">Schedule Clock Out</span>
                                <input type="text" class="form-control" id="clock_out" name="clock_out" value="{{ old('clock_out') }}" aria-describedby="basic-addon3" readonly/>
                            </div>
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <!-- <button type="reset" class="btn btn-light me-3" data-kt-schedule-modal-action="cancel">Reset</button> -->
                                <button type="button" class="btn btn-danger" data-kt-schedule-modal-action="submit" id="buttonDeleteSchedule">
                                <span class="indicator-label">Delete</span>
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
        $('#kt_modal_info_schedule').modal({backdrop: 'static', keyboard: false})
    });


    $("#kt_datatable_example_1").DataTable({
        scrollX: true,
        ordering : false,
    });

    $("#kt_daterangepicker_1").flatpickr();
    $("#kt_daterangepicker_2").flatpickr();
    $("#kt_daterangepicker_3").flatpickr();
    $("#kt_daterangepicker_4").flatpickr();
</script>

<script src="{{asset('assets/js/custom/apps/hris/validation_rekap_presensi.js')}}"></script>
@endsection