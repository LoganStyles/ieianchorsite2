<?php
$page="home"; 
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
$banners=$data['banners'];
$slides=$data['slides'];
$awards=$data['awards'];

//print_r($slides);exit;

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
<!--<div style="width:100%;">
    <img style="max-width: 100%;" src="{{ asset('/site/images/retirement12.png')}}"  />
    @if(count($slides) >0 && $slides[0])
        
        <img src="{{ asset('/site/img/'.$slides[0]['filename'])}}" style="max-width: 100%;" />
        
    @endif
</div>-->

<div class="container">
    <div id='coin-slider'>
        <?php foreach($slides as $item){ ?>
        <a href="#">
            <img src="{{ asset('/site/img/'.$item['filename'])}}" alt="" title=""/>
            <span>
                {{$item['title']}}
            </span>
        </a>
       <?php } ?>
    </div>
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
                        <a target="_blank" href="{{url('http://ffpro.ieianchorpensions.com/pfaweb/')}}">
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
                        <a href="{{url('/page/show_pension_calculator')}}">
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
                        <a href="{{url('/page/investment_portfolio')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/portfolio.png')}}" /></div>
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
                        <a href="{{url('/page/rate_of_return')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/rate_of_return.png')}}" /></div>
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
                        <a href="{{url('/page/investment')}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/strategy.png')}}" /></div>
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
                        <?php $link=($news)?($news->link_label):(""); ?>
                        <a href="{{url('/page/newsitem_site/'.$link)}}">
                            <div class="agile_services_grid1">
                                <div style="width:100%;">
                                    <div style="width:30%;float: left;"><img  class="products_icon" src="{{ asset('/site/images/news.png')}}" /></div>
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
                <div>
                    @if(count($banners) >0 && $banners[1])
                    <a href="{{$banners[1]['url']}}" target="_blank">
                    <img src="{{ asset('/site/img/'.$banners[1]['filename'])}}" style="max-width: 100%;" />
                    </a>
                </div>
                
                <div>
                    <!--twitter feeds-->
                    <a class="twitter-timeline" data-height="400" href="https://twitter.com/ieiapensionmgrs?ref_src=twsrc%5Etfw">Tweets by ieiapensionmgrs</a> 
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                @endif
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
            <?php foreach($awards as $item){ ?>
            <li>
                <div class="wthree_gallery_grid">
                    <a href="{{ asset('/site/img/'.$item['filename'])}}" class="lsb-preview" data-lsb-group="header">
                        <div class="view second-effect" style="width: 350px;height: 350px;">
                            <img src="{{ asset('/site/img/'.$item['filename'])}}" style="width: 100%;min-width: 100%;min-height: 100%;" alt="" class="img-responsive" />
                            <div class="mask">
                                <p>{!!$item['title']!!}</p>
                            </div>
                        </div>	
                    </a>
                </div>
            </li>
            <?php } ?>

        </ul>
    </div>
</div>
<!-- //gallery -->
<!-- testimonials -->
<div class="testimonials">
    <div class="container">
        <h3 class="w3l_header w3_agileits_header">Testimonials</h3>
        
        <div class="w3ls_testimonials_grids">
            <section class="center slider">
                <?php foreach($data['testimonials'] as $item){ ?>
                <div class="agileits_testimonial_grid">
                    <div class="w3l_testimonial_grid">
                        <p>{!!$item['details']!!}</p>
                        <h4>{!!$item['title']!!}</h4>
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
    <p class="sub_para_agile">
        <a class="btn btn-primary" target="_blank" href="{{url('/page/feedback/')}}"><i class="fa fa-thumbs-up"></i>&nbsp;Give us your feedback </a>
        </p>
</div>
<!-- //testimonials -->
<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>We Offer Services That Work <a href="{{url('/page/register/')}}"><strong><span style="font-size: 0.8em;margin-top: 3%;font-weight: 700!important;color: #000;text-decoration: none;" class="label label-success">Register with us today</span></strong></a> </h3>        
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
