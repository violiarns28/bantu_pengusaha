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
                        <table id="report-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Hours</th>
                                    <th>Total Overtime</th>
                                    <th>Total Day</th>
                                    <th>Total Day Off</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->totalHours }}</td>
                                        <td>{{ $item->totalOvertime }}</td>
                                        <td>{{ $item->totalDay }}</td>
                                        <td>{{ $item->totalDayOff }}</td>
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

            let table = $('#report-table').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                responsive: true
            });

            $('#start-date, #end-date').change(function() {
                // fetch api using ajax 
                $.ajax({
                    url: '/api/report/filter',
                    type: 'GET',
                    data: {
                        start_date: $('#start-date').val(),
                        end_date: $('#end-date').val()
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.success) {
                            table.clear().draw();
                            for (const item of res.data) {
                                table.row.add([
                                    item.name,
                                    item.totalHours,
                                    item.totalOvertime,
                                    item.totalDay,
                                    item.totalDayOff
                                ]).draw(false)
                            }
                        } else {
                            alert(res.message);
                        }
                    }
                });
            });

            $('#clear-button').on('click', function() {
                $('#start-date').val('');
                $('#end-date').val('');
                table.draw();
            });
        });
    </script>
@endsection
