@extends('layouts.master')

@section('title', 'Subjects')

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
                <div class="panel-heading">Subjects List</div>
                <div class="panel-body table-responsive">
                    Toggle Column:
                    <div class="btn-group" style="margin:10px 0;">
                        <button type="button" class="toggle-vis btn btn-default" data-column="0">Subject</button>
                        <button type="button" class="toggle-vis btn btn-default" data-column="1">Description</button>
                        <button type="button" class="toggle-vis btn btn-default" data-column="2">Actions</button>
                    </div>
                    <button class="pull-right btn btn-primary" data-toggle="modal" data-target="#addNewSubject">Add New Subject</button>
                    <table class="table table-striped table-bordered" id="table3">
                        <thead>
                        <tr>
                            <th>Genre</th>
                            <th>Description</th>
                            <th width="30px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->description }}</td>
                                <td><button class="btn btn-success" data-toggle="modal" data-target="#editSubject{{ $subject->id }}"><i class="livicon" data-name="edit" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection

        @section('modals')
            <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="addNewSubject" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title" id="modalLabelfade">Add New Subject</h4>
                        </div>
                        <form method="post" action="{{ route('subjects.store') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Subject</h4>
                                        <p>
                                            <input id="name" name="name" type="text" placeholder="Genre" class="form-control">
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Description</h4>
                                        <p>
                                            <input id="name" name="description" type="text" placeholder="Description" class="form-control">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-primary">Add Subject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach($subjects as $subject)
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="editSubject{{ $subject->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">Edit Subject</h4>
                            </div>
                            <form method="post" action="{{ route('subjects.update', $subject->id) }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PATCH" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Subject</h4>
                                            <p>
                                                <input id="name" name="name" type="text" placeholder="Subject" class="form-control" value="{{ $subject->name }}">
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Description</h4>
                                            <p>
                                                <input id="name" name="description" type="text" placeholder="Description" class="form-control" value="{{ $subject->description }}">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    @endforeach
@endsection