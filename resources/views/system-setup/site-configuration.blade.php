@extends('layouts.master')

@section('title', 'Settings')

@section('css')
    <link href="{{ asset('css/pages/toastr.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/pages/form_layouts.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/pages/advmodals.css') }}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{ asset('vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/clockface/js/clockface.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('js/pages/form_layouts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/noty/js/jquery.noty.packaged.min.js') }}"></script>
    <script>
        @if(session('message'))
        $(document).ready(function () {
            noty({
                text: 'Updated {{ session('message') }} Successfully',
                layout: 'topRight',
                closeWith: ['click'],
                type: 'success'
            });
        });
        @endif
        $("#openingTime").datetimepicker({
            format: 'LT'
        }).parent().css("position :relative");
        $("#closingTime").datetimepicker({
            format: 'LT'
        }).parent().css("position :relative");
    </script>
@endsection

@section('breadcrumbs')
    <li>
        <a href="{{ url('#') }}">
            <i class="livicon" data-name="home" data-size="16" data-color="#000"></i> System Setup
        </a>
    </li>
    <li>
        <a href="{{ route('site-configuration.index') }}">
            @yield('title')
        </a>
    </li>
@endsection

@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Site Information</div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <h3>Site Configuration</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Site Name :</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $site_info->site_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Shorthand Name :</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $site_info->site_abbreviation }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary col-md-push-4 col-md-4" data-toggle="modal" data-target="#updateSiteInfo">Edit Site Configuration</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">Business Hours</div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <h3>Configure Business Hours</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Opening Time :</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ date('g:ia', strtotime($business_hours->opening_time)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Closing Time :</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ date('g:ia', strtotime($business_hours->closing_time)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-danger col-md-push-4 col-md-4" data-toggle="modal" data-target="#updateBusinessHours">Edit Business Hours</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">Configure Deadline for Circulation</div>
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <h3>Circulation Deadline</h3>
                                @foreach($deadlines as $deadline)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="#" class="link link-black form-control-static" data-toggle="modal" data-target="#update{{ $deadline->code }}">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">{{ $deadline->name }} :</label>
                                                    <div class="col-md-8">
                                                        <p class="form-control-static text-black">{{ $deadline->deadline }} day/s
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('modals')
    <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="updateSiteInfo" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('site-configuration.update', $site_info->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PATCH" />
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="modalLabelfade">Update Site Configuration</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Site Name</h4>
                                <p>
                                    <input id="name" name="site_name" type="text" placeholder="Site Name" class="form-control" value="{{ $site_info->site_name }}">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4>Site Abbreviation</h4>
                                <p>
                                    <input id="name" name="site_abbreviation" type="text" placeholder="Site Abbreviation" class="form-control" value="{{ $site_info->site_abbreviation }}">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="updateBusinessHours" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" id="modalLabelfade">Update Business Hours</h4>
                </div>
                <form method="post" action="{{ route('business-hours.update', $business_hours->id) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH" />
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Opening Time</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="livicon" data-name="clock" data-size="20" data-loop="true"></i>
                                            <input type="text" class="form-control" id="openingTime" name="opening_time" value="{{ date('g:ia', strtotime($business_hours->opening_time)) }}"/>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Closing Time</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="livicon" data-name="clock" data-size="20" data-loop="true"></i>
                                            <input type="text" class="form-control" id="closingTime" name="closing_time" value="{{ date('g:ia', strtotime($business_hours->closing_time)) }}"/>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection