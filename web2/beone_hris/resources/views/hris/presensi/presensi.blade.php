@extends('layouts.parent')

@section('content')
<?php 
//Hardware ID -> MAC Address
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $output = shell_exec('ipconfig /all');
        $pattern = '/([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})/';
        preg_match_all($pattern, $output, $matches);
        $mac = $matches[0][0];
    } else {
        $output = shell_exec('/sbin/ifconfig');
        $pattern = '/HWaddr\s(\S*)/';
        preg_match_all($pattern, $output, $matches);
        $mac = $matches[1][0];
    }
?>

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Presensi</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Data Presensi</li>
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
                        <!-- <div class="input-group input-group-sm">
                            <input type="text" id="search1" name="nama" class="form-control" placeholder="Ganti Input Date"  />
                        </div> -->
                        <div class="input-group input-group-sm" style="margin-right: 2px;">
                            <input class="form-control form-control" placeholder="Filter Date" id="search1" name="tanggal" tabindex="2"/>
                        </div>

                        <button type="button" class="btn btn-custom-light-purple btn-sm" onclick="search()">
                            <span class="fas fa-search"></span>
                        </button>
                    </div>

                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                        <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_presensi">
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
                        <th class="min-w-100px">Tanggal</th>
                        <th class="min-w-100px">Clock In</th>
                        <th class="min-w-100px">Clock Out</th>
                        <th class="min-w-100px">Latitude</th>
                        <th class="min-w-100px">Longitude</th>
                        <th class="min-w-100px">Perangkat</th>
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

    <div class="modal fade" id="kt_modal_add_presensi" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_presensi_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="modalTittle">Add Presensi</h2>
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
                    <!-- <div id="map" style="height: 200px"></div> -->

                    <?php 
                        // $lat = '-7.7716784';
                        // $lng = '112.202623';
                        
                        // $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key=AIzaSyCupfH41dviDTTUCUDeGCfjQejtKhQgrck";
                        
                        // $curl = curl_init();
                        // curl_setopt($curl, CURLOPT_URL, $url);
                        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        // $response = curl_exec($curl);
                        // curl_close($curl);
                        
                        // $json = json_decode($response);
                        
                        // if ($json->status == 'OK') {
                        //     $address = $json->results[0]->formatted_address;
                        //     echo $address;
                        // } else {
                        //     echo 'Geocode failed';
                        // }                      
                    ?>
                    <!--begin::Form-->
                    <form id="kt_modal_add_presensi_form" class="form" action="{{ route('presensi.insert') }}" method="POST">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_presensi_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_presensi_header" data-kt-scroll-wrappers="#kt_modal_add_presensi_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <!--begin::Input-->
                            <input type="text" id="id" name="id" hidden  />

                            <div class="fv-row d-flex flex-column mb-7">
                                <label for="" class="form-label">Lokasi Presensi</i></label>
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="Lokasi Presensi" name="lokasi_presensi">
                                    <option></option>
                                    <option value="KANTOR">KANTOR</option>
                                    <option value="KANTOR CABANG">KANTOR CABANG</option>
                                    <option value="WFH">WFH</option>
                                    <option value="LAINNYA">LAINNYA</option>
                                </select>
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Keterangan</label>
                                <input type="text" id="keterangan" 
                                                    name="keterangan" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Keterangan Presensi"  
                                                    required/>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Hardware ID / MAC Address</label>
                                <input type="text" id="hardware_id" 
                                                    name="hardware_id" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Hardware ID / MAC Address"
                                                    value = "{{ $mac }}"  
                                                    required readonly/>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Latitude</label>
                                <input type="text" id="latitude" 
                                                    name="latitude" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Koordinat Latitude"  
                                                    required/>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Longitude</label>
                                <input type="text" id="longitude" 
                                                    name="longitude" 
                                                    class="form-control form-control-solid mb-3 mb-lg-0" 
                                                    placeholder="Koordinat Longitude"  
                                                    required/>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Tanggal Presensi 
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="List Tanggal Berapa Yang Akan Dibuat Schedule"></i></label>
                                <input class="form-control form-control-solid" placeholder="Tanggal" id="kt_daterangepicker_1" name="tanggal" tabindex="2"/>
                                <!--end::Notice-->
                            </div>

                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Clock In
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Schedule Jam Masuk"></i></label>
                                <input class="form-control form-control-solid" placeholder="Clock In" id="kt_daterangepicker_2" name="clock_in" tabindex="2"/>
                                <!--end::Notice-->
                            </div>
                            <div class="fv-row d-flex flex-column mb-7">
                                <!--begin::Notice-->
                                <label class="d-flex align-items-center form-label mb-3 required">Clock Out
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Schedule Jam Pulang"></i></label>
                                <input class="form-control form-control-solid" placeholder="Clock Out" id="kt_daterangepicker_3" name="clock_out" tabindex="2"/>
                                <!--end::Notice-->
                            </div>
                            
                            <!--end::Input group-->

                        </div>
                        <div class="text-center pt-15">    
                                <button type="reset" class="btn btn-light me-3" data-kt-schedule-modal-action="cancel">Reset</button>
                                <button type="button" class="btn btn-custom-purple" data-kt-schedule-modal-action="submit" id="buttonInsertPresensi">
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
    function haversine(lat1, lon1, lat2, lon2) {
        var R = 6371000; 
        var dLat = toRadians(lat2 - lat1);
        var dLon = toRadians(lon2 - lon1);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var distance = R * c; 
        return distance;
    }

    function toRadians(degrees) {
        return degrees * (Math.PI / 180);
    }

    $(document).ready(function () {
        $('#kt_modal_add_presensi').modal({backdrop: 'static', keyboard: false})
    
        navigator.geolocation.getCurrentPosition(function(position) {
            // var latitude = position.coords.latitude;
            // var longitude = position.coords.longitude;
            // save to database
            
            // document.getElementById('latitude').value = latitude;
            // document.getElementById('longitude').value = longitude;

            /////////////////////////////////

            var latitude1 = position.coords.latitude;
            var longitude1 = position.coords.longitude;

            const latitude = latitude1;
            const longitude = longitude1;

            const titikAbsen = { 'latitude': -7.35852, 'longitude': 112.74131 };

            // Radius yang diizinkan (10 meter)
            const radiusDiizinkan = 10;

            const jarak = haversine(latitude, longitude, titikAbsen.latitude, titikAbsen.longitude);

            // alert("latitude:  " +latitude1+ "\n" + "longitude:   " +longitude1);

            if (jarak <= radiusDiizinkan) {
                // Simpan data absensi ke dalam database atau lakukan operasi lain
                document.getElementById('latitude').value = latitude1;
                document.getElementById('longitude').value = longitude1;
            } else {
                document.getElementById('latitude').value = "";
                document.getElementById('longitude').value = "";  
            }
        });
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

    $("#search1").flatpickr();

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
                    url: "{{ url('getpresensi') }}",
                    data: { tanggal: tanggal},
                },
                columns: [
                    { data: 'tanggal' },
                    { data: 'clock_in' },
                    { data: 'clock_out' },
                    { data: 'latitude' },
                    { data: 'longitude' },
                    { data: 'hardware_id' },
                ],
                columnDefs: [

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
</script>

<script src="{{asset('assets/js/custom/apps/hris/validation_presensi.js')}}"></script>
@endsection