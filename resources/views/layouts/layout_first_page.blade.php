<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="enamad" content="398505"/>
        <title>{{ $setting->title }}</title>
        <link rel="icon" type="image/png" href="/{{ $setting->icon_site }}">
        <!-- Bootstrap css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- fontawesome css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
            integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <!-- Swiper css-->
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <!-- Fancybox css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
        <!-- custom css-->
        <link rel="stylesheet" href="{{ asset('assets/website/css/css.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/website/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/website/css/responsive2.css') }}">
        <link rel="stylesheet" href="{{asset('admin/plugins/select2/select2.min.css')}}">
        {{-- animations --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        @include('includes.css')
        @livewireStyles
    </head>
    <body>
    @livewire('calling')
    @include('auth.login2')
    @include('user.ticket.web.create')
        <header>
            {{-- تقویم --}}
            <div class="d-none d-lg-block"> 
                <div style="position: absolute;top: 0px;left: 0px;">
                    <img src="{{ asset('/assets/images/calendar.png') }}" alt="calendar" width="136px">
                    <div class="small text-start ms-4" style="position: relative;top: -106px;">
                        <p class="text-center me-4 mb-2 text-light">calendar</p>
                        {{ my_jdate(\Carbon\Carbon::now(),'d F Y') }}
                        <p class="me-4">{{ \Carbon\Carbon::now()->format('Y M d') }}</p>
                    </div>
                </div>
            </div>
            <div class="container-lg costum-container-lg" >
                <div class="header_top_box d-none d-lg-block pt-3">
                    <div class="float-start">
                        <div class="d-flex">
                            <p class="small ps-lg-5">
                                {{$setting->slogan}}
                            </p>
                        </div>
                    </div>
                    <ul class="d-flex ul_menu_top">
                        <li>
                            @if (auth()->user())
                                <a href="/admin" class="text_cd1e40">
                                    {{auth()->user()->last_name}}
                                </a>
                            @else
                                <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="text_cd1e40">
                                    <i class="fas fa-power-off"></i>
                                    ورود/ثبت نام
                                </a>
                            @endif
                        </li>
                        @unless (\Request::route()->getName()=='user.home-goust')
                            <li>
                                <a href="{{ route('user.home-goust') }}">خانه</a>
                            </li>
                        @endunless
                        <li>
                            <a href="{{ route('user.post.index.type','اطلاعیه') }}">اطلاعیه ها و بلاگ ها</a>
                        </li>
                        <li>
                            <a href="{{ route('user.cooperation.index') }}">همکاری با ما</a>
                        </li>
                        <li>
                            <a href="{{ route('user.post.index.type','آموزش') }}" >راهنما استفاده از مشاوران</a>
                        </li>
                        <li>
                            <a href="{{ route('user.about.index') }}">درباره ما</a>
                        </li>
                        <li>
                            <a href="{{ route('user.home-guost-app-pwa') }}">اپلیکیشن{{auth()->user()?'':' نصب '}}</a>
                        </li>
                        <li>
                            <a href="{{auth()->user() ? route('user.notification.create') : '#'}}">
                                <i class="fa fa-envelope mx-1"></i>
                                {{auth()->user() ? App\Model\Notification::where('user_id',auth()->user()->id)->where('status',"pending")->count() : ''}}
                            </a>    
                        </li>
                        <li>
                            <a href="{{auth()->user() ? route('admin.factor-buy.index') : '#'}}">
                                <i class="fa fa-shopping-cart mx-1"></i>
                                {{auth()->user() ? App\Model\ServiceFactor::where('user_id',auth()->user()->id)->where('status',"pending")->count() : ''}}
                            </a>    
                        </li>
                    </ul>
                </div>
                <div class="header_top_2 row">
                    <div class="col-lg-8 position-992-absolute d-none d-lg-block ps-5 my-auto">
                        <div class="search-form">
                            <form action="{{ route('user.services-search') }}" method="get" class="d-flex">
                                <button type="submit"><i class="fas fa-search"></i></button>
                                <input id="search_text" type="text" name="search" onkeypress="ajax_search()" placeholder="جستجوی سریع...">
                                <input type="hidden" name="route" value="web">
                                <select id="search_type" name="type">
                                    <option value="user" selected>نام مشاور</option>
                                    <option value="consultation">گروه های مشاوران</option>
                                    <option value="category">دسته بندی ها</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 text-start">
                        <a href="/">
                            <img class="logo" src="/{{ $setting->logo_site }}" alt="{{ $setting->title }}">
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-none" id="searchListBox"></div>

            <nav class="navbar navbar-expand-lg navbar-dark bg-default-lg py-0">
                <div class="container-fluid over-hidden" style="max-width: 100%;">
                    <div class="navbar-brand d-inline-block d-lg-none" href="/">
                        <a href="" class="text_cd1e40">
                            <i class="fas fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="search_992">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button">
                        منو
                        <i class="fas fa-bars menu_svg"></i>
                    </button>
                    <div class="collapse navbar-collapse container-lg" id="main_nav">
                        <a href="javascript:void(0)" class="search_top"><i class="fas fa-search"></i> </a>
                        <ul class="navbar-nav mx-auto">
                            @foreach($ServiceCats as $cat)
                                <li class="nav-item">
                                    {{-- فروشگاه 96 --}}
                                    @if ($cat->id==96)
                                        <a class="nav-link menu_in_a f-18 fw-bold" href="{{ route('user.store.index') }}" target="_blank">
                                    {{-- ثبت نام کارگزاری 97 --}}
                                    @elseif ($cat->id==97)
                                        <a class="nav-link menu_in_a f-18 fw-bold" href="{{ env('SIGNUP') }}" target="_blank">
                                    @else
                                        <a class="nav-link menu_in_a f-18" data-key="{{$cat->id}}" href="#" data-bs-toggle="dropdown">
                                    @endif
                                        {{$cat->title}}
                                        @if(count($cat->child_cat))
                                            <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_1" data-key="{{$cat->id}}"></i>
                                        @endif
                                    </a>
                                    @if($cat->id != 96)
                                        @if(count($cat->child_cat))
                                            <div class="dropdown-menu dropdown-menu-big dropdown-menu-{{$cat->id}}">
                                                <div class="container-lg">
                                                    {{-- @if ($cat->slug=='اوراق-بهادار') --}}
                                                        <div class="d-none d-lg-block">
                                                            <div class="p-lg-4 py-1 overflow-auto" style="max-height: 746px;">
                                                                <div class="row">
                                                                    @foreach($cat->child_cat->chunk( $cat->slug=='اوراق-بهادار'?intval($cat->child_cat->count() / 5):1  ) as $lists)
                                                                        <div class="col-2 p-0">
                                                                            @foreach($lists as $child)
                                                                                <a class="text-light" href="{{ route('user.consultation.show',$child->id) }}">
                                                                                    <div class="card_menu card_menu_2 mx-1 mb-2 p-2">
                                                                                        <div class="text-start">
                                                                                            <img src="{{ asset('assets/images/msg-icon.png') }}" style="width: 32px;opacity: 0.6;" alt="SPADSTOCK">
                                                                                        </div>
                                                                                        @if (in_array( $child->title, ['تابلو خوانی','فیلترنویسی','استراتژی معاملاتی','مشاورین برتر']))
                                                                                            <div class="mt-4 pt-1 small text-danger">{{$child->title}}</div>
                                                                                        @else
                                                                                            <div class="mt-4 pt-1 small">{{$child->title}}</div>
                                                                                        @endif
                                                                                        <p class="px-1 m-0 text-start text-start fixed-bottom">{{$child->text}}</p>
                                                                                    </div>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-lg-none">
                                                            <div class="py-1 wm-30">
                                                                <ul class="category">
                                                                    @foreach($cat->child_cat as $child)
                                                                    <li class="mb-3 text-lg-end me-lg-4">
                                                                        <a href="{{ route('user.consultation.show',$child->id) }}">
                                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                                            {{$child->title}}
                                                                        </a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    {{-- @else
                                                        <div class="row">
                                                            <div class="col-lg-4 py-lg-5 py-1 wm-30">
                                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                                <ul class="category">
                                                                    @foreach($cat->child_cat as $child)
                                                                    <li class="mb-3 text-lg-end me-lg-4">
                                                                        <a href="{{ route('user.consultation.show',$child->id) }}">
                                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                                            {{$child->title}}
                                                                        </a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none wm-70">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        @foreach($cat->child_cat as $key_child=>$child)
                                                                        <div class="col-3 mb-1 p-0 pe-1">
                                                                            <a href="{{ route('user.consultation.show',$child->id) }}">
                                                                                <div class="card_menu {{$key_child==0?'fff':''}}">
                                                                                    <h5> {{$child->title}}</h5>
                                                                                    <p> {{$child->text}}</p>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{url('/')}}" class="logo_menu_d">
                            <img src="{{ url($setting->icon_site) }}" alt="{{ $setting->title }}">
                        </a>
                        <div class="footer_mobile_nav d-lg-none p-3">
                            <a href="{{ route('user.post.index.type','اطلاعیه') }}">
                                اطلاعیه ها
                                <i class="fas fa-angle-left"></i>
                            </a>
                            
                            <a href="{{ route('user.cooperation.index') }}">
                                همکاری با ما
                                <i class="fas fa-angle-left"></i>
                            </a>

                            <a href="{{ route('user.home-guost-app-pwa') }}">
                                اپلیکیشن{{auth()->user()?'':' نصب '}}
                                <i class="fas fa-angle-left"></i>
                            </a>
                            
                            <br>

                            <a href="#">
                                راهنما استفاده از مشاوران
                                <i class="fas fa-angle-left"></i>
                            </a>
                            
                            <a href="{{ route('user.about.index') }}">
                                درباره ما
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </div>
                    </div> <!-- navbar-collapse.// -->
                </div> <!-- container-fluid.// -->
            </nav>
        </header>

        @yield('content')
        {{-- ولنجک - دانشگاه شهید بهشتی- پارک علم و فناوری
        02166435669
        این دومی درست --}}
        <footer>
            <div class="container pb-lg-2 py-4">
                <h4 class="d-none d-lg-block text-light border-bottom mb-3 pb-4">دسترسی سریع</h4>
                <div class="row pb-lg-2 direction_ltr">
                    <div class="col-lg pt-lg-4">
                        <div class="float-lg-left my-lg-2 mx-lg-0 text-center text-lg-start">
                            <div class="row">
                                <div class="col-lg-auto text-center">
                                    @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',7)->where('sort',1)->get() as $item)
                                        <a href="{{url($item->link)}}">
                                            <img class="logo_site mx-lg-2 pb-2 p-lg-0" src="{{ url($item->pic) }}" alt="{{$item->title}}">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="col-lg">
                                    <div id="spad_e_namad" class="ms-lg-5 ps-lg-5 ms-5 ps-5 d-none d-lg-block">
                                        <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=304209&amp;Code=AN91PCxVNLNXwP9vTIPl"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=304209&amp;Code=AN91PCxVNLNXwP9vTIPl" alt="" style="cursor:pointer" id="AN91PCxVNLNXwP9vTIPl"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="network px-lg-3 py-3 pt-lg-4">
                                <div class="social-icon text-center text-lg-start my-lg-2 py-lg-1">
                                    @foreach ($network as $net)
                                        @if ($net->config=="email")
                                            <a href="#" onclick='sedarMail("{{$net->address}}")' class="mx-3">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        @else
                                            <a href="{{$net->address}}" class="mx-3">
                                                <i class="fab fa-{{$net->config}}"></i>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-none d-lg-block text-start">
                                @if (auth()->user())
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#sendWebTicket">
                                        @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',7)->where('sort',3)->get() as $item)
                                            <img class="logo_site py-1 py-lg-0 mx-lg-2 scale-up-center" src="{{ $item->pic?url($item->pic):'' }}" alt="{{$item->title}}">
                                        @endforeach
                                    </a>
                                @else
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="text_cd1e40">
                                        @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',7)->where('sort',3)->get() as $item)
                                            <img class="logo_site py-1 py-lg-0 mx-lg-2 scale-up-center" src="{{ $item->pic?url($item->pic):'' }}" alt="{{$item->title}}">
                                        @endforeach
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg links-footer">
                                <div class="d-none d-lg-block text-start">
                                    @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',3)->get() as $item)
                                        <div class="my-2 my-lg-3 text-center text-lg-end"><a class="link-footer" href="{{url($item->link)}}">{{$item->title}}</a></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6 col-lg links-footer">
                                @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',2)->get() as $item)
                                    <div class="my-2 my-lg-3 text-center text-lg-end"><a class="link-footer" href="{{url($item->link)}}">{{$item->title}}</a></div>
                                @endforeach
                            </div>

                            <div class="col-6 col-lg links-footer">
                                @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',1)->get() as $item)
                                    <div class="my-2 my-lg-3 text-center text-lg-end"><a class="link-footer" href="{{url($item->link)}}">{{$item->title}}</a></div>
                                @endforeach
                                <div class="d-lg-none">
                                    @foreach (\App\Model\Data::where('page_name','فوتر')->where('section',3)->get() as $item)
                                        <div class="my-2 my-lg-3 text-center text-lg-end"><a class="link-footer" href="{{url($item->link)}}">{{$item->title}}</a></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="char">
                    <ul>
                        <li>الف</li> 
                        <li>ب</li>
                        <li>پ</li> 
                        <li>ت</li> 
                        <li>ث</li> 
                        <li>ج</li> 
                        <li>چ</li>
                        <li>ح</li> 
                        <li>خ</li> 
                        <li>د</li> 
                        <li>ذ</li> 
                        <li>ر</li> 
                        <li>ز</li>
                        <li>ژ</li> 
                        <li>س‌</li>
                        <li>ش</li> 
                        <li>ص</li> 
                        <li>ض</li> 
                        <li>ط</li> 
                        <li>ظ</li> 
                        <li>ع</li> 
                        <li>غ</li> 
                        <li>ف</li> 
                        <li>ق</li> 
                        <li>ک</li> 
                        <li>گ</li> 
                        <li>ل</li> 
                        <li>م</li> 
                        <li>ن</li> 
                        <li>و</li> 
                        <li>ه</li> 
                        <li>ی</li>
                    </ul>
                </div>
            </div>
            <div class="container text-center pb-2">
                <span class="text-secondary">All rights reserved by AdibGroup 2022</span>
            </div>
        </footer>
        
        <!-- Jquery js-->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>
        <!-- Bootstrap js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
                integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
        <!-- fontawesome js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"
                integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Swiper JS -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    @if(\Request::route()->getName()=='user.home-goust')
                        768: {
                            slidesPerView: 4,
                            spaceBetween: 10,
                        },
                        920: {
                            slidesPerView: 6,
                            spaceBetween: 10,
                        },
                    @elseif(\Request::route()->getName()=='user.consultation.show')
                        @if( \Request::route('consultation')=='76' )
                        768: {
                            slidesPerView: 1,
                            spaceBetween: 10,
                        },
                        920: {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                        @else
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 10,
                            },
                            920: {
                                slidesPerView: 3,
                                spaceBetween: 10,
                            },
                        @endif
                    @else
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 10,
                        },
                        920: {
                            slidesPerView: 5,
                            spaceBetween: 10,
                        },
                    @endif
                },
                autoplay: {
                    delay: 5000,
                },
                navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
                },
            });
        </script>
        <!-- Fancybox js-->
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <!-- sweetalert2 js-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- custom js-->
        <script src="{{ asset('assets/website/js/js.js') }}"></script>
        {{-- animations --}}
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(document).keydown(function(e) {
            if (window.event.keyCode == 13) {
                return false;
            }
        });
    </script>
    <script>
        function ajax_search() {
            let text = document.getElementById('search_text').value;
            let type = document.getElementById('search_type').value;

            if (text.length > 2) {
                $.ajax({
                    url: `/ajax/search/services/${type}/${text}`,
                    type: 'get',
                    success: function(response){
                        // console.log(response);
                        if (response.error) {
                            console.log(response.error)
                            return false;
                        }
                        if (response.length) {
                            document.getElementById("searchListBox").classList.remove("d-none");
                            document.getElementById("searchListBox").innerHTML = `<button class="btn btn-danger p-0 px-1 py-lg-1 px-lg-2 float-start m-2" onclick="document.getElementById('searchListBox').classList.add('d-none');">بستن</button>`;
    
                            for (let index = 0; index < response.length; index++) {
                                if (type=='category') {
                                    document.getElementById("searchListBox").innerHTML += `<div class='col-12 m-3'><a href='/consultation/${response[index].id}'>${response[index].title}</a></div>`;
                                } else {
                                    let route = 'profile';
                                    switch (response[index].category_id) {
                                        case 66:
                                            route = 'profile/startup';
                                            break;
                                        case 81:
                                            route = 'profile/startup';                                    
                                            break;
                                        case 345:
                                            route = 'profile/startup';
                                            break;
                                    }
                                    document.getElementById("searchListBox").innerHTML += `<div class='col-12 m-3'><a href='/consultation/${route}/${response[index].id}'>${response[index].user_id} - ${response[index].title}</a></div>`;
                                }
                            }
                        }
                    }
                });
            } else {
                document.getElementById("searchListBox").classList.add("d-none");
            }
        }
    </script>
    <script>
        $(function () {
            $('.select2').select2()
        });
    </script>
    <script>
        function sedarMail(mail) {
            location.href = "mailto:"+mail;
        }
    </script>
    <script>
        @if(session()->has('err_message'))
        $(document).ready(function () {
            Swal.fire({
                title: "ناموفق",
                text: "{{ session('err_message') }}",
                icon: "warning",
                timer: 6000,
                timerProgressBar: true,
            })
        });
        @endif
        @if(session()->has('err_message'))
        $(document).ready(function () {
            Swal.fire({
                title: "ناموفق",
                text: "{{ session('err_message') }}",
                icon: "warning",
                timer: 6000,
                timerProgressBar: true,
            })
        });
        @endif
        @if(session()->has('flash_message'))
        $(document).ready(function () {
            Swal.fire({
                title: "موفق",
                text: "{{ session('flash_message') }}",
                icon: "success",
                timer: 6000,
                timerProgressBar: true,
            })
        })
        ;@endif
        @if(session()->has('call_message'))
        $(document).ready(function () {
            Swal.fire({
                title: "",
                text: "{{ session('call_message') }}",
                icon: "warning",
                timer: 6000,
                timerProgressBar: true,
            })
        });
        @endif
        @if (! is_null($errors))
            @if (count($errors) > 0)
                $(document).ready(function () {
                    Swal.fire({
                        title: "ناموفق",
                        icon: "warning",
                        html:
                                @foreach ($errors->all() as $key => $error)
                                        '<p class="text-right mt-2 ml-5" dir="rtl"> {{$key+1}} : '  +
                                '{{ $error }}'+
                                '</p>'+
                                @endforeach
                                        '<p class="text-right mt-2 ml-5" dir="rtl">' +
                                '</p>',
                        timer:  @if(count($errors)>3)parseInt('{{count($errors)}}') * 1500 @else 6000 @endif,
                        timerProgressBar: true,
                    })
                });
            @endif
        @endif
    </script>
        @livewireScripts
    </body>
</html>
