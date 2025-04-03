@extends('layout.header')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Stocks</h1>
        </div>

        <div class="card shadow mb-4" style="width: 100%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Stock</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('update_stock', ['id' => $stock->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="item_code">Item Code</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="item_code" name="item_code" value="{{ $stock->item_code }}" required>
                    </div>

                    <div class="form-group">
                        <label for="item_name">Item Name</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $stock->item_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $stock->category }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $stock->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="stock_available">Stock Available</label> <span style="color: red;">*</span>
                        <input type="number" class="form-control" id="stock_available" name="stock_available" value="{{ $stock->stock_available }}" required>
                    </div>

                    <div class="form-group">
                        <label for="uom">UOM</label> <span style="color: red;">*</span>
                        <input type="text" class="form-control" id="uom" name="uom" value="{{ $stock->uom }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Stock</button>
                    <a href="{{ route('view_stock') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection