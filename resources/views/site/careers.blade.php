<?php 
$page=$page_name;
$states=$data['states'];
?>
@extends('layouts.master_site')

@section('title')
Careers
@endsection 

@section('content')
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
        <!-- //banner -->	
        <!-- mail -->
        <div class="team">
            <div class="container">
                <h3 class="w3l_header w3_agileits_header">C<span>areers</span></h3>
                <p class="sub_para_agile">Thank you for your interest in working with us. Unfortunately there are currently no job vacancies available, 
                    but you can provide your details below and we will contact you.</p>
                
     
    <div class="container">
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"> <span style="color: #800;">(*Required Fields)</span></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/web-careers') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            
                            <span style="color: #0086B3;font-size: 1.1em;"><strong>{{Session::get('career_status')}}</strong></span>

                            <div class="form-group{{ $errors->has('fname') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>First Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="fname" value="{{ old('fname') }}">
                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('lname') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Last Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lname" value="{{ old('lname') }}">
                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('oname') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Other Names</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="oname" value="{{ old('oname') }}">
                                    @if ($errors->has('oname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Phone</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
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
                            
                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Date of birth</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control date-picker" name="dob" value="{{ old('dob') }}">
                                    @if ($errors->has('dob'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('cv') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Upload CV (MAX 2MB)</label>
                                <div class="col-md-6">
                                    <input type="file" id="cv" name="cv">
                                    @if ($errors->has('cv'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cv') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('letter') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Upload Cover Letter (MAX 2MB)</label>
                                <div class="col-md-6">
                                    <input type="file" id="letter" name="letter">
                                    @if ($errors->has('letter'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('letter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Desired Salary</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="salary" value="{{ old('salary') }}">
                                    @if ($errors->has('salary'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('salary') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('states') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>State of Origin</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="states" id="states">
                                    @foreach($states as $state)
                                        <option value="{{$state['title']}}">{{$state['title']}}</option>
                                    @endforeach
                                </select>                                    
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('available_startdate') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Available Start Date</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control date-picker" name="available_startdate" value="{{ old('available_startdate') }}">
                                    @if ($errors->has('available_startdate'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('available_startdate') }}</strong>
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
                                        Submit
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