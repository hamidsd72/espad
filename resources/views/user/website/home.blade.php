@extends('layouts.layout_first_page')
@section('content')
<style>
    .tgju-widget {
        background: #ffffff2b !important;
    }
    .tgju-copyright , .tgju-copyright-fix {
        display: none !important;
    }
    .tgju-widget {
        border: none !important;
    }
    .marquee-tgju {
        padding: 12px;
    }
    .scale-up-center h4 {
        text-align: center;
    }
    .video_items img {
        width: 100%;
        height: 220px;
    }
    .video_items img:hover {
        opacity: 0.6;
    }
    video.home {
        opacity: unset !important;
    }
    .video_items a:hover h6 {
        color: wheat !important;
    }
    .swiper-slide {
        text-align: center;
    }
    .swiper-slide img {
        padding: 8%;
        width: 200px;
        height: 200px;
    }
    .swiper-slide:hover img {
        padding: 6%;
        transition: 0.4s;
        opacity: 0.6;
    }
    section.service_cats_items {
        background: transparent;
    }
    @media only screen and (min-width: 920px) {
        .height-lg-840 {
            height: 840px;
        }
        .swiper {
            top: -22px;
        }
        .video_items img.big {
            height: 330px;
        }
    }
</style>

<main id="home">
    <!-- اسلایدر بالای صفحه-->
    {{-- <section class="slider_top">
        <div class="swiper mySwiper slider_single">
            <div class="swiper-wrapper">
                @foreach ($sliders as $item)
                    <div class="swiper-slide">
                        <div class="slider_top_card">
                            <img src="{{$item->photo->path}}" alt="{{$item->title}}">
                            <div class="text_slider">
                                <div class="text_in">
                                    <h5>{{$item->title}}</h5>
                                    <p>{{$item->description}}</p>
                                    <a href="{{$item->link}}">
                                        <div class="scale-up-center">
                                            {{$item->link_title}}
                                            <i class="fas fa-angle-left"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}

    {{-- ویدیو بالای صفحه --}}
    @foreach ($data->where('section',1) as $item)
        {{-- <a href="{{ url($item->link) }}"> --}}
            @if ($item->video)
                <video autoplay muted loop class="home">
                    <source src="{{url($item->video)}}" type="video/mp4">
                </video>
            @endif
        {{-- </a> --}}
    @endforeach

    {{-- بنر بالای صفحه --}}
    {{-- <div id="top_banner">
        @foreach ($data->where('section',1) as $item)
            <img src="{{ url($item->pic) }}" alt="banner">
            <a href="{{ url($item->link) }}">
                <div>
                    <h3 class="text-center text-white m-0">{{$item->title}}</h3>
                </div>
            </a>
        @endforeach
    </div> --}}

    <section class="service_cats_items pt-0">
        {{-- لینک ارتباط با مشاوران --}}
        {{-- @foreach ($data->where('section',1) as $item)
            <a href="{{ url($item->link) }}">
                <div class="pt-lg-5 mx-3 text-center">
                    <div class="border border-light text-center text-white p-2 p-lg-3 fs-3" style="max-width: 480px;margin: auto;">
                        {{$item->title}}
                    </div>
                </div>
            </a>
        @endforeach --}}

        {{-- ویجت بورس --}}
        <div class="bourse-api pt-lg-4">
            <div class="py-2">
                @foreach ($data->where('section',2) as $item)
                    {!! $item->text !!}
                @endforeach
            </div>
        </div>

        {{-- شش آیتم --}}
        <div class="container">
            {{-- شش آیتم قدیم --}}
            {{-- <div class="row">
                <div class="d-none">{{$index=0}}</div>
                @foreach($serviceCats->whereIn('view',['body','both']) as $item)
                    <div class="d-none">{{$index+=1}}</div>
                    <div class="col-lg-4 @if($index > 3) mt-lg-4 @endif" data-aos="flip-up">
                        <div class="row direction_ltr items mx-lg-1">
                            <div class="col-12 px-lg-4 bg-violet">
                                <div class="d-none d-lg-block">
                                    <a href="{{ route('user.consultation.show',$item->id) }}" >
                                        <div class="items_header text-light">
                                            {{$item->title}}
                                        </div>
                                        <div class="items_description text-light">
                                            {{$item->text}}
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4 col-lg-12 my-auto p-lg-1">
                                <a href="{{ route('user.consultation.show',$item->id) }}" >
                                    <img src="{{url($item->pic)}}" alt="{{$item->title}}">
                                </a>
                            </div>
                            <div class="col-8 col-lg-12 p-lg-2 pb-lg-4 px-lg-3">
                                <div class="d-lg-none">
                                    <a href="#" target="_blank">
                                        <div class="items_header pt-lg-2">
                                            {{$item->title}}
                                        </div>
                                    </a>
                                    <div class="items_description mb-3 mb-lg-4">
                                        {{$item->text}}
                                    </div>
                                </div>
                                <a href="{{ route('user.consultation.show',$item->id) }}" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    گفتگو با مشاور
                                </a>
                            </div>
                        </div>
                        <hr class="d-lg-none mx-3 my-5">
                    </div>
                @endforeach
            </div> --}}
            {{-- شش آیتم جدید --}}
            <div class="d-flex align-items-start flex-column bd-highlight height-lg-840" >
                @foreach($serviceCats->whereIn('view',['body','both']) as $key => $item)
                    @if ($key==0)
                        <a href="#" class="text-lg-light border-bottom fs-4 py-2">
                            {{$data->where('section',1)->first()->title}}
                        </a>
                    @endif
                    <div class="bd-highlight col-12 col-md-6 col-lg-3 mt-1">
                        {{-- <div class="items p-2 p-lg-3 my-2 my-lg-0" style="background: #1d2d442b !important"> --}}
                        <div class="items">
                            <a href="{{ route('user.consultation.show',$item->id) }}" >
                                <div class="items_header fs-4">
                                    <span class="fs-5 me-2" style="color: #ffa06a">&gt;&gt;</span>
                                    {{$item->title}}
                                </div>
                                <div class="items_description p-1">
                                    {{$item->text}}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="pt-3 blue_link">
                <a href='{{ route('user.consultation.index') }}' class="text-light d-none d-lg-block">
                    نمایش همه موارد
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <a href='{{ route('user.consultation.index') }}' class="blue_link d-lg-none">
                    نمایش همه موارد
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </div> --}}
        </div>
    </section>
    

    {{-- دو ایتم سخن بزرگان --}}
    <section class="nothing_items py-3">
        <div class="container">
            @foreach ($data->where('section',4) as $item)
                <div class="section-content-text" style="min-height: 30px;"><h2 class="title-3"><span class="ms-2 fs-2" style="color: #ffa06a">&gt;&gt;</span>{{$item->title}}</h2></div>
            @endforeach
            <div class="row">
                @foreach ($data->where('section',5) as $item)
                    <div class="col-lg-6 items" @if($item->sort==1) data-aos="fade-left" @else data-aos="fade-right" @endif>
                        <div class="row px-lg-5">
                            <div class="col-4">
                                <span class="counter">0{{$item->sort}}</span>
                                <img src="{{url($item->pic)}}" alt="banner">
                            </div>
                            <div class="col-8 my-auto">
                                <p class="text-secondary mb-2 pt-4 pt-lg-0">{{$item->title}}</p>
                                <h5>{{$item->text}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-4 blue_link">
                <a href="#">
                    نمایش همه موارد
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ویدیوهای پایین صفحه --}}
    <section class="video_items py-3 text-light">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="row pt-4 pt-lg-0">
                        @foreach ($data->where('section',6)->where('sort','!=',1) as $item)
                            <div class="col-6">
                                <div data-aos="zoom-in">
                                    <a href="{{ route('user.show-video.show',$item->id) }}">
                                        <img src="{{ $item->pic?url($item->pic):asset('/assets/images/cover-small.png') }}" class="small" alt="banner">
                                    </a>
                                </div>
                                <a href="{{ route('user.show-video.show',$item->id) }}">
                                    <h6 class="footer_video text-light pt-2">{{$item->title}}</h6>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6">
                    @foreach ($data->where('section',6)->where('sort',1) as $item)
                        <div data-aos="zoom-in">
                            <a href="{{ route('user.show-video.show',$item->id) }}">
                                <img src="{{ $item->pic?url($item->pic):asset('/assets/images/cover-big.png') }}" class="big" alt="banner">
                            </a>
                        </div>
                        <a href="{{ route('user.show-video.show',$item->id) }}">
                            <h6 class="footer_video text-light pt-2">{{$item->title}}</h6>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <section class="title_site p-lg-0 pt-lg-3">
        {{-- نصب اپلیکیشن --}}
        {{-- @foreach ($data->where('section',7) as $item)
            <marquee width="100%" direction="left" behavior="scroll" scrollamount="9">
                <div class="text-secondary">
                    <a href="{{ $item->link?url($item->link):'' }}" >
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-auto pt-lg-2 d-none d-lg-block">
                                <div class="line"></div>
                            </div>
                            <div class="col-auto">
                                {!! $item->text !!}
                            </div>
                            <div class="col-auto pt-lg-2 d-none d-lg-block">
                                <div class="line"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </marquee>
        @endforeach --}}
        {{-- همکاران و مشتریان ما --}}
        <div class="container">
            <h5 class="d-none d-lg-block title-3"><span class="ms-2 fs-3" style="color: #ffa06a">&gt;&gt;</span>همکاران و مشتریان ما</h5>
            <p class="m-0 d-lg-none "><span class="ms-2 fs-6" style="color: #ffa06a">&gt;&gt;</span>همکاران و مشتریان ما</p>
            <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-ios swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-c164578535e54f7f" aria-live="polite">
                    @foreach (\App\Model\Custom::where('status','active')->get() as $custom)
                        @if ($custom->photo&&$custom->photo->path)
                            <div class="swiper-slide my-auto" role="group" >
                                <img src="{{ url($custom->photo->path) }}" width="100%" alt="{{$custom->title}}">
                                <p class="text-center px-2 px-lg-4">{{$custom->title}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</main>
    
@endsection