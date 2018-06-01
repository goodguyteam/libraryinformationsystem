<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" media="all" />
    <link href="{{ asset('css/pages/toastr.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" media="all"  />
    <link href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('vendors/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" media="all"  />
    <link href="{{ asset('vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" >
    <link href="{{ asset('vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/pages/form_layouts.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/pages/advmodals.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendors/datatables/css/dataTables.bootstrap.css') }}" type="text/css" media="all" >
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}" type="text/css" media="all" />
    <link rel="stylesheet"href="{{ asset('vendors/select2/css/select2-bootstrap.css') }}" type="text/css" media="all" />
    <link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css" media="all" >

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
    <style type="text/css" media="all">
        .header{
            text-align: center;
            font-weight: bold;
            padding: 15px;
        }
        .logo{
            height: 50px;
        }
        .header-logo{
            display: inline;
        }
        .content{
            padding: 15px;
        }
        @page {
            header: page-header;
            footer: page-footer;
        }
        .report-title{
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>
<body>
<div class="container">
    <htmlpageheader name="page-header" class="header-logo">
        <img class="img-responsive logo" src="{{ asset('img/logo/1.png') }}"/>
        <hr/>
    </htmlpageheader>
    <br/>
    <br/>
    <br/>
    <p class="report-title">List of Genres as of May, 2018</p>
    <br/>
    <table class="table-print table table-striped table-bordered " id="table3">
        <thead>
        <tr>
            <td class="header"><b>Genre</b></td>
            <td class="header"><b>Description</b></td>
        </tr>
        </thead>
        <tbody>
        @foreach($genres as $genre)
            <tr>
                <td class="content">{{ $genre->name }}</td>
                <td class="content">{{ $genre->description }}</td>
            </tr>
        @endforeach
        @foreach($genres as $genre)
            <tr>
                <td class="content">{{ $genre->name }}</td>
                <td class="content">{{ $genre->description }}</td>
            </tr>
        @endforeach
        @foreach($genres as $genre)
            <tr>
                <td class="content">{{ $genre->name }}</td>
                <td class="content">{{ $genre->description }}</td>
            </tr>
        @endforeach
        @foreach($genres as $genre)
            <tr>
                <td class="content">{{ $genre->name }}</td>
                <td class="content">{{ $genre->description }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <htmlpagefooter name="page-footer">
        <hr/>
        Your Footer Content
    </htmlpagefooter>
</div>



</body>
</html>