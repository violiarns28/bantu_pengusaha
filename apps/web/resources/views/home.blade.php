@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Attendance Recap</div>

                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Time</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Location (Latitude, Longitude)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->clock_in}}</td>
                                <td>{{$item->clock_out}}</td>
                                <td>{{$item->latitude}}, {{$item->longitude}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
<script type="text/javascript" class="init">
    $(document).ready(function() {
        var table = $('#example').DataTable({
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        });
    });
</script>

@endsection