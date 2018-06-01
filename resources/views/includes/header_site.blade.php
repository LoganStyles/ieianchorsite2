<?php $newslink=($news)?($news->link_label):("");?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- custom-theme -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="iei anchor pensions, pensions,pfa,nigeria,best,highest,top pfa" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //custom-theme -->
        <link href="{{asset('/site/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
        <link href="{{asset('/site/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
        <link rel='stylesheet' href="{{ asset('/site/css/dscountdown.css')}}" type='text/css' media='all' />
        <link href="{{asset('/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="{{ asset('/site/css/flexslider.css')}}" type="text/css" media="screen" property="" />-->
        <!-- gallery -->
        <link href="{{asset('/site/css/lsb.css')}}" rel="stylesheet" type="text/css">
        <!-- //gallery -->
        <!-- font-awesome-icons -->
        <link href="{{asset('/site/css/font-awesome.css')}}" rel="stylesheet"> 
        <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,900" rel="stylesheet">
        
        <link href="{{asset('/site/css/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" />
        <!--coin slider-->
        <link href="{{asset('/assets/global/coin-slider/coin-slider-styles.css')}}" rel="stylesheet" />
        <style>
            .dataTables_filter, .dataTables_length, .dataTables_info, .dataTables_paginate {
                /*display: none;*/
            } 

            .datatable thead {
                background-color: #e2e2e2;
            }
        </style>

        <link rel="stylesheet" type="text/css" href="{{asset('/site/js/jqPlot/jquery.jqplot.css')}}" />
        
        <link rel="shortcut icon" href="{{ asset('/assets/pages/img/favicon.ico')}}" />
        
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/site/images/icons2/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/site/images/icons2/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/site/images/icons2/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/site/images/icons2/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/site/images/icons2/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/site/images/icons2/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/site/images/icons2/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/site/images/icons2/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/site/images/icons2/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/site/images/icons2/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/site/images/icons2/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/site/images/icons2/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/site/images/icons2/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('/site/images/icons2/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('/site/images/icons2/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
    </head>	
    <body>
               
        <!-- banner -->
        <div class="header">

            <div class="w3layouts_header_right">
                <div class="agileits-social top_content">
                    <ul>                       
                        <li><a href="{{$site['facebook']}}" target="_blank"><img src="{{asset('/site/images/icons/facebook.png')}}" /></a></li>
                        <li><a href="{{$site['twitter']}}" target="_blank"><img src="{{asset('/site/images/icons/twitter.png')}}" /></a></li>
                        <li><a href="{{$site['instagram']}}" target="_blank"><img src="{{asset('/site/images/icons/instagram.png')}}" /></a></li>
                        <li><a href="{{$site['youtube']}}" target="_blank"><img src="{{asset('/site/images/icons/youtube.png')}}" /></a></li>
                        <li><a href="{{$site['linkedin']}}" target="_blank"><img src="{{asset('/site/images/icons/linkedin.png')}}" /></a></li>
                        <li><a href="https://api.whatsapp.com/send?phone=+2348165722731&text=Hello, how may we help you? Just send us a message now to get assistance." class="social-icon whatsapp" target="_blank"><img src="{{asset('/site/images/icons/whatsapp2.png')}}" /></a></li>

                    </ul>
                </div>
            </div>
            <div class="w3layouts_header_left">
                <ul>
                    <li><a target="_blank" title="RSA Account Login" href="{{$site['client_url']}}">RSA Account Login</a></li>
                    <li><a target="_blank" title="Register With Us" href="{{url('/page/register/')}}">Register With Us</a></li>
                </ul>

            </div>
<!--            <div class="w3layouts_header_left">
                <div class="w3_agile_search">
                    <form action="#" method="post">
                        <input type="search" name="Search" placeholder="Type your email.." required="" />
                        <input type="submit" value="Subscribe to Newsletter">
                    </form>
                </div>
            </div>-->
            <div class="clearfix"> </div>
        </div>
        <div class="header_mid">
            <div class="w3layouts_header_mid">
                <ul>
                    <li>
                        <div class="header_contact_details_agile"><i class="fa fa-map-marker" aria-hidden="true"></i>
                            <div class="w3l_header_contact_details_agile">
                                <div class="header-contact-detail-title">Head Office</div> 
                                <div class="w3l_header_contact_details_agile-info_inner">{{$site['office']}} </div><br>
                                <div class="w3l_header_contact_details_agile-info_inner"><strong>Email:</strong>{{$site['email']}} </div>
                                <div class="w3l_header_contact_details_agile-info_inner"><strong>Call:</strong>{{$site['phone1']}}, {{$site['phone2']}} </div>
                                
                            </div>
                        </div>
                    </li>
                    
                    <li>
                        <div class="header_contact_details_agile"><i class="fa fa-institution" aria-hidden="true"></i>
                            <div class="w3l_header_contact_details_agile">
                                <span class="w3l_header_contact_details_agile-info_inner"><strong>Bank:</strong> UBA </span><br>
                                <span class="w3l_header_contact_details_agile-info_inner"><strong>Account Name:</strong> UPCL/IEI-ANCHOR PENSIONS RSA CONTRIBUTION A/C </span><br>
                                <span class="w3l_header_contact_details_agile-info_inner"><strong>Account Number:</strong> 1006236132 </span><br><br>
                                <strong>EPCCOS :&nbsp;</strong><a target="_blank" href="{{url('https://apps.nibss-plc.com.ng/EPCCOS/login;jsessionid=26AB9979142CA84F38202ACA6726646F')}}"><span class="label label-primary">Login to EPCCOS</span></a>&nbsp;&nbsp;
                            </div>
                        </div>
                    </li>
                     <li>
                        <div class="header_contact_details_agile"><i class="fa fa-list-alt" aria-hidden="true"></i>
                            <div class="w3l_header_contact_details_agile">
                                <div class="header-contact-detail-title">Unit Prices as at {{date("M j, Y",strtotime($prices->report_date))}}</div> 
                                <span class="w3l_header_contact_details_agile-info_inner">RSA Unit Price: {{$prices->rsa}} </span><br>
                                <span class="w3l_header_contact_details_agile-info_inner">Retiree Unit Price: {{$prices->retiree}} </span><br>
                                <span class="w3l_header_contact_details_agile-info_inner">Administrative Fee: 100 </span><br><br>
                                <strong>Price History:&nbsp;</strong><a target="_blank" href="{{url('/page/unit_price/')}}"><span class="label label-primary">View Price History</span></a>&nbsp;&nbsp;
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="" style="position: relative;">
            <nav class="navbar navbar-default">
                <div class="navbar-header navbar-left">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('home')}}">
                        <div class="img_logo">
                        <img src="{{ asset('/site/img/'.$site['filename'])}}" alt="IEI Anchor Pensions" class="img-responsive" style="max-width: 60%;" />
                        </div>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <nav class="link-effect-2" id="link-effect-2">
                        <ul class="nav navbar-nav">
                            <li class="<?php if($page=="home"){echo "active";}?>"><a href="{{route('home')}}"><span data-hover="Home">Home</span></a></li>
                            
                            <li class="<?php if($page=="about_site"||$page=="board_site"||$page=="management_site"){echo "active";}?>dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="About Us">About Us</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu agile_short_dropdown">
                                    <li><a href="{{url('/page/about_site')}}">About Us</a></li>
                                    <li><a href="{{url('/page/board_site')}}">Directors</a></li>
                                    <li><a href="{{url('/page/management_site')}}">Management</a></li>
                                </ul>
                            </li>
                            <li class="<?php if($page=="service"){echo "active";}?> dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Services">Services</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu agile_short_dropdown">
                                    
                                    <?php
                                    foreach($services as $subservice){
                                        $link=$subservice['link_label']; ?>
                                    <li><a href="{{url('/page/service/'.$link)}}">{{$subservice['title']}}</a></li>
                                    <?php 
                                    
                                    }
                                    ?>
                                </ul>
                            </li>
                            
                            <li class="<?php if($page=="investment"||$page=="investment_portfolio"){echo "active";}?> dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Investment">Investment</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu agile_short_dropdown">                                    
                                    <li><a href="{{route('investment')}}">Strategy</a></li>
                                    <li><a href="{{url('/page/investment_portfolio')}}">Portfolio</a></li>
                                </ul>
                            </li>
                            
                            <li class="<?php if($page=="newsitem"){echo "active";}?>"><a href="{{url('/page/newsitem_site')}}"><span data-hover="News">News</span></a></li>
                            
                            <li class="<?php if($page=="financial_site"||$page=="download_site"||$page=="rate_of_return"||$page=="unit_price"||$page=="show_pension_calculator"){echo "active";}?>dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Resources">Resources</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu agile_short_dropdown">
                                    <li><a href="{{url('/page/download_site/')}}">Downloads</a></li>
                                    <li><a href="{{url('/page/financial_site')}}">Financial Reports</a></li>
                                    <li><a href="{{url('/page/rate_of_return')}}">Rate of Return</a></li>
                                    <li><a href="{{url('/page/unit_price/')}}">Unit Prices</a></li>
                                    <li><a href="{{url('http://ffpro.ieianchorpensions.com/pfaweb/')}}">Online Statement</a></li>
                                    <li><a href="{{url('/page/show_pension_calculator')}}">Pension Calculator</a></li>
                                </ul>
                            </li> 
                            
                            <li class="<?php if($page=="faq_site"||$page=="contact"||$page=="branch_site"){echo "active";}?>dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Contact Us">Contact Us</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu agile_short_dropdown">
                                    <li><a href="{{url('/page/contact')}}">Feedback</a></li>
                                    <li><a href="{{url('/page/faq_site')}}">FAQ</a></li>
                                    <li><a href="{{url('/page/branch_site')}}">Our Office/Service Centers</a></li>
                                </ul>
                            </li> 

                        </ul>
                    </nav>

                </div>
                <div class="clearfix"></div>
            </nav>
            
            
        </div>
