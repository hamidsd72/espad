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
                <img src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
            </div>
            <div class="col">
                <h1 class="fw-bold text-right text-dark-violet my-lg-2 d-none d-lg-block">{{ $item->title }}</h1>
                <h1 class="fw-bold text-right text-dark-violet d-lg-none fs-5">{{ $item->title }}</h1>
                <h4 class="text-right text-dark pt-lg-2 d-none d-lg-block">{{ $item->text }}</h4>
                <p class="text-right text-secondary mb-0">آخرین بروزرسانی : {{my_jdate($item->updated_at,'d F Y')}}</p>
            </div>
        </div>
        <div class="text-secondary my-2 mb-lg-4 p-ln-24 head-2">
            {!! $item->description !!}
        </div>
    </div>
</div>

<section class="about">
    <div class="consultation">
        <div class="container text-center py-4">

            <h4 class="my-4 text-center text-light">{{$body->title}}</h4>
            <img class="border" src="{{$body->pic?url($body->pic):''}}" width="100%" height="680px" alt="banner">
            
            <div class="my-4">
                {{$body->text}}
            </div>
        </div>
    </div>
</section>

@endsection

