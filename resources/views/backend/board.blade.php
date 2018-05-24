@extends('layouts.master_pages')

@section('title')
Admin - Board of Directors Page
@endsection 

@section('content')
<?php $page_name = "board";
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
                    <span>Directors</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->

        <!-- END PAGE HEADER-->
        @if($errors->all() )
        <div class="note note-info col-md-10">
            <p>
            <ul>
                @foreach($errors->all() as $error)
                <li style="color:#f00;">{{$error}}</li>
                @endforeach
            </ul>
            </p>

        </div>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row pull-right">
                                <div class="portlet-title">
                                    <div class="actions">
                                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <a class="btn btn-circle btn-default btn-sm new_item" href="">
                                                <i class="fa fa-plus"></i>New 
                                            </a>
                                            <a class="btn btn-circle btn-default btn-sm edit_item" >
                                                <i class="fa fa-pencil"></i>Edit 
                                            </a>
                                            <a class="btn btn-circle btn-default btn-sm delete_item" href="">
                                                <i class="fa fa-remove"></i>Delete 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S/N </th>
                                    <th> Title </th>
                                    <th> Details </th>
                                    <th> Keywords </th>
                                    <th> Excerpt </th>                                    
                                    <th> Approved? </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleitems as $row)
                                <tr class="table_row @if($loop->index ==0)active @endif ">
                                <input type="hidden" value="{{$row->id}}" class="row_id"/>
                                <input type="hidden" value="{{$row->type}}" class="row_type"/>
                                <input type="hidden" value="{{$row->position}}" class="row_position"/>
                                <input type="hidden" value="{{$row->display}}" class="row_display"/>
                                <input type="hidden" value="{{$loop->index +1}}" class="row_loop_index"/>
                                    <td> {{$loop->index +1}}  </td>
                                    <td class="row_title"> {{$row->title}} </td>
                                    <td class="row_details"> {!!$row->details!!} </td>
                                    <td> {{$row->keywords}}</td>
                                    <td> {!!$row->excerpt!!}...</td>                                    
                                    @if($row->display =='1')
                                    <td>YES</td>
                                    @else
                                    <td>NO</td>  
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table><br>
                        <?php echo $moduleitems->links(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">                            
                <!--BEGIN MODALS FOR EDIT-->
                <div class="portlet ">

                    <div class="portlet-body form">                                    

                        <!--full width--> 
                        <div id="board_delete_modal" class="modal fade" tabindex="-1">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="board_header">Delete Item</h4>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want to delete this item?
                                </h4>
                                <form role="form" action="{{ route('delete_item')}}" method="post" id="board_delete_form" class="form-horizontal">
                                    <input type="hidden" name="id"  id="id" value="">
                                    <input type="hidden" name="type"  id="type" value="board">
                                    <input type="submit" class="btn blue" name="submit" value="Delete" />
                                    <button class="btn default" type="button" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                    <input type="hidden" value="{{Session::token()}}" name="_token"/>                            
                                </form>

                            </div>

                        </div>
                        
                        
                        <!--full width--> 
                        <div id="board_edit_modal" class="modal fade" tabindex="2" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="board_header">Add/Update Articles</h4>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                <form role="form" action="{{ route('processm')}}" method="post" id="board_form" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="id"  id="id" value="0">
                                    <input type="hidden" name="type"  id="type"  value="board">
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Title
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="title" id="title" data-required="1" class="form-control" /> 
                                            </div>

                                            <label class="control-label col-md-2">Position&nbsp;&nbsp;</label>
                                            <div class="col-md-2">
                                                <input readonly name="position" id="position" type="number" value="{{$moduleitems->total()+1}}" class="form-control" /> 
                                            </div>
                                        </div>

                                       @if(session()->has('board') && session('board') >3)
                                       <div class="form-group">
                                            <label class="control-label col-md-3">Display
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-1">
                                                <div class="mt-radio-list" data-error-container="#form_2_membership_error">
                                                    <label class="mt-radio">
                                                        <input  type="radio" name="display" id="display_yes" value="1" /> Yes
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input checked type="radio" name="display" id="display_no" value="0" /> No
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div id="form_2_membership_error"> </div>
                                            </div>
                                        </div>
                                       @endif

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Details
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control summer_details" rows="6" name="details" id="details" ></textarea>
                                                <div id="details_error"> </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>Featured Image</h4>
                                        <div class="form-group">
                                            <!--<label for="image" col-md-2>Image Upload</label>-->
                                            <div class="col-md-2">
                                                <input type="file" id="image" name="image">
                                                <p class="help-block"> (optional) </p>
                                            </div>

                                            <label class="control-label col-md-2">Caption </label>
                                            <div class="col-md-3">
                                                <input type="text" name="caption" id="caption" class="form-control" /> 
                                            </div>  

<!--                                            <label class="control-label col-md-3">Make this the main image </label>
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
                                            </div>-->
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input type="submit" class="btn blue" name="submit" value="Submit" />
                                                <button onclick="resetForm('#board_form');" type="button" class="btn default">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{Session::token()}}" name="_token"/>
                                </form>
                                <!-- END FORM-->

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
