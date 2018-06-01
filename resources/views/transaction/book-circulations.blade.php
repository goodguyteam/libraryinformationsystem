@extends('layouts.master')

@section('title', 'Book Circulation (Borrow/Return Books)')

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
                <div class="panel-heading">Book Circulation List</div>
                <div class="panel-body table-responsive">
                    <button class="pull-right btn btn-primary" data-toggle="modal" data-target="#borrowBookStudent">Borrow a Book (Student)</button>
                    <p class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <button class="pull-right btn btn-primary" data-toggle="modal" data-target="#borrowBookPersonnel">Borrow a Book (Admin, Faculty, etc.)</button>
                    <table class="table table-striped table-bordered" id="table3">
                        <thead>
                        <tr>
                            <th>Transaction Code</th>
                            <th>Book Borrowed</th>
                            <th>Borrower</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(\Illuminate\Support\Facades\DB::table('transactions')->latest()->get() as $borrowed)
                            <tr>
                                <td>{{ $borrowed->code }}</td>
                                <td>{{ \LIS\BookInfo::where('id', \LIS\BookInventory::where('id', $borrowed->book_copy_id)->first()->book_info_id)->first()->title }}</td>
                                <td>
                                    {{ $borrowed->student_borrower_id ? \LIS\StudentInfo::where('id', $borrowed->student_borrower_id)->first()->first_name : \LIS\PersonnelInfo::where('id', $borrowed->personnel_borrower_id)->first()->first_name }} {{ $borrowed->student_borrower_id ? \LIS\StudentInfo::where('id', $borrowed->student_borrower_id)->first()->last_name : \LIS\PersonnelInfo::where('id', $borrowed->personnel_borrower_id)->first()->last_name }}
                                </td>
                                <td><b>Borrowed:</b><br/>{{ date('h:ia', strtotime($borrowed->date_borrowed)) }}<br/>{{ date('M d, Y', strtotime($borrowed->date_borrowed)) }}<br/><b>Returned:</b><br/> {{ $borrowed->date_returned > \Carbon\Carbon::now() ? 'N/A' : date('h:ia', strtotime($borrowed->date_returned)) }}<br/>{{ $borrowed->date_returned > \Carbon\Carbon::now() ? '' :  date('M d, Y', strtotime($borrowed->date_returned)) }}</td>
                                <td>{{ $borrowed->date_returned > \Carbon\Carbon::now() ? 'Currently Borrowed' : 'Returned Already' }}</td>
                                <td width="100px">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#viewTransaction{{ $borrowed->id }}"><i class="livicon" data-name="eye-open" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button> <button class="btn btn-danger" data-toggle="modal" data-target="#confirmReturn{{ $borrowed->id }}"><i class="livicon" data-name="sign-in" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
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
            <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="borrowBookStudent" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title" id="modalLabelfade">Borrow a Book</h4>
                        </div>
                        <form method="post" action="{{ route('book-circulations.store') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Borrower Information</h3>
                                        <hr/>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <h4>Student</h4>
                                                <select name="student_number">
                                                    <option selected disabled="disabled">Choose a student here...</option>
                                                    @foreach($students as $student)
                                                        <option value="{{ $student->student_number }}">{{ $student->student_number }} - {{ $student->first_name.' '.$student->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h3>Select Book</h3>
                                        <hr/>
                                        <table class="table table-striped table-bordered" id="table31">
                                            <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Accession No./ISBN</th>
                                                <th>Call Number</th>
                                                <th>Book Title</th>
                                                <th>Authors</th>
                                                <th>Status</th>
                                                <th width="1">Borrow</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $book)

                                                    @if(empty(\Illuminate\Support\Facades\DB::table('transactions')->where('book_copy_id', $book->id)->latest()->first()) || \Illuminate\Support\Facades\DB::table('transactions')->where('book_copy_id', $book->id)->latest()->first()->date_returned < \Carbon\Carbon::now())
                                                <tr>
                                                    <td>
                                                        @foreach($book_shelves as $book_shelf)
                                                            @if($book->shelving_id == $book_shelf->id)
                                                                {{ \LIS\LibraryShelf::where('id', $book_shelf->shelf_id)->first()->code }} - {{ $book_shelf->book_sequence }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $book->isbn or $book->accession_number }}</td>
                                                    <td>{{ \LIS\BookShelving::where('id', $book->shelving_id)->first()->call_number }}</td>
                                                    <td>{{ \LIS\BookInfo::where('id', $book->book_info_id)->first()->title }}</td>
                                                    <td>
                                                        @foreach(\LIS\BookAuthor::where('book_id', $book->book_info_id)->get() as $book_author)
                                                            @if(!$loop->first)
                                                                ,<br/>
                                                            @endif
                                                            {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                                        @endforeach
                                                    </td>
                                                    <td>{{ \LIS\BookInventoryStatus::where('id', $book->book_status_id)->first()->name }}</td>
                                                    <td width="100px">
                                                        <input type="radio" name="borrowed_book" value="{{ $book->id }}">
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-primary">Borrow Selected Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    @foreach(\Illuminate\Support\Facades\DB::table('transactions')->latest()->get() as $borrowed)
        <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="confirmReturn{{ $borrowed->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title" id="modalLabelfade">Confirmation for Book Returning</h4>
                    </div>
                    <form method="post" action="{{ route('book-circulations.update', $borrowed->id) }}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Are you sure you want to return the book, {{ \LIS\BookInfo::where('id', \LIS\BookInventory::where('id', $borrowed->book_copy_id)->first()->book_info_id)->first()->title }}, the one that {{ $borrowed->student_borrower_id ? \LIS\StudentInfo::where('id', $borrowed->student_borrower_id)->first()->first_name : \LIS\PersonnelInfo::where('id', $borrowed->personnel_borrower_id)->first()->first_name }} {{ $borrowed->student_borrower_id ? \LIS\StudentInfo::where('id', $borrowed->student_borrower_id)->first()->last_name : \LIS\PersonnelInfo::where('id', $borrowed->personnel_borrower_id)->first()->last_name }} borrowed?</p>
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