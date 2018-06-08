<!DOCTYPE html>
<html>

<head>
    <title>Login | Library Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- end of global level css -->
    <link href="{{ asset('vendors/iCheck/css/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet" />
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}" />
    <!-- end of page level css -->
</head>

<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div id="container_demo">
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <a class="hiddenanchor" id="toforgot"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form action="{{ route('login') }}" id="authentication" autocomplete="off" method="post">
                            {{ csrf_field() }}
                            <h3 class="black_bg">
                                <img src="{{ asset('img/logo/logo.png') }}" alt="lis_logo" height="100">
                                <br>Log In</h3>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label style="margin-bottom:0;" for="email" class="uname control-label"> <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> E-mail
                                </label>
                                <input type="email" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" autofocus />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('email') }}</small>
                                    </span>
                                @endif
                                <div class="col-sm-12">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label style="margin-bottom:0;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Password
                                </label>
                                <input type="password" id="password" name="password" placeholder="Enter a password" />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('password') }}</small>
                                    </span>
                                @endif
                                <div class="col-sm-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="remember" id="remember" class="square-blue" {{ old('remember') ? 'checked' : '' }}/> Keep me logged in
                                </label>
                            </div>
                            <p class="login button">
                                <input type="submit" value="Log In" class="btn btn-success" />
                            </p>
                            <p class="change_link">
                                <a href="#toforgot" class="btn btn-responsive botton-alignment btn-warning btn-sm btn-block">Forgot password
                                </a>
                            </p>
                        </form>
                    </div>
                    <div id="forgot" class="animate form">
                        <form action="index.html" id="reset_pw" autocomplete="on" method="post">
                            <h3 class="black_bg">
                                <img src="{{ asset('img/logo/logo.png') }}" alt="logo" height="75">
                                <br><small class="white-text" style="color: #ffffff;">FORGOT PASSWORD</small></h3>
                            <p>
                                Enter your email address below and we'll send a special reset password link to your inbox.
                            </p>
                            <div class="form-group">
                                <label style="margin-bottom:0;" for="forgotemail" class="youmai">
                                    <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Your email
                                </label>
                                <input id="forgotemail" name="forgotemail" placeholder="your@mail.com" />
                            </div>
                            <p class="login button reset_button">
                                <input type="submit" value="Reset Password" class="btn btn-raised btn-success btn-block" />
                            </p>
                            <p class="change_link">
                                <a href="#tologin" class="btn btn-raised btn-responsive botton-alignment btn-warning btn-sm to_register">Back
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<!-- end of global js -->
<script src="{{ asset('vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/login.js') }}" type="text/javascript"></script>
</body>

</html>

