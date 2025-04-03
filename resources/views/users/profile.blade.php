@extends('layout.header')
@section('content')

<div class="container-fluid">
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0">Profile</a>
        </nav>
        <hr class="mt-0 mb-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('profile.update', ['u_id' => $user->u_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            @if($user->user_icon)
                                <img class="img-account-profile rounded-circle mb-2" 
                                     src="{{ asset('storage/' . $user->user_icon) }}" 
                                     alt="{{ $user->u_fname }}'s profile picture"
                                     style="width: 187px; height: 187px; object-fit: cover;">
                            @else
                                <img class="img-account-profile rounded-circle mb-2" 
                                     src="http://bootdey.com/img/Content/avatar/avatar1.png" 
                                     alt="Default profile picture"
                                     style="width: 187px; height: 187px; object-fit: cover;">
                            @endif
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="user_icon" name="user_icon" accept=".jpg, .jpeg, .png"
                                            onchange="document.querySelector('.custom-file-label').textContent = this.files[0].name">
                                        <label class="custom-file-label" for="user_icon">Choose image</label>
                                    </div>
                                </div>
                                @error('user_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
                                @error('u_username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="u_fname">First name</label>
                                    <input class="form-control" id="u_fname" name="u_fname" type="text" placeholder="Enter your first name" value="{{ old('u_fname', $user->u_fname) }}">
                                    @error('u_fname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="u_mname">Middle name</label>
                                    <input class="form-control" id="u_mname" name="u_mname" type="text" placeholder="Enter your middle name" value="{{ old('u_mname', $user->u_mname) }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="u_lname">Last name</label>
                                    <input class="form-control" id="u_lname" name="u_lname" type="text" placeholder="Enter your last name" value="{{ old('u_lname', $user->u_lname) }}">
                                    @error('u_lname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="form-group col-md-6">
                                    <label class="small mb-1" for="u_gender">Gender:</label>
                                    <select class="form-control" id="u_gender" name="u_gender">
                                        <option value="">Select Gender</option>
                                        <option value="1" {{ old('u_gender', $user->u_gender) == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="0" {{ old('u_gender', $user->u_gender) == 0 ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('u_gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="u_contact">Phone number</label>
                                    <input class="form-control" id="u_contact" name="u_contact" type="tel" placeholder="Enter your phone number" value="{{ old('u_contact', $user->u_contact) }}">
                                    @error('u_contact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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