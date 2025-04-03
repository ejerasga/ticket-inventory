<!-- Updated edit blade file -->
@extends('layout.header')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit PR Request</h1>
        </div>

        <!-- Edit PR Request Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit PR Request Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('prrequests.update', $prRequest->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="requestor_name" class="form-label">Requestor Name</label> <span style="color: red;">*</span>
                            <input type="text" class="form-control" id="requestor_name" name="requestor_name"
                                value="{{ old('requestor_name', $prRequest->requestor_name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="department_id" class="form-label">Department</label> <span style="color: red;">*</span>
                            <select class="form-control" id="department_id" name="department_id" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->d_id }}"
                                        {{ old('department_id', $prRequest->department_id) == $department->d_id ? 'selected' : '' }}>
                                        {{ $department->d_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="item" class="form-label">Item</label> <span style="color: red;">*</span>
                            <input type="text" class="form-control" id="item" name="item"
                                value="{{ old('item', $prRequest->item) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="qty" class="form-label">Quantity</label> <span style="color: red;">*</span>
                            <input type="number" class="form-control" id="qty" name="qty"
                                value="{{ old('qty', $prRequest->qty) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="unit" class="form-label">Unit</label> <span style="color: red;">*</span>
                            <input type="text" class="form-control" id="unit" name="unit"
                                value="{{ old('unit', $prRequest->unit) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date_requested" class="form-label">Date Requested</label> <span style="color: red;">*</span>
                            <input type="date" class="form-control" id="date_requested" name="date_requested"
                                value="{{ $prRequest->date_requested ? $prRequest->date_requested->format('Y-m-d') : old('date_requested') }}" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="purpose" class="form-label">Purpose</label> <span style="color: red;">*</span>
                            <textarea class="form-control" id="purpose" name="purpose" rows="3" required>{{ old('purpose', $prRequest->purpose) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="arrived" class="form-label">Arrived?</label> <span style="color: red;">*</span>
                            <select class="form-control" id="arrived" name="arrived" required>
                                <option value="1" {{ old('arrived', $prRequest->arrived) == 1 ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0" {{ old('arrived', $prRequest->arrived) == 0 ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="date_arrived_container">
                            <label for="date_arrived" class="form-label">Date Arrived</label> <span style="color: red;">*</span>
                            <input type="date" class="form-control" id="date_arrived" name="date_arrived"
                                value="{{ old('date_arrived', optional($prRequest->date_arrived)->format('Y-m-d')) }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ old('remarks', $prRequest->remarks) }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('prrequests.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show/Hide "Date Arrived" field based on current "Arrived?" selection
        document.addEventListener('DOMContentLoaded', function() {
            const arrivedSelect = document.getElementById('arrived');
            const dateArrivedField = document.getElementById('date_arrived_container');

            // Set initial state
            updateDateArrivedVisibility();

            // Add change event listener
            arrivedSelect.addEventListener('change', updateDateArrivedVisibility);

            function updateDateArrivedVisibility() {
                if (arrivedSelect.value === '1') {
                    dateArrivedField.style.display = 'block';
                } else {
                    dateArrivedField.style.display = 'none';
                }
            }
        });
    </script>
@endsection
