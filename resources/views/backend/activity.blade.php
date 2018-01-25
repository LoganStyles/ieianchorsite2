@extends('layouts.master_pages')
<?php $page_name="activity";?>
@section('title')
Admin | Activity
@endsection 

@section('content')


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
                    <span>Visits</span>
                </li>
            </ul>
             </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Visitors
            <small>: Summary</small>
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
                                <div class="col-md-10">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th> S/N</th>
                                                <th> IP Address</th>
                                                <th> Country/City </th>
                                                <th> User </th>
                                                <th> Device </th>
                                                <th> Browser </th>
                                                <th> Page Views </th>
                                                <th> Last Activity </th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table_row">
                                                <td>1</td>
                                                <td>127.0.0.1</td>
                                                <td>Nigeria</td>
                                                <td>Guest</td>
                                                <td>Computer [Webkit] [Windows 8]</td>
                                                <td>Chrome (35.0.1916)</td>
                                                <td>4</td>
                                                <td>1 second</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
         
                        
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
            
            
            

</div>
<!-- END CONTAINER -->

@endsection
