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
    .about .top-consultation , .about .top-consultation .box {
        max-height: 276px;
    }
    .about .top-consultation img {
        width: 100%;
        height: 276px;
    }
    .about .top-consultation .background-layer {
        position: relative;
        height: 276px;
        top: -276px;
        background: #303642cc;
    }
    .about .top-consultation .background-layer-after {
        position: relative;
        height: 276px;
        width: 0px;
        top: -552px;
        background: #303642;
    }
    .about .top-consultation:hover .background-layer-after {
        width: 100%;
        transition: 1s;
    }
    .about .top-consultation .data {
        position: relative;
        top: -820px;
    }
    .about .top-consultation .data .description {
        display: none;
    }
    .about .top-consultation:hover .data {
        top: -774px;
        transition: 1s;
    }
    .about .top-consultation:hover .description {
        display: unset;
        transition: 1s;
    }
    .about .top-consultation button {
        position: relative;
        top: -60px;
        width: 60px;
        height: 60px;
        border: none;
    }
    .about .top-consultation button .after {
        display: none;
    }
    .about .top-consultation:hover .before {
        display: none;
        transition: 1s;
    }
    .about .top-consultation:hover .after {
        display: unset;
        transition: 1s;
    }
    .about .top-consultation:hover .description p {
        text-align: center;
    }
    .about .top-consultation:hover .app_name {
        color: transparent;
    }
    .app_name {
        color: #7c93ff
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
                    <div class="accordion-item">
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

    @if ( $body->where('section',99)->count() )
        <div class="container">
            <div class="row">
                @foreach ($body->where('section',99) as $item)
                    <a href="{{$item->link}}" class="col-lg-4">
                        <div class="top-consultation mb-4">
                            <div class="box">
                                <img class="rounded" alt="avatar" src="{{ $item->pic?url($item->pic):'' }}" />
                                <div class="background-layer rounded"></div>
                                <div class="background-layer-after rounded"></div>
                                <div class="data">
                                    <p class="m-1 ps-2 pb-2 text-start text-uppercase fw-bold app_name">{{env('APP_NAME')}}</p>
                                    <h4 class="text-center text-white pb-4">{{$item->title}}</h4>
                                    <div class="description text-center text-white my-3 ln-1">{!! $item->text !!}</div>
                                </div>
                            </div>
                            <button class="bg-transparent">
                                <div class="before text-center text-white h4 my-auto">
                                    <img src="{{asset('user/pic/talk_logo.png')}}" alt="talk" class="w-100 h-unset">
                                </div>
                                <div class="after text-center text-white h4 my-auto"><i class="fas fa-arrow-right mx-3"></i></div>
                            </button>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
    
    <div class="consultation mb-5">
        {{-- خدمات-بیمه" -> 66 , معرفی-کسب-و-کارهای-نوین -> 81 , کسب-و-کارهای-نوین -> 345 --}}
        @if ( in_array($item->id,[81,345,66]) )
            @include('user.consultation.categories.startup')
        @elseif ($item->id==84 || $item->id==525)
            <div class="row">
                @foreach ($items as $item)
                    <a href="{{ route('user.consultation.profile',$item->id) }}" class="col-lg-4">
                        <div class="top-consultation mb-4">
                            <div class="box">
                                <img src="{{ url($item->user()->photo->path) }}" class="rounded" alt="avatar">
                                <div class="background-layer rounded"></div>
                                <div class="background-layer-after rounded"></div>
                                <div class="data">
                                    <p class="m-1 ps-2 text-start text-uppercase fw-bold app_name">{{env('APP_NAME')}}</p>
                                    <h4 class="text-center text-white pb-4">
                                        {{$item->user()->first_name.' '.$item->user()->last_name}}
                                    </h4>
                                    <div class="description">
                                        <p class="text-center text-white my-3 ln-1">
                                            {{$item->title}}<br>رفتن به پروفایل مشاور
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <button class="bg-transparent">
                                <div class="before text-center text-white h4 my-auto">
                                    <img src="{{asset('user/pic/talk_logo.png')}}" alt="talk" class="w-100 h-unset">
                                    {{-- <i class="fa fa-plus"></i> --}}
                                </div>
                                <div class="after text-center text-white h4 my-auto">
                                    <i class="fas fa-arrow-right mx-3"></i>
                                </div>
                            </button>
                        </div>
                    </a>
                @endforeach
    
                @foreach ($items2 as $item)
                    <a href="{{ route('user.consultation.profile',$item->id) }}" class="col-lg-4">
                        <div class="top-consultation mb-4">
                            <div class="box">
                                <img src="{{ url($item->user()->photo->path) }}" class="rounded" alt="avatar">
                                <div class="background-layer rounded"></div>
                                <div class="background-layer-after rounded"></div>
                                <div class="data">
                                    <p class="m-1 ps-2 text-start text-uppercase fw-bold app_name">{{env('APP_NAME')}}</p>
                                    <h4 class="text-center text-white pb-4">
                                        {{$item->user()->first_name.' '.$item->user()->last_name}}
                                    </h4>
                                    <div class="description">
                                        <p class="text-center text-white my-3 ln-1">
                                            {{$item->title}}<br>رفتن به پروفایل مشاور
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <button class="bg-transparent">
                                <div class="before text-center text-white h4 my-auto">
                                    <img src="{{asset('user/pic/talk_logo.png')}}" alt="talk" class="w-100 h-unset">
                                    {{-- <i class="fa fa-plus"></i> --}}
                                </div>
                                <div class="after text-center text-white h4 my-auto">
                                    <i class="fas fa-arrow-right mx-3"></i>
                                </div>
                            </button>
                        </div>
                    </a>
                @endforeach
            </div>
            @include('user.consultation.categories.top')
        {{-- میزگرد-عمومی 58  ,  57 میزگرد-تخصصی  --}}
        @elseif ( $item->id==57 || $item->id==58 )
            <div class="d-none">{{$title=$item->title}}</div>
            <div class="container my-3">
                @include('user.consultation.categories.mizgerd')
            </div>
            {{-- کارگاه-های-تخصصی 53 --}}
        @elseif ( $item->id==53 )
            <div class="d-none">{{$page_name=$item->slug}}</div>
            <div class="container">
                <div class="row">
                    @if ($items->count())
                        @foreach (\App\Model\ServicePackage::where('status','active')->whereIn('user_id',$items->pluck('user_id'))->whereIn('reagent_id',$items->pluck('id'))->get() as $item)
                            @include('user.consultation.categories.kargah-takhasosi')
                        @endforeach
                    @endif
    
                    @if ($items2->count())
                        @foreach (\App\Model\ServicePackage::where('status','active')->whereIn('user_id',$items2->pluck('user_id'))->whereIn('reagent_id',$items2->pluck('id'))->get() as $item)
                            @include('user.consultation.categories.kargah-takhasosi')
                        @endforeach
                    @endif
                </div>
            </div>
        @else
            {{-- مالیات -> 76 , مالیات و حسابرسی -> 508 --}}
            <div class="{{in_array( $item->id , [76,508])?'':'container'}} page-hoghoghi">
                <div class="body {{in_array( $item->id , [76,508])?'':'p-4'}}">
                    
                    @foreach ($items as $item)
                        <div class="d-none">{{$status='online'}}</div>
                        @include('user.consultation.profile.index')
                    @endforeach

                    @foreach ($items2 as $item)
                        <div class="d-none">{{$status='offline'}}</div>
                        @include('user.consultation.profile.index')
                    @endforeach

                    <div class="container">
                        {{$items1->links()}}
                    </div>
                </div>
            </div>

        @endif

    </div>

    @if ($body->where('section','>',9)->count())
        <div class="bg-light inside-nav">
            @if ( $body->where('section',10)->count() )
                <div class="row direction_ltr bg-dark-violet" style="max-width: 100%;margin: auto;">
                    <div class="col-lg-2 p-3 py-lg-4 jump-to">
                        @foreach ($body->where('section',10)->where('sort','<',2) as $key => $item)
                            <a href="/{{$item->link}}" class="text-white h5 mx-3 mx-lg-4">{{$item->title}}</a>
                        @endforeach
                    </div>
                    <div class="col p-3 py-lg-4 text-center text-lg-start">
                        @foreach ($body->where('section',10)->where('sort','>',1) as $key => $item)
                            <a href="/{{$item->link}}" class="text-white h5 border-bottom mx-2 mx-lg-4">{{$item->title}}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="container">    
                <div class="py-lg-5">
                    <div id="top-consultation">
                        @if ( $body->where('section',11)->count() )
                            <h4 class="fw-bold text-right text-dark-violet my-4">
                                @foreach ($body->where('section',11) as $key => $item)
                                    {{$item->title}}
                                @endforeach
                            </h4>
                        @endif

                        @if ( $body->where('section',12)->count() )
                            <div class="row">
                                @foreach ($body->where('section',12)->sortBy('sort') as $key => $item)
                                    <div class="col-lg-4">
                                        <div class="card bg-white mb-3" style="height: auto;">
                                            <div class="card-header @if($item->sort==1) bg-dark-violet @else bg-ligh-gray @endif fs-6 fw-bold text-white text-center">
                                                {{$item->title}}
                                            </div>
                                            <div class="card-body p-2 p-lg-3 px-lg-4">
                                                <div class="text-center">
                                                    @if (is_file($item->pic))
                                                        <img style="width: 100%;height: 206px;" src="{{url($item->pic)}}" alt="banner">
                                                    @endif
                                                    @if (is_file($item->video))
                                                        <video controls>
                                                            <source src="{{url($item->video)}}" type="video/mp4">
                                                        </video>
                                                    @endif
                                                    <div @if (!$item->link) style="margin-bottom: 36px" @endif></div>
                                                </div>
                                                @if ($item->link)
                                                    <a href="{{$item->link?url($item->link):''}}" class="text-light-orange">
                                                        <div class="text-end fw-bold mt-3">
                                                            نمایش بیشتر
                                                            <i class="fa fa-angle-left"></i>
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endif
</section>

@if (auth()->user())
    @include('user.forms.qarardad-moshavere')
    @include('user.forms.qarardad-moshavere-hozori')
    @include('user.forms.payam-moshavere')
    <script>
        function setUp(id , type, cons_id, title, subject) {
            document.getElementById('qarardad-id').value = id;
            document.getElementById('qarardad-type').value = type;
            document.getElementById('qarardad-cons-id').value = cons_id;
            document.getElementById('qarardad-title').value = title;
            document.getElementById('qarardad-moshavereLabel').innerHTML = subject;
        }
        function setUp2(id , type, cons_id, title, subject) {
            document.getElementById('qarardad-id2').value = id;
            document.getElementById('qarardad-type2').value = type;
            document.getElementById('qarardad-cons-id2').value = cons_id;
            document.getElementById('qarardad-title2').value = title;
            document.getElementById('qarardad-moshavere-hozoriLabel').innerHTML = subject;
        }
        function setUp3(id , type, cons_id, title, subject) {
            document.getElementById('qarardad-id3').value = id;
            document.getElementById('qarardad-type3').value = type;
            document.getElementById('qarardad-cons-id3').value = cons_id;
            document.getElementById('qarardad-title3').value = title;
            document.getElementById('qarardad-moshavereLabel').innerHTML = subject;
        }
    </script>
@endif

@endsection