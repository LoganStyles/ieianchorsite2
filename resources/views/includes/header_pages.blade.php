
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->     
        <link href="{{ asset('/assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />        
        <link href="{{asset('/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />
        
        <link href="{{asset('/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('/assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('/assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
       
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('/assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('/assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" href="{{ asset('/assets/pages/img/favicon.ico')}}" /> 
        
        <!-- include summernote css/js -->
        <link href="{{ asset('/assets/summernote/summernote.css')}}" rel="stylesheet" type="text/css" />
        
        </head>
    <!-- END HEAD -->
    
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-md">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{url('/module/dashboard')}}">
                        <img src="{{asset('/assets/pages/img/login/iei_anchor_small.png')}}" alt="logo" class="logo-default" />
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar"></li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar"></li>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar"></li>
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="{{asset('/assets/pages/img/avatar.png')}}" />
                                <span class="username username-hide-on-mobile"> {{session('users_fullname')}} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{route('logout')}}">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a target="_blank" href="{{url('/page/index')}}" class="dropdown-toggle" style="color:#fff;">
                                <i class="fa fa-rocket"></i>Launch Site
                            </a>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <form class="sidebar-search  " action="#" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
<!--                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>-->
                                </div>
                            </form>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
                        <li class="nav-item start <?php if($page_name=='dashboard' || $page_name=='setup' || $page_name=='activity'){echo 'active open';}?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="<?php if($page_name=='dashboard' || $page_name=='setup'){echo 'selected';}?>"></span>
                                <span class="arrow <?php if($page_name=='dashboard' || $page_name=='setup'){echo 'open';}?>"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start <?php if($page_name=='dashboard'){echo 'active open';}?>">
                                    <a href="{{url('/module/dashboard')}}" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">Statistics</span>
                                    </a>
                                </li>
                                <li class="nav-item start <?php if($page_name=='activity'){echo 'active open';}?>">
                                    <a href="{{url('/module/activity')}}" class="nav-link ">
                                        <i class="fa fa-globe"></i>
                                        <span class="title">Site Activity</span>
                                    </a>
                                </li>
                                <li class="nav-item start <?php if($page_name=='setup'){echo 'active open';}?>">
                                    <a href="{{url('/module/setup')}}" class="nav-link ">
                                        <i class="fa fa-globe"></i>
                                        <span class="title">Site info</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Modules</h3>
                        </li>
                        @if(session()->has('about') && session('about') >1)<!--can view-->
                        <li class="nav-item  <?php if($page_name=='about'){echo 'active ';}?>">
                            <a href="{{url('/module/about')}}" class="nav-link ">
                                <i class="fa fa-info-circle"></i>
                                <span class="title">About</span>
                            </a>
                        </li>
                        @endif
                        
                        <li class="nav-item <?php if($page_name=='service'){echo 'active ';}?> ">
                            <a href="{{url('/module/service')}}" class="nav-link ">
                                <i class="fa fa-briefcase"></i>
                                <span class="title">Services</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='testimonial'){echo 'active ';}?>">
                            <a href="{{url('/module/testimonial')}}" class="nav-link ">
                                <i class="fa fa-thumbs-up"></i>
                                <span class="title">Testimonials</span>
                            </a>
                        </li>
                        @if(session()->has('newsitem') && session('newsitem') >2)<!--content developers-->
                        <li class="nav-item  <?php if($page_name=='newsitem'){echo 'active ';}?>">
                            <a href="{{url('/module/newsitem')}}" class="nav-link ">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">News</span>
                            </a>
                        </li>
                        @endif
                        
                        @if(session()->has('article') && session('article') >2)<!--content developers-->
                        <li class="nav-item  <?php if($page_name=='article'){echo 'active ';}?>">
                            <a href="{{url('/module/article')}}" class="nav-link ">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="title">Articles</span>
                            </a>
                        </li>
                        @endif
                        
                        <li class="nav-item  <?php if($page_name=='banner'){echo 'active ';}?>">
                            <a href="{{url('/module/banner')}}" class="nav-link ">
                                <i class="fa fa-picture-o"></i>
                                <span class="title">Banners</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='slide'){echo 'active ';}?>">
                            <a href="{{url('/module/slide')}}" class="nav-link ">
                                <i class="fa fa-photo"></i>
                                <span class="title">Slides</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='award'){echo 'active ';}?>">
                            <a href="{{url('/module/award')}}" class="nav-link ">
                                <i class="fa fa-hourglass-o"></i>
                                <span class="title">Awards</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='states'){echo 'active ';}?>">
                            <a href="{{url('/module/states')}}" class="nav-link ">
                                <i class="fa fa-calendar-o"></i>
                                <span class="title">States & Contacts</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='board'){echo 'active ';}?>">
                            <a href="{{url('/module/board')}}" class="nav-link ">
                                <i class="fa fa-group"></i>
                                <span class="title">Board</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='management'){echo 'active ';}?>">
                            <a href="{{url('/module/management')}}" class="nav-link ">
                                <i class="fa fa-group"></i>
                                <span class="title">Management</span>
                            </a>
                        </li>
                        
                        @if(session()->has('faq') && session('faq') >2)
                        <li class="nav-item  <?php if($page_name=='faq_cats'){echo 'active ';}?>">
                            <a href="{{url('/module/faqcat')}}" class="nav-link ">
                                <i class="fa fa-group"></i>
                                <span class="title">FAQ Categories</span>
                            </a>
                        </li>
                        
                        <li class="nav-item  <?php if($page_name=='faq'){echo 'active ';}?>">
                            <a href="{{url('/module/faq')}}" class="nav-link ">
                                <i class="fa fa-group"></i>
                                <span class="title">FAQs</span>
                            </a>
                        </li>
                        @endif
                                                
                        @if(session()->has('users') && session('users') >3)<!--super users-->
                        <li class="nav-item <?php if($page_name=='personnel' || $page_name=='role'){echo 'active open';}?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">Users</span>                                
                                <span class="<?php if($page_name=='personnel' || $page_name=='role'){echo 'selected';}?>"></span>
                                <span class="arrow <?php if($page_name=='personnel' || $page_name=='role'){echo 'open';}?>"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php if($page_name=='personnel'){echo 'active open';}?>">
                                    <a href="{{route('show_users')}}" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title">Personnel</span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($page_name=='role'){echo 'active open';}?> ">
                                    <a href="{{route('show_usergroups')}}" class="nav-link ">
                                        <i class="fa fa-group"></i>
                                        <span class="title">User Groups</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        @endif
                        
                        
                        
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->