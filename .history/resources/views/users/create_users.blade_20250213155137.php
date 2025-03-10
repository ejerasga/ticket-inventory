@extends('layout.header')
    @section('content')


    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <form action="" method="post" autocomplete="off">
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
                <label for="u_email">Email:</label>
                <input type="email" class="form-control" id="u_email" name="u_email">
                @error('u_email')
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
                <input type="text" class="form-control" id="u_gender" name="u_gender">
                @error('u_gender')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="u_contact">Contact:</label>
                <input type="tel" class="form-control" id="u_contact" name="u_contact" placeholder="0945-185-4051" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}">
            </div>

            <div class="form-group">
                <label for="d_id">Department ID:</label>
                <input type="text" class="form-control" id="d_id" name="d_id">
            </div>

            <div class="form-group">
                <label for="r_id">Role ID:</label>
                <input type="text" class="form-control" id="r_id" name="r_id">
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>

    </div>

@endsection