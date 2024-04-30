@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Data Approval</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Data Approval</li>
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

                        <!-- <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <button type="button" class="btn btn-custom-purple btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_pengajuan">
                                <span class="fas fa-plus"></span>
                                Add New</button>
                        </div> -->
                        <!--end::Toolbar-->

                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Datatable-->
                    <table id="kt_datatable_example_1" class="table table-sm table-hover align-middle table-row-dashed">
                        <thead>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-80px">Nama</th>
                            <th class="min-w-80px">Nomor</th>
                            <th class="min-w-80px">Jenis Pengajuan</th>
                            <th class="min-w-80px">From Date</th>
                            <th class="min-w-80px">To Date</th>
                            <th class="min-w-50px">Dari Jam</th>
                            <th class="min-w-50px">Sampai Jam</th>
                            <th class="min-w-100px">Keterangan</th>
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
                    url: "{{ url('getapproval') }}",
                    data: { tanggal: tanggal},
                },
                columns: [
                    { data: 'nama' },
                    { data: 'nomor_user' },
                    { data: 'jenis_pengajuan' },
                    { data: 'tanggal' },
                    { data: 'tanggal2' },
                    { data: 'waktu' },
                    { data: 'waktu2' },
                    { data: 'keterangan' },
                    { data: 'id'},
                ],
                columnDefs: [
                    {
                        targets: 8,
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <td class="text-end">
                                <center>
                                <span class="badge btn-custom-light-purple badge">
                                    <a href="#" class="text-purple" 
                                        onclick="approve('`+row.id+`', '`+row.jenis_pengajuan+`')"> Approve </span></i>
                                    </a>
                                </span>
                                <span class="badge btn-custom-light-purple badge">
                                    <a href="#" class="text-purple" 
                                        onclick="reject('`+row.id+`', '`+row.jenis_pengajuan+`')"> Reject </span></i>
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

</script>

<script src="{{asset('assets/js/custom/apps/hris/validation_approval.js')}}"></script>
@endsection