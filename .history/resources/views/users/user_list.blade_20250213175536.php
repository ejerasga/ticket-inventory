@extends('layout.header')
@section('content')

<div class="container mt-4">
    <h2>User List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->u_id }}</td>
                <td>{{ $user->u_username }}</td>
                <td>{{ $user->u_fname }} {{ $user->u_mname }} {{ $user->u_lname }}</td>
                <td>{{ $user->u_gender == 1 ? 'Male' : 'Female' }}</td>
                <td>{{ $user->u_contact }}</td>
                <td>
                    <a href="{{ route('user_profile', ['u_id' => Auth::user()->u_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
