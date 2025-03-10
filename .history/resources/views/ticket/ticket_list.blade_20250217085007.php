@extends('layout.header')
    @section('content')


    
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4" style="margin-right: 8px;">
            <h3 class="text-dark mb-0">Request</h3><a class="btn btn-primary text-center" role="button" href="{{ route('request_create')}}">Create Request</a>
        </div>
        <div class="row">
            <div class="col-sm-8 col-md-8 col-lg-3 col-xl-3 m-auto mb-4">
                <div class="card shadow border-start-primary py-2" style="margin-right: -50px;margin-left: -45px;padding-left: 30px;padding-right: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1" style="padding-right: 0px;margin-right: -53px;"><span class="text-danger">FOR APPROVAL</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>100</span></div>
                            </div>
                            <div class="col-auto"><a class="fs-6" href="{{ route('TobeApproved')}}">View More</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-3 col-xl-3 col-xxl-3 m-auto mb-4">
                <div class="card shadow border-start-primary py-2" style="margin-right: -50px;margin-left: -45px;">
                    <div class="card-body" style="padding-left: 30px;margin-right: 29px;padding-right: 0px;">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1" style="margin-right: -28px;"><span class="text-success">in progress</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>50</span></div>
                            </div>
                            <div class="col-auto"><a class="fs-6" href="{{ route('InProgress')}}">View More</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-3 col-xl-3 m-auto mb-4">
                <div class="card shadow border-start-primary py-2" style="margin-right: -50px;margin-left: -45px;">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span class="text-primary">FOR EVALUATION</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>25</span></div>
                            </div>
                            <div class="col-auto"><a class="fs-6" href="{{ route('Done')}}">View More</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                    <option value="10" selected="">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>&nbsp;</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                    </div>
                </div>
                <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Control Number</th>
                                <th scope="col" class="text-center">Service</th>
                                <th scope="col" class="text-center">Encoded by</th>
                                <th scope="col" class="text-center">Requested by</th>
                                @if (Auth::user()->u_username == 'super admin')
                                    <th scope="col" class="text-center">Department</th>
                                @endif
                                <th scope="col" class="text-center">Date Received</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($rows as $row)
                                <tr onclick="window.location='{{ route('request', ['id' => $row->req_id]) }}';"
                                    class="clickable-row">
                                    <td class="text-center">{{ $row->req_id }}</td>
                                    <td class="text-center">{{ $row->req_control_no }}</td>
                                    <td class="text-center">{{ $row->service_name }}</td>
                                    <td class="text-center">{{ $row->u_username }}</td>
                                    <td class="text-center">{{ $row->req_by_username }}</td>
                                    @if (Auth::user()->u_username == 'super admin')
                                        <td class="text-center">{{ $row->dept_name }}</td>
                                    @endif
                                    <td class="text-center">{{ $row->received_date }}</td>
                                    <td class="text-center">{{ $row->status_name }}</td>
                                </tr>
                                @endforeach
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                    </div>
                    <div class="col-md-6">
                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection