@extends('layouts.parent')

@section('content')

<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-white fw-bold my-1 fs-3">Dashboard</h1>
            {{ Breadcrumbs::render('dashboard') }}
        </div>
        <div class="d-flex align-items-center py-3 py-md-1">

        </div>
    </div>
</div>


@endsection