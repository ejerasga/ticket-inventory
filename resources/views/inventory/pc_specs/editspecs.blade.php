@extends('layout.header')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit PC Specification</h1>
        </div>
        <div class="card shadow mb-4" style="width: 100%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit PC Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pcspecs.update', $pcspec->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Deployed To</label> <span style="color: red;">*</span>
                        <input type="text" name="name_deployed" class="form-control" value="{{ $pcspec->name_deployed }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Department</label> <span style="color: red;">*</span>
                        <select name="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->d_id }}"
                                    {{ $pcspec->department_id == $department->d_id ? 'selected' : '' }}>
                                    {{ $department->d_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Location</label> <span style="color: red;">*</span>
                        <select name="location_id" class="form-control" required>
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->l_id }}"
                                    {{ $pcspec->location_id == $location->l_id ? 'selected' : '' }}>
                                    {{ $location->located_at }}
                                </option>
                            @endforeach
                        </select>
                        @error('location_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Enhanced Image Upload Field with Drag & Drop and Paste -->
                    <div class="mb-3">
                        <label class="small mb-1">Upload Images (Optional)</label>
                        <div class="image-upload-container card p-3">
                            <!-- Traditional file input (hidden but functional) -->
                            <input type="file" class="file-input" id="ticket_images" name="ticket_images[]" multiple
                                accept="image/*" style="display: none;">

                            <!-- Drag & Drop Zone -->
                            <div id="drop-zone" class="text-center p-4 border rounded mb-3">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i>
                                <p>Drag and drop images here, <span class="text-primary">paste screenshots</span>
                                    or
                                    <span class="text-primary" id="browse-btn">browse files</span>
                                </p>
                            </div>

                            <!-- Preview Area -->
                            <div id="image-previews" class="d-flex flex-wrap gap-2 mt-2"></div>

                            @error('ticket_images')
                                <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if ($pcspec->image_filenames && count($pcspec->image_filenames) > 0)
                        <div class="form-group">
                            <label>Current Images:</label>
                            <div class="row">
                                @foreach ($pcspec->image_filenames as $key => $image)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-truncate">{{ $image }}</small>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="delete_images[]"
                                                            value="{{ $image }}"
                                                            id="delete_image_{{ $key }}" class="form-check-input">
                                                        <label for="delete_image_{{ $key }}"
                                                            class="form-check-label text-danger">
                                                            Delete
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center">
                                                @php
                                                    $department = App\Models\Department::find($pcspec->department_id);
                                                    $departmentName = $department
                                                        ? strtolower($department->d_name)
                                                        : 'unknown';
                                                    $pcName = strtolower($pcspec->name_deployed);
                                                    $imagePath = "pc_images/{$departmentName}/{$pcName}/{$image}";
                                                @endphp

                                                <a href="{{ url($imagePath) }}" target="_blank">
                                                    <img src="{{ url($imagePath) }}" alt="{{ $image }}"
                                                        class="img-fluid" style="max-height: 150px; width: auto;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No images available for this PC.
                        </div>
                    @endif

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Update PC</button>
                        <a href="{{ route('pcspecs.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add script to show filename when files are selected
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var files = [];
            for (var i = 0; i < this.files.length; i++) {
                files.push(this.files[i].name);
            }
            document.querySelector('.custom-file-label').textContent = files.join(', ');
        });

        // JavaScript for Image Upload
        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('ticket_images');
            const imagePreviews = document.getElementById('image-previews');
            const browseBtn = document.getElementById('browse-btn');

            // Counter for generating unique file names for pasted images
            let pasteCounter = 0;

            // File collection to store all selected files
            let selectedFiles = new DataTransfer();

            // Handle Browse button click
            browseBtn.addEventListener('click', function() {
                fileInput.click();
            });

            // Highlight drop zone when file is dragged over it
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('bg-light');
            });

            // Remove highlight when file is dragged out
            dropZone.addEventListener('dragleave', function() {
                dropZone.classList.remove('bg-light');
            });

            // Handle file drop
            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('bg-light');

                if (e.dataTransfer.files.length > 0) {
                    handleFiles(e.dataTransfer.files);
                }
            });

            // Handle file input change
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    handleFiles(fileInput.files);
                }
            });

            // Handle paste events on the entire document
            document.addEventListener('paste', function(e) {
                const items = e.clipboardData.items;

                for (let i = 0; i < items.length; i++) {
                    if (items[i].type.indexOf('image') !== -1) {
                        const blob = items[i].getAsFile();
                        const fileName = `pasted-image-${pasteCounter++}.png`;

                        // Create a File object from the Blob
                        const file = new File([blob], fileName, {
                            type: blob.type
                        });

                        // Add to collection and preview
                        addFileToCollection(file);
                        createPreview(file);
                    }
                }
            });

            // Process files (validate and preview)
            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    // Validate if it's an image
                    if (!file.type.match('image.*')) {
                        alert('Please upload only image files.');
                        return;
                    }

                    // Add to collection and preview
                    addFileToCollection(file);
                    createPreview(file);
                });
            }

            // Add file to the collection
            function addFileToCollection(file) {
                selectedFiles.items.add(file);

                // Update the file input with all selected files
                fileInput.files = selectedFiles.files;
            }

            // Create image preview with remove button
            function createPreview(file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewContainer = document.createElement('div');
                    previewContainer.className = 'position-relative';

                    const previewImage = document.createElement('img');
                    previewImage.src = e.target.result;
                    previewImage.className = 'img-thumbnail';
                    previewImage.style.height = '100px';
                    previewImage.style.width = 'auto';

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'btn btn-sm btn-danger position-absolute';
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.setAttribute('type', 'button');

                    // Remove image functionality
                    removeBtn.addEventListener('click', function() {
                        // Create a new DataTransfer object
                        const updatedFiles = new DataTransfer();

                        // Add all files except the one to be removed
                        Array.from(selectedFiles.files).forEach(f => {
                            if (f.name !== file.name || f.size !== file.size) {
                                updatedFiles.items.add(f);
                            }
                        });

                        // Update our collection
                        selectedFiles = updatedFiles;

                        // Update the file input
                        fileInput.files = selectedFiles.files;

                        // Remove preview
                        previewContainer.remove();
                    });

                    previewContainer.appendChild(previewImage);
                    previewContainer.appendChild(removeBtn);
                    imagePreviews.appendChild(previewContainer);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
