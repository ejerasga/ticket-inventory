@extends('layout.header')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Stocks</h1>
    </div>

    <!-- Add New Stock Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Stock</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('store_stock') }}">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="item_code">Item Code</label> <span style="color: red;">*</span></label> 
                            <input type="text" class="form-control" id="item_code" name="item_code" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="item_name">Item Name</label> <span style="color: red;">*</span></label> 
                            <input type="text" class="form-control" id="item_name" name="item_name" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="category">Category</label> <span style="color: red;">*</span></label> 
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="uom">UOM</label> <span style="color: red;">*</span></label> 
                            <input type="text" class="form-control" id="uom" name="uom" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="stock_available">Stock Available (Quantity)</label> <span style="color: red;">*</span>
                    <input type="number" class="form-control" id="stock_available" name="stock_available" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Stock</button>
            </form>
        </div>
    </div>

    <!-- Stocks Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Available Stocks</h6>
        </div>
        <div class="card-body">
            <!-- Success message display -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Search stocks...">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="stocksTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Stock Available</th>
                            <th>UOM</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->item_code }}</td>
                                <td>{{ $stock->item_name }}</td>
                                <td>{{ $stock->category }}</td>
                                <td>{{ $stock->description }}</td>
                                <td>{{ $stock->stock_available }}</td>
                                <td>{{ $stock->uom }}</td>
                                <td>
                                    <a href="{{ route('edit_stock', $stock->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('delete_stock', $stock->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this item?')">
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

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#stocksTable tbody tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>
@endsection