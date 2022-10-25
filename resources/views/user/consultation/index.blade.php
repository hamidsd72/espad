@extends('layouts.layout_first_page')
@section('content')
<style>
    section.about .navbar-4 .line-top {
        border-left: 1px solid #003B5C;
        height: 18px;
        margin-left: 10px;
    }
    section.about .navbar-4 .circle {
        border: 2px solid #003B5C;
        width: 20px;
        height: 20px;
        border-radius: 50px;
    }
    section.about .navbar-4 .point2 {
        background: #003B5C;
        width: 14px;
        height: 14px;
        border-radius: 50px;
        margin: auto;
        margin-top: 1px;
    }
    section.about .navbar-4 a:hover div.text-secondary {
        color: #FFA06A !important;
    }
    section.about .navbar-4 div.selected {
        color: #FFA06A !important;
    }
    .swiper-slide .card-hover:hover .card-header {
        background: #FFA06A !important;
        transition: 0.4s;
    }
</style>

<section class="about">

    <div class="bg-gradient-blue text-white p-4 p-lg-0 py-lg-5">
        <div class="col-lg-9 m-auto" style="text-align: justify;direction: rtl;">
            @foreach ($data->where('section',1) as $item)
                <h1 class="fw-bold text-center">{{$item->title}}</h1>
                <h6 class="text-center text-light-blue">{{$item->link}}</h6>
                <div class="text-center pb-lg-5 mb-lg-5">{!! $item->text !!}</div>
            @endforeach
        </div>
    </div>
    <div class="container py-4">

        <div class="body bg-white">
               
            {{-- زیردسته های اوراق بهادار --}}
            @if ($cats==83)
                <div class="row">
                    @foreach ($items as $item)
                        <a href="{{ route('user.consultation.show',$item->id) }}" class="col-lg-4">
                            <div class="top-consultation mb-4">
                                <div class="box">
                                    <img class="rounded" alt="avatar"
                                        src="/{{$item->service_id ? is_file(\App\Model\ServiceCat::find($item->service_id)->pic)? \App\Model\ServiceCat::find($item->service_id)->pic : \App\Model\ServiceCat::find( \App\Model\ServiceCat::find($item->service_id)->service_id )->pic : $item->pic }}" />
                                    <div class="background-layer rounded"></div>
                                    <div class="background-layer-after rounded"></div>
                                    <div class="data">
                                        <h4 class="text-center text-white pb-4">
                                            {{$item->title}}
                                        </h4>
                                        <div class="description">
                                            <p class="text-center text-white my-3 ln-1">
                                                {{str_replace('-',' ',$item->slug)}}<br>رفتن به لیست مشاوران
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button class="bg-light-orange">
                                    <div class="before text-center text-white h4 my-auto">
                                        <i class="fa fa-plus"></i>
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
            @else
                <div style="max-height: 500px;">
                    <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-ios swiper-backface-hidden">
                        <div class="swiper-wrapper" id="swiper-wrapper-c164578535e54f7f" aria-live="polite">
                            @foreach ($items as $item)
                                
                                <div class="swiper-slide p-0" role="group" >
                                    <div class="card-hover">
                                        <div class="card card-rounded border" style="border: none;">
                                            <div class="card-header header-dark-blue" style="min-height: 64px;">
                                                <h6 class="text-center text-white mb-0">{!! $item->text !!}</h6>
                                            </div>
                                            <div class="card-body text-center" style="min-height: 532px">
                                                {{-- <img class="mx-auto p-1 px-3 rounded" src="/{{$item->service_id ? \App\Model\ServiceCat::find($item->service_id)->pic : $item->pic }}"  --}}
                                                <img class="mx-auto px-3 rounded" 
                                                src="/{{$item->service_id ? is_file(\App\Model\ServiceCat::find($item->service_id)->pic)? \App\Model\ServiceCat::find($item->service_id)->pic : \App\Model\ServiceCat::find( \App\Model\ServiceCat::find($item->service_id)->service_id )->pic : $item->pic }}" 
                                                alt="banner" style="width: 220px;height: 90px;">
                                                <a href="#">
                                                    <h6 class="text-center text-info my-2" style="min-height: 40px;">{{$item->title}}</h6>
                                                </a>
                                                <div class="mx-lg-2">
                                                    <a href="{{ route('user.consultation.show',$item->id) }}" class="btn btn-lg text-white col-12 call">
                                                        <i class='fas fa-phone-alt'></i>
                                                        شروع مشاوره
                                                    </a>
                                                    <a href="{{ route('user.consultation.show',$item->id) }}" class="btn btn-lg col-12 my-3 about">لیست مشاوران</a>
                                                    {{-- <a href="#" onclick="setUp('{{$item->id}}', 'consultation', 0, 'قرارداد','{{$item->title}}')" data-bs-toggle="modal" data-bs-target="#qarardad-moshavere">
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            درخواست قرارداد</p>
                                                    </a>
                                                    <a href="#" onclick="setUp2('{{$item->id}}', 'consultation', 0, 'حضوری','{{$item->title}}')" data-bs-toggle="modal" data-bs-target="#qarardad-moshavere-hozori">
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            درخواست مشاوره حضوری</p>
                                                    </a>
                                                    <a href="#" onclick="setUp2('{{$item->id}}', 'consultation', 0, 'پیام','{{$item->title}}')" data-bs-toggle="modal" data-bs-target="#payam-moshavere">
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            ارسال پیام</p>
                                                    </a> --}}
                                                    <a href="{{(explode(',',$item->sub_text1))[1]??'#'}}" >
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            {{ (explode(',',$item->sub_text1))[0] }}
                                                        </p>
                                                    </a>
                                                    <a href="{{(explode(',',$item->sub_text1))[2]??'#'}}" >
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            {{ (explode(',',$item->sub_text2))[0] }}
                                                        </p>
                                                    </a>
                                                    <a href="{{(explode(',',$item->sub_text1))[3]??'#'}}" >
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            {{ (explode(',',$item->sub_text3))[0] }}
                                                        </p>
                                                    </a>
                                                    <a href="{{(explode(',',$item->sub_text1))[4]??'#'}}" >
                                                        <p class="descrption">
                                                            <span class="circle-icon-dark-blue">
                                                                <i class="fa fa-check"></i>
                                                            </span>
                                                            {{ (explode(',',$item->sub_text4))[0] }}
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                            @endforeach
                        </div>
                    </div>
                    {{-- <div class="swiper-pagination"></div> --}}
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-scrollbar"></div>
                </div>

                <div class="row direction_ltr pb-4 px-4">
                    <div class="col navbar-4">
                        {{-- برای صفحه مشاوره  --}}
                        @if (\Request::route()->getName() == 'user.consultation.category')
                        {{-- ایتم اول دسته مشاوره --}}
                            <a href="{{ route('user.consultation.show',$items[0]->id) }}" class="d-flex">
                                <div class="circle">
                                    <div class="point2"></div>
                                </div>
                                <div class="mx-2 text-secondary selected">
                                    {{$items[0]->title}}
                                </div>
                            </a>
                            {{-- ۶ ایتم --}}
                            @foreach(App\Model\ServiceCat::where('status', 'active')->whereIn('view',['both','body'])->get() as $item)
                                <div class="line-top"></div>    
                                <a href="{{ route('user.consultation.show',$item->id) }}" class="d-flex">
                                    <div class="circle">
                                        <div class="">
                                        </div>
                                    </div>
                                        <div class="mx-2 text-secondary ">
                                        {{$item->title}}
                                    </div>
                                </a>
                            @endforeach
                            {{-- برای دیگر صفحات --}}
                        @else
                            @foreach ($items as $key => $item)
                                @if ($key>0)
                                    <div class="line-top"></div>    
                                @endif
                                <a href="{{ route('user.consultation.show',$item->id) }}" class="d-flex">
                                    <div class="circle">
                                        @if ($key>0)
                                            <div class="">
                                        @else
                                            <div class="point2">
                                        @endif
                                        </div>
                                    </div>
                                    @if ($key>0)
                                        <div class="mx-2 text-secondary ">
                                    @else
                                        <div class="mx-2 text-secondary selected">
                                    @endif
                                        {{$item->title}}
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>

                    <div class="col-lg-9 my-auto" style="text-align: justify;direction: rtl;">
                        @foreach ($data->where('section',3) as $item)
                            <h4>{{$item->title}}</h4>
                            {!! $item->text !!}
                        @endforeach
                    </div>

                </div>
            @endif

        </div>
    </div>
</section>

@endsection
