@extends('layouts.master')

@section('title', 'Disposal Module')

@section('css')
    <link href="{{ 'vendors/jasny-bootstrap/css/jasny-bootstrap.cs' }}s" rel="stylesheet">
    <link href="{{ 'vendors/iCheck/css/all.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'css/pages/form_layouts.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'vendors/simple-line-icons/css/simple-line-icons.css' }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('assets/backend/vendors/ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/css/pages/icon.css') }}" rel="stylesheet" type="text/css" />   for icons-->
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/datatables/css/dataTables.bootstrap.css' }}">
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/select2/css/select2.min.css' }}" />
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/select2/css/select2-bootstrap.css' }}" />
    <link href="{{ 'css/pages/tables.css' }}" rel="stylesheet" type="text/css">
    <!-- for modals -->
    <link href="{{ 'vendors/modal/css/component.css' }}" rel="stylesheet" />
    <link href="{{ 'css/pages/advmodals.css' }}" rel="stylesheet" />
    <!-- for sweet alerts -->
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/sweetalert/css/sweetalert.css' }}" />
@endsection

@section('js')
    <script src="{{ 'vendors/vendors/jasny-bootstrap/js/jasny-bootstrap.js' }}"></script>
    <script src="{{ 'vendors/vendors/iCheck/js/icheck.js' }}"></script>
    <script src="{{ 'vendors/js/pages/form_layouts.js' }}"></script>
    <!-- For data tables adv. 2 -->
    <script type="text/javascript" src="{{ 'vendors/datatables/js/jquery.dataTables.js' }}"></script>
    <script type="text/javascript" src="{{ 'vendors/datatables/js/dataTables.bootstrap.js' }}"></script>
    <script type="text/javascript" src="{{ 'vendors/datatables/js/dataTables.responsive.js' }}"></script>
    <script type="text/javascript" src="{{ 'vendors/select2/js/select2.js' }}"></script>
    <script type="text/javascript" src="{{ 'js/pages/table-advanced2.js' }}"></script>
    <!-- For sweetalert -->
    <script type="text/javascript" src="{{ 'vendors/sweetalert/js/sweetalert.min.js' }}"></script>
    <script type="text/javascript" src="{{ 'vendors/sweetalert/js/sweetalert-dev.js' }}"></script>
    <script type="text/javascript" src="{{ 'js/pages/sweetalert.js' }}"></script>

    <script type="text/javascript">

      //table31
    jQuery(document).ready(function() {

        var t1 = $('#t1').DataTable({
            "responsive":true
        });

        $('button.toggle-vis').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = t1.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        });

    });
// may bugs pa yung sa toggle at
    //table32
  jQuery(document).ready(function() {

      var t2 = $('#t2').DataTable({
          "responsive":true
      });

      $('button.toggle-vis').on('click', function(e) {
          e.preventDefault();

          // Get the column API object
          var column = t2.column($(this).attr('data-column'));

          // Toggle the visibility
          column.visible(!column.visible());
      });

  });

    </script>



