@extends('layouts.master_pages')

@section('title')
Admin | User Groups
@endsection 

@section('content')
<?php $page_name="role";
//$data = $request->session()->all();
//print_r($data);exit;
$user_role=session('users');

//echo 'management '.session('management');
//echo 'users '.session('users');
//echo 'users_email '.session('users_email');
//exit;
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
                    <span>Users</span>
                </li>
            </ul>
             </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> User Groups
            <small>: All User Groups</small>
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
                        <div class="caption font-dark"></div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    @if($user_role && $user_role >2)
                                    <div class="btn-group">
                                        <a href="{{route('create_user')}}" id="" class="btn sbold green"> New
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
         
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                            <thead>
                                <tr>
                                    <th> S/N </th>
                                    <th> Group </th>
                                    <th> Description </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($usergroups as $usergroup)
                                <tr class="table_row">
                                <input type="hidden" value="{{$usergroup['id']}}" class="row_id"/>
                                <input type="hidden" value="{{$usergroup['type']}}" class="row_type"/>
                                <input type="hidden" value="{{$usergroup['title']}}" class="row_title"/>
                                <input type="hidden" value="{{$usergroup['description']}}" class="row_description"/>
                                <input type="hidden" value="{{$usergroup['user']}}" class="row_users"/>
                                <input type="hidden" value="{{$usergroup['delete_group']}}" class="row_delete_group"/>
                                <input type="hidden" value="{{$usergroup['role']}}" class="row_roles"/>
                                <input type="hidden" value="{{$usergroup['management']}}" class="row_management"/>
                                <input type="hidden" value="{{$usergroup['board']}}" class="row_board"/>
                                <input type="hidden" value="{{$usergroup['newsitem']}}" class="row_newsitem"/>
                                <input type="hidden" value="{{$usergroup['article']}}" class="row_article"/>
                                <input type="hidden" value="{{$usergroup['banner']}}" class="row_banner"/>
                                <input type="hidden" value="{{$usergroup['slide']}}" class="row_slide"/>
                                <input type="hidden" value="{{$usergroup['state']}}" class="row_state"/>
                                <input type="hidden" value="{{$usergroup['award']}}" class="row_award"/>
                                <input type="hidden" value="{{$usergroup['testimonial']}}" class="row_testimonial"/>
                                <input type="hidden" value="{{$usergroup['service']}}" class="row_service"/>
                                <input type="hidden" value="{{$usergroup['about']}}" class="row_about"/>
                                <input type="hidden" value="{{$usergroup['report']}}" class="row_reports"/>
                                
                                    <td> {{$loop->index+1}}  </td>
                                    <td class="row_title"> {{$usergroup['title']}} </td>
                                    <td class="row_description"> {{$usergroup['description']}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>   
            <?php //echo $user_role;exit;?>

        @if($user_role && $user_role >2)
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-pencil font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Add/Update Usergroups</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form role="form" action="{{ route('process_role')}}" method="post" id="role_form" class="form-horizontal">
                            <input type="hidden" name="id"  id="id" value="0">
                            <input type="hidden" name="type"  id="type" value="role">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Title
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="title" id="title" data-required="1" class="form-control" /> 
                                    </div>

                                    <label class="control-label col-md-2">Description&nbsp;&nbsp;</label>
                                    <div class="col-md-4">
                                        <input name="description" id="description" type="text" value="" class="form-control" /> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Users Module</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="user" id="user">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">Delete</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="delete_group" id="delete_group">
                                            <option value="0">NO</option>
                                            <option value="1">YES</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">User Groups</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="role" id="role">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">Management</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="management" id="management">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Board</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="board" id="board">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">News</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="newsitem" id="newsitem">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Testimonials</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="testimonial" id="testimonial">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">Service</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="service" id="service">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Articles</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="article" id="article">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">Banner</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="banner" id="banner">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">Slides</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="slide" id="slide">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">States</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="state" id="state">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Awards</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="award" id="award">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

<!--                                    <label class="control-label col-md-2">States</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="state" id="state">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>-->
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">About</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="about" id="about">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-md-2">Reports</label>
                                    <div class="col-lg-4 col-sm-4" >
                                        <select class="form-control " name="report" id="report">
                                            <option value="1">NONE</option>
                                            <option value="2">READ</option>
                                            <option value="3">WRITE</option>
                                            <option value="4">SPECIAL</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>                               

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <input type="submit" class="btn blue" name="submit" value="Submit" />
                                        <button onclick="resetForm('#role_form');" type="button" class="btn default">Reset</button>
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
        @endif

        <div class="row">
            <div class="col-md-12">                            
                <!--BEGIN MODALS FOR EDIT-->
                <div class="portlet ">

                    <div class="portlet-body form">                                    

                        <!--full width--> 
                        <div id="service_delete_modal" class="modal fade" tabindex="-1">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="service_header">Delete Item</h4>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want to delete this item?
                                </h4>
                                <form role="form" action="" method="post" id="service_delete_form" class="form-horizontal">
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
