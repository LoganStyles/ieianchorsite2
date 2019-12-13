<?php
$page = "home";
?>

@extends('layouts.master_site')

@section('title')
Retire Happy
@endsection 

@section('content')

<div class="slider-container" style="max-height: 350px">
            <div class="slider-control left inactive"></div>
            <div class="slider-control right"></div>
            <ul class="slider-pagi"></ul>
            <div class="slider">
                <div class="slide slide-0 active" >
                    <div class="slide__bg" ></div>
                    <div class="slide__content">
                        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                        </svg>
                        <div class="slide__text">
                            <h2 class="slide__text-heading">Live in your world. Play in ours</h2>
                            <p class="slide__text-desc">With IEI...You are in good hands, because our customers' satisfaction is our goal
                                </p>
                            <a class="slide__text-link" href="{{url('/about_site')}}">Client Satisfaction</a>
                        </div>
                    </div>
                </div>
                <div class="slide slide-1 ">
                    <div class="slide__bg"></div>
                    <div class="slide__content">
                        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                        </svg>
                        <div class="slide__text">
                            <h2 class="slide__text-heading">Invest Right, Live Better </h2>
                            <p class="slide__text-desc">
                                We apply proven strategies to maximize your average returns thereby achieving your financial goals.</p>
                            <a class="slide__text-link" href="{{url('/investment')}}">Investment Strategy</a>
                        </div>
                    </div>
                </div>
                <div class="slide slide-2">
                    <div class="slide__bg"></div>
                    <div class="slide__content">
                        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                        </svg>
                        <div class="slide__text">
                            <h2 class="slide__text-heading">Looking for superb customer service?</h2>
                            <p class="slide__text-desc">Providing quality service, building good relationships, helping customers efficiently...IEI Anchor Pensions</p>
                            <a class="slide__text-link" href="{{url('/faq_site')}}">Top Service</a>
                        </div>
                    </div>
                </div>
                <div class="slide slide-3">
                    <div class="slide__bg"></div>
                    <div class="slide__content">
                        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                        </svg>
                        <div class="slide__text">
                            <h2 class="slide__text-heading">Pleasing people the world over</h2>
                            <p class="slide__text-desc">At IEI, We have a personal connection with our customers such that doing business with us is a breeze.</p>
                            <a class="slide__text-link" href="{{url('/service_site')}}">Building Connections</a>
                        </div>
                    </div>
                </div>
                <div class="slide slide-4">
                    <div class="slide__bg"></div>
                    <div class="slide__content">
                        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
                        </svg>
                        <div class="slide__text">
                            <h2 class="slide__text-heading">Pleasing people the world over</h2>
                            <p class="slide__text-desc">At IEI, We have a personal connection with our customers such that doing business with us is a breeze.</p>
                            <a class="slide__text-link" href="{{url('/service_site')}}">Building Connections</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- //middle -->
<div class="testimonials">
    <div class="container" style="width:100%;">
        <div class="agile_team_grids_top">
            <div class="col-md-2 col-lg-2 col-sm-12">
                <div id="banner_01">
                    <!--banners-->
                    <!--append ajax fetched banners here-->
                </div>

            </div>


            <div class="col-md-8 col-lg-8 col-sm-12">
                <div class="col-md-12 col-lg-12 "col-sm-12>
                    <div class="col-md-4 col-lg-4 col-sm-12 w3_agile_services_grid">
                        <a target="_blank" href="{{url('https://ffpro.ieianchorpensions.com/pfaweb/')}}">
                            <div class="agile_services_grid1" >
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/statements.png')}}" /></div>
                                    <div style="width:70%;float: right;background-color: #042948;"> <p class="product_icon_title">Online Statement</p></div>
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
                        <a href="{{url('/show_pension_calculator')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/calculator.png')}}" /></div>
                                    <div style="width:70%;float: left;background-color: #042948;"> <p class="product_icon_title">Pension Calculator</p></div>
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
                        <a href="{{url('/investment_portfolio')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img class="products_icon" src="{{ asset('/site/images/portfolio.png')}}" /></div>
                                    <div style="width:70%;float: left;background-color: #042948;"> <p class="product_icon_title">Investment Portfolio</p></div>
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
                        <a href="{{url('/rate_of_return')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img class="products_icon" src="{{ asset('/site/images/rate_of_return.png')}}" /></div>
                                    <div style="width:70%;float: left;background-color: #042948;"> <p class="product_icon_title">Rate of Return</p></div>
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
                        <a href="{{url('/investment')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img class="products_icon" src="{{ asset('/site/images/strategy.png')}}" /></div>
                                    <div style="width:70%;float: left;background-color: #042948;"> <p class="product_icon_title">Investment Strategy</p></div>
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
                        <a href="{{url('/newsitem_site')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img class="products_icon" src="{{ asset('/site/images/news.png')}}" /></div>
                                    <div style="width:70%;float: left;background-color: #042948;"> <p class="product_icon_title">News</p></div>
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
                <div id="banner_02">
                    <!--banners-->
                    <!--append ajax fetched banners here-->
                </div>

                <div>
                    <!--twitter feeds-->
                    <a class="twitter-timeline" data-height="400" href="https://twitter.com/ieiapensionmgrs?ref_src=twsrc%5Etfw">Tweets by ieiapensionmgrs</a> 
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>

            </div>

        </div>
    </div>
</div>


<!-- gallery -->
<div class="gallery">
    <h3 class="w3l_header w3_agileits_header">Our <span>Awards</span></h3>
    <p class="sub_para_agile">We have been recognized for our efficient services</p>
    <div class="agile_team_grids_top">
        <ul id="flexiselDemo1">	
            <!--append ajax fetched awards here-->

        </ul>
    </div>
</div>
<!-- //gallery -->
<!-- testimonials -->
<div class="testimonials">
    <div class="container">
        <h3 class="w3l_header w3_agileits_header">Testimonials</h3>

        <div class="w3ls_testimonials_grids">
            <section class="center slider" id="testimonial_section">
                <!--append ajax fetched testimonials here-->

            </section>
        </div>
    </div>
    <p class="sub_para_agile">
        <a class="btn btn-primary" target="_blank" href="{{url('/feedback/')}}"><i class="fa fa-thumbs-up"></i>&nbsp;Give us your feedback </a>
    </p>
</div>
<!-- //testimonials -->
<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>We Offer Services That Work <a href="{{url('/register/')}}"><strong><span style="font-size: 0.8em;margin-top: 3%;font-weight: 700!important;color: #000;text-decoration: none;" class="label label-success">Register with us today</span></strong></a> </h3>        
    </div>
</div>
<!-- //small-banner -->	


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="background-color: #09347a;color: #fff;padding: 2%;text-align: center;">CAVEAT</h4>
            </div>
            <div class="modal-body">
                <p style="color: #000;font-weight: 500;">Please do not give money to any staff of IEI-Anchor Pensions as charges for services 
                    rendered or to be rendered.
                </p>
                <p style="color: #000;font-weight: 500;">
                    IEI-Anchor Pensions will not ask for gratification in any form (e.g: money, recharge cards etc) 
                    before or after processing withdrawal applications on your retirement savings account.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


@endsection
