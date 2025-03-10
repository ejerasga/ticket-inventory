@extends('layout.header')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Ticket</h6>
        </div>
        <div class="card-body">
            <form id="ticketForm" action="{{ route('ticket_save') }}" method="POST">
                @csrf
                <div class="col-xl-12">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="small mb-1" for="s_id">Service Type</label>
                            <select class="form-control" id="s_id" name="s_id" required>
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->s_id }}">{{ $service->s_name }}</option>
                                @endforeach
                            </select>
                            @error('u_lname')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="l_id">Located at?</label>
                                <select class="form-control" id="l_id" name="l_id" required>
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->l_id }}">{{ $location->located_at }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="d_id">Department:</label>
                                <select class="form-control" id="d_id" name="d_id" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->d_id }}">{{ $department->d_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="f_name">First name</label>
                                <input class="form-control" id="f_name" name="f_name" type="text" placeholder="Enter your first name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="l_name">Last name</label>
                                <input class="form-control" id="l_name" name="l_name" type="text" placeholder="Enter your last name" required>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="date_needed">Date Needed</label>
                                <input class="form-control" id="date_needed" name="date_needed" type="date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="time_needed">Time Needed</label>
                                <input class="form-control" id="time_needed" name="time_needed" type="time" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
