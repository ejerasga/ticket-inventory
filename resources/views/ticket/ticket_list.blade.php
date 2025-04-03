@extends('layout.header')
@section('content')

    <!-- resources\views\ticket\ticket_list.blade.php -->

    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">List of Tickets</h1>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs mb-3" id="ticketTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="active-tickets-tab" data-toggle="tab" href="#active-tickets" role="tab"
                    aria-controls="active-tickets" aria-selected="true">Active Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="completed-tickets-tab" data-toggle="tab" href="#completed-tickets" role="tab"
                    aria-controls="completed-tickets" aria-selected="false">Completed Tickets</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="ticketTabsContent">
            <!-- Active Tickets Tab -->
            <div class="tab-pane fade show active" id="active-tickets" role="tabpanel" aria-labelledby="active-tickets-tab">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Active Tickets</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="activeTicketsTable" width="100%" cellspacing="0">
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
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        @if ($ticket->final_status == 0)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->t_control_no }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->service->s_name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->location->located_at }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->department ? $ticket->department->d_name : 'N/A' }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->date_needed }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->time_needed }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
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
                                                        <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                            class="text-decoration-none text-dark">
                                                            @if ($ticket->assigned_to)
                                                                {{ $ticket->assignedStaff->u_fname . ' ' . $ticket->assignedStaff->u_lname }}
                                                            @else
                                                                Not Assigned
                                                            @endif
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (Auth::user()->r_id == 1)
                                                    <td style="text-align: center;">
                                                        <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                            class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            data-toggle="modal"
                                                            data-target="#assignModal{{ $ticket->t_control_no }}">
                                                            <i class="fas fa-user-plus"></i>
                                                        </button>
                                                        <a href="#" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>

                                            <!-- Assign Modal -->
                                            <div class="modal fade" id="assignModal{{ $ticket->t_control_no }}"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Assign Ticket
                                                                #{{ $ticket->t_control_no }}</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('ticket_assign', $ticket->t_id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Assign to:</label>
                                                                    <select class="form-control" name="assigned_to"
                                                                        required>
                                                                        <option value="">Select Staff</option>
                                                                        <!-- Option for Super Admin (self-assignment) -->
                                                                        @if (Auth::user()->r_id == 1)
                                                                            <option value="{{ Auth::user()->u_id }}">
                                                                                Myself
                                                                                ({{ Auth::user()->u_fname . ' ' . Auth::user()->u_lname }})
                                                                            </option>
                                                                        @endif
                                                                        <!-- Options for Admin users -->
                                                                        @foreach ($adminUsers as $admin)
                                                                            @if ($admin->r_id == 2)
                                                                                <option value="{{ $admin->u_id }}">
                                                                                    {{ $admin->u_fname . ' ' . $admin->u_lname }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Assign
                                                                    Ticket</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Tickets Tab -->
            <div class="tab-pane fade" id="completed-tickets" role="tabpanel" aria-labelledby="completed-tickets-tab">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Completed Tickets</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="completedTicketsTable" width="100%" cellspacing="0">
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
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        @if ($ticket->final_status == 1)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->t_control_no }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->service->s_name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->location->located_at }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->department ? $ticket->department->d_name : 'N/A' }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->date_needed }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ $ticket->time_needed }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                        class="text-decoration-none text-dark">
                                                        Completed
                                                    </a>
                                                </td>
                                                @if (Auth::user()->r_id == 1 || Auth::user()->r_id == 2)
                                                    <td>
                                                        <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                            class="text-decoration-none text-dark">
                                                            @if ($ticket->assigned_to)
                                                                {{ $ticket->assignedStaff->u_fname . ' ' . $ticket->assignedStaff->u_lname }}
                                                            @else
                                                                Not Assigned
                                                            @endif
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (Auth::user()->r_id == 1)
                                                    <td style="text-align: center;">
                                                        <a href="{{ route('ticket_info', $ticket->t_id) }}"
                                                            class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                @endif
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
        $(document).ready(function() {
            // Initialize DataTables for both tables
            $('#activeTicketsTable').DataTable();
            $('#completedTicketsTable').DataTable();

            // Handle tab switching to properly resize DataTables
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $.fn.dataTable.tables({
                    visible: true,
                    api: true
                }).columns.adjust();
            });
        });
    </script>

@endsection
