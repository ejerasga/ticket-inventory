@extends('layout.header')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PC Images - {{ $pcspec->name_deployed }}</h1>
            <a href="{{ route('pcspecs.index') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Images</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($pcspec->image_filenames && count($pcspec->image_filenames) > 0)
                        @foreach($pcspec->image_filenames as $image)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">{{ $image }}</div>
                                    <div class="card-body">
                                        @php
                                            // Get department name - updated to match your schema
                                            $department = \App\Models\Department::find($pcspec->department_id);
                                            $departmentName = $department ? strtolower($department->d_name) : 'unknown';
                                            
                                            // Construct the path - ensure this matches your storage structure
                                            $path = 'pc_images/' . $departmentName . '/' . strtolower($pcspec->name_deployed) . '/' . $image;
                                        @endphp
                                        <img src="{{ asset('pc_images/' . $departmentName . '/' . strtolower($pcspec->name_deployed) . '/' . $image) }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <p class="text-center">No images available for this PC.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection