<?php
$page = $page_name;
$states = $data['states'];
?>
@extends('layouts.master_site')

@section('title')
Register
@endsection 

@section('content')
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

<!-- //banner -->	
<!--        <div class="banner1">
            <div class="wthree_banner1_info">
                <h3><span>R</span>egister with us</h3>
            </div>
        </div>-->
<!-- //banner -->	
<!-- mail -->
<div class="team">
    <div class="container">
        <h3 class="w3l_header w3_agileits_header">RSA <span>REGISTRATION</span></h3>


        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading"> <span style="color: #800;">(*Required Fields)</span></div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/web-register') }}">
                                {!! csrf_field() !!}

                                <span style="color: #0086B3;font-size: 1.1em;"><strong>{{Session::get('reg_status')}}</strong></span>

                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label"><span style="color: #f00">*</span>Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                        @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label"><span style="color: #f00">*</span>E-Mail Address</label>


                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label"><span style="color: #f00">*</span>Details</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="details" value="{{ old('details') }}">
                                        @if ($errors->has('details'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>




                                <div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">Captcha</label>


                                    <div class="col-md-6">
                                        {!! captcha_image_html('ContactCaptcha') !!}
                                        <input class="form-control" type="text" id="CaptchaCode" name="CaptchaCode" style="margin-top:5px;">


                                        @if ($errors->has('CaptchaCode'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('CaptchaCode') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <br/>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i>Post
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection