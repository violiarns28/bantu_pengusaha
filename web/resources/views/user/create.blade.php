@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">User Detail</div>
                    @if (Route::has('user.store'))
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">

                                </div>
                                <div class="mt-2 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">

                                </div>

                                <div class="mt-2 form-group">
                                    <label for="mac_address">Device ID</label>
                                    <input type="text" class="form-control" id="mac_address" name="mac_address">

                                </div>

                                <div class="mt-2 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                </div>

                                <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
