@extends('layouts.layout_first_page')
@section('content')
<style>
    a.hover-orange:hover h4 {
        color: #ffa06a;
    }
    .p-ln-24 p {
        line-height: 24px;
        text-align: justify;
    }
    .head-2 a {
        font-size: 16px;
        color: black
    }
    .tgju-copyright-fix , .tgju-copyright {
        display: none !important;
    }
    .links .body ul {
        list-style: unset !important;
    }
    .accordion-button:not(.collapsed) {
        color: #0c63e4;
        background-color: transparent;
        box-shadow: none;
    }
    .accordion-button {
        background-color: transparent;
    }
    .accordion-button::after {
        margin: unset;
        position: absolute;
        width: 2rem;
        height: 2rem;
        background-size: 2rem;
        background-image: url({{asset('/assets/images/plus.png')}});
    }
    .accordion-button:not(.collapsed)::after {
        background-image: url({{asset('/assets/images/minus.png')}});
    }
    @media all and (min-width: 992px) {
        .head-2 a {
            font-weight: bold;
            font-size: 24px;
        }
        .swiper {
            top: 0px;
        }
    }
</style>


<div class="bg-light-yasi text-white p-3">
    <div class="container">
        <div class="row " id="top-consultation">
            <div class="col-2 my-lg-auto text-lg-start">
                <img src="{{ $body->where('section',100)->first()?url($body->where('section',100)->first()->pic):asset('assets/images/msg-icon.png') }}" alt="banner">
            </div>
            <div class="col">
                <h1 class="fw-bold text-right text-dark-violet my-lg-2 d-none d-lg-block">{{ $item->title }}</h1>
                <h1 class="fw-bold text-right text-dark-violet d-lg-none fs-5">{{ $item->title }}</h1>
                <h4 class="text-right text-dark pt-lg-2 d-none d-lg-block">{{ $item->text }}</h4>
                <p class="text-right text-secondary">آخرین بروزرسانی : {{my_jdate($item->updated_at,'d F Y')}}</p>
            </div>
        </div>
        <div class="row">
            @foreach ($body->where('section',101) as $link)
                <div class="col-md-4 col-lg-3">
                    <div class="links">
                        <div class="header text-dark"> <span class="fs-5" style="color: #ffa06a">>></span> {{$link->title}}</div>
                        <div class="body text-primary">{!! $link->text !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-secondary my-2 mb-lg-4 p-ln-24 head-2">
            {!! $item->description !!}
        </div>

        @if ( $body->where('section',102)->count() )
            <div class="accordion" id="accordionExample">
                @foreach ($body->where('section',102) as $content)
                    <div class="accordion-item" style="background-color: transparent;border: none;">
                        <h2 class="accordion-header" id="heading{{$content->id}}">
                            {{-- <button class="accordion-button {{$body->where('section',102)->first()->id==$content->id?'':'collapsed'}}" type="button" data-bs-toggle="collapse" --}}
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                 {{-- data-bs-target="#collapse{{$content->id}}" aria-expanded="{{$body->where('section',102)->first()->id==$content->id?'true':'false'}}" aria-controls="collapse{{$content->id}}"> --}}
                                 data-bs-target="#collapse{{$content->id}}" aria-expanded="false" aria-controls="collapse{{$content->id}}">
                                 <p class="m-0 px-5 fw-bold">{{ $content->title }}</p>
                            </button>
                        </h2>
                        {{-- <div id="collapse{{$content->id}}" class="accordion-collapse collapse {{$body->where('section',102)->first()->id==$content->id?'show':''}}"  --}}
                        <div id="collapse{{$content->id}}" class="accordion-collapse collapse" 
                            aria-labelledby="heading{{$content->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-dark">
                                {!! $content->text !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>


<section class="about">
    <div class="consultation mb-5">
        {{-- خدمات-بیمه" -> 66 , معرفی-کسب-و-کارهای-نوین -> 81 , کسب-و-کارهای-نوین -> 345 --}}
        @if ( in_array($item->id,[81,345,66]) )
            @include('user.consultation.categories.startup')
        @else
            {{-- مالیات -> 76 , مالیات و حسابرسی -> 508 --}}
            <div class="{{in_array( $item->id , [76,508])?'':'container'}} page-hoghoghi">
                <div class="body {{in_array( $item->id , [76,508])?'':'p-4'}}">
                    {{-- 103 گروه-کالایی 55 , قراردادهای-آتی-و-آپشن-ها 54 , فرآیند-پذیرش-در-بورس-کالا 56 , املاک-مستغلات 102 , صندوق-مستغلات --}}
                    {{-- 509,77,78,79 خدمات بورسی ، خدمات ارزی و ریالی ، صندوق ها و بازار های بین المللی --}}
                    @if (in_array( $item->id , [55,54,56,103,102,509,77,78,79]) )
                        <div class="d-none">{{$status='online'}}</div>
                        <div class="row">
                            @foreach ($items as $item)
                                @include('user.consultation.categories.bource-kala')
                            @endforeach
                        </div>

                        <div class="d-none">{{$status='offline'}}</div>
                        <div class="row">
                            @foreach ($items2 as $item)
                                @include('user.consultation.categories.bource-kala')
                            @endforeach
                        </div>
                        {{-- طلا 77 --}}
                    @elseif ($item->id==77)

                        <div class="d-none">{{$page_name=$item->slug}}</div>
                        <div class="row">
                            @foreach ($body->where('section',2)->sortBy('sort') as $item)
                                @include('user.consultation.categories.kargah-takhasosi')
                            @endforeach
                        </div>

                        <div class="row">
                            @foreach ($body->where('section',3)->sortBy('sort') as $item)
                                @include('user.consultation.categories.kargah-takhasosi')
                            @endforeach
                        </div>
                        
                        <div class="row">
                            <div class="d-none">{{$page_name="آیتم-طلا"}}</div>
                            @foreach ($items as $item)
                                <div class="d-none">{{$status='online'}}</div>
                                @include('user.consultation.categories.bource-kala')
                                {{-- @include('user.consultation.categories.kargah-takhasosi') --}}
                            @endforeach
                            
                            @foreach ($items2 as $item)
                                <div class="d-none">{{$status='offline'}}</div>
                                @include('user.consultation.categories.bource-kala')
                                {{-- @include('user.consultation.categories.kargah-takhasosi') --}}
                            @endforeach
                        </div>
                        
                        {{-- رمزارز-ها -> 79 , ETF-،-پذیره نویسی -> 78--}}
                    @elseif ($item->id==79 || $item->id==78)
                        <div class="d-none">{{$page_name=$item->slug}}</div>

                        <div class="row">
                            @foreach ($body->where('section',3)->sortBy('sort') as $item)
                                @include('user.consultation.categories.kargah-takhasosi')
                            @endforeach
                        </div>
    
                        <div class="d-none">{{$status='online'}}</div>
                        <div class="row">
                            @foreach ($items as $item)
                                @include('user.consultation.categories.bource-kala')
                            @endforeach
                        </div>

                        <div class="d-none">{{$status='offline'}}</div>
                        <div class="row">
                            @foreach ($items2 as $item)
                                @include('user.consultation.categories.bource-kala')
                            @endforeach
                        </div>
                        {{-- مالیات -> 76 --}}
                    @elseif (in_array( $item->id , [76,508]))
                        <style>
                            .border-bottom-gold {
                                border-bottom: 2px solid #c7a97b;
                                max-width: 200px;
                            }
                            .consultation {
                                background: white !important;
                            }
                            a.hover-dark:hover {
                                color: black !important;
                            }
                            .top_banner img {
                                width: 100%;
                            }
                            .top_banner div.box {
                                position: relative;
                                top: -210px;
                                width: 20%;
                                padding: 10px 12px;
                                margin-right: 20%;
                                background: #ffffff99;
                            }
                            .top_banner .msg {
                                line-height: 36px;
                                /* --borderColor: #c7a97b;
                                border-left: 3px solid var(--borderColor,transparent);
                                border-top: 3px solid var(--borderColor,transparent);
                                margin-left: -20px;
                                margin-top: -12px; */
                            }
                            @media only screen and (max-width: 640px) {
                               
                            }
                        </style>

                        <div class="top_banner">
                            @foreach ($body->where('section',1) as $item)
                                <img src="{{ $item->pic?url($item->pic):'' }}" alt="banner">
                                {{-- <a href="{{ route('user.consultation.show', \App\Model\ServiceCat::where('sort', 8)->first('id')->id ) }}"> --}}
                                <a href="{{ $item->link?url($item->link):'' }}">
                                    <div class="d-none d-lg-block box">
                                        <div class="text-center text-dark fs-4 msg" >{{$item->title}}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="container">
                            <div class="py-4 mb-4">
                                @foreach ($body->where('section',2) as $item)
                                    <a href="{{ $item->link?url($item->link):'' }}" class="text-dark fw-bold h4 py-1 text-center border-bottom-gold">{{$item->title}}</a>
                                @endforeach
                                <div class="card-body row">
                                    @foreach ($body->where('section',3) as $item)
                                        <div class="col-lg-4 col-md-6 py-4">
                                            <img src="{{ $item->pic?url($item->pic):'' }}" class="my-auto" height="50px" alt="banner">
                                            <a href="{{ $item->link?url($item->link):'' }}" class="text-dark-violet h6 hover-dark fw-bold">{{$item->title}}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-ios swiper-backface-hidden">
                                <div class="swiper-wrapper" id="swiper-wrapper-c164578535e54f7f" aria-live="polite"> --}}

                                    <div class="row">
                                        @foreach ($items as $item)
                                            {{-- <div class="swiper-slide p-0" role="group" > --}}
                                            <div class="col-lg-6">
                                                <div class="d-none">{{$status='online'}}</div>
                                                @include('user.consultation.categories.maliat')
                                            </div>
                                        @endforeach
            
                                        @foreach ($items2 as $item)
                                            {{-- <div class="swiper-slide p-0" role="group" > --}}
                                            <div class="col-lg-6">
                                                <div class="d-none">{{$status='offline'}}</div>
                                                @include('user.consultation.categories.maliat')
                                            </div>
                                        @endforeach
                                    </div>

                                {{-- </div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-scrollbar"></div> --}}

                        </div>
                        {{-- مشاورین-برتر ,  مشاورین-برترر ۵۲۵ --}}
                    @elseif ($item->id==57 || $item->id==58)
                        @include('user.consultation.categories.mizgerd')
                    {{-- @elseif ($item->id==53) --}}
                    {{-- 
                        <div class="row">
                            @foreach ($items as $item)
                                @include('user.consultation.categories.kargah-takhasosi')
                            @endforeach
           