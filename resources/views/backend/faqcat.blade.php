@extends('layouts.master_pages')

@section('title')
Admin - Activity Page
@endsection 

@section('content')
<?php $page_name = "faqcat";
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
                    <span>FAQ Categories</span>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleitems as $row)
                                <tr class="table_row @if($loop->index ==0)active @endif ">
                                <input type="hidden" value="{{$row->id}}" class="row_id"/>
                                <input type="hidden" value="{{$row->type}}" class="row_type"/>
                                <input type="hidden" value="{{$loop->index +1}}" class="row_loop_index"/>
                                    <td> {{$row->id}}  </td>
                                    <td class="row_title"> {{$row->title}} </td>
                                    <td class="row_details"> {{$row->description}} </td>
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
                        <div id="faqcat_delete_modal" class="modal fade" tabindex="-1">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="faqcat_header">Delete Item</h4>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want to delete this item?
                                </h4>
                                <form role="form" action="{{ route('delete_item')}}" method="post" id="faqcat_delete_form" class="form-horizontal">
                                    <input type="hidden" name="id"  id="id" value="">
                                    <input type="hidden" name="type"  id="type" value="faqcat">
                                    <input type="submit" class="btn blue" name="submit" value="Delete" />
                                    <button class="btn default" type="button" data-dismiss="modal" aria-hidden="true">Cancel</button>
                                    <input type="hidden" value="{{Session::token()}}" name="_token"/>                            
                                </form>

                            </div>

                        </div>
                        
                        
                        <!--full width--> 
                        <div id="faqcat_edit_modal" class="modal fade" tabindex="2" >
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="faqcat_header">Add/Update Articles</h4>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                <form role="form" action="{{ route('processm')}}" method="post" id="faqcat_form" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="id"  id="id" value="0">
                                    <input type="hidden" name="type"  id="type"  value="faqcat">
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
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Description
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control summer_details" rows="6" name="details" id="details" ></textarea>
                                                <div id="details_error"> </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <input type="submit" class="btn blue" name="submit" value="Submit" />
                                                <button onclick="resetForm('#faqcat_form');" type="button" class="btn default">Reset</button>
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
