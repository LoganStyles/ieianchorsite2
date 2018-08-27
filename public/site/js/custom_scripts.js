
function fetchLatestPrices($last_id) {
    $.ajax({
        url: BASEURL + '/fetchLatestPrices',
        method: 'GET',
        data: {'last_id': $last_id},
        success: function (response) {
            var price_data = JSON.parse(response)

            if (Object.keys(price_data).length > 0) {
                setLocalStorage("latestUnitPrice", response);
                //update page prices
                var options = {year: 'numeric', month: 'long', day: 'numeric'};
                var report_date = new Date(price_data.report_date)
                $('#price_date').text("Unit Prices as at " + report_date.toLocaleDateString("en-US", options));
                $('#price_fund1').text("RSA Fund I: " + price_data.fund1);
                $('#price_fund2').text("RSA Fund II: " + price_data.fund2);
                $('#price_fund3').text("RSA Fund III: " + price_data.fund3);
                $('#price_fund4').text("RSA Fund IV: " + price_data.fund4);
            }
        },
        error: function (jqXHR, textStatus, error) {
            console.log(error);
            console.log(textStatus)
        },
        complete: function () {
        }
    });
}

function fetchPageDetails($page) {
    $.ajax({
        url: BASEURL + '/pagedata',
        method: 'GET',
        data: {'page': $page},
        success: function (response) {
            var page_data = JSON.parse(response);
            

            if (page_data.length > 0) {
                var list = "",content = "",link="",excerpt="", title = "", details = "";
                
                for (i = 0; i < page_data.length; i++) {
                    if ($page == "about") {
                        title = page_data[i].title;
                        details = page_data[i].details;
                        list += '<div class="w3ls_courses_left_grid">';
                        list += '<h3>' + title + '</h3>';
                        list += details + '</div>';
                    }else if($page == "board" || $page == "management" || $page=="service" || $page=="newsitem" || $page=="article"){
                        link=BASEURL+'/'+$page+'/'+page_data[i].link_label;
                        title = page_data[i].title;
                        excerpt = page_data[i].excerpt;
                        list+='<div class="col-md-4 w3_agile_services_grid">';
                        list+='<a href="'+link+'">';
                        list+='<div class="agile_services_grid1" >';
                        list+='<div class="agile_services_grid1_sub">';
                        list+='<p style="color: #cd9536; font-weight: 600; font-size: 1em;">'+title+'</p>';
                        list+='</div><div></div></div>';
                        list+='<div class="agileits_w3layouts_services_grid1">';
                        list+='<div class="w3_agileits_services_grid1">';
                        list+='<div class="clearfix"> </div>';
                        list+='</div>';
                        list+='<h4><a href="'+link+'">'+excerpt+'...</a></h4>';
                        list+='</div></a></div>';
                    }else if($page == "branch"){
                        link=BASEURL+'/'+$page+'/'+page_data[i].link_label;
                        title = page_data[i].title;
                        title = page_data[i].title;
                    }
                }
                //update data
                content='#'+$page+'_content';
                $(content).html(list);

            }
        },
        error: function (jqXHR, textStatus, error) {
            console.log(jqXHR);
            console.log(error);
            console.log(textStatus)
        },
        complete: function () {
        }
    });
}

function fetchPageDetailsNoImages($page) {
    $.ajax({
        url: BASEURL + '/pagedata_noimages',
        method: 'GET',
        data: {'page': $page},
        success: function (response) {
            var page_data = JSON.parse(response)

            if (page_data.length > 0) {
                var list = "",content = "",link="",url="", title = "", details = "",
                        contactperson="",phone="",address="",filename="",viewfile="",downloadfile="";
                
                for (i = 0; i < page_data.length; i++) {
                    if ($page == "branche") {
                        title = page_data[i].title;
                        phone = page_data[i].phone;
                        contactperson = page_data[i].contactperson;
                        address = page_data[i].address;
                        list += '<div class="col-md-4 w3_agile_services_grid">';
                        list +='<a href="javascript:;">';
                        list +='<div class="agile_services_grid1" >';
                        list +='<div class="agile_services_grid1_sub">';
                        list +='<p style="color: #cd9536; font-weight: 600; font-size: 1em;">'+title+'</p>';
                        list +='</div></div>';
                        list +='<div class="agileits_w3layouts_services_grid1">';
                        list +='<p>'+phone+'</p>';
                        list +='<p>Personnel:<strong>'+contactperson+'</strong></p>';
                        list +='</div>';
                        list +='<div class="agileits_w3layouts_services_grid1">';
                        list +='<h4><a href="javascript:;">'+address+'</a></h4>';
                        list +='</div></a></div>';
                    }
                    else if ($page == "downloadcat" ){
                        title = page_data[i].title;
                        url = BASEURL+'/download/'+page_data[i].title;
                        list +='<tr class="">';
                        list +='<td><a href="'+url+'">'+title+'</a></td>';
                        list +='</tr>';
                    }else if ($page == "faqcat" ){
                        title = page_data[i].title;
                        url = BASEURL+'/faq/'+page_data[i].title;
                        list +='<tr class="">';
                        list +='<td><a href="'+url+'">'+title+'</a></td>';
                        list +='</tr>';
                    }else if($page =="financial"){
                        title = page_data[i].title;
                        viewfile = BASEURL+'/viewfile/'+page_data[i].filename;
                        downloadfile = BASEURL+'/downloads/'+page_data[i].filename;
                        list +='<div class="accordion" style="width:100%;overflow: auto;">';
                        list +='<span></span>&nbsp;';
                        list +='<div class="pull-left" style="width:80%;">'+title+'</div>';
                        list +='<div class="pull-right" style="width:20%;">';
                        list +='<button style="color:#000;" id="'+viewfile+'" class="view_button">View</button>';
                        list +='<button style="color:#000;" id="'+downloadfile+'" class="download_button">Download</button>';
                        list +='</div>';
                        list +='</div>';
                    }
                }
                //update data
                content='#'+$page+'_content';
                $(content).html(list);

            }
        },
        error: function (jqXHR, textStatus, error) {
            console.log(error);
            console.log(textStatus)
        },
        complete: function () {
        }
    });
}

