@extends('layouts.master_site')
<?php 
$page=$page_name; 
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem']
?>
@section('title')
Contact Us
@endsection 

@section('content')

        <div class="team">
            <div class="container">
                <h3 class="w3l_header w3_agileits_header">FEED <span>BACK</span></h3>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading"> <span style="color: #800;">(*Required Fields)</span></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('process_feedback')}}">
                            {!! csrf_field() !!}
                            <span style="color: #0086B3;font-size: 1.1em;"><strong>{{Session::get('response_status')}}</strong></span>
                            <div class="form-group{{ $errors->has('feedback_type') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Feedback Type</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="feedback_type" id="feedback_type">
                                        <option value="issue">Issue</option>
                                        <option value="suggestion">Suggestion</option>
                                        <option value="enquiry">Enquiry</option>
                                </select>                                    
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Name</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Phone</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required> 
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">PIN</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="pin" value="{{ old('pin') }}">
                                    @if ($errors->has('pin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                                        
                            <div class="form-group{{ $errors->has('employer') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Employer</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="employer" value="{{ old('employer') }}" >
                                    @if ($errors->has('employer'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('employer') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Subject</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                                    @if ($errors->has('subject'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label"><span style="color: #f00">*</span>Details</label>
                                <div class="col-md-6">
                                    <textarea style="width: 283px;" name="details" id="details" value="{{ old('details') }}" rows="3" placeholder="Your Message..." required></textarea>
                                    <!--<input type="text" class="form-control" name="details" value="{{ old('details') }}">-->
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
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      
        </div>
<!--        <div class="agile_map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.3905851087434!2d-34.90500565012194!3d-8.061582082752993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7ab18d90992e4ab%3A0x8e83c4afabe39a3a!2sSport+Club+Do+Recife!5e0!3m2!1sen!2sin!4v1478684415917" style="border:0"></iframe>
        </div>-->
        <!-- //mail -->
        
        @endsection