@extends('layouts.master_site')
<?php 
$page=$page_name;
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
$fetched_item=$data['fetched_item'];
$current_cat_item=$data['fetched_item'][0];//current cat item
$current_cat_id=$current_cat_item['category_id'];//current cat_id
$listed_items=$data['listed_items'];


foreach ($listed_items as $object) {
    $downloads[] = (array) $object;
}
?>
@section('title')
DOWNLOADs
@endsection 

<style>
.accordion {
    background-color: #042948;
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
<div class="stats-bottom-banner">
    <div class="container">
        <h3>Wouldn't You Like <span>To</span> Retire Happy</h3>
    </div>
</div>
<!-- //small-banner -->	

<!-- services -->

<div class="team">
    <div class="container">
        <h3 class="w3l_header w3_agileits_header"><span>DOWNLOADS</span></h3>
        <div class="agile_team_grids_top">
            <div class="col-md-12 w3ls_banner_bottom_left w3ls_courses_left">
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            @foreach($downloads as $item)
                            <tr class="@if($item['id'] ==$current_cat_id)accordion @endif ">
                                <td><a href="{!!$item['id']!!}">{!!$item['title']!!}</a></td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table> 
                    <br>
                </div>
                <div class="col-md-8">
                    <div class="w3ls_courses_left_grids">
                    @foreach($fetched_item as $f_item)
                    <button id="{{url('/downloads/'.$f_item['filename'])}}" class="accordion">{!!$f_item['title']!!}</button>
                    @endforeach
                    </div>
                </div>
                
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@endsection