@extends('layout.header')
    @section('content')


    <form action="{{ route('') }}" method="get" autocomplete="off">
        @csrf
        <label for="u_username">Username:</label><br>
        <input type="text" id="u_username" name="u_username"><br>
        @error('u_username')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_password">Password:</label><br>
        <input type="password" id="u_password" name="u_password"><br>
        @error('u_password')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_email">Email:</label><br>
        <input type="email" id="u_email" name="u_email"><br>
        @error('u_email')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_fname">First Name:</label><br>
        <input type="text" id="u_fname" name="u_fname"><br>
        @error('u_fname')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_mname">Middle Name:</label><br>
        <input type="text" id="u_mname" name="u_mname"><br>
        @error('u_mname')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_lname">Last Name:</label><br>
        <input type="text" id="u_lname" name="u_lname"><br>
        @error('u_lname')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_gender">Gender:</label><br>
        <input type="text" id="u_gender" name="u_gender"><br>
        @error('u_gender')
            <span class="error text-danger">{{ $message }}</span>
        @enderror

        <label for="u_contact">Contact:</label><br>
        <input type="tel" id="u_contact" name="u_contact" placeholder="0945-185-4051" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}""><br>

        <label for="u_sig">Signature:</label><br>
        <input type="text" id="u_sig" name="u_sig"><br>

        <label for="o_id">Organization ID:</label><br>
        <input type="text" id="o_id" name="o_id"><br>

        <label for="d_id">Department ID:</label><br>
        <input type="text" id="d_id" name="d_id"><br>

        <label for="r_id">Role ID:</label><br>
        <input type="text" id="r_id" name="r_id"><br>

        <label for="remember_token">Remember Token:</label><br>
        <input type="text" id="remember_token" name="remember_token"><br>

        <label for="is_active">Is Active:</label><br>
        <input type="text" id="is_active" name="is_active"><br>

        <button type="submit">Create User</button>
    </form>

@endsection