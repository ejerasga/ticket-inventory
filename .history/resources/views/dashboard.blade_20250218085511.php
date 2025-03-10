@extends('layout.header')
    @section('content')
    
   

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- For Approval Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    For Approval</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTicketCount }}</div>
                                </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- In Progress Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    In Progress</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inProgressTicketCount }}</div>
                                </div>
                            <div class="col-auto">
                                <i class="fas fa-redo fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

            <!-- For Evaluation Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    For Evaluation</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedTicketCount }}</div>
                                </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Ticket Status Chart -->
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ticket Status Overview</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="ticketStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('ticketStatusChart').getContext('2d');
            var ticketStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['For Approval', 'In Progress', 'For Evaluation'],
                    datasets: [{
                        data: [
                            {{ $pendingTicketCount }},
                            {{ $inProgressTicketCount }},
                            {{ $completedTicketCount }}
                        ],
                        backgroundColor: [
                            '#f6c23e', // warning yellow for Pending
                            '#4e73df', // primary blue for In Progress
                            '#1cc88a'  // success green for Completed
                        ],
                        hoverBackgroundColor: [
                            '#daa520',
                            '#2e59d9',
                            '#17a673'
                        ],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    cutoutPercentage: 0,
                },
            });
        });
        </script>

    @endsection