@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i> Materials Subject for Disposal
                    </h3>
                    <span class="pull-right">
                        <i class="fa fa-fw fa-chevron-up clickable"></i>
                        <!-- <i class="fa fa-fw fa-times removepanel clickable"></i> -->
                    </span>
                </div>

            <div class="panel-body table-responsive">
                    Toggle Column:
                    <div class="btn-group" style="margin:10px 0;">
                        <button type="button" class="toggle-vis btn btn-default" data-column="0">LOC</button>
                        <button type="button" class="toggle-vis btn btn-default" data-column="2">Author | Publisher</button>
                        <button type="button" class="toggle-vis btn btn-default" data-column="5">Remarks</button>
                        <button type="button" class="toggle-vis btn btn-default" data-column="7">Date</button>
                    </div>
                    <table class="table table-striped table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th>CODE</th>
                                <th>Title</th>
                                <th>Author | Publisher</th>
                                <th>Shelf</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                          {{ csrf_field() }}
                          <?php $no=1; ?>
                          @foreach($book_inventory as $key => $bi)
                            <tr class="book_inventory{{$bi->id}}">
                                <td>{{$bi->lcode}} - {{ $bi->bseq }}</td>
                                <td>{{$bi->title}}</td>
                                <td>
                                  @foreach($book_authors as $book_author)
                                      @if($book_author->book_id == $bi->bi_id)
                                          @if(!$loop->first)
                                              , <br/>
                                          @endif
                                          {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                      @endif
                                  @endforeach
                                  <br>
                                  {{$bi->publisher}}
                                </td>
                                <td>{{$bi->shelf}}</td>
                                <td>{{$bi->status}}</td>
                                <td class = " text-center">
                                  <a href="#" class="edit-modal btn btn-responsive btn-md btn-success" data-id="{{ $bi->id }}" data-status="{{ $bi->status_id }}" data-code="{{ $bi->lcode }}" data-title="{{ $bi->title }}" data-author="{{ $bi->author }}" data-pub="{{ $bi->publisher }}">
                                    <span class="glyphicon glyphicon-ok-sign"></span>
                                  </a>
                                  <a href="#" class="create-modal btn btn-md btn-danger" data-id="{{ $bi->id }}" data-code="{{ $bi->lcode  }}" data-title="{{ $bi->title }}" data-author="{{ $bi->author }}" data-pub="{{ $bi->publisher }}">
                                    <span class="glyphicon glyphicon-remove-sign"></span>
                                  </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($bi->date)->format('M d, Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end for table -->
            </div>
        </div>
    </div> <!-- end for row-->

    <!-- space for modal -->
     {{--form Update(Clear Book Status)--}}

    <div id="update" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label class="col-md-10 control-label">Are you sure you want to clear the status of this book?</label>
                <form class="form-horizontal" role="modal">
                  <div class="form-group">
                    <div class="col-sm-10">
                      <!-- id ng iu-update sa inventory -->
                      <input type="text" class="form-control" id="fid" disabled />
                    </div>
                    <div class="col-sm-10">
                      <!-- status ng iu-update sa Inventory -->
                      <input type="name" class="form-control" id="s" value="{{ $bi->status_id }}" />
                    </div>
                  </div>
                </form>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn actionBtn">
              <span id="footer_action_button" class="glyphicon"></span>
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <span class="glyphicon glyphicon"></span>Close
              </button>
          </div>
        </div>
      </div>
    </div>

     {{--form Create DisposalInfo--}}
    <div id="create" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form" >
              <hr style="margin-top: -10px;">
              <div class="form-group">
                  <label class="col-md-4 control-label">Type of Disposal :</label>
                  <div class="col-md-8">
                    <select name="type" id="disposal-type">
                      <option selected disabled="disabled">Disposal Type:</option>
                      @foreach($types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="form-group row add">
                <label class="control-label col-sm-2" for="remarks">Remarks :</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="remarks" name="remarks"
                  placeholder="Please enter your remarks here..." required rows="5"></textarea>
                  <p class="error text-center alert alert-danger hidden"></p>
                </div>
              </div>
            </form>
          </div>
            <div class="modal-footer">
              <button class="btn btn-warning" type="submit" id="add" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove-sign"></span> Dispose
              </button>
              <button class="btn btn-warning" type="submit" data-dismiss="modal">
                Cancel
              </button>
            </div>
        </div>
      </div>
    </div>

  <!-- For List of Disposed MAterials -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <h3 class="panel-title">
                      <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i> Materials Subject for Disposal
                  </h3>
                  <span class="pull-right">
                      <i class="fa fa-fw fa-chevron-up clickable"></i>
                      <!-- <i class="fa fa-fw fa-times removepanel clickable"></i> -->
                  </span>
              </div>

          <div class="panel-body table-responsive">
                  Toggle Column:
                  <div class="btn-group" style="margin:10px 0;">
                      <button type="button" class="toggle-vis btn btn-default" data-column="0">LOC</button>
                      <button type="button" class="toggle-vis btn btn-default" data-column="2">Author | Publisher</button>
                      <button type="button" class="toggle-vis btn btn-default" data-column="5">Remarks</button>
                      <button type="button" class="toggle-vis btn btn-default" data-column="6">Date</button>
                  </div>
                  <table class="table table-striped table-bordered" id="t2">
                      <thead>
                          <tr>
                              <th>CODE</th>
                              <th>Title</th>
                              <th>Author | Publisher</th>
                              <th>Disposal Status</th>
                              <th>Remarks</th>
                              <th>Date</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($book_inventory2 as $key => $bi)
                          <tr>
                            <td>{{$bi->lcode}} - {{ $bi->bseq }}</td>
                            <td>{{$bi->title}}</td>
                            <td>
                              @foreach($book_authors as $book_author)
                                  @if($book_author->book_id == $bi->bi_id)
                                      @if(!$loop->first)
                                          , <br/>
                                      @endif
                                      {{ $authors->where('id', $book_author->author_id)->first()->name }}
                                  @endif
                              @endforeach
                              <br>
                              {{$bi->publisher}}
                            </td>
                            <td>{{$bi->status}}</td>
                            <td>{{$bi->rem}}</td>
                            <td>{{ \Carbon\Carbon::parse($bi->cdate)->format('M d, Y')}}</td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div> <!-- end for table -->
          </div>
      </div>
  </div> <!-- end for row-->




@endsection
