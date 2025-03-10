@extends('layout.header')
@section('content')

<div class="container-fluid">
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0">Profile</a>
        </nav>
        <hr class="mt-0 mb-4">

        <form action="{{ route('user_update', ['u_id' => $user->u_id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>

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
                                <div class="col-md-6">
                                    <label class="small mb-1" for="f_fname">First name</label>
                                    <input class="form-control" id="f_fname" name="f_fname" type="text" placeholder="Enter your first name" value="{{ old('f_fname', $user->f_fname) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="m_lname">Middle name</label>
                                    <input class="form-control" id="m_lname" name="m_lname" type="text" placeholder="Enter your middle name" value="{{ old('m_lname', $user->m_lname) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="l_fname">Last name</label>
                                    <input class="form-control" id="l_fname" name="u_lname" type="text" placeholder="Enter your last name" value="{{ old('l_lname', $user->l_lname) }}">
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="form-group">
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
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
