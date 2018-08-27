@extends('layouts.master_site')
<?php 
$page=$page_name;
$fetched_item=$data['fetched_item'];
$listed_items=$data['listed_items'];
?>
@section('title')
Services
@endsection 

@section('content')

<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3>MANAGEMENT<span> TEAM</span> </h3>
    </div>
</div>
<!-- //small-banner -->	

<!-- manangement details -->

<div class="team">
    <div class="container">
        <div class="agile_team_grids_top">
            <div class="col-md-12 w3ls_banner_bottom_left w3ls_courses_left">
                <div class="col-md-4">
                    <h3>Board of Directors</h3>
                    <table class="table table-bordered">
                        <thead>
                        </thead>
                        <tbody>
                            @foreach($listed_items as $item)
                            <tr>
                                <td><a href="{{$item->link_label}}">{{$item->title}}</a></td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table> 
                    <br>
                    <?php echo $listed_items->links(); ?>
                </div>
                <div class="col-md-8">
                    <div class="w3ls_courses_left_grids">
                    @foreach($fetched_item as $subitem)
                        <div class="w3ls_courses_left_grid">
                            <h2>
                                {!!$subitem['title']!!}</h2>
                            <div>
                                <!--<img src="{{ asset('/site/img/'.$subitem['filename'])}}" style="max-width: 100%;" />-->
                            </div>
                            <div class="item_page_details">{!!$subitem['details']!!}</div>
                        
                    </div>
                    @endforeach
                </div>
                </div>
                
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--services-->
@endsection