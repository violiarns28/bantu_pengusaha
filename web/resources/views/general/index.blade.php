@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">General</div>
                    <form action="{{ route('general.update_location') }}" method="POST">
                        @csrf <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm">
                                    <label class="form-label">
                                        Latitude
                                    </label>
                                    <input id='latitude' type="text" class="form-control" name="lat"
                                        placeholder="Latitude" value="{{ $location->value->lat }}">
                                </div>
                                <div class="col-sm">
                                    <label class="form-label">
                                        Longtitude
                                    </label>
                                    <input id='longtitude' type="text" class="form-control" name="lng"
                                        placeholder="Longtitude" value="{{ $location->value->lng }}">
                                </div>
                                <div>
                                    <button id='save-button' class="btn btn-primary mt-2">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            @if (session('status') && session('message'))
                Swal.fire({
                    icon: '{{ session('status') }}',
                    title: '{{ session('message') }}'
                });
            @endif
        });
    </script>
@endsection
