@extends('layout.header')
    @section('content')


    <div class="container-fluid">


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Ticket</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('user_save') }}" method="POST">
                    @csrf
                    <div class="col-xl-12">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="">Type</label>
                                <select class="form-control" id="" name="">
                                    <option value="">Select Type</option>
                                    <option value="1">IT</option>
                                    <option value="2">HR</option>
                                    <option value="3">ADMIN</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="u_username">Username</label>
                                <input class="form-control" id="u_username" name="u_username" type="text" placeholder="Enter your username" value="">
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="u_fname">First name</label>
                                    <input class="form-control" id="u_fname" name="u_fname" type="text" placeholder="Enter your first name" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="u_mname">Middle name</label>
                                    <input class="form-control" id="u_mname" name="u_mname" type="text" placeholder="Enter your middle name" value="">
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="u_lname">Last name</label>
                                    <input class="form-control" id="u_lname" name="u_lname" type="text" placeholder="Enter your last name" value="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection