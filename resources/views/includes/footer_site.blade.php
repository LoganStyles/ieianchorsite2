
<!-- footer -->
        <div class="footer_agile_w3ls">
            <div class="container">
                <div class="agileits_w3layouts_footer_grids">
                    <div class="col-md-3 footer-w3-agileits">
                        <h3>About Us</h3>
                        <ul>
                            <li><a href="{{url('/page/board/')}}">The Board of Directors</a></li>
                            <li><a href="{{url('/page/management/')}}">The Management Team</a></li>                           
                            <li><a target="_blank" href="{{url('https://ubapensions.com/')}}">UBA Pensions Custodian Limited</a></li>                            
                            <li><a href="#">Frequently Asked Questions</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                                                
                    </div>
                    <div class="col-md-3 footer-agileits">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>                           
                            <li><a href="{{url('/page/service')}}">Services</a></li>
                            <li><a href="#">Retirement Planning</a></li>
                            <?php //$newslink=$news->link_label;
                            $newslink=""; ?>
                            <li><a href="{{url('/page/newsitem/'.$newslink)}}">News</a></li>
                            <li><a href="#">Unit Prices</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 footer-wthree">
                        <br><br>
                        <ul>
                            <li><a href="{{url('http://www.pencom.gov.ng/')}}">Pencom</a></li>                            
                            <li><a href="{{url('/downloads/Whistle_Blowing_Guidelines_for_Pensions')}}">Whistle Blowing Guidelines</a></li>
                            <li><a href="{{url('/downloads/RSA_Transfer_Guidelines.pdf')}}">RSA Transfer Guidelines</a></li>
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
                            
                        </ul>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <div style="margin:auto; width: 30%;">                    
                    <div style="">
                        <a href="{{route('home')}}">
                            <img src="{{ asset('/site/images/icons/iei_anchor.png')}}" alt="IEI Anchor Pensions" class="img-responsive" style="max-width: 40%;margin: 3% auto;" />
                        </a>
                    </div>
                    
                    <div class="agileits-social" style="text-align: center;">
                        <ul>
                            <li><a href="{{$site['facebook']}}" target="_blank"><img src="{{asset('/site/images/icons/facebook.png')}}" /></a></li>
                            <li><a href="{{$site['twitter']}}" target="_blank"><img src="{{asset('/site/images/icons/twitter.png')}}" /></a></li>
                            <li><a href="{{$site['instagram']}}" target="_blank"><img src="{{asset('/site/images/icons/instagram.png')}}" /></a></li>
                            <li><a href="{{$site['youtube']}}" target="_blank"><img src="{{asset('/site/images/icons/youtube.png')}}" /></a></li>
                            <li><a href="{{$site['linkedin']}}" target="_blank"><img src="{{asset('/site/images/icons/linkedin.png')}}" /></a></li>
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
            if (navigator.serviceWorker.controller) {
              console.log('[PWA Builder] active service worker found, no need to register')
            } else {
              //Register the ServiceWorker
              navigator.serviceWorker.register('../service-worker.js', {
                scope: './'
              }).then(function(reg) {
                console.log('Service worker has been registered for scope:'+ reg.scope);
              });
            }

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
        <script type="text/javascript" src="{{ asset('/site/js/jquery-2.1.4.min.js')}}"></script>
        <!-- //js -->
        <!-- Counter required files -->
       
        
        <script>
jQuery(document).ready(function ($) {
//    $('.demo2').dsCountDown({
//        endDate: new Date("December 24, 2020 23:59:00"),
//        theme: 'black'
//    });
});
        </script>
        <!-- //Counter required files -->

<script src="{{asset('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>

<script src="{{asset('/site/js/datatables/jquery.dataTables.min.js')}}"></script>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.js"></script><![endif]-->
<script type="text/javascript" src="{{asset('site/js/jqPlot/jquery.jqplot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.dateAxisRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.logAxisRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.canvasTextRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.canvasAxisTickRenderer.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/jqPlot/plugins/jqplot.highlighter.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('site/js/slick.js')}}"  charset="utf-8"></script>
<script type="text/javascript">
$(document).on('ready', function () {
    $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: false,
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    centerMode: false,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
});
        </script>
        <!-- //carousal -->
        <!-- flexisel -->
        <script type="text/javascript">
            $(window).load(function () {
                $("#flexiselDemo1").flexisel({
                    visibleItems: 4,
                    animationSpeed: 1000,
                    autoPlay: true,
                    autoPlaySpeed: 3000,
                    pauseOnHover: true,
                    enableResponsiveBreakpoints: true,
                    responsiveBreakpoints: {
                        portrait: {
                            changePoint: 480,
                            visibleItems: 1
                        },
                        landscape: {
                            changePoint: 640,
                            visibleItems: 2
                        },
                        tablet: {
                            changePoint: 768,
                            visibleItems: 2
                        }
                    }
                });

            });
        </script>
        <script type="text/javascript" src="{{ asset('/site/js/jquery.flexisel.js')}}"></script>
        <!-- //flexisel -->
        <!-- gallery-pop-up -->
        <script src="{{ asset('/site/js/lsb.min.js')}}"></script>
        <script>
            $(window).load(function () {
                $.fn.lightspeedBox();
            });
        </script>
        <!-- //gallery-pop-up -->
        <!-- flexSlider -->
        <script defer src="{{ asset('/site/js/jquery.flexslider.js')}}"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function (slider) {
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>
        <!-- //flexSlider -->

        <!-- start-smooth-scrolling -->
        <script type="text/javascript" src="{{ asset('/site/js/move-top.js')}}"></script>
        <script type="text/javascript" src="{{ asset('/site/js/easing.js')}}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
        </script>
        <!-- start-smooth-scrolling -->
        <!-- for bootstrap working -->
        <script src="{{ asset('/site/js/bootstrap.js')}}"></script>
        <!-- //for bootstrap working -->
        <!-- here stars scrolling icon -->
        <script type="text/javascript">
            $(document).ready(function () {
                
                 var defaults = {
                 containerID: 'toTop', // fading element id
                 containerHoverID: 'toTopHover', // fading element hover id
                 scrollSpeed: 1200,
                 easingType: 'linear' 
                 };
                 

                $().UItoTop({easingType: 'easeOutQuart'});

            });
        </script>
        <!-- //here ends scrolling icon -->
    </body>
</html>


