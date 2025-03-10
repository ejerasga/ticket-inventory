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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Control No.</th>
                                <th>Service</th>
                                <th>Location</th>
                                <th>Department</th>
                                <th>Date Needed</th>
                                <th>Time Needed</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            
                            
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->









    @endsection