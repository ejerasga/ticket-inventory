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
                    

                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1" for="u_username">Username</label>
                                    <input class="form-control" id="u_username" name="u_username" type="text" placeholder="Enter your username" value="{{ old('u_username', $user->u_username) }}">
                                </div>
    
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="u_fname">First name</label>
                                        <input class="form-control" id="u_fname" name="u_fname" type="text" placeholder="Enter your first name" value="{{ old('u_fname', $user->u_fname) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="u_mname">Middle name</label>
                                        <input class="form-control" id="u_mname" name="u_mname" type="text" placeholder="Enter your middle name" value="{{ old('u_mname', $user->u_mname) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="u_lname">Last name</label>
                                        <input class="form-control" id="u_lname" name="u_lname" type="text" placeholder="Enter your last name" value="{{ old('u_lname', $user->u_lname) }}">
                                    </div>
                                </div>
    
                                <div class="row gx-3 mb-3">
                                    <div class="form-group col-md-6">
                                        <label for="u_gender">Gender:</label>
                                        <select class="form-control" id="u_gender" name="u_gender">
                                            <option value="">Select Gender</option>
                                            <option value="1" {{ old('u_gender', $user->u_gender) == 1 ? 'selected' : '' }}>Male</option>
                                            <option value="0" {{ old('u_gender', $user->u_gender) == 0 ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('u_gender')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="u_contact">Phone number</label>
                                        <input class="form-control" id="u_contact" name="u_contact" type="tel" placeholder="Enter your phone number" value="{{ old('u_contact', $user->u_contact) }}">
                                    </div>
                                </div>
    
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>

@endsection