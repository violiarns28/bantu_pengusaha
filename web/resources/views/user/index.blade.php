@extends('layouts.app')

@section('content')
    {{-- Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            @if (Route::has('user.destroy'))
                <form id="deleteForm" method="POST" action="{{ route('user.destroy', 0) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (Route::has('user.create'))
                    <a href="{{ route('user.create') }}" type="button" class="mb-2 btn btn-info">+ Add User</a>
                @endif
                <div class="card">
                    <div class="card-header">User List</div>

                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Device ID</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mac_address }}</td>
                                        <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('user.edit', $item->id) }}" type="button"
                                                class="btn btn-warning">Edit</a>
                                            <button id='user-delete' type="button" class="btn btn-danger"
                                                data-bs-id="{{ $item->id }}">Delete</button>
                                        </td>
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


            $('#example').on('click', '#user-delete', function() {
                var id = $(this).data('bs-id');
                $('#deleteForm').attr('action', '/user/' + id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
@endsection
