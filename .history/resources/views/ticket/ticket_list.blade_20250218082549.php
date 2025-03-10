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
                            <tr>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        {{ $ticket->t_control_no }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        {{ $ticket->service->s_name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        {{ $ticket->location->located_at }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        {{ $ticket->department ? $ticket->department->d_name : 'N/A' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        {{ $ticket->date_needed }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        {{ $ticket->time_needed }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                        @if ($ticket->status == 0)
                                            For Approval
                                        @elseif ($ticket->status == 1)
                                            In Progress
                                        @elseif ($ticket->status == 2)
                                            For Evaluation
                                        @elseif ($ticket->status == 4 && $ticket->final_status == 1)
                                            Completed
                                        @endif
                                    </a>
                                </td>
                                @if (Auth::user()->r_id == 1 || Auth::user()->r_id == 2)
                                    <td>
                                        <a href="{{ route('ticket_info', $ticket->t_id) }}" class="text-decoration-none text-dark">
                                            @if($ticket->assigned_to)
                                                {{ $ticket->assignedStaff->u_fname . ' ' . $ticket->assignedStaff->u_lname }}
                                            @else
                                                Not Assigned
                                            @endif
                                        </a>
                                    </td>
                                @endif
                                @if (Auth::user()->r_id == 1)
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#assignModal{{ $ticket->t_control_no }}">Assign</button>
                                        <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                    </td>
                                @endif
                            </tr>
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