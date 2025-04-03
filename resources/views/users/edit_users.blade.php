@extends('layout.header')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user_update', ['u_id' => $user->u_id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="u_username">Username:</label> <span style="color: red;">*</span></label> 
                        <input type="text" class="form-control" id="u_username" name="u_username"
                            value="{{ $user->u_username }}">
                        @error('u_username')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="u_password">Password (leave blank to keep current):</label>
                        <input type="password" class="form-control" id="u_password" name="u_password">
                        @error('u_password')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_fname">First Name:</label> <span style="color: red;">*</span></label> 
                        <input type="text" class="form-control" id="u_fname" name="u_fname"
                            value="{{ $user->u_fname }}">
                        @error('u_fname')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_mname">Middle Name:</label> <span style="color: red;">*</span></label> 
                        <input type="text" class="form-control" id="u_mname" name="u_mname"
                            value="{{ $user->u_mname }}">
                        @error('u_mname')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_lname">Last Name:</label> <span style="color: red;">*</span></label> 
                        <input type="text" class="form-control" id="u_lname" name="u_lname"
                            value="{{ $user->u_lname }}">
                        @error('u_lname')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_gender">Gender:</label> <span style="color: red;">*</span></label> 
                        <select class="form-control" id="u_gender" name="u_gender">
                            <option value="">Select Gender</option>
                            <option value="1" {{ $user->u_gender == 1 ? 'selected' : '' }}>Male</option>
                            <option value="0" {{ $user->u_gender == 0 ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('u_gender')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="u_contact">Contact:</label> <span style="color: red;">*</span></label> 
                        <input type="tel" class="form-control" id="u_contact" name="u_contact" placeholder="09365821564" pattern="09\d{9}" title="Contact number should be 11 digits and should start with 09 (e.g 09365821564)"
                            value="{{ $user->u_contact }}">
                        @error('u_contact')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="d_id">Department:</label> <span style="color: red;">*</span></label> 
                        <select class="form-control" id="d_id" name="d_id">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->d_id }}"
                                    {{ $user->d_id == $department->d_id ? 'selected' : '' }}>
                                    {{ $department->d_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('d_id')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="r_id">Roles:</label> <span style="color: red;">*</span></label> 
                        <select class="form-control" id="r_id" name="r_id">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->r_id }}"
                                    class="role-option {{ $role->r_id != 3 ? 'conditional-role' : '' }}"
                                    {{ $user->r_id == $role->r_id ? 'selected' : '' }}>
                                    {{ $role->r_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('r_id')
                            <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="{{ route('user_list') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentSelect = document.getElementById('d_id');
            const roleSelect = document.getElementById('r_id');
            const conditionalRoles = document.querySelectorAll('.conditional-role');

            // Function to update roles based on selected department
            function updateRoles() {
                const selectedDepartment = departmentSelect.value;
                const currentRole = "{{ $user->r_id }}";

                // Hide all conditional roles first
                conditionalRoles.forEach(role => {
                    role.style.display = 'none';
                });

                // If department id is 1, show all roles
                if (selectedDepartment === '1') {
                    conditionalRoles.forEach(role => {
                        role.style.display = '';
                    });
                }

                // If the current role is hidden, reset selection
                if (roleSelect.selectedOptions[0].style.display === 'none') {
                    roleSelect.value = '';
                }
            }

            // Initial update
            updateRoles();

            // Listen for changes on department select
            departmentSelect.addEventListener('change', updateRoles);
        });
    </script>
@endsection
