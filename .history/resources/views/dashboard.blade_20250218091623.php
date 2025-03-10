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

        

        <div class="row">
            <!-- Ticket Assignment Breakdown Chart -->
            <div class="col-xl-8 col-lg-7 m">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ticket Assignment Breakdown (MIS Department)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="assignmentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Status Chart -->
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
</div>



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
                            '#4e73df', // primary blue for For Approval
                            '#1cc88a', // success green for In Progress
                            '#f6c23e'  // warning yellow for For Evaluation
                        ],
                        hoverBackgroundColor: [
                            '#2e59d9',
                            '#17a673',
                            '#daa520'
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

        // Bar Chart for Ticket Assignments
        var assignmentCtx = document.getElementById('assignmentChart').getContext('2d');
        var assignmentChart = new Chart(assignmentCtx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($ticketAssignments as $assignment)
                        '{{ $assignment->full_name }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Assigned Tickets',
                    data: [
                        @foreach($ticketAssignments as $assignment)
                            {{ $assignment->ticket_count }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(78, 115, 223, 0.8)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            return tooltipItem.yLabel + ' tickets';
                        }
                    }
                }
            }
        });
    </script>

    @endsection