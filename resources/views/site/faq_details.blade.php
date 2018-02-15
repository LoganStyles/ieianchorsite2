@extends('layouts.master_site')
<?php 
$page=$page_name;
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
$fetched_item=$data['fetched_item'];
$listed_items=$data['listed_items'];


foreach ($listed_items as $object) {
    $faqs[] = (array) $object;
}
//print_r($fetched_item);exit;
?>
@section('title')
FAQs
@endsection 

<style>
.accordion {
    /*background-color: #eee;*/
    background-color: #042948;
    /*color: #444;*/
    color: #cd9536 !important;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

.active, .accordion:hover {
    background-color: #ccc;
}

.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}
</style>

@section('content')

<!-- small-banner -->
<!--<div class="stats-bottom-banner">
    <div class="container">
        <h3>Wouldn't You Like <span>To</span> Retire Happy</h3>
    </div>
</div>-->
<!-- //small-banner -->	

<!-- services -->

<div class="team">
    <div class="container">
        <h3 class="w3l_header w3_agileits_header">F<span>AQS</span></h3>
        <div class="agile_team_grids_top">
            <div class="col-md-12 w3ls_banner_bottom_left w3ls_courses_left">
                <div class="col-md-4">
                    <h3>Categories</h3>
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            @foreach($faqs as $item)
                            <tr>
                                <td><a href="{!!$item['id']!!}">{!!$item['title']!!}</a></td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table> 
                    <br>
                    <?php //echo $listed_items->links(); ?>
                </div>
                <div class="col-md-8">
                    <div class="w3ls_courses_left_grids">
                        
                        
                    <!--<h2>Animated Accordion</h2>-->
<!--<p>Click on the buttons to open the collapsible content.</p>-->
@foreach($fetched_item as $f_item)
<button class="accordion">{!!$f_item['question']!!}</button>
<div class="panel">
  <p>{!!$f_item['answer']!!}</p>
</div>
@endforeach


                </div>
                </div>
                
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

@endsection