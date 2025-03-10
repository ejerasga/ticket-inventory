@extends('layout.header')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $ticket->t_control_no }}</h6>
            <a href="{{ route('ticket_list') }}" class="btn btn-sm btn-primary">Back to List</a>
        </div>
        
        <div class="card-body">
            <!-- Ticket Details -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Service Details:</h6>
                    <p><strong>Service:</strong> {{ $ticket->service->s_name }}</p>
                    <p><strong>Location:</strong> {{ $ticket->location->located_at }}</p>
                    <p><strong>Department:</strong> {{ $ticket->department ? $ticket->department->d_name : 'N/A' }}</p>
                    <p><strong>Date Needed:</strong> {{ $ticket->date_needed }}</p>
                    <p><strong>Time Needed:</strong> {{ $ticket->time_needed }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Status Information:</h6>
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
                    @if(Auth::user()->r_id == 1 || Auth::user()->r_id == 2)
                        <p><strong>Assigned To:</strong> 
                            @if($ticket->assigned_to)
                                {{ $ticket->assignedStaff->u_fname . ' ' . $ticket->assignedStaff->u_lname }}
                            @else
                                Not Assigned
                            @endif
                        </p>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <h6 class="font-weight-bold">Description:</h6>
                <p>{{ $ticket->description }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="text-center">
                @if($ticket->assigned_to == Auth::user()->u_id && $ticket->status == 1)
                    <form action="{{ route('ticket_complete', $ticket->t_id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success mr-2">Complete</button>
                    </form>
                    <form action="{{ route('ticket_reject', $ticket->t_id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                @endif

                @if($ticket->status == 2 && $ticket->req_by == Auth::user()->u_id)
                    <a href="{{ route('ticket_evaluate', $ticket->t_id) }}" class="btn btn-primary">
                        Evaluate
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection