@extends('layouts.layout_first_page')
@section('content')
<style>
    .only-white p , .only-white h6 , .only-white h5 , .only-white h4 , .only-white h3 , .only-white h2 , .only-white h1 {
        color: white !important;
    }
    .hover-white:hover a {
        background: whitesmoke !important;
        color: #003b5c !important;
        transition: 0.4s;
    }
    #likes {
        float: left;
        position: relative;
        top: -46px;
    }
    #likes a:hover .svg-inline--fa {
        color: #ffc107 !important;
        transition: 0.2s;
    }
    .moshaver h5:hover , .moshaver p:hover {
        color: #04d2c8 !important;
        transition: 0.2s;
    }
    section.about .navbar-4 .line-top {
        border-right: 2px solid #04d2c8;
        height: 28px;
        margin-right: 9px;
    }
    section.about .navbar-4 .circle {
        border: 2px solid #04d2c8;
        width: 20px;
        height: 20px;
        border-radius: 50px;
    }
    section.about .navbar-4 .point2 {
        background: #04d2c8;
        width: 14px;
        height: 14px;
        border-radius: 50px;
        margin: auto;
        margin-top: 1px;
    }
    section.about .navbar-4 a:hover div.text-secondary {
        color: #04d2c8 !important;
    }
    section.about .navbar-4 div.selected {
        color: #04d2c8 !important;
    }
</style>
<div class="bg-light-yasi text-white p-3">
    <div class="container">
        <div class="row " id="top-consultation">
            <div class="col-2 my-lg-auto">
                <img class="float-lg-left" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
            </div>
            <div class="col">
                <h1 class="fw-bold text-right text-dark-violet my-lg-2 d-none d-lg-block">{{ \App\Model\ServiceCat::find($item->category_id)->title  }}</h1>
                <h1 class="fw-bold text-right text-dark-violet d-lg-none fs-5">{{ \App\Model\ServiceCat::find($item->category_id)->title  }}</h1>
                <h4 class="text-right text-dark d-none d-lg-block">{{ \App\Model\ServiceCat::find($item->category_id)->text }}</h4>
                <p class="text-right text-secondary mb-0">آخرین بروزرسانی : {{my_jdate(\App\Model\ServiceCat::find($item->category_id)->updated_at,'d F Y')}}</p>
            </div>
        </div>
    </div>
</div>

<section class="about bg-light">
    <div class="container pb-4">
        <div class="body p-4">

            <div class="row">

                <div class="col-lg-3 col-md-6 moshaver">
                    <div class="p-3 rounded" style="border:1px dashed #04d2c8">
                        <a href="#" >
                            <img src="{{ url($item->user()->photo->path) }}" width="100%" class="rounded shadow" alt="avatar">
                        </a>
                    </div>
                    <div class="bg-white mt-4 p-3 rounded text-secondary">
                        <h5 class="text-dark pt-2">{{$item->user()->first_name.' '.$item->user()->last_name}}</h5>
                        <p class="small my-2">{{$item->title}}</p>
                        <a href="{{ route('user.consultation.edit',$services->find($package)->slug) }}" class="btn btn-success col-12">
                            {{ ' شرکت در کارگاه '.$services->find($package)->title }}
                            <div class="text-dark text-center small">
                                {{ $services->find($package)->price>0?' ریال '.$services->find($package)->price:' رایگان ' }}
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col">

                    <h6 class="text-secondary pt-4 pt-lg-2">
                        <i class="fa fa-bookmark px-1" style="color: #04d2c8;"></i>
                        برنامه
                    </h6>
                    <hr class="my-4">

                    <div class="row bg-white rounded">

                        <div class="col-lg border p-0">
                            <div class="p-3">
                                <div class="py-3">
                                    دوره های من
                                </div>

                                <div class="navbar-4 mt-3">
                                    @foreach ($services as $key => $service)
                                        @if ($key>0)
                                            <div class="line-top"></div>    
                                        @endif
                                        <a href="{{ route('user.consultation.edit',$service->slug) }}" class="d-flex">
                                            <div class="circle">
                                                @if ($service->id!=$package)
                                                    <div class="">
                                                @else
                                                    <div class="point2">
                                                @endif
                                                </div>
                                            </div>
                                            @if ($service->id!=$package)
                                                <div class="mx-2 text-secondary ">
                                            @else
                                                <div class="mx-2 text-secondary selected">
                                            @endif
                                                {{$service->title}}
                                                <div class="float-start pe-lg-5 me-lg-5">{{$service->price>0?price( $service->price ).'ریال':'رایگان'}}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                    
                            </div>
                        </div>

                        <div class="col-lg border p-0">
                            <div class="p-3">
                                <div class="py-3">
                                    سرفصل های دوره
                                </div>
                                {!! $item->description !!}
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>

        </div>
    </div>
</section>

@endsection
