@extends('layouts.master')

@section('title')
    Admin Login
@endsection   

    <body class="login">
    <!-- BEGIN : LOGIN PAGE 5-1 -->
    @section('content')
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset">
                <div class="login-bg" style="background-image:url({{asset('/assets/pages/img/login/bg1.jpg')}})">
                    <img class="login-logo" src="{{asset('/assets/pages/img/login/iei_anchor.png')}}" /> 
                </div>
            </div>
            <div class="col-md-6 login-container bs-reset">
                <div class="login-content">
                    <h1><strong>Admin Login</strong></h1>
                    <form action="{{route('login_u')}}" class="login-form" method="post">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Enter any username and password. </span>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input value="ade@gmail.com" class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" required/>
                            </div>
                            <div class="col-xs-6">
                                <input value="password" class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
<!--                                <div class="rem-password">
                                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" name="remember" value="1" /> Remember me
                                        <span></span>
                                    </label>
                                </div>-->
                            </div>
                            <div class="col-sm-8 text-right">
                                <div class="forgot-password">
                                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                </div>
                                <input type="submit" class="btn green" name="submit" value="Login" />
                            </div>
                        </div>
                        <input type="hidden" value="{{Session::token()}}" name="_token"/>
                    </form>

                </div>
                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-5 bs-reset">
                            <ul class="login-social">
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright &copy; IEI Anchor Pensions {{date('Y')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endsection
        <!-- END : LOGIN PAGE 5-1 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        
    