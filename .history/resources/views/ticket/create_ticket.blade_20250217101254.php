@extends('layout.header')
    @section('content')


    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Ticket</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('ticket_save') }}" method="POST">
                    @csrf
                    <div class="col-xl-12">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="s_id">Service Type</label>
                                <select class="form-control" id="s_id" name="s_id">
                                    <option value="">Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->s_id }}">{{ $service->s_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="l_id">Located at?</label>
                                    <select class="form-control" id="l_id" name="l_id">
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->l_id }}">{{ $location->located_at }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="d_id">What Department?</label>
                                    <select class="form-control" id="d_id" name="d_id">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $location)
                                            <option value="{{ $location->d_id }}">{{ $location->located_at }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="u_fname">First name</label>
                                    <input class="form-control" id="u_fname" name="u_fname" type="text" placeholder="Enter your first name" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="u_lname">Last name</label>
                                    <input class="form-control" id="u_lname" name="u_lname" type="text" placeholder="Enter your last name" value="">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="">Date Needed</label>
                                    <input class="form-control" id="" name="" type="date" value="">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="">Time Needed</label>
                                    <input class="form-control" id="" name="" type="time" value="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" id="" name="" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection