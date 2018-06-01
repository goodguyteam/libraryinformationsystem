@extends('layouts.master')

@section('title', 'Book Info List')

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
                <div class="panel-heading">Editions List</div>
                <div class="panel-body table-responsive">
                    <button class="pull-right btn btn-primary" data-toggle="modal" data-target="#addNewBook">Add New Book</button>
                    <table class="table table-striped table-bordered" id="table3">
                        <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Authors</th>
                            <th>Publisher</th>
                            <th width="1">Copyright</th>
                            <th width="1">Classification Code</th>
                            <th width="100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>
                                    @foreach(\LIS\BookAuthor::where('book_id', $book->id)->get() as $book_author)
                                        @if(!$loop->first)
                                            ,<br/>
                                        @endif
                                        {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                    @endforeach
                                </td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ date('Y', strtotime($book->copyright)) }}</td>
                                <td>{{ $book->classification }}</td>
                                <td>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#viewBook{{ $book->id }}"><i class="livicon" data-name="eye-open" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
                                    |
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#editBook{{ $book->id }}"><i class="livicon" data-name="edit" data-size="20" data-color="#fff" data-hc="#ccc" data-loop="true"></i></button>
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
            <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="addNewBook" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title" id="modalLabelfade">Add New Book Info</h4>
                        </div>
                        <form method="post" action="{{ route('book-infos.store') }}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <h4>Book Title</h4>
                                                <p>
                                                    <input id="name" name="title" type="text" placeholder="Book Title" class="form-control" />
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <h4>Copyright Year</h4>
                                            <p>
                                                <input id="name" type="number" placeholder="YYYY" minlength="4" maxlength="4" value="{{ date('Y', strtotime(\Carbon\Carbon::now()))}}" name="copyright" class="form-control"/>
                                            </p>
                                        </div>
                                        <div class="col-md-3">
                                            <h4>Edition </h4>
                                            <p>
                                                <input id="name" type="text" placeholder="Edition" name="edition" class="form-control"/>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h4>Library of Congress Classification</h4>
                                            <p>
                                                <select name="class_code">
                                                    <option selected disabled>Select Classification</option>
                                                    @foreach($classifications as $classification)
                                                        <option value="{{ $classification->code }}">{{ $classification->name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <h4>Author/s</h4>
                                                <p>
                                                    <select id="selectAuthor" name="authors[]" multiple>
                                                        @foreach($authors as $author)
                                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>Publisher</h4>
                                                <p>
                                                    <select name="publisher_id">
                                                        <option selected disabled>Select Publisher</option>
                                                        @foreach($publishers as $publisher)
                                                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <h4>Genre/s</h4>
                                                <p>
                                                    <select id="selectAuthor" name="genres[]" multiple>
                                                        @foreach($genres as $genre)
                                                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>Subject/s</h4>
                                                <p>
                                                    <select name="subjects[]" multiple>
                                                        @foreach($subjects as $subject)
                                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn  btn-primary">Add Book Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach($books as $book)
                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="editBook{{ $book->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">Edit {{ $book->title }}</h4>
                            </div>
                            <form method="post" action="{{ route('editions.update', $book->id) }}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PATCH" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Edition Code</h4>
                                            <p>
                                                <input id="name" name="code" type="text" placeholder="Edition Code" class="form-control" value="{{ $book->title }}">
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

                <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="viewBook{{ $book->id }}" role="dialog" aria-labelledby="modalLabelfade" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title" id="modalLabelfade">View Details of {{ $book->title }}</h4>
                            </div>
                            <div>
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PATCH" />
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <p>
                                                <p class="form-control-static"><b>Book Title: </b><br/>{{ $book->title }}</p>
                                                </p>
                                            </div>
                                            <div class="col-md-12">
                                                <p>
                                                <p class="form-control-static"><b>{{ isset($book->edition) ? 'Edition &' : '' }} Copyright Year: </b><br/>{{ isset($book->edition) ? $book->edition.', ' : '' }}{{ date('Y', strtotime($book->copyright)) }}</p>
                                                </p>
                                            </div>
                                            <div class="col-md-12">
                                                <p>
                                                <p class="form-control-static"><b>Publishing Company: </b><br/>{{ $book->publisher }}</p>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                            <p class="form-control-static"><b>Authors: </b><br/>
                                                @foreach(\LIS\BookAuthor::where('book_id', $book->id)->get() as $book_author)
                                                    @if(!$loop->first)
                                                        ,<br/>
                                                    @endif
                                                    {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                                @endforeach
                                            </p>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                            <p class="form-control-static"><b>Genres: </b><br/>
                                                @foreach($book_genres as $book_genre)
                                                    @if($book_genre->book_id == $book->id)
                                                        {{ $loop->first ? '' : ', ' }}{{ $genres->where('id', $book_genre->genre_id)->first()->name }}
                                                    @endif
                                                @endforeach
                                            </p>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                            <p class="form-control-static"><b>Subjects: </b><br/>
                                            @forelse($book_subjects as $book_subject)
                                                @if($book_subject->book_id == $book->id)
                                                        {{ $loop->first ? '' : ', ' }}{{ $subjects->where('id', $book_subject->subject_id)->first()->name }}
                                                    @endif
                                            @empty
                                                N/A
                                                @endforelse
                                            </p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn  btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
@endsection