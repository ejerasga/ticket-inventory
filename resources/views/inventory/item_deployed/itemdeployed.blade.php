@extends('layout.header')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Items Deployed</h1>
        </div>

        <!-- Add New Deployed Item Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Deployed Item</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('store_itemdeployed') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Requested By</label> <span style="color: red;">*</span>
                                <input type="text" name="requested_by" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Item Name</label> <span style="color: red;">*</span>
                                <select name="item_id" class="form-control" required>
                                    <option value="">Select Item</option>
                                    @foreach ($stocks as $stock)
                                        <option value="{{ $stock->id }}" data-available="{{ $stock->stock_available }}">
                                            {{ $stock->item_name }} (Available: {{ $stock->stock_available }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Department</label> <span style="color: red;">*</span>
                                <select name="department_id" class="form-control" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->d_id }}">
                                            {{ $department->d_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label> <span style="color: red;">*</span>
                                <input type="number" name="quantity" class="form-control" min="1" required>
                            </div>
                            <div class="form-group">
                                <label>Returning</label> <span style="color: red;">*</span>
                                <select name="returning" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Purpose</label> <span style="color: red;">*</span>
                                <textarea name="purpose" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Deployed</label> <span style="color: red;">*</span>
                                <input type="date" name="date_deployed" class="form-control" required>
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
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remark" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gatepass</label> <span style="color: red;">*</span>
                                <select name="gatepass" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Date Returned</label>
                                <input type="date" name="date_returned" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Deployed Items Card with Tabs -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Item Deployment Records</h6>
            </div>
            <div class="card-body">
                <!-- Success message display -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="deploymentTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="deployed-tab" data-toggle="tab" href="#deployed" role="tab"
                            aria-controls="deployed" aria-selected="true">
                            Deployed Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="returned-tab" data-toggle="tab" href="#returned" role="tab"
                            aria-controls="returned" aria-selected="false">
                            Returned Items
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="deploymentTabsContent">
                    <!-- Deployed Items Tab -->
                    <div class="tab-pane fade show active" id="deployed" role="tabpanel" aria-labelledby="deployed-tab">
                        <!-- Search Bar -->
                        <div class="mb-3 mt-3">
                            <input type="text" id="searchDeployedInput" class="form-control"
                                placeholder="Search deployed items...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="deployedItemsTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Requested By</th>
                                        <th>Item Name</th>
                                        <th>Department</th>
                                        <th>Quantity</th>
                                        <th>Purpose</th>
                                        <th>Date Deployed</th>
                                        <th>Location</th>
                                        <th>Gatepass</th>
                                        <th>Returning</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        @if (empty($item->date_returned))
                                            <tr>
                                                <td>{{ $item->requested_by }}</td>
                                                <td>{{ $item->stock->item_name ?? 'N/A' }}</td>
                                                <td>{{ $item->department->d_name ?? 'N/A' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->purpose }}</td>
                                                <td>{{ $item->date_deployed }}</td>
                                                <td>{{ $item->location->located_at ?? 'N/A' }}</td>
                                                <td>{{ $item->gatepass ? 'Yes' : 'No' }}</td>
                                                <td>{{ $item->returning ? 'Yes' : 'No' }}</td>
                                                <td style="width: 100px;">
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('edit_itemdeployed', $item->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('delete_itemdeployed', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Returned Items Tab -->
                    <div class="tab-pane fade" id="returned" role="tabpanel" aria-labelledby="returned-tab">
                        <!-- Search Bar -->
                        <div class="mb-3 mt-3">
                            <input type="text" id="searchReturnedInput" class="form-control"
                                placeholder="Search returned items...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="returnedItemsTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Requested By</th>
                                        <th>Item Name</th>
                                        <th>Department</th>
                                        <th>Quantity</th>
                                        <th>Purpose</th>
                                        <th>Date Deployed</th>
                                        <th>Location</th>
                                        <th>Gatepass</th>
                                        <th>Date Returned</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        @if (!empty($item->date_returned))
                                            <tr>
                                                <td>{{ $item->requested_by }}</td>
                                                <td>{{ $item->stock->item_name ?? 'N/A' }}</td>
                                                <td>{{ $item->department->d_name ?? 'N/A' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->purpose }}</td>
                                                <td>{{ $item->date_deployed }}</td>
                                                <td>{{ $item->location->located_at ?? 'N/A' }}</td>
                                                <td>{{ $item->gatepass ? 'Yes' : 'No' }}</td>
                                                <td>{{ $item->date_returned }}</td>
                                                <td style="width: 100px;">
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('edit_itemdeployed', $item->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('delete_itemdeployed', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#deployedItemsTable tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });

        $(document).ready(function() {
            // Initialize DataTables for both tables
            $('#deployedItemsTable').DataTable({
                "pageLength": 10,
                "ordering": true
            });

            $('#returnedItemsTable').DataTable({
                "pageLength": 10,
                "ordering": true
            });

            // Search functionality for deployed items
            $('#searchDeployedInput').keyup(function() {
                $('#deployedItemsTable').DataTable().search($(this).val()).draw();
            });

            // Search functionality for returned items
            $('#searchReturnedInput').keyup(function() {
                $('#returnedItemsTable').DataTable().search($(this).val()).draw();
            });
        });
    </script>
@endsection
