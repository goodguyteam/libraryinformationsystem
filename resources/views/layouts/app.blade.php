<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ \LIS\SystemInfo::first()->site_abbreviation }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"  media="all" type="text/css" />
    <!-- end of global css -->
    @section('css')
    @show
</head>
<body class="skin-josh">
<header class="header">
    <a href="{{ route('dashboard') }}" class="logo" >
        <img src="{{ asset('img/logo/logo.png') }}" alt="logo" height="75" style="margin-top: 2.5%;margin-bottom: 2.5%">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ Laravolt\Avatar\Facade::create(Auth::user()->name)->setBorder(0, '#fff')->toBase64() }}" width="35" class="img-circle img-responsive pull-left" height="35" alt="riot">
                        <div class="riot">
                            <div>
                                {{ Auth::user()->name }}
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="{{ Laravolt\Avatar\Facade::create(Auth::user()->name)->setBorder(0, '#fff')->toBase64() }}" width="90" class="img-circle img-responsive" height="90" alt="User Image" />
                            <p class="topprofiletext text-nowrap text-center">{{ \Illuminate\Support\Str::words(Auth::user()->name, 2, '') }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="view_user.html"> <i class="livicon" data-name="user" data-s="18"></i> My Profile </a>
                        </li>
                        <li role="presentation"></li>
                        <li>
                            <a href="user_profile.html"><i class="livicon" data-name="gears" data-s="18"></i> Account Settings </a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="lockscreen.html"> <i class="livicon" data-name="lock" data-s="18"></i> Lock </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"> <i class="livicon" data-name="sign-out" data-s="18"></i> Logout </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->

    <aside class="left-side sidebar-offcanvas">
        <br/>
        <section class="sidebar " style="margin-top: 5%">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                        <li>
                            <a href="advanced_tables.html"> <i class="livicon" data-name="table" title="Advanced tables" data-c="#418BCA" data-hc="#418BCA" data-size="25" data-loop="true"></i> </a>
                        </li>
                        <li>
                            <a href="tasks.html"> <i class="livicon" data-c="#EF6F6C" title="Tasks" data-hc="#EF6F6C" data-name="list-ul" data-size="25" data-loop="true"></i> </a>
                        </li>
                        <li>
                            <a href="gallery.html"> <i class="livicon" data-name="image" title="Gallery" data-c="#F89A14" data-hc="#F89A14" data-size="25" data-loop="true"></i> </a>
                        </li>
                        <li>
                            <a href="users_list.html"> <i class="livicon" data-name="users" title="Users List" data-size="25" data-c="#01bc8c" data-hc="#01bc8c" data-loop="true"></i> </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @section('sidebar')

                @show
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">
        <section class="content-header">
            <h1>@yield('title')</h1>
            <ol class="breadcrumb">
                @section('breadcrumbs')
                @show
            </ol>
        </section>
        <section class="content">
            @section('content')
            @show
        </section>
    </aside>
    <!-- right-side -->
    <section id="modals">
        @section('modals')

        @show
    </section>
</div>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
    <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<!-- global js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
@section('js')
@show

<script type="text/javascript">

  $(document).on('click', '.create-modal', function(){
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Dispose Book');
  });
  //function add (Save)
  $("#add").click(function(){

    var idofselect = document.getElementById('disposal-type');
    var finalidselect = idofselect.options[idofselect.selectedIndex].value;
    var valofremarks = document.getElementById('remarks').value;

    // alert(finalidselect);
    // alert(valofremarks);

    $.ajax ({
      type : 'POST',
      url : '{{ route("disposal-infos.store") }}',
      dataType: 'json',
      data : {
        '_token': $('input[name=_token]').val(),
        disposal_type_id: finalidselect,
        remarks: valofremarks
      },

      success: function(data){
        alert('TAMA');

      },

      error: function(response) {
        alert('MALI');
      }

    });
    $('#disposal_type').val('');
    $('#remarks').val('');
  });





</script>

<!-- end of page level js -->
</body>
</html>
