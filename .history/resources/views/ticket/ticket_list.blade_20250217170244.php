@extends('layout.header')
    @section('content')


    
    <!-- resources\views\ticket\ticket_list.blade.php -->

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
                                @if (Auth::user()->r_id == 1 || Auth::user()->r_id == 2)
                                    <th>Assigned Staff</th>
                                @endif
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
                                <tr style="cursor: pointer;" data-toggle="modal" data-target="#ticketModal{{ $ticket->t_control_no }}">
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
                                        @elseif ($ticket->status == 4 && $ticket->final_status == 1)
                                            Completed
                                        @endif
                                    </td>
                                    @if (Auth::user()->r_id == 1 || Auth::user()->r_id == 2)
                                        <td>
                                            @if($ticket->assigned_to)
                                                {{ $ticket->assignedStaff->u_fname . ' ' . $ticket->assignedStaff->u_lname }}
                                            @else
                                                Not Assigned
                                            @endif
                                        </td>
                                    @endif
                                    @if (Auth::user()->r_id == 1)
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#assignModal{{ $ticket->t_control_no }}">Assign</button>
                                            <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                        </td>
                                    @endif
                                </tr>


                                <!-- Assign Modal -->
<div class="modal fade" id="assignModal{{ $ticket->t_control_no }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Ticket #{{ $ticket->t_control_no }}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ticket.assign', $ticket->t_id) }}" method="POST">
                    @csrf
                    <label for="assigned_to">Assign to:</label>
                    <select name="assigned_to" class="form-control" required>
                        @foreach($adminUsers as $admin)
                            <option value="{{ $admin->u_id }}">{{ $admin->u_fname }} {{ $admin->u_lname }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Assign</button>
                </form>
            </div>
        </div>
    </div>
</div>




                                <!-- New Ticket Details Modal -->
                                <div class="modal fade" id="ticketModal{{ $ticket->t_control_no }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ticket #{{ $ticket->t_control_no }}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Ticket Details -->
                                                <div class="mb-4">
                                                    <h6 class="font-weight-bold">Details:</h6>
                                                    <p><strong>Service:</strong> {{ $ticket->service->s_name }}</p>
                                                    <p><strong>Location:</strong> {{ $ticket->location->located_at }}</p>
                                                    <p><strong>Department:</strong> {{ $ticket->department ? $ticket->department->d_name : 'N/A' }}</p>
                                                    <p><strong>Date Needed:</strong> {{ $ticket->date_needed }}</p>
                                                    <p><strong>Time Needed:</strong> {{ $ticket->time_needed }}</p>
                                                    <p><strong>Description:</strong> {{ $ticket->description }}</p>
                                                    <p><strong>Status:</strong> 
                                                        @if ($ticket->status == 0)
                                                            For Approval
                                                        @elseif ($ticket->status == 1)
                                                            In Progress
                                                        @elseif ($ticket->status == 2)
                                                            For Evaluation
                                                        @elseif ($ticket->status == 4 && $ticket->final_status == 1)
                                                            Completed
                                                        @endif
                                                    </p>
                                                </div>

                                                <!-- Action Buttons - Only visible to assigned staff -->
                                                @if($ticket->assigned_to == Auth::user()->u_id && $ticket->status == 1)
                                                    <div class="text-center">
                                                        <form action="{{ route('ticket_complete', $ticket->t_id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success mr-2">Complete</button>
                                                        </form>
                                                        <form action="{{ route('ticket_reject', $ticket->t_id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Reject</button>
                                                        </form>
                                                    </div>
                                                @endif

                                                <!--  Evaluate button when the ticket is ready for evaluation -->
                                                @if($ticket->status == 2 && $ticket->req_by == Auth::user()->u_id)
                                                    <div class="text-center mt-4">
                                                        <a href="{{ route('ticket_evaluate', $ticket->t_id) }}" class="btn btn-primary">
                                                            Evaluate
                                                        </a>
                                                    </div>
                                                @endif
                            
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


    <script>
        // Prevent the Assign button from triggering the ticket details modal
        document.querySelectorAll('.btn-info').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        });
    </script>


    @endsection