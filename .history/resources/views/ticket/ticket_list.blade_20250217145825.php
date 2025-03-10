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
                                @if (Auth::user()->r_id == 1)
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#assignModal{{ $ticket->t_control_no }}">Assign</button>
                                        <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                    </td>
                                @endif
                            </tr>

                            <!-- Assign Modal -->
                            <div class="modal fade" id="assignModal{{ $ ->t_control_no }}" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="assignModalLabel">Assign Ticket</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="userSelect">Select Admin Staff</label>
                                                    <select class="form-control" id="userSelect" name="user_id" required>
                                                        
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Assign</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>





    @endsection