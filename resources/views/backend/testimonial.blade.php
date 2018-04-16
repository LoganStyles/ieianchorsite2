@extends('layouts.master_pages')

@section('title')
Admin - Testimonial Page
@endsection 

@section('content')
<?php $page_name = "testimonial"; 
$moduleitems=$data['moduleitems'];
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
                    <span>Testimonial</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Testimonial
            <small>User Testimonials</small>
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
            <?php $processed_ids = [] ?>
            @foreach($moduleitems as $testimonialitem)
            <?php $current_id = $testimonialitem['id']; ?>
            @if(!in_array($testimonialitem['id'],$processed_ids) && !empty($testimonialitem['id']))
            <div class="col-md-6">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-speech font-green-sharp"></i>
                            <span id="testimonial_title" class="caption-subject bold uppercase"> {!!$testimonialitem['title']!!}</span>
                            <!--<span class="caption-helper">weekly stats...</span>-->
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-default btn-sm clicked_button" href="" data-toggle="modal">
                                <i class="fa fa-pencil"></i>Edit 
                            </a>

                            <a href="" class="btn btn-circle btn-default btn-sm del_button" data-toggle="modal">
                                <i class="fa fa-plus"></i> Delete </a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
                            <input type="hidden" id="testimonial_id" value="{{$testimonialitem['id']}}">
                            <input type="hidden" id="type" value="{{$testimonialitem['type']}}">
                            <input type="hidden" id="testimonial_position" value="{{$testimonialitem['position']}}">
                            <input type="hidden" id="testimonial_display" value="{{$testimonialitem['display']}}">
                            <div id="testimonial_details"> {!!$testimonialitem['details']!!}</div>>
                            <div>                                
                                <div class="row">
                                    @foreach($moduleitems as $testimonial_inneritem)
                                    @if($current_id == $testimonial_inneritem['imageid'] && !empty($testimonial_inneritem['imageid']))
                                    <div class="col-sm-6 col-md-3">
                                        <a href="#" class="thumbnail">
                                            <img src="{{asset('/site/img/'.$testimonial_inneritem['filename'])}}" alt="100%x180" style="height: 180px; width: 100%; display: block;">
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
            <?php array_push($processed_ids,$testimonialitem['id'])?>
            @endif
            @endforeach

        </div>

        <div class="row">
            <div class="col-md-10">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-pencil font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Add/Update Items</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form role="form" action="{{ route('processm')}}" method="post" id="testimonial_form" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="id"  id="id" value="0">
                            <input type="hidden" name="type"  id="type"  value="testimonial">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Name
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="title" id="title" data-required="1" class="form-control" /> 
                                    </div>

                                    <label class="control-label col-md-2">Position&nbsp;&nbsp;</label>
                                    <div class="col-md-2">
                                        <input name="position" id="position" type="number" value="{{count($processed_ids)+1}}" class="form-control" /> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Display
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-1">
                                        <div class="mt-radio-list" data-error-container="#form_2_membership_error">
                                            <label class="mt-radio">
                                                <input checked type="radio" name="display" id="display_yes" value="1" /> Yes
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input type="radio" name="display" id="display_no" value="0" /> No
                                                <span></span>
                                            </label>
                                        </div>
                                        <div id="form_2_membership_error"> </div>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="control-label col-md-2">Testimonial
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="6" name="details" id="details"></textarea>
                                        <div id="details_error"> </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>Image Details</h4>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <input type="file" id="image" name="image">
                                        <p class="help-block"> (optional) </p>
                                    </div>

                                    <label class="control-label col-md-2">Caption </label>
                                    <div class="col-md-3">
                                        <input type="text" name="caption" id="caption" class="form-control" /> 
                                    </div>  

                                    <label class="control-label col-md-3">Make this the main image </label>
                                    <div class="col-md-2">
                                        <div class="mt-radio-list" data-error-container="#form_2_image_error">
                                            <label class="mt-radio">
                                                <input  type="radio" name="main" id="main_yes" value="1" /> Yes
                                                <span></span>
                                            </label>
                                            <label class="mt-radio">
                                                <input checked type="radio" name="main" id="main_no" value="0" /> No
                                                <span></span>
                                            </label>
                                        </div>
                                        <div id="form_2_image_error"> </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <input type="submit" class="btn blue" name="submit" value="Submit" />
                                        <button onclick="resetForm('#testimonial_form');" type="button" class="btn default">Reset</button>
                                    </div>
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


        <div class="row">
            <div class="col-md-12">                            
                <!--BEGIN MODALS FOR EDIT-->
                <div class="portlet ">

                    <div class="portlet-body form">                                    

                        <!--full width--> 
                        <div id="testimonial_delete_modal" class="modal fade" tabindex="-1">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="testimonial_header">Delete Item</h4>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want to delete this item?
                                </h4>
                                <form role="form" action="{{ route('delete_item')}}" method="post" id="testimonial_delete_form" class="form-horizontal">
                                    <input type="hidden" name="id"  id="id" value="">
                                    <input type="hidden" name="type"  id="type" value="testimonial">
                                    <input type="submit" class="btn blue" name="submit" value="Delete" />
                                    <input type="hidden" value="{{Session::token()}}" name="_token"/>                            
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
                <!--END PORTLET-->
            </div>
        </div>

    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->

@endsection
