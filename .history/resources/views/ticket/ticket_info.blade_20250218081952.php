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