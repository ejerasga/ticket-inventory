@extends('layout.header')
@section('content')
    <!-- Users Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <!-- Success message display -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search users...">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="d-none">ID</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="d-none">{{ $user->u_id }}</td>
                                <td>{{ $user->u_username }}</td>
                                <td>{{ $user->u_fname }} {{ $user->u_mname }} {{ $user->u_lname }}</td>
                                <td>{{ $user->department->d_name }}</td>
                                <td>{{ $user->u_gender == 1 ? 'Male' : 'Female' }}</td>
                                <td>{{ $user->u_contact }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('user_edit', ['u_id' => $user->u_id]) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user_delete', ['u_id' => $user->u_id]) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const usersTable = document.getElementById('usersTable');
        const rows = usersTable.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                const rowText = rows[i].textContent.toLowerCase();
                rows[i].style.display = rowText.includes(searchTerm) ? '' : 'none';
            }
        });
    });
</script>
