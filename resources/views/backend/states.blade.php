@extends('layouts.master_pages')

@section('title')
Admin | States
@endsection 

@section('content')
<?php 
$page_name="states";
$states=$data['states'];
//print_r($states);exit;
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
                    <a href="{{url('/module/dashboard')}}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span></span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> States
            <small>& contacts</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="note note-info col-md-12">
            <p>
            <ul>
                @foreach($errors->all() as $error)
                <li style="color:#f00;">{{$error}}</li>
                @endforeach
            </ul>
            </p>
        </div>

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
                            
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S/N </th>
                                    <th> State </th>
                                    <th> Team Code </th>
                                    <th> Team Name </th>
                                    <th> Contact Email </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($states as $row)
                                <tr class="table_row">
                                <input type="hidden" value="{{$row->id}}" class="row_id"/>
                                <input type="hidden" value="{{$row->type}}" class="row_type"/>
                                <input type="hidden" value="{{$row->team_code}}" class="row_team_code"/>
                                <input type="hidden" value="{{$row->team_name}}" class="row_team_name"/>
                                <input type="hidden" value="{{$row->contact_email}}" class="row_contact_email"/>
                                    <td> {{$row->id}}  </td>
                                    <td> {{$row->title}} </td>
                                    <td> {{$row->team_code}}</td>
                                    <td> {{$row->team_name}}</td>
                                    <td> {{$row->contact_email}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table><br>
                        <?php echo $states->links(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-10">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-pencil font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Update States</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form role="form" action="{{ route('process_states')}}" method="post" id="ref_states_teams_form" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="id"  id="id" value="0">
                            <input type="hidden" name="type"  id="type"  value="ref_states_teams">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Team Name
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="team_name" id="team_name" data-required="1" class="form-control" /> 
                                    </div>

                                    <label class="control-label col-md-2">Team Code&nbsp;&nbsp;</label>
                                    <div class="col-md-2">
                                        <input name="team_code" id="team_code" type="text" value="" class="form-control" /> 
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Contact Email
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" name="contact_email" id="contact_email" data-required="1" class="form-control" /> 
                                    </div>
                                </div>
                                <hr>
                                
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <input type="submit" class="btn blue" name="submit" value="Submit" />
                                        <button onclick="resetStatesForm('#ref_states_teams_form');" type="button" class="btn default">Cancel</button>
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
                        <div id="delete_modal" class="modal fade" tabindex="-1">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="service_header">Delete Item</h4>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want to delete this item?
                                </h4>
                                <form role="form" action="{{ route('delete_item')}}" method="post" id="delete_form" class="form-horizontal">
                                    <input type="hidden" name="id"  id="id" value="">
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
