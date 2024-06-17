@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Attendance Recap</div>
                    <div class="card-body"> 
                        <div class="row mb-4">
                            <div class="col-sm">
                                <label class="form-label">
                                    Start Date
                                </label>
                                <input id='start-date' type="date" class="form-control" placeholder="Start Date">
                            </div>
                            <div class="col-sm">
                                <label class="form-label">
                                    End Date
                                </label>
                                <input id='end-date' type="date" class="form-control" placeholder="End Date">
                            </div>
                            <div>
                                <button id='clear-button' class="btn btn-secondary mt-2">Clear</button>
                            </div>
                        </div>
                        <table id="attendance-table" class="table table-striped" style="width:100%">
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
                                @foreach ($attendances as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->clock_in }}</td>
                                        <td>{{ $item->clock_out }}</td>
                                        <td>{{ $item->latitude }}, {{ $item->longitude }}</td>
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
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                let start = $('#start-date').val() ? new Date($('#start-date').val()) : null;
                let end = $('#end-date').val() ? new Date($('#end-date').val()) : null;
                let date = new Date(data[1]);

                if ((start === null && end === null) ||
                    (start === null && date <= end) ||
                    (start <= date && end === null) ||
                    (start <= date && date <= end)) {
                    return true;
                }
                return false;
            });

            let table = $('#attendance-table').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });

            $('#start-date, #end-date').change(function() {
                table.draw();
            });

            $('#clear-button').on('click', function() {
                $('#start-date').val('');
                $('#end-date').val('');
                table.draw();
            });
        });
    </script>
@endsection
