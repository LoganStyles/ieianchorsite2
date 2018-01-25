@extends('layouts.master_pages')

@section('title')
Admin | Users
@endsection 

@section('content')
<?php $page_name="personnel"; ?>

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
        <h3 class="page-title"> Users
            <small>: Personnel</small>
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
                            <div class="row">
                                <div class="col-md-6">
                                    @if(session()->has('users') && session('users') >2)
                                    <div class="btn-group">
                                        <a href="{{route('create_user')}}" id="sample_editable_1_new" class="btn sbold green"> Create Admin
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <thead>
                                <tr>
                                    <th>S/N </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> User Group </th>
                                    <th> Last Login Time </th>
                                    <th> MAC Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr class="table_row">
                                    <td> {{$loop->index+1}}  </td>
                                    <td> {{$user['name']}} </td>
                                    <td> {{$user['email']}}</td>
                                    <td> {{$user['role_title']}}</td>
                                    <td> {{$user['last_login_time']}} </td>
                                    <td> {{$user['mac']}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                        <div id="service_delete_modal" class="modal fade" tabindex="-1">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title" id="service_header">Delete Item</h4>
                            </div>
                            <div class="modal-body">
                                <h4>
                                    Are you sure you want to delete this item?
                                </h4>
                                <form role="form" action="{{ route('delete_item')}}" method="post" id="service_delete_form" class="form-horizontal">
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
