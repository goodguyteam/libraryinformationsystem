@extends('layouts.master')

@section('title', 'Dashboard')

@section('css')<link href="{{ asset('assets/backend/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/backend/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" href="{{ asset('assets/backend/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/backend/vendors/animate/animate.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/pages/only_dashboard.css') }}" />
<style type="text/css">
    @import '{{ asset('assets/backend/vendors/highcharts/code/css/highcharts.css') }}';

    /* Link the series colors to axis colors */
    .highcharts-color-0 {
        fill: #7cb5ec;
        stroke: #7cb5ec;
    }
    .highcharts-axis.highcharts-color-0 .highcharts-axis-line {
        stroke: #7cb5ec;
    }
    .highcharts-axis.highcharts-color-0 text {
        fill: #7cb5ec;
    }
    .highcharts-color-1 {
        fill: #90ed7d;
        stroke: #90ed7d;
    }
    .highcharts-axis.highcharts-color-1 .highcharts-axis-line {
        stroke: #90ed7d;
    }
    .highcharts-axis.highcharts-color-1 text {
        fill: #90ed7d;
    }


    .highcharts-yaxis .highcharts-axis-line {
        stroke-width: 2px;
    }

</style>


<link href="{{ asset('css/pages/toastr.css') }}" rel="stylesheet" />
<!--page level css -->
<!-- Add fancyBox main CSS files -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/fancybox/jquery.fancybox.css') }}" media="screen" />
<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/fancybox/helpers/jquery.fancybox-buttons.css') }}" />
<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/fancybox/helpers/jquery.fancybox-thumbs.css') }}" />
<!--page level css end-->
@endsection

@section('js')
    <!-- EASY PIE CHART JS -->
    <script src="{{ asset('assets/backend/vendors/jquery.easy-pie-chart/js/easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/jquery.easy-pie-chart/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/jquery.easingpie.js') }}"></script>
    <!--end easy pie chart -->
    <!--for calendar-->
    <script src="{{ asset('assets/backend/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="{{ asset('assets/backend/vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/backend/vendors/flotchart/js/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="{{ asset('assets/backend/vendors/sparklinecharts/jquery.sparkline.js') }}"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/backend/vendors/countUp.js/js/countUp.js') }}"></script>
    <!--   maps -->
    <script src="{{ asset('assets/backend/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/chartjs/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/backend/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <!--  todolist-->
    <script src="{{ asset('assets/backend/js/pages/todolist.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/dashboard.js') }}" type="text/javascript"></script>

    <!-- begining of page level js -->
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="{{ asset('assets/backend/vendors/fancybox/jquery.fancybox.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/backend/vendors/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/backend/vendors/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="{{ asset('assets/backend/vendors/fancybox/helpers/jquery.fancybox-media.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/backend/js/pages/gallery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/noty/js/jquery.noty.packaged.min.js') }}"></script>
    <!-- end of page level js -->
    @if(session('login'))
        <script type="text/javascript">
            $(document).ready(function () {
                noty({
                    text: '{{ session('login') }}',
                    layout: 'topRight',
                    closeWith: ['click'],
                    type: 'success'
                });
            });
        </script>
    @endif
@endsection

