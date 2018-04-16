<?php 
$page=$page_name; 
$site=$data['siteitems'][0];
$services=$data['services'];
$news=$data['newsitem'];
?>
@extends('layouts.master_site')
@section('title')
Investment Portfolio
@endsection 

@section('content')

<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3><span>InvestmenT Portfolio</span></h3>
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
                    <div style="background-color: #042948;"> <p class="product_icon_title">RSA</p></div>
                    <table id="rsaTable" class="datatable" style=" width: 100%;">
                        <thead></thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
                
                <div style="margin-top: 3%;">
                    <div style="background-color: #042948;"> <p class="product_icon_title">Retiree</p></div>
                    <table id="retireeTable" class="datatable" style=" width: 100%;">
                        <thead></thead>
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
<script type="text/javascript">
    
    $(document).ready(function () {
        
        loadRSA();
        loadRetiree();
    });    
    //load RSA
    function loadRSA(){
        $('#rsaTable tbody').html('Loading RSA ...');
        
        $.ajax({
           url:"{{url('http://41.223.131.235/ieia_api/api/RSA/GetInvestmentPortfolo?schemeID=1')}}",
           method:'GET',
           success:function(response){
               //console.log(response);
               if (response !== null && response !== 'undefined') {
               
                var jsonData = JSON.parse(response);                
               if(jsonData.length > 0){
                   
                   // columns
                    var h = '<tr>';
                    $.each(jsonData[0], function (key, value) {
                            h += '<th>' + (key == 'Item' ? 'RSA' : key.substring(1, 11).replace(/_/g, '-')) + '</th>';
                    });
                    h += '</tr>';
                    $('#rsaTable thead').append(h);
                   
                   // rows
                   var r = "";
                    $.each(jsonData, function (key, row) {
                            r += '<tr>';						
                            $.each(row, function (key1, value1) {
                                    r += '<td style="text-align:left;">' + (isNaN(value1) ? value1 : value1 + '%') + '</td>';
                            });						
                            r += '</tr>';
                            });
                            $('#rsaTable tbody').html(r);
                            $('#rsaTable tfoot').append('<tr style="font-weight:600"><td>TOTAL</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td></tr>');
                            //$('#rsaTable').attr("style",{border:"solid 1px #042948"});
                    }

                    }

                },
                error: function (jqXHR, textStatus, error) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("Ajax error: " + textStatus + ' : ' + error);
                }

            });
        }
        
        //load Retiree
    function loadRetiree(){
        $('#retireeTable tbody').html('Loading Retiree ...');
        
        $.ajax({
           url:"{{url('http://41.223.131.235/ieia_api/api/rsa/GetInvestmentPortfolo?schemeID=12')}}",
           method:'GET',
           success:function(response){
               //console.log(response);
               if (response !== null && response !== 'undefined') {
               
                var jsonData = JSON.parse(response);                
               if(jsonData.length > 0){
                   
                   // columns
                    var h = '<tr>';
                    $.each(jsonData[0], function (key, value) {
                            h += '<th>' + (key == 'Item' ? 'Retiree' : key.substring(1, 11).replace(/_/g, '-')) + '</th>';
                    });
                    h += '</tr>';
                    $('#retireeTable thead').append(h);
                   
                   // rows
                   var r = "";
                    $.each(jsonData, function (key, row) {
                            r += '<tr>';						
                            $.each(row, function (key1, value1) {
                                    r += '<td style="text-align:left;">' + (isNaN(value1) ? value1 : value1 + '%') + '</td>';
                            });						
                            r += '</tr>';
                            });
                            $('#retireeTable tbody').html(r);
                            $('#retireeTable tfoot').append('<tr style="font-weight:600"><td>TOTAL</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td></tr>');
                            
                        }

                    }

                },
                error: function (jqXHR, textStatus, error) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("Ajax error: " + textStatus + ' : ' + error);
                }

            });
        }
    
</script>
@endsection