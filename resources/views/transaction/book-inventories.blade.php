@extends('layouts.master')

@section('title', 'Book Inventories List')

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
                <div class="panel-heading">Book Inventory List</div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-bordered" id="table3">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Call Number</th>
                            <th>Book Title</th>
                            <th>Authors</th>
                            <th>Status</th>
                            <th width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($book_inventories as $book_inventory)
                                <tr>
                                    <td>
                                        @foreach($book_shelves as $book_shelf)
                                            @if($book_inventory->shelving_id == $book_shelf->id)
                                                {{ $shelves->where('id', $book_shelf->shelf_id)->first()->code }} - {{ $book_shelf->book_sequence }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($book_shelves as $book_shelf)
                                            @if($book_inventory->shelving_id == $book_shelf->id)
                                                {{ $book_shelf->call_number }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $book_infos->where('id', $book_inventory->book_info_id)->first()->title }}</td>
                                    <td>
                                        @foreach($book_authors->where('book_id', $book_inventory->book_info_id) as $book_author)
                                            @if($book_author->book_id == $book_inventory->book_info_id)
                                                @if(!$loop->first)
                                                    , <br/>
                                                @endif
                                                {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ \LIS\BookInventoryStatus::where('id', $book_inventory->book_status_id)->first()->name }}</td>
                                    <td>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#editBookCopy{{ $book_inventory->id }}"><i class="livicon" data-name="edit" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Pending Acquisitions List</div>
                <div class="panel-body table-responsive">
                    <table class="table table-striped table-bordered" id="table31">
                        <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Authors</th>
                            <th>Acquisition Type</th>
                            <th>Date of Acquisition</th>
                            <th width="1">Quantity</th>
                            <th width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($acquisition_infos->where('cancelled', false) as $acquisition_info)
                            @if(is_null(\LIS\BookInventory::where('acquisition_info_id', $acquisition_info->id)->first()))
                                <tr>
                                    <td>{{ $book_infos->where('id', $acquisition_info->book_id)->first()->title }}</td>
                                    <td>
                                        @foreach($book_authors as $book_author)
                                            @if($book_author->book_id == $acquisition_info->book_id)
                                                @if(!$loop->first)
                                                    , <br/>
                                                @endif
                                                {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $acquisition_types->where('id', $acquisition_info->acquisition_type_id)->first()->name }}</td>
                                    <td>{{ date('M d, Y', strtotime($acquisition_info->date_acquired)) }}</td>
                                    <td>{{ $acquisition_info->quantity }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#inventoryBook{{ $acquisition_info->id }}"><i class="livicon" data-name="sign-in" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#cancelAcquisition{{ $acquisition_info->id }}"><i class="livicon" data-name="ban" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        @endsection

        @section('modals')

            @foreach($book_inventories as $book_inventory)
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="editBookCopy{{ $book_inventory->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">Edit Book Copy</h4>
                            </div>
                            <form method="post" action="{{ route('book-inventories.update', $book_inventory->id) }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PATCH" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Inventory Details</h3>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <h4>ISBN</h4>
                                                            <p>
                                                                <input id="name" name="isbn" type="text" placeholder="ISBN" class="form-control" value="{{ $book_inventory->isbn }}"/>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4>Accession Number</h4>
                                                            <p>
                                                                <input id="name" name="accession_number" type="text" placeholder="YYYY-#####-###" class="form-control" value="{{ $book_inventory->accession_number }}"/>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-6"><h4>Call Number</h4>
                                                            <p>
                                                                <input id="name" name="call_number" type="text" placeholder="Call Number" class="form-control" value="{{ \LIS\BookShelving::where('id', $book_inventory->shelving_id)->first()->call_number }}"/>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4>Book Sequence</h4>
                                                            <p>
                                                                <input id="name" name="book_sequence" type="text" placeholder="### or ###.# or ### #/#" class="form-control" value="{{ \LIS\BookShelving::where('id', $book_inventory->shelving_id)->first()->book_sequence }}"/>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-6"><h4>Book Status</h4>
                                                            <p>
                                                                <select name="book_status_code">
                                                                    @foreach(\LIS\BookInventoryStatus::all() as $book_status)
                                                                        @if($book_status->code != 'dspsd' || $book_status->code != 'cndmnd' || $book_status->code != 'wdng')
                                                                        <option value="{{ $book_status->code }}" {{ $book_inventory->book_status_id == $book_status->id ? 'selected' : '' }}>{{ $book_status->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

    @foreach($acquisition_infos as $acquisition_info)

                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="inventoryBook{{ $acquisition_info->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">Inventory Book: {{ $book_infos->where('id', $acquisition_info->book_id)->first()->title }}</h4>
                            </div>
                            <form method="post" action="{{ route('book-inventories.store') }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="POST" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Book Info</h3>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-4"><h4>Book Title, Edition</h4>
                                                    <p>
                                                    <p class="form-control-static">
                                                        {{ $book_infos->where('id', $acquisition_info->book_id)->first()->title }}
                                                        {{ isset($book_infos->where('id', $acquisition_info->book_id)->first()->edition) ? ', '.$book_infos->where('id', $acquisition_info->book_id)->first()->edition : '' }}</p>
                                                    </p>
                                                </div>
                                                <div class="col-md-4"><h4>Author/s</h4>
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

                                                <div class="col-md-4"><h4>Publisher</h4>
                                                    <p>
                                                    <p class="form-control-static">
                                                        {{ \LIS\Publisher::where('id', $book_infos->where('id', $acquisition_info->book_id)->first()->publisher_id)->first()->name }}
                                                    </p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h3>Cataloguing</h3>
                                            <hr/>
                                            <div class="form-group">
                                                <div class="col-md-4"><h4>Classification Info</h4>
                                                    <p>
                                                        <input id="name" name="class_id" type="hidden" placeholder="ISBN" class="form-control" value="{{ $book_infos->where('id', $acquisition_info->book_id)->first()->class_id }}"/>

                                                    <p class="form-control-static">{{ $classifications->where('id', $book_infos->where('id', $acquisition_info->book_id)->first()->class_id)->first()->code }} - {{ $classifications->where('id', $book_infos->where('id', $acquisition_info->book_id)->first()->class_id)->first()->name }}</p>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Shelf</h4>
                                                    <p>
                                                        <select name="shelf_code">
                                                            <option selected disabled>Select Shelf</option>
                                                            @foreach($shelves as $shelf)
                                                                <option value="{{ $shelf->code }}">{{ $shelf->code }} - {{ $shelf->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h4>Section</h4>
                                                    <p>
                                                        <select name="section_code">
                                                            <option selected disabled>Select Section</option>
                                                            @foreach($shelf_sections as $shelf_section)
                                                                <option value="{{ $shelf_section->prefix }}">{{ $shelf_section->prefix }} - {{ $shelf_section->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <h3>Inventory Entries</h3>
                                            <hr/>
                                        </div>
                                        <input type="hidden" name="book_info_id" value="{{ $acquisition_info->book_id }}"/>
                                        <input type="hidden" name="acquisition_info_id" value="{{ $acquisition_info->id }}"/>
                                        <div class="col-md-1">
                                            <h5>#</h5>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <h5>ISBN</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Accession Number</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <h5>Call Number</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <h5>Book Sequence</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <hr/>
                                        </div>
                                            @for ($i = 0; $i < $acquisition_info->quantity; $i++)
                                            {{--<div class="col-md-12">--}}
                                                {{--<h4>{{ $book_infos->where('id', $acquisition_info->book_id)->first()->title }}, Copy #{{ $i + 1 }}</h4>--}}
                                            {{--</div>--}}

                                            <div class="col-md-1">
                                                <h5>{{ $i + 1 }}</h5>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group-sm">
                                                    <div class="col-md-6">
                                                        <p>
                                                            <input id="name" name="isbn[]" type="text" placeholder="ISBN" class="form-control" />
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>
                                                            <input id="name" name="accession_number[]" type="text" placeholder="YYYY-#####-###" class="form-control" />
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-sm">
                                                    <div class="col-md-6">
                                                        <p>
                                                            <input id="name" name="call_number[]" type="text" placeholder="Call Number" class="form-control"/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>
                                                            <input id="name" name="book_sequence[]" type="text" placeholder="### or ###.# or ### #/#" class="form-control"/>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12"><br/><hr/></div>
                                            @endfor
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary">Add to Inventory</button>
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
                                <input type="hidden" name="_page" value="IN" />
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