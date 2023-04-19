
<style>
    .consultation {
        background: white;
    }
    .text-blue {
        color: #00788D;
    }
    .hover-orange:hover {
        color: #ffa06a !important;
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
        background: linear-gradient(rgba(0, 121, 141, 0.75), rgba(0, 121, 141, 0.75));
    }
    .about .top-consultation .background-layer-after {
        position: relative;
        height: 276px;
        width: 0px;
        top: -552px;
        background: #00788D;
    }
    .about .top-consultation:hover .background-layer-after {
        width: 100%;
        transition: 1s;
    }
    .about .top-consultation .data {
        position: relative;
        top: -700px;
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
    .about .list-item2 img {
        width: 100%;
        height: 90px;
    }
    .about .list-item2 img.avatar {
        width: 48px;
        height: 48px;
        border-radius: 50px;
    }
</style>

<div class="d-none">{{$page_name=$item->slug}}</div>
<div class="row">
    @php
        if ($name=='paid') {
            $packages = \App\Model\ServicePackage::where('status','active')->where('type', 'meeting')->where('price', '>', 0)->get();
        } else {
            $packages = \App\Model\ServicePackage::where('status','active')->where('type', 'meeting')->whereIn('price', [0,null])->get();
        }
    @endphp


    @foreach ($packages->where('started_at','>',\Carbon\Carbon::now()) as $item)
        <a href="{{ route('user.consultation.edit', $item->slug ) }}" class="col-lg-4">
            <div class="top-consultation mb-4">
                <div class="box">
                    <img src="{{ $item->photo?url($item->photo->path):'' }}" class="rounded" alt="avatar">
                    <div class="background-layer rounded"></div>
                    <div class="background-layer-after rounded"></div>
                    <div class="data">
                        <h4 class="text-center text-white pb-4">
                            {{$item->title}}
                        </h4>
                        <div class="description">
                            <p class="text-center text-white my-3 ln-1">
                                رفتن به 
                                <br>
                                {{$item->title}}
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

<div class="p-4">
    @foreach ($body->where('section',6) as $item)
        <h4 class="text-blue">{{$item->title}}</h4>
    @endforeach
    <div class="row">
        @foreach ($packages->where('started_at','<',\Carbon\Carbon::now()) as $item)
            <div class="col-lg-6 text-center">
                <div class="row list-item2 py-4">
                    <div class="col-lg-3 p-0">
                        <img src="{{ $item->photo?url($item->photo->path ):'' }}" alt="banner">
                    </div>
                    <div class="col">
                        <a href="#" class="hover-orange">
                            <h5 class="text-dark fw-light hover-orange">
                                {{$item->title}}
                            </h5>
                            <div class="mb-1 text-secondary hover-orange">
                                {{ $item->user()->first_name.' '.$item->user()->last_name }}
                            </div>
                        </a>
                    </div>
                    <style>
                        .hover-orange p {
                            margin-bottom: 4px;
                        }
                    </style>
                </div>
            </div>
        @endforeach
    </div>
</div>