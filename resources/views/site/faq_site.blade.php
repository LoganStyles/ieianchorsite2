<?php
$page=$page_name; 
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
$moduleitems=$data['moduleitems'];

foreach ($moduleitems as $object) {
            $faqs[] = (array) $object;
        }

//print_r($moduleitems);exit;
?>
@extends('layouts.master_site')
@section('title')
Board of Directors
@endsection 

@section('content')


<!-- small-banner -->
<!--<div class="stats-bottom-banner">
    <div class="container">
        <h3>Wouldn't You Like <span>To</span> Retire Happy</h3>
    </div>
</div>-->
<!-- //small-banner -->	

<!-- //middle -->
<div class="testimonials">
    <div class="container" style="width:100%;">
        <h3 class="w3l_header w3_agileits_header">F<span>AQS</span></h3>
        <div class="agile_team_grids_top">
            <div class="col-md-2 col-lg-2 col-sm-12">
            </div>
           
            
            <div class="col-md-8 col-lg-8 col-sm-12">
                <div class="col-md-12">
                    @foreach($faqs as $item)
                    <div class="col-md-4 w3_agile_services_grid">
                        <a href="{{url('/page/faq/'.$item['id'])}}">
                            <div class="agileits_w3layouts_services_grid1">
                                <div class="w3_agileits_services_grid1">
                                    <div class="clearfix"> </div>
                                </div>
                                <h4><a href="{{url('/page/faq/'.$item['id'])}}">{!!$item['title']!!}</a></h4>
                            </div>
                        </a>                        
                    </div>
                    @endforeach
           
            <div class="clearfix"> </div>
            </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-12">
<!--                <a href="https://www.instagram.com/ieianchorpensions/" target="_blank">
                <img src="{{ asset('/site/images/not-late.png')}}" style="max-width: 100%;" />
                </a>-->
            </div>
            
        </div>
    </div>
</div>

@endsection
<?php //include 'includes/footer.php'; ?>