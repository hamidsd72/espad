@extends('layouts.layout_first_page')
@section('content')

<style>
    .text-blue {
        color: #00788D;
    }
    .hover-orange:hover {
        color: #ffa06a !important;
    } 
    section.about .top-consultation , section.about .top-consultation .box {
        max-height: 276px;
    }
    section.about .top-consultation img {
        width: 100%;
        height: 276px;
    }
    section.about .top-consultation .background-layer {
        position: relative;
        height: 276px;
        top: -276px;
        background: linear-gradient(rgba(0, 121, 141, 0.75), rgba(0, 121, 141, 0.75));
    }
    section.about .top-consultation .background-layer-after {
        position: relative;
        height: 276px;
        width: 0px;
        top: -552px;
        background: #00788D;
    }
    section.about .top-consultation:hover .background-layer-after {
        width: 100%;
        transition: 1s;
    }
    section.about .top-consultation .data {
        position: relative;
        top: -700px;
    }
    section.about .top-consultation .data .description {
        display: none;
    }
    section.about .top-consultation:hover .data {
        top: -774px;
        transition: 1s;
    }
    section.about .top-consultation:hover .description {
        display: unset;
        transition: 1s;
    }
    section.about .top-consultation button {
        position: relative;
        top: -60px;
        width: 60px;
        height: 60px;
        border: none;
    }
    section.about .top-consultation button .after {
        display: none;
    }
    section.about .top-consultation:hover .before {
        display: none;
        transition: 1s;
    }
    section.about .top-consultation:hover .after {
        display: unset;
        transition: 1s;
    }
    section.about .list-item2 img {
        width: 100%;
        height: 90px;
    }
    section.about .list-item2 img.avatar {
        width: 48px;
        height: 48px;
        border-radius: 50px;
    }
</style>
<section class="about">
    <div class="container pb-4">

        <h6 class="text-secondary py-4">مشاورین برتر</h6>

        <div class="body bg-white p-4">
            
            <div class="row">
                @for ($i = 0; $i < 3; $i++)
                    <a href="#" class="col-lg-4">
                        <div class="top-consultation mb-4">
                            <div class="box">
                                <img class="rounded" src="https://img.business.com/h/300/aHR0cHM6Ly9pbWFnZXMuYnVzaW5lc3MuY29tL2FwcC91cGxvYWRzLzIwMjIvMDMvMjMwMzIxMDQvaG9tZV9vZmZpY2VfS2l3aXNfZ2V0dHktMy5qcGc=" alt="banner">
                                <div class="background-layer rounded"></div>
                                <div class="background-layer-after rounded"></div>
                                <div class="data">
                                    <h4 class="text-center text-white pb-4">احمد صمدیان</h4>
                                    <div class="description">
                                        <p class="text-center text-white my-3 ln-1">
                                            کارشناس حقوق قضا
                                            <br>
                                            رفتن به پروفایل مشاور
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
                @endfor
            </div>
            
            <div class="card mb-4">
                <div class="card-header text-center p-4">
                    <a href="#" class="text-blue h4 text-center">More Best Picks</a>
                </div>
                <div class="card-body row">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="col-lg-4 col-md-6 p-4 text-center">
                            <a href="#" class="text-dark-violet h4 hover-orange fw-light">Telemedicine Software</a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="p-4">
                <h4 class="text-blue">Trending Articles for Maintaining Your Business</h4>
                <div class="row">
                    @for ($i = 0; $i < 5; $i++)
                        <div class="col-lg-6 text-center">
    
                            <div class="row list-item2 py-4">
    
                                <div class="col-lg-3 p-0">
                                    <img src="https://img.business.com/rc/100x75/aHR0cHM6Ly9pbWFnZXMuYnVzaW5lc3MuY29tL2FwcC91cGxvYWRzLzIwMjIvMDMvMjMwMjAzMzkvQWNjb3VudGluZ19Tb2Z0d2FyZV9BbmRyZXlQb3Bvdl9HZXR0eS0zLmpwZw==" alt="avatar">
                                </div>
    
                                <div class="col">
                                    <a href="#" class="hover-orange">
                                        <h5 class="text-dark fw-light hover-orange">
                                            How Small Businesses Can Budget for a Tumultuous Year
                                        </h5>
                                        <p class="mb-1 text-secondary hover-orange">
                                            Creating a business budget for the new year is challenging when it's not clear when the pandemic will end. Here's how to budget for an uncertain 2021.
                                        </p>
                                    </a>
                                    <img class="avatar" src="https://img.business.com/w/32/aHR0cHM6Ly9pbWFnZXMuYnVzaW5lc3MuY29tL2FwcC91cGxvYWRzLzIwMjEvMTIvMTIwNjE3MDYvZG9ubmEtZnVzY2FsZG8ucG5n" alt="avatar">
                                    <span class="text-secondary px-1">Donna Fuscaldo</span>
                                </div>
                                
                            </div>
                            
                        </div>
                    @endfor
                </div>
            </div>

        </div>

    </div>
</section>

@endsection