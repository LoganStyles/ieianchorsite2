@extends('layouts.master_site')
<?php 
$page=$page_name;
$fetched_item=$data['fetched_item'];
$listed_items=$data['listed_items'];
?>
@section('title')
News
@endsection 

@section('content')

<!-- small-banner -->
<div class="stats-bottom-banner">
    <div class="container">
        <h3> <span>NEWS</span></h3>
    </div>
</div>
<!-- //small-banner -->	

<!-- manangement details -->

<div class="team">
    <div class="container">
        <div class="agile_team_grids_top">
            <div class="col-md-12 w3ls_banner_bottom_left w3ls_courses_left">
                <div class="col-md-4">
                    <h3>Latest Stories</h3><br>
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
                            <h2>{!!$subitem['title']!!}</h2>
                            <div>
                                @if($subitem['filename'])
                                <img src="{{ asset('/site/img/'.$subitem['filename'])}}" style="max-width: 100%;" />
                                @endif
                            </div>
                            <div class="item_page_details">{!!$subitem['details']!!}</div>
                        
                        </div>
                    @endforeach
                    </div>
                    
                    <div>
                        <!--disqus-->
                        <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://https-ieianchorpensions-com-ieiweb.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
                    </div>
                </div>
                
            </div>
            
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--NEWS-->
<script id="dsq-count-scr" src="//https-ieianchorpensions-com-ieiweb.disqus.com/count.js" async></script>
@endsection