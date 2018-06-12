@extends('layouts.master')

@section('title', 'Weeding Report')

@section('css')
    <link href="{{ 'vendors/jasny-bootstrap/css/jasny-bootstrap.cs' }}s" rel="stylesheet">
    <link href="{{ 'vendors/iCheck/css/all.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'css/pages/form_layouts.css' }}" rel="stylesheet" type="text/css" />
    <link href="{{ 'vendors/simple-line-icons/css/simple-line-icons.css' }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/datatables/css/dataTables.bootstrap.css' }}">
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/select2/css/select2.min.css' }}" />
    <link rel="stylesheet" type="text/css" href="{{ 'vendors/select2/css/select2-bootstrap.css' }}" />
    <link href="{{ 'css/pages/tables.css' }}" rel="stylesheet" type="text/css">

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

    <script type="text/javascript">



      //table33
    jQuery(document).ready(function() {

        var table33 = $('#table33').DataTable({
            "responsive":true
        });

        $('button.toggle-vis').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = table33.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        });

    });


    </script>



@endsection

@section('content')

  <!-- For List of Disposed MAterials -->
  <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-primary">
              <div class="panel-heading">
                  <h3 class="panel-title">
                      <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i> Weeding
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

                  <div class="btn-group" style="margin-left: 655px">
                      <a href="{{ route('report.weedingpdf')  }}" class="btn btn-info">Print <span class="glyphicon glyphicon-print"></span></a>
                  </div>

                  <table class="table table-striped table-bordered" id="table33">
                      <thead>
                          <tr>
                              <th>Call Number</th>
                              <th>Title</th>
                              <th>Author</th>
                              <th>Date Acquired</th>
                          </tr>
                      </thead>
                      <tbody>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libraryinformationsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT
    BS.call_number as cn,
    BIN.title as title,
    GROUP_CONCAT(A.name SEPARATOR ', ') as author,
    AI.date_acquired as da
FROM
    book_inventories BI
INNER JOIN book_shelvings BS ON
    BI.shelving_id = BS.id
INNER JOIN book_infos BIN ON
    BI.book_info_id = BIN.id
INNER JOIN book_authors BA ON
    BIN.id = BA.book_id
INNER JOIN authors A ON
    BA.author_id = A.id
INNER JOIN acquisition_infos AI ON
    BI.acquisition_info_id = AI.id
INNER JOIN disposal_infos DI ON
    BI.disposal_info_id = DI.id
INNER JOIN disposal_types DT ON
    DI.disposal_type_id = DT.id
    WHERE DT.name='Weeded'
	    GROUP BY BI.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["cn"]."</td><td>".$row["title"]."</td><td>".$row["author"]."</td><td>".$row["da"]."</td></tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
                      </tbody>
                  </table>
              </div> <!-- end for table -->
          </div>
      </div>
  </div> <!-- end for row-->




@endsection
