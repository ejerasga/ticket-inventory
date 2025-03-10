@extends('layout.header')
    @section('content')


    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Users</h1>
        </div> --}}

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Users</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user_save') }}" method="POST" auto>
                    @csrf
                    <div class="form-group">
                        <label for="u_username">Username:</label>
                        <input type="text" class="form-control" id="u_username" name="u_username" aria-describedby="emailHelp">
                        @error('u_username')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_password">Password:</label>
                        <input type="password" class="form-control" id="u_password" name="u_password">
                        @error('u_password')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_fname">First Name:</label>
                        <input type="text" class="form-control" id="u_fname" name="u_fname">
                        @error('u_fname')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_mname">Middle Name:</label>
                        <input type="text" class="form-control" id="u_mname" name="u_mname">
                        @error('u_mname')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_lname">Last Name:</label>
                        <input type="text" class="form-control" id="u_lname" name="u_lname">
                        @error('u_lname')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_gender">Gender:</label>
                        <select class="form-control" id="u_gender" name="u_gender">
                            <option value="">Select Gender</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                        @error('u_gender')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_contact">Contact:</label>
                        <input type="tel" class="form-control" id="u_contact" name="u_contact" placeholder="09451854051" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}">
                    </div>

                    <div class="form-group">
                        <label for="d_id">Department:</label>
                        <select class="form-control" id="d_id" name="d_id">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->d_id }}">{{ $department->d_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="d_id">Roles:</label>
                        <select class="form-control" id="r_id" name="r_id">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->r_id }}">{{ $role->r_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>
        </div>

    </div>

@endsection