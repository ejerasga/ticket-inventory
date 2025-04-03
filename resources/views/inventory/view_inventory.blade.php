@extends('layout.header')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Inventory Management</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Available Stocks Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('view_stock') }}">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Available Stocks</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Stock::count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('view_stock') }}" class="small text-primary">
                                View Stocks
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Item Deployed Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('item_deployed') }}">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Item Deployed</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ \App\Models\ItemDeployed::count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-export fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('item_deployed') }}" class="small text-success">
                                View Item Deployed
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PR Requests Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('prrequests.index') }}">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        PR Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\PrRequest::count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('prrequests.index') }}" class="small text-danger">
                                View PR Requests
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PC Specifications Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ route('pcspecs.index') }}">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        PC Specifications</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\PcSpecs::count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-desktop fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('pcspecs.index') }}" class="small text-info">
                                View PC Specs
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Item Replacement Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Item Replacement</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">125</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-sync-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="" class="small text-warning">
                                View Item Replacement
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Printer Logs Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        Printer Logs</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">125</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-print fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="" class="small text-secondary">
                                View Printer Logs
                                <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Charts Row (Optional) -->
        @if (Auth::check() && (Auth::user()->r_id == 1 || Auth::user()->r_id == 2))
            <div class="row">
                <!-- Inventory Status Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Inventory Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">View Options:</div>
                                    <a class="dropdown-item" href="#" id="viewMonthly">Monthly View</a>
                                    <a class="dropdown-item" href="#" id="viewQuarterly">Quarterly View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" id="exportChartData">Export Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="inventoryOverviewChart"></canvas>
                            </div>
                            <!-- Added Summary Stats Below Chart -->
                            <div class="mt-4 text-center small">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Total Items:
                                            {{ \App\Models\Stock::sum('stock_available') ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Deployed:
                                            {{ \App\Models\ItemDeployed::count() ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Low Stock:
                                            {{ \App\Models\Stock::where('stock_available', '<', 5)->count() ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Pending PR:
                                            {{ \App\Models\PrRequest::where('arrived', 0)->count() ?? 0 }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Item Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="itemCategoriesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- /.container-fluid -->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set up chart configuration only if elements exist
            if (document.getElementById('inventoryOverviewChart')) {
                // Fetch actual data from the database
                const availableItems = {!! json_encode([
                    \App\Models\Stock::whereMonth('created_at', 1)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 2)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 3)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 4)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 5)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 6)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 7)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 8)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 9)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 10)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 11)->sum('stock_available') ?? 0,
                    \App\Models\Stock::whereMonth('created_at', 12)->sum('stock_available') ?? 0,
                ]) !!};

                const deployedItems = {!! json_encode([
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 1)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 2)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 3)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 4)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 5)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 6)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 7)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 8)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 9)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 10)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 11)->count() ?? 0,
                    \App\Models\ItemDeployed::whereMonth('date_deployed', 12)->count() ?? 0,
                ]) !!};

                const prRequests = {!! json_encode([
                    \App\Models\PrRequest::whereMonth('created_at', 1)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 2)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 3)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 4)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 5)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 6)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 7)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 8)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 9)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 10)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 11)->count() ?? 0,
                    \App\Models\PrRequest::whereMonth('created_at', 12)->count() ?? 0,
                ]) !!};

                var ctx = document.getElementById('inventoryOverviewChart').getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                            "Nov", "Dec"
                        ],
                        datasets: [{
                                label: "Available Items",
                                lineTension: 0.3,
                                backgroundColor: "rgba(78, 115, 223, 0.05)",
                                borderColor: "rgba(78, 115, 223, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointBorderColor: "rgba(78, 115, 223, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: availableItems,
                            },
                            {
                                label: "Deployed Items",
                                lineTension: 0.3,
                                backgroundColor: "rgba(28, 200, 138, 0.05)",
                                borderColor: "rgba(28, 200, 138, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(28, 200, 138, 1)",
                                pointBorderColor: "rgba(28, 200, 138, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
                                pointHoverBorderColor: "rgba(28, 200, 138, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: deployedItems,
                            },
                            {
                                label: "PR Requests",
                                lineTension: 0.3,
                                backgroundColor: "rgba(246, 194, 62, 0.05)",
                                borderColor: "rgba(246, 194, 62, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(246, 194, 62, 1)",
                                pointBorderColor: "rgba(246, 194, 62, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
                                pointHoverBorderColor: "rgba(246, 194, 62, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: prRequests,
                            }
                        ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'month'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 12
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                    beginAtZero: true,
                                    callback: function(value, index, values) {
                                        return value;
                                    }
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
                            display: true,
                            position: 'bottom'
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
                        }
                    }
                });

                // Add event listeners for the view option buttons
                document.getElementById('viewMonthly').addEventListener('click', function(e) {
                    e.preventDefault();
                    myLineChart.data.labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug",
                        "Sep", "Oct", "Nov", "Dec"
                    ];
                    myLineChart.data.datasets[0].data = availableItems;
                    myLineChart.data.datasets[1].data = deployedItems;
                    myLineChart.data.datasets[2].data = prRequests;
                    myLineChart.update();
                });

                document.getElementById('viewQuarterly').addEventListener('click', function(e) {
                    e.preventDefault();
                    myLineChart.data.labels = ["Q1", "Q2", "Q3", "Q4"];

                    // Calculate quarterly totals
                    const availableQuarterly = [
                        availableItems.slice(0, 3).reduce((a, b) => a + b, 0),
                        availableItems.slice(3, 6).reduce((a, b) => a + b, 0),
                        availableItems.slice(6, 9).reduce((a, b) => a + b, 0),
                        availableItems.slice(9, 12).reduce((a, b) => a + b, 0)
                    ];

                    const deployedQuarterly = [
                        deployedItems.slice(0, 3).reduce((a, b) => a + b, 0),
                        deployedItems.slice(3, 6).reduce((a, b) => a + b, 0),
                        deployedItems.slice(6, 9).reduce((a, b) => a + b, 0),
                        deployedItems.slice(9, 12).reduce((a, b) => a + b, 0)
                    ];

                    const prQuarterly = [
                        prRequests.slice(0, 3).reduce((a, b) => a + b, 0),
                        prRequests.slice(3, 6).reduce((a, b) => a + b, 0),
                        prRequests.slice(6, 9).reduce((a, b) => a + b, 0),
                        prRequests.slice(9, 12).reduce((a, b) => a + b, 0)
                    ];

                    myLineChart.data.datasets[0].data = availableQuarterly;
                    myLineChart.data.datasets[1].data = deployedQuarterly;
                    myLineChart.data.datasets[2].data = prQuarterly;
                    myLineChart.update();
                });

                document.getElementById('exportChartData').addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('Export functionality will be implemented in the next update.');
                });
            }

            if (document.getElementById('itemCategoriesChart')) {
                var ctx = document.getElementById('itemCategoriesChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Hardware", "Software", "Peripherals", "Supplies"],
                        datasets: [{
                            data: [40, 25, 15, 20],
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
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
                        cutoutPercentage: 70,
                    },
                });
            }
        });
    </script>
@endsection
