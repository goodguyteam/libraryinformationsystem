@extends('layouts.master')

@section('title', 'Book Acquisition List')

@section('css')
    <link href="{{ asset('css/pages/toastr.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css">
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
        $('#selectEdition').select2({
            theme: "bootstrap",
            placeholder: "Select Edition..."
        });


        $('#selectAuthor').select2({
            theme: "bootstrap",
            placeholder: "Select Author/s..."
        });

    </script>
@endsection

@section('breadcrumbs')
    <li>
        <a href="{{ url('#') }}">
            <i class="livicon" data-name="retweet" data-size="16" data-color="#000"></i> Transaction
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
                <div class="panel-heading">Book Acquisition List</div>
                <div class="panel-body table-responsive">
                    <button class="pull-right btn btn-primary" data-toggle="modal" data-target="#acquisiteBook">Acquire Book</button>
                    <table class="table table-striped table-bordered" id="table3">
                        <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Authors</th>
                            <th>Acquisition Type</th>
                            <th width="1">Quantity</th>
                            <th>Status</th>
                            <th width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($acquisition_infos as $acquisition_info)
                            <tr>
                                <td>{{ $book_infos->where('id', $acquisition_info->book_id)->first()->title }}</td>
                                <td>
                                    @foreach(\LIS\BookAuthor::where('book_id', $acquisition_info->book_id)->get() as $book_author)
                                        @if(!$loop->first)
                                            ,<br/>
                                        @endif
                                        {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                    @endforeach
                                </td>
                                <td>{{ $acquisition_types->where('id', $acquisition_info->acquisition_type_id)->first()->name }}</td>
                                <td>{{ $acquisition_info->quantity }} pc/s</td>
                                <td>
                                    @if(is_null(\LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->first()))
                                        Pending
                                    @else
                                        In Inventory
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#viewAcquisition{{ $acquisition_info->id }}"><i class="livicon" data-name="eye-open" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                    @if(is_null(\LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->first()))
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#cancelAcquisition{{ $acquisition_info->id }}"><i class="livicon" data-name="ban" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                        @endif
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
            <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="acquisiteBook" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title" id="modalLabelfade">Acquire Book Details</h4>
                        </div>
                        <form method="post" action="{{ route('acquisition-infos.store') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-5">
                                                <h4>Book Name</h4>
                                                <p>
                                                    <select name="book_id">
                                                        <option selected disabled>Select Book</option>
                                                        @foreach($book_infos as $book_info)
                                                            <option value="{{ $book_info->id }}">{{ $book_info->title }} - {{ date('Y', strtotime($book_info->copyright)) }}  {{ isset($book_info->edition) ? '- '.$book_info->edition : '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-5">
                                                <h4>Acquisition Type</h4>
                                                <p>
                                                    <select name="acquisition_type_id">
                                                        <option selected disabled>Select Acquisition Type</option>
                                                        @foreach($acquisition_types as $acquisition_type)
                                                            <option value="{{ $acquisition_type->id }}">{{ $acquisition_type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-2">
                                                <h4>Quantity</h4>
                                                <p>
                                                    <input id="name" type="number" placeholder="Quantity" minlength="4" maxlength="4" value="1" name="quantity" class="form-control"/>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-primary">Acquire Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    @foreach($acquisition_infos as $acquisition_info)
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="viewAcquisition{{ $acquisition_info->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">Acquisition Details #{{ $acquisition_info->id }}</h4>
                            </div>
                            <form method="post" action="{{ route('acquisition-infos.store') }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="POST" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Book Info</h3>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <h4>Book Name</h4>
                                                    <p>
                                                    <p class="form-control-static">{{ $book_infos->where('id', $acquisition_info->book_id)->first()->title }}</p>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Authors</h4>
                                                    <p>
                                                    <p class="form-control-static">
                                                        @foreach(\LIS\BookAuthor::where('book_id', $acquisition_info->book_id)->get() as $book_author)
                                                            @if(!$loop->first)
                                                                ,
                                                            @endif
                                                            {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                                        @endforeach
                                                    </p>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Publisher</h4>
                                                    <p>
                                                    <p class="form-control-static">
                                                        {{ \LIS\Publisher::where('id', $book_infos->where('id', $acquisition_info->book_id)->first()->publisher_id)->first()->name }}
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3>Acquisition Info</h3>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <h4>Acquisition Type</h4>
                                                    <p>
                                                    <p class="form-control-static">{{ $acquisition_types->where('id', $acquisition_info->acquisition_type_id)->first()->name }}</p>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Quantity</h4>
                                                    <p>
                                                    <p class="form-control-static">
                                                        {{ $acquisition_info->quantity }} pc/s acquired in this transaction
                                                    </p>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>In Inventory</h4>
                                                    <p>
                                                    <p class="form-control-static">
                                                        @if(is_null(\LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->first()))
                                                            Pending, currently not in inventory.
                                                        @else
                                                            Currently {{ \LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->count() }} pc/s in inventory
                                                        @endif
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!is_null(\LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->first()))
                                        <div class="col-md-12">
                                            <h3>Inventory List</h3>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <p><b>Format:</b> (Acquisition Number/ISBN, Call Number, Copy Status, )</p>
                                                    <ul>
                                                        @foreach(\LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->get() as $inventory)
                                                            <li>
                                                                {{ $inventory->accession_number or $inventory->isbn }}, {{ \LIS\BookShelving::where('id', $inventory->shelving_id)->first()->call_number }}, {{ \LIS\BookInventoryStatus::where('id', $inventory->book_status_id)->first()->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="cancelAcquisition{{ $acquisition_info->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h4 class="modal-title" id="modalLabelfade">Confirmation Dialog <small class="white-text">Acquisition #{{ $acquisition_info->id}}</small></h4>
                            </div>
                            <form method="post" action="{{ route('acquisition-infos.destroy', $acquisition_info->id) }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_page" value="AQ" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Are you sure you want to cancel this acquisition?</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn  btn-danger">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    @endforeach
@endsection