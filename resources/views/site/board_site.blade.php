<?php
$page=$page_name; 
?>
@extends('layouts.master_site')
@section('title')
Board of Directors
@endsection 

@section('content')


<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>BOARD <span> OF</span> DIRECTORS</h3>
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
                <div class="col-md-12" id="board_content">
                    <!--fetch board content with ajax-->
           
            <div class="clearfix"> </div>
            </div>
            </div>
            <div class="col-md-2 col-lg-2 col-sm-12">  </div>
            
        </div>
    </div>
</div>

@endsection