function setLocalStorage(key, value) {
    if (typeof (Storage) !== "undefined") {
        localStorage.setItem(key, value);
    }
}

$(document).on('ready', function () {

    var latest_unit_price, last_id;
    //chk for localstorage support
    if (typeof (Storage) !== "undefined") {
        if (window.localStorage.latestUnitPrice) {
            latest_unit_price = JSON.parse(window.localStorage.latestUnitPrice);
            fetchLatestPrices(latest_unit_price.id);
        } else {
            fetchLatestPrices(0);
        }
    } else {
        fetchLatestPrices(0);
    }

    if (page_name == "home") {
        $(window).load(function () {
            $('#myModal').modal('show');
        });
        $('#coin-slider').coinslider({
          width: 1262,
            height: 300,
            navigation: false,
            delay: 5000
        });

        //FETCH AWARDS,TESTIMONIALS,SERVICES,BANNERS FOR HOME PAGE
        $.ajax({
            url: BASEURL + "/homedata",
            method: 'GET',
            data: {},
            success: function (response) {
                var home_data = JSON.parse(response)
                if (home_data.length > 0) {

                    var service_list = "", award_list = "", testimonial_list = "", banner_list = "",
                            link = "", title = "", filename = "",
                            details = "", url = "",
                            banner_count = 0;

                    for (i = 0; i < home_data.length; i++) {
                        switch (home_data[i].type) {
                            case 'service':
                                link = home_data[i].link_label;
                                title = home_data[i].title;
                                service_list += '<li><a href="' + BASEURL + '/service/' + link + '">' + title + '</a></li>';
                                break;
                            case 'award':
                                filename = home_data[i].filename;
                                title = home_data[i].title;
                                award_list += '<li><div class="wthree_gallery_grid">';
                                award_list += '<a href="' + IMG_URL + '/' + filename + '" class="lsb-preview" data-lsb-group="header">';
                                award_list += '<div class="view second-effect" style="width: 350px;height: 350px;">';
                                award_list += '<img src="' + IMG_URL + '/' + filename + '" style="width: 100%;min-width: 100%;min-height: 100%;" alt="" class="img-responsive" />';
                                award_list += '<div class="mask">' + title + '</div>';
                                award_list += '</div></a></div></li>';
                                break;
                            case 'testimonial':
                                filename = home_data[i].filename;
                                title = home_data[i].title;
                                link = home_data[i].link_label;
                                details = home_data[i].details;
                                testimonial_list += '<div class="agileits_testimonial_grid">';
                                testimonial_list += '<div class="w3l_testimonial_grid">';
                                testimonial_list += '<p>' + details + '</p>';
                                testimonial_list += '<h4>' + title + '</h4>';
                                testimonial_list += '<h5>Client</h5>';
                                testimonial_list += '<div class="w3l_testimonial_grid_pos">';
                                testimonial_list += '<img src="' + USER_IMG_URL + '/' + filename + '" style="max-width: 100px;" alt="" class="img-responsive" />';
                                testimonial_list += '</div></div></div>';
                                break;
                            case 'banner':
                                banner_count++;
                                filename = home_data[i].filename;
                                url = home_data[i].url;
                                banner_list = '<a href="' + url + '" target="_blank">';
                                banner_list += '<img src="' + IMG_URL + '/' + filename + '" style="max-width: 100%;" alt="" class="img-responsive" />';
                                banner_list += '</a>';
                                banner_id = "#banner_0" + banner_count;
                                $(banner_id).html(banner_list);
                                break;

                        }
                    }
                    //APPEND DATA FOR HOME PAGE
                    $('#services_dropdown').html(service_list);
                    $('#flexiselDemo1').html(award_list);
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
                    $('#testimonial_section').html(testimonial_list);
                    //slider for testimonials     
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
                }
            },
            error: function (jqXHR, textStatus, error) {
                console.log(error);
                console.log(textStatus)
            },
            complete: function () {
            }
        });
    }
    
    else if(page_name=="about_site" || 
            page_name=="board_site" || 
            page_name=="management_site" || 
            page_name=="service_site" ||
            page_name=="newsitem_site" ||
            page_name=="article_site"){
        fetchPageDetails(page_name.replace("_site",""));
    }
    else if(page_name=="branch_site"){
        fetchPageDetailsNoImages("branche");
    }else if(page_name=="download_site"){
        fetchPageDetailsNoImages("downloadcat");
    }else if(page_name=="financial_site"){
        fetchPageDetailsNoImages("financial");
    }else if(page_name=="faq_site"){
        fetchPageDetailsNoImages("faqcat");
    }

    $(function () {
        $('.show_menu').click(function () {
            $('.menu').fadeIn();
            $('.show_menu').fadeOut();
            $('.hide_menu').fadeIn();
        });
        $('.hide_menu').click(function () {
            $('.menu').fadeOut();
            $('.show_menu').fadeIn();
            $('.hide_menu').fadeOut();
        });
    });

    //downloads files from all downloads page
    $('body').on('click', '.download_button', function () {
        var $location = $(this).attr('id');
        window.location = $location;
    });
    //views a file in browser
    $('body').on('click', '.view_button', function () {
        var $butt_link = $(this).attr('id');
        window.open($butt_link, "_blank");
    });

    var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
    };
    $().UItoTop({easingType: 'easeOutQuart'});
});


