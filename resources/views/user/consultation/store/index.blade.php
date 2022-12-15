@extends('layouts.layout_first_page')
@section('content')
<style>
    a.hover-light-blue:hover {
        color: #32c9db !important;
    }
    .text-{
        text-align: justify;
    }
    .swiper-button-next:after, .swiper-rtl .swiper-button-prev:after {
        content: 'prev';
    }
    .swiper-button-next {
        border-radius: 50px;
        padding: 30px;
    }
    @media (max-width: 640px) {
        .swiper-button-next {
            display: none;
        }
    }
    @media (max-width: 768px) {
        .swiper-button-next {
            right: unset;
            top: unset;
            left: 1%;
            margin-top: -150px;
        }
    }
    @media only screen and (min-width: 1200px) {
        .swiper {
            top: unset;
        }
        .swiper-button-next {
            right: unset;
            top: unset;
            left: 14%;
            margin-top: -150px;
        }
    }
</style>
<section class="about bg-white">
    <div class="container">
        <div class="row my-3">
            <div class="col-xl-2 col-lg-3 text-center"><h4 class="text-center" style="color: #32c9db">اسپاد کالا</h4></div>
            <div class="col-auto my-auto d-none d-lg-block">
                <ul class="d-flex ul_menu_top my-auto">
                    @foreach (\App\Model\ServiceCat::find(96)->child_cat->where('id','!=',534) as $child_cat)
                        <li class="ms-4">
                            <a href="{{ route('user.store.show',$child_cat->id) }}" class="hover-light-blue @if ($id??'') {{$id==$child_cat->id?'text-dark fw-bold':'text-secondary'}} 
                                @else text-secondary @endif">{{$child_cat->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 d-lg-none">
                @foreach (\App\Model\ServiceCat::find(96)->child_cat->where('id','!=',534) as $child_cat)
                    <div class="m-2">
                        <a href="{{ route('user.store.show',$child_cat->id) }}" class="@if ($id??'') {{$id==$child_cat->id?'text-dark fw-bold':'text-secondary'}}
                             @else text-secondary @endif">{{$child_cat->title}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- اسلایدر بالا --}}
    @if ($banners->count())    
        <div id="demo" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators">
                @foreach ($banners as $key => $item)
                    @if ($item->photo->path)
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></button>
                    @endif
                @endforeach
            </div>
            
            <div class="carousel-inner">
                <div class="d-none">{{$active='active'}}</div>
                @foreach ($banners as $item)
                    @if ($item->photo->path)
                        <div class="carousel-item {{$active}}">
                            <a href="{{route('user.store.edit',$item->id)}}">
                                <img src="{{ url($item->photo->path) }}" class="d-block w-100" style="min-height: 180px;" alt="{{$item->title}}">
                                <div class="carousel-caption">
                                    <h4 class="d-none d-lg-block">{{$item->title}}</h4>
                                    <p class="d-lg-none">{{$item->title}}</p>
                                </div>
                            </a>    
                        </div>
                        <div class="d-none">{{$active=''}}</div>
                    @endif
                @endforeach
            </div>
            
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button> --}}
        </div>
    @endif

    <div class="container pb-4">

        <div class="body">
        
            <h2 class="py-4 d-flex">
                <div class="line"></div>
                @if ($id??'')
                    {{' صفحه '.$item->title}}
                @else
                    صفحه اصلی فروشگاه
                @endif
            </h2>
            {{-- آیتم های چرخ وفلک --}}
            <div class="col-12 py-3" style="background: #ef4056;border-radius: 20px;">
                <div class="row">
    
                    <div class="col text-center my-auto">
                        <p class="m-0 px-lg-5 fs-5 text-center fw-bold text-light">پیشنهاد شگفت انگیز</p>
                        <img src="https://www.digikala.com/statics/img/png/specialCarousel/box.png" width="145px" alt="alt">
                        <a href="@if ($id??'') {{ route('user.store.index') }} @else # @endif" class="text-light fs-6">مشاهده همه موارد</a>
                    </div>
    
                    <div class="col-lg-10">
                        <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-ios swiper-backface-hidden" style="border-radius: 20px;">
                            <div class="swiper-wrapper" id="swiper-wrapper-c164578535e54f7f" aria-live="polite">
                                @foreach ($items as $item)
                                    @if ($item->photo->path)
                                        <div class="swiper-slide p-0" role="group" >
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="{{route('user.store.edit',$item->id)}}">
                                                        <img src="{{ url($item->photo->path) }}" class="w-100" alt="{{$item->title}}">
                                                        {{$item->title}}
                                                        <div class="text-start small">{{number_format($item->amount).' تومان '}}</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-button-next btn btn-light p-4"></div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                    
                </div>
            </div>
            {{-- پایان آیتم های چرخ وفلک --}}

            {{-- آیتم های پایین صفحه --}}
            <div class="col-12 py-3 mt-4" style="border-radius: 20px;background: #c0c2c5">
                <div class="row">
                    
                    <div class="col-lg-4 my-auto">
                        <div class="row">
                            <div class="col-auto"><img class="me-lg-4" src="https://www.digikala.com/statics/img/png/specialCarousel/box.png" width="66px" alt="alt"></div>
                            <div class="col-auto my-auto"><p class="m-0 fs-3 text-center text-success">{{\App\Model\ServiceCat::find(532)?\App\Model\ServiceCat::find(532)->title:'پیشنهاد شگفت انگیز'}}</p></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row" style="direction: ltr;">
                            @foreach (\App\Model\Service::where('status', 'active')->where('category_id', 532 )->get() as $item)
                                @if ($item->photo->path)
                                    <a href="{{route('user.store.edit',$item->id)}}">
                                        <div class="bg-white text-center mx-1 p-1" style="width: 80px;height: 80px;border-radius: 50px;">
                                            <img src="{{ url($item->photo->path) }}" class="w-100" style="height: 72px;border-radius: 50px;" alt="{{$item->title}}">
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-2 my-auto text-center">
                        <a href="{{ route('user.store.show',532) }}" class="bg-white text-success p-3 fs-6" style="border-radius: 50px;">مشاهده محصولات >></a>
                    </div>
                    
                </div>
            </div>
            {{-- پایان آیتم های پایین صفحه --}}
            
        </div>

    </div>
</section>

@endsection