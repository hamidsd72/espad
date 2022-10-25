@extends('layouts.layout_first_page')
@section('content')
<style>
    section.bg-light {
        background: #fff !important;
    }
    section.about .navbar-4 .line-top {
        border-right: 2px solid #157347;
        height: 28px;
        margin-right: 9px;
    }
    section.about .navbar-4 .circle {
        border: 2px solid #157347;
        width: 20px;
        height: 20px;
        border-radius: 50px;
    }
    section.about .navbar-4 .point2 {
        background: #157347;
        width: 14px;
        height: 14px;
        border-radius: 50px;
        margin: auto;
        margin-top: 1px;
    }
    section.about .navbar-4 a:hover div.text-secondary {
        color: #157347 !important;
    }
    section.about .navbar-4 div.selected {
        color: #157347 !important;
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

                <div class="col-lg-6 moshaver mt-2 mt-lg-4">

                    @if ($services->find($package)??'')
                        <h4 class="py-4 d-flex">
                            <div class="line"></div>
                            {{ $services->find($package)->title }}
                        </h4>
                    @endif
                    {!! $item->text !!}

                    <div class="px-4 mt-lg-5 bg-light" style="border-radius: 6px;">
                        <h4 class="py-4 d-flex">
                            <div class="line"></div>
                            مدرس دوره
                        </h4>
                        <div class="row">
                            <div class="col-4 col-lg-3">
                                <div class="mm">
                                    <img src="{{ url($item->user()->photo->path) }}" width="100%" class="" alt="avatar">
                                </div>
                            </div>
                            <div class="col">
                                <h6>{{$item->user()->first_name.' '.$item->user()->last_name}}</h6>
                                <p class="my-3 text-swcondary">{{$item->user()->education}}</p>
                            </div>
                        </div>
                        <p class="py-3 pb-lg-4 text-secondary">{{$item->title}}</p>
                    </div>

                    <h4 class="py-4 d-flex">
                        <div class="line"></div>
                        سرفصل های دوره
                    </h4>
                    {!! $item->description !!}

                </div>
                <div class="col-lg-2"></div>
                <div class="col bg-light p-4" style="border-radius: 8px;">
                    <img src="{{ $services->find($package)->photo?url( $services->find($package)->photo->path ):'' }}" class="mb-4" style="border-radius: 6px;width: 100%" alt="banner">
                    {{-- @if ($status=='online')
                        <div class="row">
                            <div class="col-lg mb-4">
                                <a  @if (auth()->user())
                                        @if (auth()->user()->amount > $item->price*10) href="{{route('user.call.request',[$item->id,'service'])}}"
                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="btn btn-success col-12">
                                        ۱۰ دقیقه
                                    <small style="font-size: 12px;">
                                        {{number_format($item->price*10).' تومان '}}
                                    </small>
                                </a>
                            </div>
                            <div class="col-lg mb-4">
                                <a  @if (auth()->user())
                                        @if (auth()->user()->amount > $item->price*30) href="{{route('user.call.request',[$item->id,'service'])}}"
                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="btn btn-success col-12">
                                        ۳۰ دقیقه
                                    <small style="font-size: 12px;">
                                        {{number_format($item->price*30).' تومان '}}
                                    </small>
                                </a>
                            </div>
                            <div class="col-lg mb-4">
                                <a  @if (auth()->user())
                                        @if (auth()->user()->amount > $item->price*60) href="{{route('user.call.request',[$item->id,'service'])}}"
                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="btn btn-success col-12">
                                        ۶۰ دقیقه
                                    <small style="font-size: 12px;">
                                        {{number_format($item->price*60).' تومان '}}
                                    </small>
                                </a>
                            </div>
                        </div>
                    @elseif($status=='offline')
                        <a  @if (auth()->user())
                                @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                                    href="{{ route('user.consultation.evoke',$item->user_id) }}"
                                @endunless
                            @else
                                href="#" data-bs-toggle="modal" data-bs-target="#login"
                            @endif class="btn btn-secondary col-12 mb-4">آنلاین شد خبرم کن
                        </a>
                    @endif --}}
                    <div class="float-start text-secondary">
                        <p>
                            {{$item->user()->first_name.' '.$item->user()->last_name}}
                        </p>
                        <p class="my-3">
                            {{$item->info_plus==0?'عمومی':'برتر'}}
                        </p>
                    </div>
                    <p class="text-secondary">مدرس : </p>
                    <p class="mt-3 text-secondary">سطح : </p>

                    <a href="{{ route('user.consultation.edit',$services->find($package)->slug) }}" class="btn btn-success col-12">
                        {{ ' شرکت در کارگاه '.$services->find($package)->title }}
                        <div class="text-dark text-center small">
                            {{ $services->find($package)->price>0?' تومان '.$services->find($package)->price:' رایگان ' }}
                        </div>
                    </a>

                    <div class="p-2">
                        <h5 class="py-4">
                            دوره های من
                        </h5>
        
                        <div class="navbar-4">
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
                                        <div class="mx-2 text-secondary">
                                    @else
                                        <div class="mx-2 text-secondary selected">
                                    @endif
                                        {{$service->title}}
                                        <div class="float-start pe-lg-5 me-lg-5">{{$service->price>0?price( $service->price ).'تومان':'رایگان'}}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

@endsection
