<?php
$page=$page_name;
$resultitems=$data['resultitems'];
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
?>
@extends('layouts.master_site')

@section('title')
Pension Calculator
@endsection 

@section('content')

<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>Wouldn't You Like <span>To</span> Retire Happy</h3>
    </div>
</div>
<!-- //small-banner -->	

<!-- courses -->
<div class="team">
    <div class="container">
        <div class="agile_team_grids_top">
            <div class="col-md-6 w3ls_banner_bottom_left w3ls_courses_left">
                <div class="w3ls_courses_left_grids">
                    <form id="pensionCalculatorForm" action="{{ route('pension_calc')}}" method="post">
                        <div class="form-group">
                            <label class="control-label">What is your current RSA Balance?</label>
                            <input type="text" id="rsa_balance" name="rsa_balance" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">How much is your total monthly contribution (Employer + Employee)?</label>
                            <input type="text" id="monthly_contribution" name="monthly_contribution" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">How long do you have to retirement? (In years)</label>
                            <input type="text" id="years_before_retirement" name="years_before_retirement" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">What return do you think you will get on your pensions?</label>
                            <input type="text" id="percentage_return" name="percentage_return" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"></label>
                            <button type="submit" class="btn btn-default">Calculate</button>
                            <span id="loader"></span>
                            <span id="messanger" class="alert"></span>
                        </div>
                        <input type="hidden" value="{{Session::token()}}" name="_token"/>
                    </form>
                </div>
            </div>
            <div class="col-md-6 agileits_courses_right estimated_results">
                <h3>Estimated Results</h3>
                <table class="table table-bordered">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h4>What will you get at retirement?</h4></td>
                            <td><span class="badge badge-primary">{{$resultitems['total_package']}}</span></td>
                        </tr>
                        <tr>
                            <td><strong><h4>Do I qualify for lumpsum payment?</h4></strong></td>
                            <td><span class="badge badge-primary">{{$resultitems['qualify_for_lumpsum']}}</span></td>
                        </tr>
                        <tr>
                            <td><strong><h4>My total lumpsum package: </h4></strong></td>
                            <td><span class="badge badge-primary">{{$resultitems['lumpsum']}}</span></td>
                        </tr>
                        <tr>
                            <td><strong><h4>Do I qualify for programmed redrawal?</h4></strong></td>
                            <td><span class="badge badge-primary">{{$resultitems['qualify_for_programmed_withdrawal']}}</span></td>
                        </tr>
                        <tr>
                            <td><strong><h4>My monthly pension allowance</h4></strong></td>
                            <td><span class="badge badge-primary">{{$resultitems['qualify_for_lumpsum']}}</span></td>
                        </tr>
                       
                    </tbody>
                </table>  
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //courses -->
@endsection