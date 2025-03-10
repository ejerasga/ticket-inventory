@extends('layout.header')
    @section('content')


    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Users</h1>
        </div> --}}

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Ticket</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user_save') }}" method="POST">
                    @csrf
                    

                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>

    </div>

@endsection