<!-- footer -->
<div class="footer_agile_w3ls">
    <div class="container">
        <div class="agileits_w3layouts_footer_grids">
            <div class="col-md-3 footer-w3-agileits">
                <h3>About Us</h3>
                <ul>
                    <li><a href="{{url('/board_site/')}}">The Board of Directors</a></li>
                    <li><a href="{{url('/management_site/')}}">The Management Team</a></li>                           
                    <li><a target="_blank" href="{{url('https://ubapensions.com/')}}">UBA Pensions Custodian Limited</a></li>                            
                    <li><a href="{{url('/faq_site')}}">Frequently Asked Questions</a></li>
                    <li><a href="{{url('/contact/')}}">Contact Us</a></li>
                </ul>

            </div>
            <div class="col-md-3 footer-agileits">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>                           
                    <li><a href="{{url('/service_site')}}">Services</a></li>
                    <li><a href="{{url('/service/retirement_planning_service')}}">Retirement Planning</a></li>
                    <li><a href="{{url('/newsitem_site')}}">News</a></li>
                    <li><a href="{{url('/unit_price')}}">Unit Prices</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-wthree">
                <br><br>
                <ul>
                    <li><a href="{{url('/article_site')}}">Articles</a></li> 
                    <li><a target="_blank" href="{{url('http://www.pencom.gov.ng/')}}">Pencom</a></li> 
                    <li><a target="_blank" href="{{url('/downloads/Whistle_Blowing_Guidelines_for_Pensions')}}">Whistle Blowing Guidelines</a></li>
                    <li><a target="_blank" href="{{url('/downloads/RSA_Transfer_Guidelines.pdf')}}">RSA Transfer Guidelines</a></li>
                    <li><a target="_blank" href="{{url('https://apps.nibss-plc.com.ng/EPCCOS/login;jsessionid=26AB9979142CA84F38202ACA6726646F')}}">EPCCOS</a></li>
                </ul>
            </div>

            <div class="col-md-3 footer-agileits-w3layouts">
                <h3>Downloads</h3>
                <ul>                            
                    <li><a href="{{url('/downloads/RSA-FORM.pdf')}}">Rsa Form</a></li>                            
                    <li><a href="{{url('/downloads/Client-Update-form.pdf')}}">Client Update Form</a></li>
                    <li><a href="{{url('/downloads/CHANGE-OF-EMPLOYER.pdf')}}">Change Of Employer</a></li>
                    <li><a href="{{url('/downloads/CHANGE-OF-NEXT-OF-KIN-NOK.pdf')}}">Change Of Next Of Kin</a></li>
                    <li><a href="{{url('/downloads/CHECKLIST_FOR_25_LUMP_SUM_WITHDRAWAL_REQUEST.pdf')}}">Checklist For 25% Lump Sum</a></li>
                    <li><a href="{{url('/downloads/CHECKLIST_DEATH_BENEFIT_REQUEST_FGN_EMPLOYEES.pdf')}}">Checklist For Death Benefit</a></li>
                    <li><a href="{{url('/downloads/CHECKLIST-FOR-VOLUNTARY-CONTRIBUTION.pdf')}}">Checklist For Voluntary Contribution</a></li>
                    <li><a href="{{url('/download_site/')}}"><strong>ALL DOWNLOADS</strong></a></li>

                </ul>
            </div>
            <div class="clearfix"></div>

        </div>
        <div style="margin:auto; width: 80%;">                    
            <div style="">
                <a href="{{route('home')}}">
                    <img src="{{ asset('/site/images/icons/iei_anchor.png')}}" alt="IEI Anchor Pensions" class="img-responsive" style="max-width: 40%;margin: 3% auto;" />
                </a>
            </div>

            <div class="agileits-social" style="text-align: center;">
                <ul>
                    <li><a href="https://web.facebook.com/anchorpensions?_rdc=1&_rdr" target="_blank"><img src="{{asset('/site/images/icons/facebook.png')}}" /></a></li>
                    <li><a href="https://twitter.com/ieiapensionmgrs" target="_blank"><img src="{{asset('/site/images/icons/twitter.png')}}" /></a></li>
                    <li><a href="https://www.instagram.com/ieianchorpensions/" target="_blank"><img src="{{asset('/site/images/icons/instagram.png')}}" /></a></li>
                    <li><a href="https://www.youtube.com/channel/UCyXZnwdv_jcXyNeFfBfhvEw" target="_blank"><img src="{{asset('/site/images/icons/youtube.png')}}" /></a></li>
                    <li><a href="https://www.linkedin.com/company-beta/16194771" target="_blank"><img src="{{asset('/site/images/icons/linkedin.png')}}" /></a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=+2348165722731&text=Hello, how may we help you? Just send us a message now to get assistance." class="social-icon whatsapp" target="_blank"><img src="{{asset('/site/images/icons/whatsapp2.png')}}" /></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<div class="wthree_copy_right">
    <div class="container">
        <p>© {{date('Y')}} IEI-Anchor Pension Managers Limited. All rights reserved</p>
    </div>
</div>


<!-- //footer -->
<!-- //bootstrap-pop-up -->

<!-- js -->
<!--service worker registration-->
<script type="text/javascript">

    //This is the "Offline copy of pages" service worker

    //Add this below content to your HTML page, or add the js file to your page at the very top to register sercie worker
//    if (navigator.serviceWorker.controller) {
//        console.log('[PWA Builder] active service worker found, no need to register')
//    } else {
//        //Register the ServiceWorker
//        navigator.serviceWorker.register('../service-worker.js', {
//            scope: './'
//        }).then(function (reg) {
//            console.log('Service worker has been registered for scope:' + reg.scope);
//        });
//    }

//        if ('serviceWorker' in navigator && 'PushManager' in window) {
//            window.addEventListener('load', function() {
//                navigator.serviceWorker.register('../service-worker.js').then(function(registration) {
//                    // Registration was successful
//                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
//                }, function(err) {
//                    // registration failed :(
//                    console.log('ServiceWorker registration failed: ', err);
//                });
//            });
//        }
</script>

<script src="{{asset('/site/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>



<script src="{{asset('/site/js/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/jquery.jqplot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.dateAxisRenderer.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.logAxisRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.canvasTextRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.canvasAxisTickRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.highlighter.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/slick.min.js')}}"  charset="utf-8"></script>
<!-- FlexSlider -->
<script type="text/javascript" src="{{asset('/site/js/jquery.flexisel.js')}}"></script>
<!-- gallery-pop-up -->
<script src="{{asset('/site/js/lsb.min.js')}}"></script>
<script src="{{asset('/site/js/progressbar.min.js')}}"></script>
<script>
    var page_name = "<?php echo $page; ?>";
    var bar = new ProgressBar.Line("#container-progress", {
        color: '#09347a',
        strokeWidth: 0.2,
        trailWidth: 0.5,
        easing: 'easeInOut'
    });
    bar.animate(1, { duration: 1000 });
    $(window).load(function () {
        $.fn.lightspeedBox();
    });
    
</script>
<!-- //gallery-pop-up -->
<script type="text/javascript" src="https://ieianchorpensions.com/livechat/php/app.php?widget-init.js"></script>
<script type="text/javascript" src="{{asset('/site/js/custom_scripts.js')}}"></script>

<!-- start-smooth-scrolling -->
<script type="text/javascript" src="{{asset('/site/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('/site/js/easing.js')}}"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
        });
    });
</script>
</body>
</html>