@section('breadcrumbs')
    <li>
        <a href="{{ route('dashboard') }}">
            <i class="livicon" data-name="home" data-size="16" data-color="#000"></i> Dashboard
        </a>
    </li>
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right">
                                <span>December Visitors</span>
                                <div class="number" id="myTargetElement1"></div>
                            </div>
                            <i class="livicon  pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">November</small>
                                <h4 id="myTargetElement1.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">October</small>
                                <h4 id="myTargetElement1.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
            <!-- Trans label pie charts strats here-->
            <div class="redbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Unique Visitors</span>
                                <div class="number" id="myTargetElement2"></div>
                            </div>
                            <i class="livicon pull-right" data-name="user" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">November</small>
                                <h4 id="myTargetElement2.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">October</small>
                                <h4 id="myTargetElement2.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
            <!-- Trans label pie charts strats here-->
            <div class="goldbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Total Books (2018)</span>
                                <div class="number" id="myTargetElement3"></div>
                            </div>
                            <i class="livicon pull-right" data-name="notebook" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">New Books</small>
                                <h4 id="myTargetElement3.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">Old Books</small>
                                <h4 id="myTargetElement3.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
            <!-- Trans label pie charts strats here-->
            <div class="palebluecolorbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Borrowed (Week)</span>
                                <div class="number" id="myTargetElement4"></div>
                            </div>
                            <i class="livicon pull-right" data-name="qrcode" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Last Week</small>
                                <h4 id="myTargetElement4.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">Last Month</small>
                                <h4 id="myTargetElement4.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    <div class="row ">
        <div class="col-md-8 col-sm-6">
            <div class="panel panel-border">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="barchart" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i> Realtime Book Chart
                        <small>- Books stored on the server</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <!--<div id="realtimechart" style="height:350px;"></div>-->
                    <div id="chart-container" style="height:350px;"></div>

                    <script src="{{ asset('assets/backend/vendors/highcharts/code/js/highcharts.js') }}"></script>
                    <script src="{{ asset('assets/backend/vendors/highcharts/code/js/modules/exporting.js') }}"></script>
                    <script src="{{ asset('assets/backend/vendors/highcharts/code/modules/data.js') }}"></script>
                    <script src="{{ asset('assets/backend/vendors/highcharts/code/modules/drilldown.js') }}"></script>

                    <script type="text/javascript">

                        Highcharts.chart('chart-container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Total Acquisitions, Books'
                            },
                            subtitle: {
                                text: 'Click columns to see more data. For more detailed data, <a href="#" target="_blank">click here</a>.'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                className: 'highcharts-color-0',
                                title: {
                                    text: 'Total Books'
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            plotOptions: {
                                column: {
                                    borderRadius: 5
                                },
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y}'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
                            },

                            "series": [
                                {
                                    "name": "Class",
                                    "colorByPoint": false,
                                    "data": [
                                        {
                                            "name": "Filipiniana",
                                            "y": 300,
                                            "drilldown": "FIL"
                                        },
                                        {
                                            "name": "Circulation",
                                            "y": 100,
                                            "drilldown": "CIRC"
                                        },
                                        {
                                            "name": "Theses",
                                            "y": 300,
                                            "drilldown": "ACAD"
                                        },
                                        {
                                            "name": "General Reference",
                                            "y": 100,
                                            "drilldown": "GENREF"
                                        },
                                        {
                                            "name": "Computer References",
                                            "y": 100,
                                            "drilldown": "CMPTR"
                                        },
                                        {
                                            "name": "Pocket Books",
                                            "y": 70,
                                            "drilldown": "PCKTBK"
                                        },
                                        {
                                            "name": "Magazines",
                                            "y": 30,
                                            "drilldown": null
                                        }
                                    ]
                                }
                            ],
                            "drilldown": {
                                "series": [
                                    {
                                        "name": "Filipiniana",
                                        "id": "FIL",
                                        "data": [
                                            [
                                                "v65.0",
                                                0.1
                                            ],
                                            [
                                                "v64.0",
                                                1.3
                                            ],
                                            [
                                                "v63.0",
                                                53.02
                                            ],
                                            [
                                                "v62.0",
                                                1.4
                                            ],
                                            [
                                                "v61.0",
                                                0.88
                                            ],
                                            [
                                                "v60.0",
                                                0.56
                                            ],
                                            [
                                                "v59.0",
                                                0.45
                                            ],
                                            [
                                                "v58.0",
                                                0.49
                                            ],
                                            [
                                                "v57.0",
                                                0.32
                                            ],
                                            [
                                                "v56.0",
                                                0.29
                                            ],
                                            [
                                                "v55.0",
                                                0.79
                                            ],
                                            [
                                                "v54.0",
                                                0.18
                                            ],
                                            [
                                                "v51.0",
                                                0.13
                                            ],
                                            [
                                                "v49.0",
                                                2.16
                                            ],
                                            [
                                                "v48.0",
                                                0.13
                                            ],
                                            [
                                                "v47.0",
                                                0.11
                                            ],
                                            [
                                                "v43.0",
                                                0.17
                                            ],
                                            [
                                                "v29.0",
                                                0.26
                                            ]
                                        ]
                                    },
                                    {
                                        "name": "Circulation",
                                        "id": "CIRC",
                                        "data": [
                                            [
                                                "v58.0",
                                                1.02
                                            ],
                                            [
                                                "v57.0",
                                                7.36
                                            ],
                                            [
                                                "v56.0",
                                                0.35
                                            ],
                                            [
                                                "v55.0",
                                                0.11
                                            ],
                                            [
                                                "v54.0",
                                                0.1
                                            ],
                                            [
                                                "v52.0",
                                                0.95
                                            ],
                                            [
                                                "v51.0",
                                                0.15
                                            ],
                                            [
                                                "v50.0",
                                                0.1
                                            ],
                                            [
                                                "v48.0",
                                                0.31
                                            ],
                                            [
                                                "v47.0",
                                                0.12
                                            ]
                                        ]
                                    },
                                    {
                                        "name": "Theses",
                                        "id": "ACAD",
                                        "data": [
                                            [
                                                "v11.0",
                                                6.2
                                            ],
                                            [
                                                "v10.0",
                                                0.29
                                            ],
                                            [
                                                "v9.0",
                                                0.27
                                            ],
                                            [
                                                "v8.0",
                                                0.47
                                            ]
                                        ]
                                    },
                                    {
                                        "name": "General Reference",
                                        "id": "GENREF",
                                        "data": [
                                            [
                                                "v11.0",
                                                3.39
                                            ],
                                            [
                                                "v10.1",
                                                0.96
                                            ],
                                            [
                                                "v10.0",
                                                0.36
                                            ],
                                            [
                                                "v9.1",
                                                0.54
                                            ],
                                            [
                                                "v9.0",
                                                0.13
                                            ],
                                            [
                                                "v5.1",
                                                0.2
                                            ]
                                        ]
                                    },
                                    {
                                        "name": "Computer References",
                                        "id": "CMPTR",
                                        "data": [
                                            [
                                                "v16",
                                                2.6
                                            ],
                                            [
                                                "v15",
                                                0.92
                                            ],
                                            [
                                                "v14",
                                                0.4
                                            ],
                                            [
                                                "v13",
                                                0.1
                                            ]
                                        ]
                                    },
                                    {
                                        "name": "Pocket Books",
                                        "id": "PCKTBK",
                                        "data": [
                                            [
                                                "v50.0",
                                                0.96
                                            ],
                                            [
                                                "v49.0",
                                                0.82
                                            ],
                                            [
                                                "v12.1",
                                                0.14
                                            ]
                                        ]
                                    }
                                ]
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="panel blue_gradiant_bg">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="qrcode" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Transaction Toggler
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sparkline-chart">
                                <!--<div class="number" id="sparkline_bar"></div>-->
                                <div class="number">
                                    <a class="fancybox" href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->margin(0)->backgroundColor(248,248,248)->color(65,139,202)->generate('qfSodG6fVv5yKT1MMuvv'))!!}" data-fancybox-group="gallery" title="Scan this to toggle library transactions">
                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->margin(0)->backgroundColor(65,139,202)->color(255,255,255)->generate('qfSodG6fVv5yKT1MMuvv'))!!}" class="img-responsive gallery-style" alt="Image">
                                    </a>
                                </div>
                                <small class="white-text">Scan to toggle Transactions<br/>(Click if the QR Code is too small)</small>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"></div>
                        <div class="margin-bottom-10 visible-sm"></div>
                    </div>
                </div>
            </div>
            <!-- BEGIN Percentage monitor -->
            <div class="panel green_gradiante_bg ">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="spinner-six" data-size="16" data-loop="false" data-c="#fff" data-hc="white"></i> Result vs Target
                    </h3>
                </div>
                <div class="panel-body nopadmar">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <h4 class="small-heading">Sales</h4>
                            <span class="chart cir chart-widget-pie widget-easy-pie-1" data-percent="45">
                                <span class="percent">45</span>
                                        </span>
                        </div>
                        <!-- /.col-sm-4 -->
                        <div class="col-sm-6 text-center">
                            <h4 class="small-heading">Reach</h4>
                            <span class="chart cir chart-widget-pie widget-easy-pie-3" data-percent="25">
                                <span class="percent">25</span>
                                        </span>
                        </div>
                        <!-- /.col-sm-4 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- END BEGIN Percentage monitor-->
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="panel panel-success panel-border">
                <div class="panel-heading  border-light">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="calendar" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Calendar
                    </h4>
                </div>
                <div class="panel-body">
                    <div id='external-events'></div>
                    <div id="calendar"></div>
                    <div class="box-footer pad-5">
                        <a href="#" class="btn btn-success btn-block createevent_btn" data-toggle="modal" data-target="#myModal">Create event
                        </a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">
                                        <i class="fa fa-plus" style="margin-top: 8px;"></i> Create Event
                                    </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group">
                                        <input type="text" id="new-event" class="form-control" placeholder="Event">
                                        <div class="input-group-btn">
                                            <button type="button" id="color-chooser-btn" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                Type
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right" id="color-chooser">
                                                <li>
                                                    <a class="palette-primary" href="#">Primary</a>
                                                </li>
                                                <li>
                                                    <a class="palette-success" href="#">Success</a>
                                                </li>
                                                <li>
                                                    <a class="palette-info" href="#">Info</a>
                                                </li>
                                                <li>
                                                    <a class="palette-warning" href="#">warning</a>
                                                </li>
                                                <li>
                                                    <a class="palette-danger" href="#">Danger</a>
                                                </li>
                                                <li>
                                                    <a class="palette-default" href="#">Default</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /btn-group -->
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                                        Close
                                        <i class="fa fa-times" style="margin-top: 4px;"></i>
                                    </button>
                                    <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                                        <i class="fa fa-plus" style="margin-top: 5px;"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- To do list -->
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="panel panel-primary todolist">
                <div class="panel-heading border-light">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="medal" data-size="18" data-color="white" data-hc="white" data-l="true"></i> Tasks
                    </h4>
                </div>
                <div class="panel-body nopadmar">
                    <form class="row list_of_items">
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck checkbox-custom">
                                    <input type="checkbox" class="striked large" />
                                </div>
                                <div class="todotext todoitem">Meeting with CEO</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Team Out</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Review On Sales</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Meeting with Client</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Analysis on Views</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Seminar on Market</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Business Review</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Purchase Equipment</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Meeting with CEO</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                        <div class="todolist_list showactions">
                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1">
                                <div class="todoitemcheck">
                                    <input type="checkbox" class="striked" />
                                </div>
                                <div class="todotext todoitem">Takeover Leads</div>
                                <span class="label label-default">2016-07-27</span>
                            </div>
                            <div class="col-md-4  col-sm-4 col-xs-4  pull-right showbtns todoitembtns">
                                <a href="#" class="todoedit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <span class="striks">|</span>
                                <a href="#" class="tododelete redcolor">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="todolist_list adds">
                        <form role="form" id="main_input_box" class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="custom_textbox">Add Task</label>
                                <input id="custom_textbox" name="Item" type="text" required placeholder="Add list item here" class="form-control" />
                            </div>
                            <div class="form-group is-empty date_pick">
                                <label class="sr-only" for="task_deadline">Datepicker</label>
                                <input class="form-control datepicker" placeholder='Dead line' id="task_deadline" data-date-format="YYYY/MM/DD" required="required" name="task_deadline" type="text">
                            </div>
                            <input type="submit" value="Add Task" class="btn btn-primary add_button" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row ">
        <div class="col-md-4 col-sm-12">
            <div class="panel panel-danger">
                <div class="panel-heading border-light">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="mail" data-size="18" data-color="white" data-hc="white" data-l="true"></i> Quick Mail
                    </h4>
                </div>
                <div class="panel-body no-padding">
                    <div class="compose row">
                        <label class="col-md-3 hidden-xs">To:</label>
                        <input type="text" class="col-md-9 col-xs-9" placeholder="name@email.com " tabindex="1" />
                        <div class="clear"></div>
                        <label class="col-md-3 hidden-xs">Subject:</label>
                        <input type="text" class="col-md-9 col-xs-9" tabindex="1" placeholder="Subject" />
                        <div class="clear"></div>
                        <div class='box-body'>
                            <form>
                                <textarea class="textarea textarea_home resize_vertical" placeholder="Write mail content here"></textarea>
                            </form>
                        </div>
                        <br />
                        <div class="pull-right">
                            <a href="#" class="btn btn-danger">Send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="panel panel-border">
                <div class="panel-heading">
                    <h4 class="panel-title pull-left visitor">
                        <i class="livicon" data-name="map" data-size="16" data-loop="true" data-c="#515763" data-hc="#515763"></i> Visitors Map
                    </h4>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="livicon" data-name="settings" data-size="16" data-loop="true" data-c="#515763" data-hc="#515763"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="panel-collapse collapses" href="#">
                                    <i class="fa fa-angle-up"></i>
                                    <span>Collapse</span>
                                </a>
                            </li>
                            <li>
                                <a class="panel-refresh" href="#">
                                    <i class="fa fa-refresh"></i>
                                    <span>Refresh</span>
                                </a>
                            </li>
                            <li>
                                <a class="panel-config" href="#panel-config" data-toggle="modal">
                                    <i class="fa fa-wrench"></i>
                                    <span>Configurations</span>
                                </a>
                            </li>
                            <li>
                                <a class="panel-expand" href="#">
                                    <i class="fa fa-expand"></i>
                                    <span>Fullscreen</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body nopadmar">
                    <div id="world-map-markers" style="width:100%; height:300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
