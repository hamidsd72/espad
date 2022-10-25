<style>
    .abs {
        position: absolute;
        top: 20px;
        bottom: 0px;
        height: 100%;
        margin-top: 45%;
        width: 100%;
        z-index: 99;
    }
    .bg-small-shadow {
        background: #ffffffb0;
    }
    @media only screen and (min-width: 920px) {
        .swiper {
            top: 2px;
            padding: 16px 0px;
        }
        .swiper-slide .card {
            margin-top: 9px;
            margin-right: 32px;
        }
        .swiper-slide-active .card {
            margin-left: 32px;
            margin-right: 0px;
        }
        .swiper-slide-prev .card {
            margin-left: 0px;
            margin-right: 32px;
        }
        .swiper-slide-next .card {
            margin: 0px;
        }
        .abs {
            position: absolute;
            top: -16px;
            height: 100%;
            width: 0%;
            color: transparent;
            background: transparent;
        }
        .bg-small-shadow {
            background: transparent;
        }
        .swiper-slide:hover img {
            opacity: 0.4;
            transition: 0.4s;
        }
        .swiper-slide:hover .abs {
            color: #000000f1;
            width: 100%;
            transition: 0.6s;
        }
        @media (min-width: 992px) {
            .swiper-button-prev , .swiper-button-next{
                left: 218px;
                top: 840px;
            }
        }
        .abs p, .abs h4, .abs h6 {
            text-align: center !important;
        }
    }
</style>

<div class="d-none">{{$counter = 1}}</div>
<div class="d-none">{{$sum = $items->count()+$items2->count()}}</div>

<div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-ios swiper-backface-hidden py-lg-4">
    <div class="swiper-wrapper" id="swiper-wrapper-c164578535e54f7f" aria-live="polite">
        @foreach ($items as $item)
            @if ($item->photo)
                <div class="swiper-slide my-auto" role="group" aria-label="{{$counter}} / {{$sum}}">
                    <div class="card">
                        <a href="{{ route('user.consultation.profile4',$item->id) }}">
                            <div class="abs">
                                <div class="bg-small-shadow p-4 p-lg-0">
                                    <h4 class="fw-bold">{{$item->title}}</h4>
                                    <h6 class="my-4 my-lg-5 fw-bold">{!! $item->text !!}</h6>
                                    <div class="text-center">
                                        <button class="btn btn-danger">نمایش بیشتر</button>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ $item->photo->path?url($item->photo->path):'' }}" class="mx-auto" alt="avatar" width="100%">
                        </a>
                    </div>
                </div>
            @endif
            <div class="d-none">{{$counter += 1}}</div>
        @endforeach
        @foreach ($items2 as $item)
            @if ($item->photo)
                <div class="swiper-slide my-auto" role="group" aria-label="{{$counter}} / {{$sum}}">
                    <div class="card">
                        <a href="{{ route('user.consultation.profile4',$item->id) }}">
                            <div class="abs">
                                <div class="bg-small-shadow p-4 p-lg-0">
                                    <h4 class="fw-bold">{{$item->title}}</h4>
                                    <h6 class="my-4 my-lg-5 fw-bold">{!! $item->text !!}</h6>
                                    <div class="text-center">
                                        <button class="btn btn-danger">نمایش بیشتر</button>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ $item->photo->path?url($item->photo->path):'' }}" class="mx-auto" alt="avatar" width="100%">
                        </a>
                    </div>
                </div>
            @endif
            <div class="d-none">{{$counter += 1}}</div>
        @endforeach
    </div>
</div>

<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>
<div class="swiper-scrollbar"></div>

