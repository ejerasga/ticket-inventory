@extends('layout.header')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ticket List</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Control No.</th>
                        <th>Service</th>
                        <th>Location</th>
                        <th>Department</th>
                        <th>Date Needed</th>
                        <th>Time Needed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->t_control_no }}</td>
                            <td>{{ $ticket->service->s_name }}</td>
                            <td>{{ $ticket->location->located_at }}</td>
                            <td>{{ $ticket->department->d_name }}</td>
                            <td>{{ $ticket->date_needed }}</td>
                            <td>{{ $ticket->time_needed }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
@endif
</script>

@endsection
