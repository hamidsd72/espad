<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="msvalidate.01" content="9EC40B156D7A98D82B168DF74575DD11" />
        <meta name="id" content="1468851838648">
		<meta name="summary" content="">

		<title>{{$setting->title}}</title>
		<meta name="keywords" content="{{$keywordsSeo}}">
		<meta name="description" content="{{$descriptionSeo}}"/>
		<meta property="og:title" content="{{$titleSeo}}"/>
		<meta property="og:description" content="{{$descriptionSeo}}"/>
		<meta name="url" content="{{ url('/') }}"/>
		<meta property="og:image" content="{{url($setting->logo_site)}}">
		<link rel="icon" type="image/png" href="{{url($setting->icon_site)}}">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap.css') }}"> --}}
        <link href="https://www.bourse.lu/css/fontawesome-all.min.css" rel="stylesheet" />
        <link rel="preload" href="/fonts/fa-light-300.woff2" as="font" type="font/woff2" crossorigin="anonymous">
        <link href="https://www.bourse.lu/css/site-all.min.css?v=26032018" rel="stylesheet" />
        <link href="https://www.bourse.lu/css/luxse-components-bundle-css.min.css?v=3110018" rel="stylesheet" />
        <link rel="canonical" href="https://www.bourse.lu/home" />
        <script src="https://www.bourse.lu/js/intersection-observer.min.js"></script>
        <script src="https://www.bourse.lu/js/lazyload.min.js"></script>
        <script>
            var lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazy"
            });
        </script>
        <!-- Facebook Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return; n = f.fbq = function () {
                    n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
                n.queue = []; t = b.createElement(e); t.async = !0;
                t.src = v; s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1376830605807839');
            fbq('track', 'PageView');
        </script>
        <!-- End Facebook Pixel Code -->

        <!-- LinkedIn Code Tag -->
        <script> _linkedin_partner_id = "1476986"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script>
        <script> (function () { var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript"; b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s); })(); </script>
        <!-- End LinkedIn Code Tag -->

        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push(

                { 'gtm.start': new Date().getTime(), event: 'gtm.js' }
            ); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-N9B67M2');</script>
        <!-- End Google Tag Manager -->
		<style>
			#serialcookielaw {
				display: none !important;
			}
		</style>
    </head>
    
    <body style="overflow-x: hidden;">

        @yield('content')

        <div id="page-footer">
            <div class="grid-flex banafsh">
                <div class="sub-column-100">
                    <div class="grid-lol-grid-3-container" style="padding-top: 16px;">
                        <div class="row-lol-grid-3">
                            <div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
                                <div class="sub-column-33 text-sm-center">
                                    <h6 class="page-footer-title">
                                        <img src="{{$setting->icon_site}}" alt="{{$setting->title}}" style="width: 78px;margin-bottom: -38px;">
                                        {{$setting->title}}
                                    </h6>
                                    <ul class="page-footer-logos">
                                        @foreach ($network as $net)
                                            @switch($net->config)
                                                @case("instagram")
                                                    <li class="page-footer-logo">
                                                        <a href="{{$net->address}}" class="lazy">
                                                            <i class="fab fa-instagram" style="font-size: 32px;"></i>
                                                        </a>
                                                    </li>
                                                    @break
                                                @case("whatsapp")
                                                    <li class="page-footer-logo">
                                                        <a href="{{$net->address}}" class="lazy">
                                                            <i class="fab fa-whatsapp" style="font-size: 32px;"></i>
                                                        </a>
                                                    </li>
                                                    @break
                                                @case("email")
                                                    <li class="page-footer-logo">
                                                        <a href="#" onclick='sedarMail("{{$net->address}}")' class="lazy">
                                                            <i class="fa fa-envelope" style="font-size: 32px;"></i>
                                                        </a>
                                                    </li>
                                                    @break
                                            @endswitch
                                        @endforeach
                                        {{-- <li class="page-footer-logo">
                                            <a href="/about-us"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                 data-src="https://www.bourse.lu/img/footer-logo-bourse.png" alt="footer-logo-bourse.png" class="lazy">
                                                </a></li>
                                        <li class="page-footer-logo"><a href="https://www.fundsquare.net" target="_blank"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/footer-logo-fundsquare.png" alt="footer-logo-fundsquare.png" class="lazy"></a></li>
                                        <li class="page-footer-logo"><a href="/about-us"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/footer-logo-bourse.png" alt="footer-logo-bourse.png" class="lazy"></a></li>
                                        <li class="page-footer-logo"><a href="https://www.fundsquare.net" target="_blank"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/footer-logo-fundsquare.png" alt="footer-logo-fundsquare.png" class="lazy"></a></li> --}}
                                    </ul>
                                    <img src="{{$setting->logo_site}}" alt="{{$setting->title}}" style="width: 140px;">
                                </div>
                            </div>
        
                            <div class="col-lol-grid-3-lg-4 col-lol-grid-3-md-12 col-lol-grid-3-sm-12 col-lol-grid-3-xs-12">
                                <div class="row-lol-grid-3 mix-for-sm">
                                    <div class="col-lol-grid-3-lg-4 dir-lg-r text-sm-center">
                                        <h6 class="page-footer-title">عنوان این بخش</h6>
                                        <p><a class="page-footer-btn" href="/contact">لینک ها</a></p>
                                        <p><a class="page-footer-btn" href="/press-centre">لینک ها</a></p>
                                        <p><a class="page-footer-btn" href="/faq-luxse">لینک ها</a></p>
                                    </div>
                
                                    <div class="col-lol-grid-3-lg-4 dir-lg-r text-sm-center">
                                        <h6 class="page-footer-title">عنوان این بخش</h6>
                                        <p><a class="page-footer-btn" href="/contact">لینک ها</a></p>
                                        <p><a class="page-footer-btn" href="/press-centre">لینک ها</a></p>
                                        <p><a class="page-footer-btn" href="/faq-luxse">لینک ها</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="page-footer-row-3">
                <div class="section-content-text" style="min-height: 30px;">
                    <div class="page-wrapper">
                        <div id="page-footer-row-3-inner">
                            <div id="page-footer-row-3-col-1"><p>&copy; 2022&nbsp; All rights reserved by AdibGroup </p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div id="page-footer">
            <div id="page-footer-row-2">
                <div class="section-content-text" style="min-height: 30px;">
                    <div class="page-wrapper">
                        <div class="grid-adaptive">
                            <div class="sub-column-33">
                                <h6 class="page-footer-title">LuxSE Group</h6>
                                <p><b>The LuxSE Group is composed</b>&nbsp;of the Luxembourg Stock Exchange (LuxSE) the leading listing venue for international securities and Fundsquare, its wholly-owned subsidiary specialized in delivering to the fund industry an efficient and standardized infrastructure for the exchange of information.</p>
                                <ul class="page-footer-logos">
                                    <li class="page-footer-logo"><a href="/about-us"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/footer-logo-bourse.png" alt="footer-logo-bourse.png" class="lazy"></a></li>
                                    <li class="page-footer-logo"><a href="https://www.fundsquare.net" target="_blank"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="https://www.bourse.lu/img/footer-logo-fundsquare.png" alt="footer-logo-fundsquare.png" class="lazy"></a></li>
                                </ul>
                            </div>
    
                            <div class="sub-column-33">
                                <h6 class="page-footer-title">Stay connected</h6>
                                <p class="page-footer-socialmedia"><a href="https://www.linkedin.com/company/69379?trk=vsrp_companies_res_name&amp;trkInfo=VSRPsearchId%3A1095053301450691266301%2CVSRPtargetId%3A69379%2CVSRPcmpt%3Aprimary" target="_blank"><i class="fab fa-linkedin">&nbsp;</i></a><a href="https://twitter.com/LuxembourgSE" target="_blank"><i aria-hidden="true" class="fab fa-twitter-square">&nbsp;</i></a></p>
                                <p><a class="page-footer-btn" href="/contact">Contact us</a></p>
                                <p><a class="page-footer-btn" href="/press-centre">Press centre</a></p>
                                <p><a class="page-footer-btn" href="/faq-luxse">FAQ - LuxSE</a></p>
                            </div>
    
                            <div class="sub-column-33">
                                <h6 class="page-footer-title">Subscribe to our newsletter</h6>
                                <p>Sign up to our newsletter and receive regular updates and news directly from the stock exchange.</p>
                                <div class="pipedrive-button-box" style="position: relative; display: block;  width: auto; height: 61px; background-color: #ca1234; overflow: hidden !important;"><a href="http://eepurl.com/gMSx8j" style="color:#fff;" target="_blank">Subscribe </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="page-footer-row-3">
                <div class="section-content-text" style="min-height: 30px;">
                    <div class="page-wrapper">
                        <div id="page-footer-row-3-inner">
                            <div id="page-footer-row-3-col-1"><p>&copy; 2022&nbsp; All rights reserved by AdibGroup </p></div>
    
                            <div id="page-footer-row-3-col-2">
                                <ul class="page-footer-nav">
                                    <li><a class="sub-link-1" href="/careers">Careers</a>&nbsp;</li>
                                    <li><a href="/sitemap">Sitemap</a></li>
                                    <li><a href="http://www.bourse.lu/gdpr">GDPR</a></li>
                                    <li><div class="JSComponent" data-associatedclass="Overlay" data-template="/overlay/footer-terms-of-use"><a href="/footer-terms-of-use">Terms of use</a></div></li>
                                    <li><a class="sub-link-1" href="/documents/legislation-MEMBERS-procedure_reclamation_FR.pdf">Complaints(FR)</a></li>
                                    <li><a href="/documents/legislation-MEMBERS-conflict-of-interest.pdf">Conflict of Interest</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        <script src="https://www.bourse.lu/js/d3.v4.js"></script>
        <script src="https://www.bourse.lu/js/moment.js"></script>
        <script src="https://www.bourse.lu/js/moment-timezone.min.js"></script>
        <script src="https://www.bourse.lu/js/moment-timezone-with-data.min.js"></script>
        <script src="https://www.bourse.lu/js/handlebars.min-latest.js"></script>
        <script src="https://www.bourse.lu/js/jquery-3.1.0.min.js"></script>
        <script src="https://www.bourse.lu/js/jquery-ui.min.js"></script>
        <script src="https://www.bourse.lu/js/typeahead.jquery.min.js"></script>
        <script src="https://www.bourse.lu/js/jquery.serialoverlay.js"></script>
        <script src="https://www.bourse.lu/js/jquery.serialstep.js"></script>
        <script src="https://www.bourse.lu/js/dropzone.js"></script>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="https://www.bourse.lu/js/site-all.js"></script>
        <script src="https://www.bourse.lu/js/JSComponent.js?v=11122019"></script>
        <script src="https://www.bourse.lu/js/iscroll-probe.js"></script>

        <script>
            window.JsComponentConfig = {"urls":{"api":"https://www.bourse.lu/api","dl":"https://dl.bourse.lu/dl","img":"/img","assets":{"icons":"/img","img":"/img"},"js":"/js","template":"/js","translations":"/js","http":"https://www.bourse.lu"},"chart":{"backgroundImage":"https://www.bourse.lu/img/page-header-logo.svg"}};
            window.JsComponentConfig.pages = {
                search: window.JsComponentConfig.urls.http + '/search',
                security: window.JsComponentConfig.urls.http + '/security/',
            };
            $(function(){
                var components = {length: $(".JSComponent").length, loading: [], ready:{all:false}};
                // Le composant est charge :
                window.JSComponentDefault.bind('_componentloaded', function(params, eventIndex){
                    var index = components.loading.indexOf(params.name);
                    if(index>=0) {
                        components.loading.splice(index, 1);
                        components.ready[params.name] = true;
                    }
                    if(components.loading.length<=0 && components.ready.all==false){
                        components.ready.all=true;
                        window.JSComponentDefault.trigger('_ready', ['global'], {components: components});
                    }
                });
                // Chargement des composants :
                $(".JSComponent").each(function(){
                    components.loading.push($(this).data().associatedclass);
                    $(this).JSComponent();
                });
            });

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('set', 'anonymizeIp', true);
            ga('create', 'UA-623595-1', 'auto');
            ga('send', 'pageview');
            
            $("#subscribenewsletter").on("click", function() {
                var mailcontent = "?subject=LuxSE newsletter subscription&body=" + encodeURIComponent("Please subscribe my email ("+ $("#emailnewsletter").val() + ") to the Luxembourg Stock Exchange newsletter");
                $("#subscribenewsletter").attr("href","mailto:news@bourse.lu" + mailcontent);
            });
        </script>

        <script src="https://www.bourse.lu/js/luxse-1.0.1.min.js?v=3110018"></script>
        <script src="https://www.bourse.lu/js/luxse-components-bundle.min.js?v=3110018"></script>
        <script src="//platform.linkedin.com/in.js"></script>

        <script>
            (function() {
                LuxSE.render({
                    verbose: false,
                    lang: 'EN',
                    urls: {
                        api: 'https://www.bourse.lu/api',
                        templates: 'https://www.bourse.lu/js',
                        translations: 'https://www.bourse.lu/js',
                        vendors: 'https://www.bourse.lu/js'
                    },
                    translations: {
                        filename: 'global.json'
                    },
                    vendors: ['jquery.flexslider.js', 'jquery.serialslider.js','jquery.serialscrolling.js'],
                    loader: { uri: 'https://www.bourse.lu/img/bdl_site_loader.gif', className: 'loader'  }
                });
            })();

            $(document).ready(function(){
                !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
            });

            $(document).ready(function(){
                $(".social-links").on('click',function(event){
                    var width=0;
                    var elt = $(event.target).parents('.lp-menu-list-item').find('.twitter-share-button-rendered');
                    if(elt.width() == 1) {
                        var linkedinLinks = elt.parent().find('.IN-widget').after();
                        var url = elt.attr("data-url");
                        var message = elt.parent().attr("data-text");
                        elt.remove();
                        linkedinLinks.append('&nbsp;<a href="https://twitter.com/share" class="twitter-share-button" data-url="' + url + '" data-text="' + message + '" data-hashtags="LuxSE">Tweet</a>');
                        twttr.widgets.load();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                let isAlerted = localStorage.getItem('alerted_check');
                if(!isAlerted) {
                    $("div.headerstrip-wrapper").fadeIn("7000")
                } else {
                    $("div.headerstrip-wrapper").hide()
                }
            }); 

            var closeButtons = $('.js-banner__dismiss');
            closeButtons.on('click', function() {
                $(this).parent().hide();
                localStorage.setItem('alerted_check', 'yes');
            });
        </script>
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:1158072,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
        <script>
            if (lazyLoadInstance) {
                lazyLoadInstance.update();
            }
        </script>
        <script>
            function sedarMail(mail) {
                location.href = "mailto:"+mail;
            }
        </script>
    </body> 

</html>


