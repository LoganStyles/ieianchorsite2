@extends('layouts.master_pages')

@section('title')
Admin | Setup
@endsection 

@section('content')
<?php $page_name = "setup"; 
$siteinfo=$data['siteitems'][0];
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{url('/module/dashboard')}}">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Site info</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Site Information
            <small>:address, emails, social media etc</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="note note-info col-md-10">
            <p>
            <ul>
                @foreach($errors->all() as $error)
                <li style="color:#f00;">{{$error}}</li>
                @endforeach
            </ul>
            </p>
        </div>


        <div class="row">
            <div class="col-md-10">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">

                    <?php ?>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form role="form" action="{{ route('update_site')}}" method="post" id="site_form" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="id"  id="id" value="{{$siteinfo['id']}}">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful!
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Site Url</label>
                                    <div class="col-md-4">
                                        <input type="text" name="url" data-required="1" class="form-control" value="{{$siteinfo['url']}}" />
                                    </div>

                                    <label class="col-md-2 control-label">Email Address</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email" name="email" value="{{$siteinfo['email']}}" class="form-control" placeholder="Email Address"> </div>
                                    </div>
                                </div>                        

                                <div class="form-group">
                                    <label class="control-label col-md-2">Phone1&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="phone1" type="text" class="form-control" value="{{$siteinfo['phone1']}}" /> </div>

                                    <label class="control-label col-md-2">Phone2&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="phone2" type="text" class="form-control" value="{{$siteinfo['phone2']}}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Facebook&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="facebook" type="text" class="form-control" value="{{$siteinfo['facebook']}}"/> </div>

                                    <label class="control-label col-md-2">Twitter&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="twitter" type="text" class="form-control" value="{{$siteinfo['twitter']}}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Instagram&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="instagram" type="text" class="form-control" value="{{$siteinfo['instagram']}}"/> </div>

                                    <label class="control-label col-md-2">Youtube&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="youtube" type="text" class="form-control" value="{{$siteinfo['youtube']}}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Linkedin&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="linkedin" type="text" class="form-control" value="{{$siteinfo['linkedin']}}"/> </div>

                                    <label class="control-label col-md-2">Client Url&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="client_url" type="text" class="form-control" value="{{$siteinfo['client_url']}}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Opening hours&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="opening" type="text" class="form-control" value="{{$siteinfo['opening']}}"/> </div>

                                    <label class="control-label col-md-2">Head office&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <!--<input name="office" type="text" class="form-control" value=""/>-->
                                        <textarea class="form-control" rows="6" name="office" id="office" >{{$siteinfo['office']}}</textarea>
                                    </div>

                                </div>

                                <div class="form-group">                           

                                    <div class="col-md-2">
                                        <input type="file" id="image" name="image">
                                        <p class="help-block"> (site logo) </p>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-3 col-md-12">
                                        <input type="submit" class="btn blue pull-right" name="submit" value="Save" />                                
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <input type="hidden" value="{{Session::token()}}" name="_token"/>
                        </form>
                        <!-- END FORM-->
                    </div>

                    <!-- END VALIDATION STATES-->
                </div>
            </div>
        </div>


        @endsection