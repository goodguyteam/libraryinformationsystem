@extends('layouts.master')

@section('title', 'Student Management')

@section('css')
    <link href="{{ asset('css/pages/toastr.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/pages/form_layouts.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/pages/advmodals.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}" />
    <link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ asset('vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/clockface/js/clockface.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('js/pages/form_layouts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pages/table-advanced2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/noty/js/jquery.noty.packaged.min.js') }}"></script>
    <script>
        @if(session('message'))
        $(document).ready(function () {
            noty({
                text: '{{ session('message') }}',
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
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Students List</div>
                <div class="panel-body table-responsive">
                    <button class="pull-right btn btn-primary" data-toggle="modal" data-target="#addNewUser">Add New Student</button>
                    <table class="table table-striped table-bordered" id="table3">
                        <thead>
                        <tr>
                            <th width="1">Student No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Course, Year and Section</th>
                            <th width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->margin(0)->backgroundColor(249,249,249)->generate($student->student_number))!!} " class="center-block"/></td>
                                    <td><img src="{{ $student->image_path or Laravolt\Avatar\Facade::create($student->first_name.' '.$student->last_name)->setBorder(0, '#000')->toBase64() }}" width="100px" class="center-block img-circle"/></td>
                                    <td><p class="center-block text-center">{{ $student->last_name }}, {{ $student->first_name }}</p></td>
                                    <td><p class="center-block text-center">{{ $student->course }} {{ $student->year }}-{{ $student->section }}</p></td>
                                    <td>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#viewStudent{{ $student->id }}"><i class="livicon" data-name="eye-open" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                        |
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editStudent{{ $student->id }}"><i class="livicon" data-name="edit" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection

        @section('modals')
            <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="addNewUser" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title" id="modalLabelfade">Add New User</h4>
                        </div>
                        <form method="post" action="{{ route('identity-management.store') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Name</h4>
                                        <p>
                                            <input id="name" name="name" type="text" placeholder="Full Name" class="form-control">
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Email</h4>
                                        <p>
                                            <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Password</h4>
                                        <p>
                                            <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-primary">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    @foreach($students as $student)
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="viewStudent{{ $student->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">View Student Details</h4>
                            </div>
                            <div>
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="POST" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ Laravolt\Avatar\Facade::create($student->first_name.' '.$student->last_name)->setBorder(0, '#000')->toBase64() }}" width="135px"/>
                                            <h4>Student Number</h4>
                                            <p>
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(130)->margin(0)->backgroundColor(255,255,255)->generate($student->student_number))!!} ">
                                            </p>
                                        </div>
                                        <div class="col-md-8">
                                            <h4>Student Info</h4>
                                            <p>
                                            <p class="form-control-static"><b>Name:</b> {{ $student->last_name }}, {{ $student->first_name }}</p>
                                            </p>
                                            <p>
                                            <p class="form-control-static"><b>Course:</b> {{ $student->course }} {{ $student->year }}-{{ $student->section }}</p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="editStudent{{ $student->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">Add New User</h4>
                            </div>
                            <form method="post" action="{{ route('identity-management.store') }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="POST" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Name</h4>
                                            <p>
                                                <input id="name" name="name" type="text" placeholder="Full Name" class="form-control">
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Email</h4>
                                            <p>
                                                <input id="email" name="email" type="text" placeholder="Email" class="form-control">
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Password</h4>
                                            <p>
                                                <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    @endforeach
@endsection