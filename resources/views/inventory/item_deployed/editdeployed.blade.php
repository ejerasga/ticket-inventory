@extends('layout.header')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Deployed Item</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Edit Deployed Item Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Item Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('update_itemdeployed', ['id' => $itemdeployed->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requested_by">Requested By</label> <span style="color: red;">*</span>
                                <input type="text" class="form-control" id="requested_by" name="requested_by"
                                    value="{{ $itemdeployed->requested_by }}" required>
                            </div>

                            <div class="form-group">
                                <label>Item Name</label> <span style="color: red;">*</span>
                                <select name="item_id" class="form-control" required>
                                    <option value="">Select Item</option>
                                    @foreach ($stocks as $stock)
                                        <option value="{{ $stock->id }}"
                                            {{ $itemdeployed->item_id == $stock->id ? 'selected' : '' }}>
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
                                        <option value="{{ $department->d_id }}"
                                            {{ $itemdeployed->department_id == $department->d_id ? 'selected' : '' }}>
                                            {{ $department->d_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label> <span style="color: red;">*</span>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    value="{{ $itemdeployed->quantity }}" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="returning">Returning</label> <span style="color: red;">*</span>
                                <select class="form-control" id="returning" name="returning" required>
                                    <option value="1" {{ $itemdeployed->returning == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ $itemdeployed->returning == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="purpose">Purpose</label> <span style="color: red;">*</span>
                                <input type="text" class="form-control" id="purpose" name="purpose"
                                    value="{{ $itemdeployed->purpose }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_deployed">Date Deployed</label> <span style="color: red;">*</span>
                                <input type="date" class="form-control" id="date_deployed" name="date_deployed"
                                    value="{{ $itemdeployed->date_deployed }}" required>
                            </div>

                            <div class="form-group">
                                <label for="location_id">Location</label> <span style="color: red;">*</span>
                                <select class="form-control" id="location_id" name="location_id" required>
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->l_id }}"
                                            {{ $itemdeployed->location_id == $location->l_id ? 'selected' : '' }}>
                                            {{ $location->located_at }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="remark">Remark</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                    value="{{ $itemdeployed->remark }}">
                            </div>

                            <div class="form-group">
                                <label for="gatepass">Gatepass</label> <span style="color: red;">*</span>
                                <select class="form-control" id="gatepass" name="gatepass" required>
                                    <option value="1" {{ $itemdeployed->gatepass == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ $itemdeployed->gatepass == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date_returned">Date Returned</label>
                                <input type="date" class="form-control" id="date_returned" name="date_returned"
                                    value="{{ $itemdeployed->date_returned }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Item</button>
                    <a href="{{ route('item_deployed') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
