@extends('layouts.master')

@section('title')
Create Admin
@endsection   

<body class=" login">
    <!-- BEGIN : LOGIN PAGE 5-1 -->
    @section('content')
    @if(count($errors)>0)
    <div class="row">
        <div class="col-md-6">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset">
                <div class="login-bg" style="background-image:url({{asset('/assets/pages/img/login/bg1.jpg')}})">
                    <img class="login-logo" src="{{asset('/assets/pages/img/login/iei_anchor.png')}}" /> </div>
            </div>
            <div class="col-md-6 login-container bs-reset">
                <div class="login-content">
                    <h1><strong>Create Admin</strong></h1>
                    <form action="{{ route('create_u')}}" class="login-form" method="post">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Enter any username and password. </span>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" value="{{Request::old('firstname')}}" placeholder="Type your firstname" name="firstname" required/> </div>
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Type your lastname" value="{{Request::old('lastname')}}" name="lastname" required/> </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Type your password" name="password" required/> 
                            </div>

                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Confirm your password" name="cpassword" required/> 
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group {{$errors->has('email')?'has-error':""}}" type="text" autocomplete="off" placeholder="Type your email" name="email" value="{{Request::old('email')}}" required/> 
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group form-md-line-input has-info">
                                    <select class="form-control" id="role" name="role">   
                                        @foreach($roles as $role)
                                        <option value="{{$role['id']}}">{{$role['title']}}</option>
                                        @endforeach
                                    </select>
                                    <label for="role">Select User Group</label>
                                </div>
                            </div>
                        </div>                                            

                        <div class="row">
                            <div class="col-sm-4">
                                
                            </div>
                            <div class="col-sm-8 text-right"> 
                                <div class="forgot-password">
                                        <a href="{{route('login')}}" id="forget-password" class="forget-password">Already Have an Account?</a>
                                    </div>
                                <!--<button class="btn green" type="submit">Create</button>-->
                                <input type="submit" class="btn green" name="submit" value="Create" />
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

