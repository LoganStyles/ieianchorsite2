<?php
$page="home"; 
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
$banners=$data['banners'];
$slides=$data['slides'];

?>

@extends('layouts.master_site')

@section('title')
Retire Happy
@endsection 

@section('content')

<!-- //banner -->	
<!--<div id="exampleSlider" style="margin-top: 40px;">
    <div><h3>Open A Retirement Savings Account Today <span>and Retire Happy</span></h3></div>
    <div><h3>Don't Simply Retire, <span>Have Something to Retire To</span></h3></div>
</div>-->
<div style="width:100%;">
    <!--<img style="max-width: 100%;" src="{{ asset('/site/images/retirement12.png')}}"  />-->
    @if(count($slides) >0 && $slides[0])
        
        <img src="{{ asset('/site/img/'.$slides[0]['filename'])}}" style="max-width: 100%;" />
        
    @endif
</div>

<!-- //middle -->
<div class="testimonials">
    <div class="container" style="width:100%;">
        <div class="agile_team_grids_top">
            <div class="col-md-2 col-lg-2 col-sm-12">
                @if(count($banners) >0 && $banners[0])
                    <a href="{{$banners[0]['url']}}" target="_blank">
                    <img src="{{ asset('/site/img/'.$banners[0]['filename'])}}" style="max-width: 100%;" />
                    </a>
                @endif
            </div>
            
            
            <div class="col-md-8 col-lg-8 col-sm-12">
                <div class="col-md-12 col-lg-12 "col-sm-12>
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <a target="_blank" href="{{url('http://41.223.131.235/pfaweb')}}">
                            <div class="agile_services_grid1" >
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/statements.png')}}" /></div>
                                    <div style="width:70%;float: left;"> <p class="product_icon_title">Online Statement</p></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="agileits_w3layouts_services_grid1">
                               <p class="products_icon_details">You can monitor you RSA account with ease. This 
                                        makes it easy to stay organised and get a clear picture of your current balance.</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <a href="{{url('/page/show_pension_calculator')}}">
                            <div class="agile_services_grid1">
                                 <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/calculator.png')}}" /></div>
                                    <div style="width:70%;float: left;"> <p class="product_icon_title">Pension Calculator</p></div>
                                    <div class="clearfix"></div>
                                </div>                                
                            </div>

                            <div class="agileits_w3layouts_services_grid1">
                                <p class="products_icon_details">Find out how much retirement income you would get and how 
                                    much you should consider saving to achieve your target</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <a href="#">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/portfolio.png')}}" /></div>
                                    <div style="width:70%;float: left;"> <p class="product_icon_title">Investment Portfolio</p></div>
                                    <div class="clearfix"></div>
                                </div>                                
                            </div>
                            <div class="agileits_w3layouts_services_grid1">
                                <p class="products_icon_details">Get the best rate of return on your investments. this provides 
                                    you with a better measure of profitability on your funds
                                </p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <a href="#">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/rate_of_return.png')}}" /></div>
                                    <div style="width:70%;float: left;"> <p class="product_icon_title">Rate of Return</p></div>
                                    <div class="clearfix"></div>
                                </div>                                
                            </div>
                            <div class="agileits_w3layouts_services_grid1">
                                <p class="products_icon_details">Check your rate of return to enable you manage your contributions 
                                    effectively and efficiently.
                                </p>
                            </div>
                        </a>
                    </div> 
                    
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <a href="{{url('/page/investment')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/strategy.png')}}" /></div>
                                    <div style="width:70%;float: left;"> <p class="product_icon_title">Investment Strategy</p></div>
                                    <div class="clearfix"></div>
                                </div>                                
                            </div>
                            <div class="agileits_w3layouts_services_grid1">
                                <p class="products_icon_details">IEI-ANCHOR  in line with PENCOM guidelines and its internal investment 
                            management policy has designed an investment strategy suitable for our clients
                                </p>
                            </div>
                        </a>
                    </div> 
                    
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <?php $link=$data['newsitem']->link_label; ?>
                        <a href="{{url('/page/newsitem/'.$link)}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/news.png')}}" /></div>
                                    <div style="width:70%;float: left;"> <p class="product_icon_title">News</p></div>
                                    <div class="clearfix"></div>
                                </div>                                
                            </div>
                            <div class="agileits_w3layouts_services_grid1">
                                <p class="products_icon_details">Get the latest news on pension matters, including breaking news and more
                                </p>
                            </div>
                        </a>
                    </div> 
       
            <div class="clearfix"> </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-12">
                @if(count($banners) >0 && $banners[1])
                    <a href="{{$banners[1]['url']}}" target="_blank">
                    <img src="{{ asset('/site/img/'.$banners[1]['filename'])}}" style="max-width: 100%;" />
                    </a>
                @endif
            </div>
            
        </div>
    </div>
</div>
<!-- testimonials -->
<div class="testimonials">
    <div class="container">
        <h3 class="w3l_header w3_agileits_header">Testimonials</h3>
        <p class="sub_para_agile">What others say about us</p>
        <div class="w3ls_testimonials_grids">
            <section class="center slider">
                <?php foreach($data['testimonials'] as $item){ ?>
                <div class="agileits_testimonial_grid">
                    <div class="w3l_testimonial_grid">
                        <p>{{$item['details']}}</p>
                        <h4>{{$item['title']}}</h4>
                        <h5>Client</h5>
                        <div class="w3l_testimonial_grid_pos">
                            <?php $image=$item['link_label']; ?>
                            <img src="{{ asset('/site/img/'.$item['filename'])}}" style="max-width: 100px;" alt=" " class="img-responsive" />
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </section>
        </div>
    </div>
</div>
<!-- //testimonials -->
<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>We Offer Services That Work <a href="{{url('/page/register/')}}"><strong><span style="font-size: 0.8em;margin-top: 3%;font-weight: 700!important;color: #000;text-decoration: none;" class="label label-success">Register with us today</span></strong></a> </h3>        
    </div>
</div>
<!-- //small-banner -->	
@endsection
