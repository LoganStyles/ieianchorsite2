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
FAQs
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
    <div class="container" >
        <h3 class="w3l_header w3_agileits_header">F<span>AQS</span></h3>
        <div class="agile_team_grids_top">            
            
                <div class="col-md-12 w3ls_banner_bottom_left w3ls_courses_left" style="margin-left: 20%;">
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                @foreach($faqs as $item)
                                <tr class="">
                                    <td><a href="{{url('/page/faq/'.$item['id'])}}">{!!$item['title']!!}</a></td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </table> 
                        <br>
                    </div>
           
            <div class="clearfix"> </div>
            </div>            
        </div>
    </div>
</div>

@endsection
<?php //include 'includes/footer.php'; ?>