@extends('layout.header')
    @section('content')


/*************  ✨ Codeium Command 🌟  *************/
    <form action="{{ route('users.store') }}" method="post" autocomplete="off">
    <form action="{{ route('') }}" method="get" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="u_username">Username:</label>
            <input type="text" class="form-control" id="u_username" name="u_username" aria-describedby="emailHelp">
            @error('u_username')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_username">Username:</label><br>
        <input type="text" id="u_username" name="u_username"><br>
        @error('u_username')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_password">Password:</label>
            <input type="password" class="form-control" id="u_password" name="u_password">
            @error('u_password')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_password">Password:</label><br>
        <input type="password" id="u_password" name="u_password"><br>
        @error('u_password')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_email">Email:</label>
            <input type="email" class="form-control" id="u_email" name="u_email">
            @error('u_email')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_email">Email:</label><br>
        <input type="email" id="u_email" name="u_email"><br>
        @error('u_email')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_fname">First Name:</label>
            <input type="text" class="form-control" id="u_fname" name="u_fname">
            @error('u_fname')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_fname">First Name:</label><br>
        <input type="text" id="u_fname" name="u_fname"><br>
        @error('u_fname')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_mname">Middle Name:</label>
            <input type="text" class="form-control" id="u_mname" name="u_mname">
            @error('u_mname')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_mname">Middle Name:</label><br>
        <input type="text" id="u_mname" name="u_mname"><br>
        @error('u_mname')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_lname">Last Name:</label>
            <input type="text" class="form-control" id="u_lname" name="u_lname">
            @error('u_lname')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_lname">Last Name:</label><br>
        <input type="text" id="u_lname" name="u_lname"><br>
        @error('u_lname')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_gender">Gender:</label>
            <input type="text" class="form-control" id="u_gender" name="u_gender">
            @error('u_gender')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <label for="u_gender">Gender:</label><br>
        <input type="text" id="u_gender" name="u_gender"><br>
        @error('u_gender')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="u_contact">Contact:</label>
            <input type="tel" class="form-control" id="u_contact" name="u_contact" placeholder="0945-185-4051" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}">
        </div>
        <label for="u_contact">Contact:</label><br>
        <input type="tel" id="u_contact" name="u_contact" placeholder="0945-185-4051" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}""><br>

        <div class="form-group">
            <label for="d_id">Department ID:</label>
            <input type="text" class="form-control" id="d_id" name="d_id">
        </div>

        <div class="form-group">
            <label for="r_id">Role ID:</label>
            <input type="text" class="form-control" id="r_id" name="r_id">
        </div>
        <label for="d_id">Department ID:</label><br>
        <input type="text" id="d_id" name="d_id"><br>

        <button type="submit" class="btn btn-primary">Create User</button>
        <label for="r_id">Role ID:</label><br>
        <input type="text" id="r_id" name="r_id"><br>

        <button type="submit">Create User</button>
    </form>
/******  107b7f67-2dc6-46f6-8d53-5f081a750a09  *******/

@endsection