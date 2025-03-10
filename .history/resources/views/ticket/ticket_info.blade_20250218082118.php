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
            
    
            <!-- Ticket Info -->
            <div class="modal-body">
                <h5>Ticket #{{ $ticket->t_control_no }}</h5>
                
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


    <script>
        // Prevent the Assign button from triggering the ticket details modal
        document.querySelectorAll('.btn-info').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        });
    </script>


    @endsection