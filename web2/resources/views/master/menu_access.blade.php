@extends('layouts.parent')

@section('content')

<!-- Title & Breadcrumbs -->
<div class="toolbar py-5 py-lg-10" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
            <div class="page-title d-flex flex-column me-3">
                <h1 class="d-flex text-white fw-bold my-1 fs-3">Menu Access</h1>
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
                    <li class="breadcrumb-item text-white opacity-75">Menu Access</li>
                    <li class="breadcrumb-item">
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center py-3 py-md-1">

            </div>
        </div>
    </div>
<!-- End Title & Breadcrumbs -->

<form id="kt_update_menu_access_form" class="form" method="POST">
@csrf
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

                    <!--begin::Datatable-->
                    <table id="kt_datatable_example_1" class="table table-sm table-hover align-middle table-row-dashed table-striped">
                        <thead>
                        <tr class="text-start text-black-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Nama Menu</th>
                            @foreach($listaccess as $access)
                            <th class="min-w-125px">{{ $access['nama'] }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        @php
                            $isChecked = false
                        @endphp

                        @foreach($listmenu as $menu)
                            <tr>
                                @if($menu->parent_id == 0)
                                    <td>{{ $menu->nama }} <span class="badge badge-success">Is Parent</span></td>
                                @else
                                    <td>{{ $menu->nama }}</td>
                                @endif
                                @foreach($listaccess as $access)
                                    @foreach($listmenuaccess as $menuaccess)
                                        @if($menuaccess->menu_id == $menu->id && $menuaccess-> access_id == $access->id)
                                            @php
                                                $isChecked = true;
                                                break;
                                            @endphp
                                        @else
                                            @php
                                                $isChecked = false;
                                            @endphp
                                        @endif
                                    @endforeach

                                        @if($isChecked)
                                                <td style="text-align: center"><input class="form-check-input" type="checkbox" name="menu_access[]" value="{{$menu->id}}-{{$access->id}}" checked></td>
                                        @else
                                                <td style="text-align: center"><input class="form-check-input" type="checkbox" name="menu_access[]" value="{{$menu->id}}-{{$access->id}}"></td>
                                        @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end::Datatable-->
                </div>
                <!--end::Card body-->
                    <button type="button" class="btn btn-custom-purple" data-kt-menuedt-modal-action="submit" id="buttonUpdateMenuAccess">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->
</form>

@endsection

@section('scripts')

<script src="{{asset('assets/js/custom/apps/user-management/menu_access/validation_menu_access.js')}}"></script>

@endsection