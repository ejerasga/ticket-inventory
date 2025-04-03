@extends('layout.header')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">PC Specifications</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow mb-4" style="width: 100%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New PC</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pcspecs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Deployed To</label> <span style="color: red;">*</span>
                        <input type="text" name="name_deployed" class="form-control" value="{{ old('name_deployed') }}"
                            required>
                        @error('name_deployed')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Department</label> <span style="color: red;">*</span>
                        <select name="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->d_id }}"
                                    {{ old('department_id') == $department->d_id ? 'selected' : '' }}>
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
                                <option value="{{ $location->l_id }}">
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
                    <button type="submit" class="btn btn-primary">Add PC</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4" style="width: 100%;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">PC Specifications</h6>
                <div class="form-group mb-0">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search PC specifications...">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="pcSpecsTable">
                        <thead>
                            <tr>
                                <th class="d-none">ID</th>
                                <th>Deployed To</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Images</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pcs as $pc)
                                <tr>
                                    <td class="d-none">{{ $pc->id }}</td>
                                    <td>{{ $pc->name_deployed }}</td>
                                    <td>{{ $pc->department_id ? \App\Models\Department::where('d_id', $pc->department_id)->value('d_name') : '' }}
                                    </td>
                                    <td>{{ $pc->location->located_at ?? 'N/A' }}</td>
                                    <td>{{ count($pc->image_filenames ?? []) }} image(s)</td>
                                    <td>
                                        <a href="{{ route('pcspecs.images', $pc->id) }}"
                                            class="btn btn-sm btn-primary d-none">
                                            <span class="material-icons">View Image</span>
                                        </a>
                                        <a href="{{ route('pcspecs.edit', $pc->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pcspecs.destroy', $pc->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this PC specification?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Searching -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#pcSpecsTable tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
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
