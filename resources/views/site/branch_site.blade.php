<?php
$page=$page_name;
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
$moduleitems=$data['moduleitems'];

foreach ($moduleitems as $object) {
    $branches[] = (array) $object;
   }
?>
@extends('layouts.master_site')
@section('title')
Branches
@endsection 

@section('content')


<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>OUR <span> SERVICE</span> CENTERS</h3>
    </div>
</div>
<!-- //small-banner -->	

<!-- //middle -->
<div class="testimonials">
    <div class="container" style="width:100%;">
        <div class="agile_team_grids_top">
            <div class="col-md-2 col-lg-2 col-sm-12">
<!--                <a href="https://www.instagram.com/ieianchorpensions/" target="_blank">
                <img src="{{ asset('/site/images/savings.png')}}" style="max-width: 100%;" />
                </a>-->
            </div>
           
            
            <div class="col-md-8 col-lg-8 col-sm-12">
                <div class="col-md-12">
                    @foreach($branches as $item)
                    <div class="col-md-4 w3_agile_services_grid">
                        <a href="javascript:;">
                            <div class="agile_services_grid1" >
                                <div class="agile_services_grid1_sub">
                                    <p style="color: #cd9536; font-weight: 600; font-size: 1em;">{!!$item['title']!!}</p>
                                </div>
                                
                            </div>
                            <div class="agileits_w3layouts_services_grid1">
                                <div class="w3_agileits_services_grid1">
                                    <div class="clearfix"> </div>
                                </div>
                                <h4><a href="javascript:;">{!!$item['address']!!}...</a></h4>
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