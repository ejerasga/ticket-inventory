@extends('layout.header')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">PR Requests</h1>
    </div>

    <!-- Add New PR Request Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create PR Request</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('prrequests.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="requestor_name" class="form-label">Requestor Name</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="requestor_name" name="requestor_name"
                            value="{{ old('requestor_name') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="department_id" class="form-label">Department</label> <span style="color: red;">*</span>
                        <select class="form-control" id="department_id" name="department_id" required>
                            <option value="">Select Department</option>
                            @foreach (App\Models\Department::all() as $department)
                                <option value="{{ $department->d_id }}"
                                    {{ old('department_id') == $department->d_id ? 'selected' : '' }}>
                                    {{ $department->d_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3"> 
                        <label for="item" class="form-label">Item</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="item" name="item"
                            value="{{ old('item') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="qty" class="form-label">Quantity</label> <span style="color: red;">*</span>
                        <input type="number" class="form-control" id="qty" name="qty"
                            value="{{ old('qty') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="unit" class="form-label">Unit</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="unit" name="unit"
                            value="{{ old('unit') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_requested" class="form-label">Date Requested</label> <span style="color: red;">*</span>
                        <input type="date" class="form-control" id="date_requested" name="date_requested"
                            value="{{ old('date_requested') }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="purpose" class="form-label">Purpose</label> <span style="color: red;">*</span>
                        <textarea class="form-control" id="purpose" name="purpose" rows="3" required>{{ old('purpose') }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="arrived" class="form-label">Arrived?</label> <span style="color: red;">*</span>
                        <select class="form-control" id="arrived" name="arrived" required>
                            <option value="1" {{ old('arrived') == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('arrived') == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="date_arrived_container" style="display: none;">
                        <label for="date_arrived" class="form-label">Date Arrived</label>
                        <input type="date" class="form-control" id="date_arrived" name="date_arrived"
                            value="{{ old('date_arrived') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- PR Requests Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">PR Requests</h6>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search requests...">
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered" id="prRequestsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Requestor Name</th>
                            <th>Department</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Purpose</th>
                            <th>Date Requested</th>
                            <th>Arrived?</th>
                            <th>Date Arrived</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prRequests as $prRequest)
                            <tr>
                                <td>{{ $prRequest->requestor_name }}</td>
                                <td>{{ $prRequest->department->d_name }}</td>
                                <td>{{ $prRequest->item }}</td>
                                <td>{{ $prRequest->qty }}</td>
                                <td>{{ $prRequest->unit }}</td>
                                <td>{{ $prRequest->purpose }}</td>
                                <td>{{ $prRequest->date_requested }}</td>
                                <td>{{ $prRequest->arrived ? 'Yes' : 'No' }}</td>
                                <td>{{ $prRequest->date_arrived }}</td>
                                <td>{{ $prRequest->remarks }}</td>
                                <td>
                                    <a href="{{ route('prrequests.edit', $prRequest->id) }}"
                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('prrequests.destroy', $prRequest->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this PR request?')">
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
</div>

<script>
    // Show/Hide "Date Arrived" field based on the "Arrived?" dropdown
    document.addEventListener('DOMContentLoaded', function() {
        var arrivedSelect = document.getElementById('arrived');
        var dateArrivedContainer = document.getElementById('date_arrived_container');
        
        // Set initial visibility
        if (arrivedSelect.value == '1') {
            dateArrivedContainer.style.display = 'block';
        } else {
            dateArrivedContainer.style.display = 'none';
        }
        
        // Add change event listener
        arrivedSelect.addEventListener('change', function() {
            if (this.value == '1') {
                dateArrivedContainer.style.display = 'block';
            } else {
                dateArrivedContainer.style.display = 'none';
            }
        });
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#prRequestsTable tbody tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>
@endsection