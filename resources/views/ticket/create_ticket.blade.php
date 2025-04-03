@extends('layout.header')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Ticket</h6>
            </div>
            <div class="card-body">
                <form id="ticketForm" action="{{ route('ticket_save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-xl-12">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="small mb-1" for="s_id">Service Type <span
                                        style="color: red;">*</span></label>
                                <select class="form-control" id="s_id" name="s_id" required>
                                    <option value="">Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->s_id }}">{{ $service->s_name }}</option>
                                    @endforeach
                                </select>
                                @error('s_id')
                                    <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="l_id">Located at? <span
                                            style="color: red;">*</span></label>
                                    <select class="form-control" id="l_id" name="l_id" required>
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->l_id }}">{{ $location->located_at }}</option>
                                        @endforeach
                                    </select>
                                    @error('l_id')
                                        <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="d_id">Department: <span
                                            style="color: red;">*</span></label>
                                    <select class="form-control" id="d_id" name="d_id" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->d_id }}">{{ $department->d_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('d_id')
                                        <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="f_name">First name <span
                                            style="color: red;">*</span></label>
                                    <input class="form-control" id="f_name" name="f_name" type="text"
                                        placeholder="Enter your first name" required>
                                    @error('f_name')
                                        <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="l_name">Last name <span
                                            style="color: red;">*</span></label>
                                    <input class="form-control" id="l_name" name="l_name" type="text"
                                        placeholder="Enter your last name" required>
                                    @error('l_name')
                                        <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="date_needed">Date Needed <span
                                            style="color: red;">*</span></label>
                                    <input class="form-control" id="date_needed" name="date_needed" type="date" required>
                                    @error('date_needed')
                                        <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="time_needed">Time Needed <span
                                            style="color: red;">*</span></label>
                                    <input class="form-control" id="time_needed" name="time_needed" type="time" required>
                                    @error('time_needed')
                                        <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="description">Description <span
                                        style="color: red;">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                @error('description')
                                    <span class="error text-danger" style="font-size: 1rem">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Enhanced Image Upload Field with Drag & Drop and Paste -->
                            <div class="mb-3">
                                <label class="small mb-1">Upload Images (Optional)</label>
                                <div class="image-upload-container card p-3">
                                    <!-- Traditional file input (hidden but functional) -->
                                    <input type="file" class="file-input" id="ticket_images" name="ticket_images[]"
                                        multiple accept="image/*" style="display: none;">

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

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Image Upload Functionality -->
    <script>
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
