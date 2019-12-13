<?php 
$page=$page_name; 
?>
@extends('layouts.master_site')
@section('title')
Rate of Return
@endsection 

@section('content')

<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>Rate <span>of</span> Return</h3>
    </div>
</div>
<!-- //small-banner -->	

<!-- -->
<div class="team">
    <div class="container">
        <div class="agile_team_grids_top">
            <div class="col-md-12 w3ls_banner_bottom_left w3ls_courses_left">
                <div class="w3ls_courses_left_grids">
                    
                    <div class="w3ls_courses_left_grid">
                          
                    </div>
                </div>
                
                <div>
                    <h2>Annual Rate of Return and 3 Year Rolling Rate of Return</h2>
                    <div style="background-color: #042948;"> <p class="product_icon_title">RSA</p></div>
                    <table id="rsa_fund_table" class="datatable" style=" width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-left">Date</th>
                                <th class="text-left">Annual Rate of Return</th>
                                <th class="text-left">3 Year Rolling Average Return</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                
                <div style="margin-top: 3%;">
                    <div style="background-color: #042948;"> <p class="product_icon_title">Retiree</p></div>
                    <table id="retiree_fund_table" class="datatable" style=" width: 100%;">
                        <thead><tr>
                                <th class="text-left">Date</th>
                                <th class="text-left">Annual Rate of Return</th>
                                <th class="text-left">3 Year Rolling Average Return</th>
                            </tr></thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
                        
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!---->
<script type="text/javascript" src="{{ asset('/site/js/jquery-2.1.4.min.js')}}"></script>
<script>
	$(function() {
            rsa = [
                    { "Date": "31 Dec 2018", "AnnualReturn": 9.62, "AverageRollingReturn": 11.94},
                    { "Date": "31 Dec 2017", "AnnualReturn": 14.02, "AverageRollingReturn": 10.38 },
                    { "Date": "31 Dec 2016", "AnnualReturn": 12.19, "AverageRollingReturn": 8.50 },
                    { "Date": "31 Dec 2015", "AnnualReturn": 9.67, "AverageRollingReturn": 10.33 },
                    { "Date": "31 Dec 2014", "AnnualReturn": 3.62, "AverageRollingReturn": 12.65 },
                    { "Date": "31 Dec 2013", "AnnualReturn": 17.7, "AverageRollingReturn": 14.14 }
		];
                
                retiree = [
			{ "Date": "31 Dec 2018", "AnnualReturn": 11.44, "AverageRollingReturn": 12.55 },
            { "Date": "31 Dec 2017", "AnnualReturn": 14.71, "AverageRollingReturn": 12.40 },
            { "Date": "31 Dec 2016", "AnnualReturn": 11.51, "AverageRollingReturn": 11.02 },
			{ "Date": "31 Dec 2015", "AnnualReturn": 11.65, "AverageRollingReturn": 11.83 },
			{ "Date": "31 Dec 2014", "AnnualReturn": 9.89, "AverageRollingReturn": 12.84 },
			{ "Date": "31 Dec 2013", "AnnualReturn": 13.95, "AverageRollingReturn": 11.65 }
		];
                
                // RSA table and graph
		var rsaLine1 = [];
		var rsaLine2 = [];
                
                for(i = 0; i < rsa.length; i++) {
			rsaLine1.push([rsa[i].Date, rsa[i].AnnualReturn]);
			rsaLine2.push([rsa[i].Date, rsa[i].AverageRollingReturn]);			
			$('#rsa_fund_table tbody').append('<tr><td>' + rsa[i].Date + '</td><td>' + rsa[i].AnnualReturn + '</td><td>' + rsa[i].AverageRollingReturn + '</td></tr>');
		}
                
        // Retiree table and graph
		var retireeLine1 = [];
		var retireeLine2 = [];
		
		for(i = 0; i < retiree.length; i++) {
			retireeLine1.push([retiree[i].Date, retiree[i].AnnualReturn]);
			retireeLine2.push([retiree[i].Date, retiree[i].AverageRollingReturn]);			
			$('#retiree_fund_table tbody').append('<tr><td>' + retiree[i].Date + '</td><td>' + retiree[i].AnnualReturn + '</td><td>' + retiree[i].AverageRollingReturn + '</td></tr>');
		}
        });
 </script>
<script type="text/javascript">
    
    $(document).ready(function () {
        
    });    
    
</script>
@endsection