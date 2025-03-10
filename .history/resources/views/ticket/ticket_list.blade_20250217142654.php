@extends('layout.header')
    @section('content')


    


    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">List of Tickets</h1>
        

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tickets</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Control No.</th>
                                <th>Service</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Date Needed</th>
                                <th>Time Needed</th>
                                <th>Status</th>
                                @if (Auth::user()->r_id == 1)
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Control No.</th>
                                <th>Service</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Date Needed</th>
                                <th>Time Needed</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
        
                            @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->t_control_no }}</td>
                                <td>{{ $ticket->service->s_name }}</td>
                                <td>{{ $ticket->location->located_at }}</td>
                                <td>{{ $ticket->department ? $ticket->department->d_name : 'N/A' }}</td>
                                <td>{{ $ticket->date_needed }}</td>
                                <td>{{ $ticket->time_needed }}</td>
                                <td>
                                    @if ($ticket->status == 0)
                                        For Approval
                                    @elseif ($ticket->status == 1)
                                        In Progress
                                    @elseif ($ticket->status == 2)
                                        For Evaluation
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="#" class="btn btn-sm btn-primary">Assign</a>
                                    <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>





    @endsection