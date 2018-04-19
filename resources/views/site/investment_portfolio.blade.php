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
                        <thead>
                            <tr>
                                <td>RSA</td>
                                <td>2018-04-17</td>
                                <td>2018-04-16</td>
                                <td>2018-04-15</td>
                                <td>2018-04-14</td>
                                <td>2018-04-13</td>
                                <td>2018-04-12</td>
                                <td>2018-04-11</td>                                
                            </tr>
                        </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:left;">CASH</td>
                                        <td style="text-align:left;">0.6%</td>
                                        <td style="text-align:left;">0.63%</td>
                                        <td style="text-align:left;">0.49%</td>
                                        <td style="text-align:left;">0.49%</td>
                                        <td style="text-align:left;">0.49%</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.56%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">MUTUAL FUNDS</td>
                                        <td style="text-align:left;">0.33%</td>
                                        <td style="text-align:left;">0.33%</td>
                                        <td style="text-align:left;">0.33%</td>
                                        <td style="text-align:left;">0.33%</td>
                                        <td style="text-align:left;">0.33%</td>
                                        <td style="text-align:left;">0.33%</td>
                                        <td style="text-align:left;">0.33%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">EQUITIES</td>
                                        <td style="text-align:left;">5.84%</td>
                                        <td style="text-align:left;">5.54%</td>
                                        <td style="text-align:left;">5.48%</td>
                                        <td style="text-align:left;">5.48%</td>
                                        <td style="text-align:left;">5.48%</td>
                                        <td style="text-align:left;">5.33%</td>
                                        <td style="text-align:left;">5.29%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">COMM. PAPERS-U</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.9%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">CORPORATE BONDS</td>
                                        <td style="text-align:left;">7.03%</td>
                                        <td style="text-align:left;">7.01%</td>
                                        <td style="text-align:left;">7.03%</td>
                                        <td style="text-align:left;">7.03%</td>
                                        <td style="text-align:left;">7.03%</td>
                                        <td style="text-align:left;">7.03%</td>
                                        <td style="text-align:left;">7.03%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">FIXED DEPOSIT</td>
                                        <td style="text-align:left;">18.67%</td>
                                        <td style="text-align:left;">19.05%</td>
                                        <td style="text-align:left;">19.09%</td>
                                        <td style="text-align:left;">19.09%</td>
                                        <td style="text-align:left;">19.09%</td>
                                        <td style="text-align:left;">19.09%</td>
                                        <td style="text-align:left;">19.09%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">INFRASTRUCTURE BOND</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.64%</td>
                                        <td style="text-align:left;">0.64%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">FGN BOND</td>
                                        <td style="text-align:left;">48.59%</td>
                                        <td style="text-align:left;">48.52%</td>
                                        <td style="text-align:left;">48.63%</td>
                                        <td style="text-align:left;">48.63%</td>
                                        <td style="text-align:left;">48.63%</td>
                                        <td style="text-align:left;">48.65%</td>
                                        <td style="text-align:left;">48.64%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">TREASURY BILLS</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.68%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">STATE GOVT BONDS</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.68%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                    </tr>
                                </tbody>
                        <tfoot><tr style="font-weight:600"><td>TOTAL</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td></tr></tfoot>
                    </table>
                </div>
                
                <div style="margin-top: 3%;">
                    <div style="background-color: #042948;"> <p class="product_icon_title">Retiree</p></div>
                    <table id="retireeTable" class="datatable" style=" width: 100%;">
                        <thead>
                            <tr>
                                <td>RETIREE</td>
                                <td>2018-04-17</td>
                                <td>2018-04-16</td>
                                <td>2018-04-15</td>
                                <td>2018-04-14</td>
                                <td>2018-04-13</td>
                                <td>2018-04-12</td>
                                <td>2018-04-11</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                        <td style="text-align:left;">CASH</td>
                                        <td style="text-align:left;">1.9%</td>
                                        <td style="text-align:left;">1.98%</td>
                                        <td style="text-align:left;">1.7%</td>
                                        <td style="text-align:left;">1.7%</td>
                                        <td style="text-align:left;">1.7%</td>
                                        <td style="text-align:left;">1.7%</td>
                                        <td style="text-align:left;">1.7%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">CORPORATE BONDS</td>
                                        <td style="text-align:left;">6.32%</td>
                                        <td style="text-align:left;">6.31%</td>
                                        <td style="text-align:left;">6.33%</td>
                                        <td style="text-align:left;">6.33%</td>
                                        <td style="text-align:left;">6.33%</td>
                                        <td style="text-align:left;">6.33%</td>
                                        <td style="text-align:left;">6.33%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">COMM.PAPERS-U</td>
                                        <td style="text-align:left;">2.38%</td>
                                        <td style="text-align:left;">2.37%</td>
                                        <td style="text-align:left;">2.38%</td>
                                        <td style="text-align:left;">2.38%</td>
                                        <td style="text-align:left;">2.38%</td>
                                        <td style="text-align:left;">2.38%</td>
                                        <td style="text-align:left;">2.38%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">FIXED DEPOSIT</td>
                                        <td style="text-align:left;">19.52%</td>
                                        <td style="text-align:left;">19.51%</td>
                                        <td style="text-align:left;">19.56%</td>
                                        <td style="text-align:left;">19.56%</td>
                                        <td style="text-align:left;">19.56%</td>
                                        <td style="text-align:left;">19.56%</td>
                                        <td style="text-align:left;">19.56%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">TREASURY BILLS</td>
                                        <td style="text-align:left;">11.69%</td>
                                        <td style="text-align:left;">11.67%</td>
                                        <td style="text-align:left;">11.71%</td>
                                        <td style="text-align:left;">11.71%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                        <td style="text-align:left;">11.7%</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">FGN BONDS</td>
                                        <td style="text-align:left;">58.2%</td>
                                        <td style="text-align:left;">58.15%</td>
                                        <td style="text-align:left;">58.32%</td>
                                        <td style="text-align:left;">58.32%</td>
                                        <td style="text-align:left;">58.32%</td>
                                        <td style="text-align:left;">58.33%</td>
                                        <td style="text-align:left;">58.33%</td>
                                    </tr>
                        </tbody>
                        <tfoot>
                            <tr style="font-weight:600"><td>TOTAL</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td><td>100%</td></tr>
                        </tfoot>
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
        
        //loadRSA();
        //loadRetiree();
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