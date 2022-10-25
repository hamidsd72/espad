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
    section.about .navbar-4 .point {
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
</style>

<section class="about">

    <div class="bg-gradient-blue text-white p-4 p-lg-0 py-lg-5">
        <h1 class="fw-bold text-center">The Best Business Phone Systems of 2022</h1>
        <h5 class="text-center text-light-blue">
            By Jessica Elliott, business.com Contributing Writer Updated Aug 18, 2022
        </h5>
        <div class="text-center pb-lg-5 mb-lg-5">
            Our team of experts has compared the best small business phone systems for 2022. See up-to-date comparisons, reviews and costs for the top-rated services.
        </div>
    </div>

    <div class="container py-4">

        <div class="body bg-white p-4">
                
            <div class="swiper mySwiper swiper-initialized swiper-horizontal swiper-ios swiper-backface-hidden">
                <div class="swiper-wrapper" id="swiper-wrapper-c164578535e54f7f" aria-live="polite">

                    @foreach ($items as $key => $item)
                        
                        <div class="swiper-slide" role="group" aria-label="{{$key+1}} / 7" style="width: 375px; margin-right: 10px;">
                            <div class="card-hover">
                                <div class="card card-rounded shadow" style="border: none;">
                                    <div class="card-header header-dark-blue">
                                        <h6 class="text-center text-white mb-0">لورم ایپسوم متن ساختگی با تولید سادگی با استفاده از طراحان گرافیک است</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        {{-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScFO4r1R_iPEfkV2PljLuQI3VXX3zb8zc0yg&usqp=CAU" class="avatar" alt="avatar"> --}}
                                        <img class="mx-auto p-1 px-3" src="https://img.business.com/h/50/aHR0cHM6Ly9pbWFnZXMuYnVzaW5lc3MuY29tL2FwcC91cGxvYWRzLzIwMjIvMDgvMDEwMzQzNTgvcmluZ2NlbnRyYWxfbG9nby5wbmc=" alt="banner" width="100%;">
                                        <a href="#">
                                            <h6 class="text-center text-info my-2">{{$item->title}}</h6>
                                        </a>
                                        <div class="mx-lg-2">
                                            <button class="btn btn-lg text-white col-12 call mt-3">
                                                <i class='fas fa-phone-alt'></i>
                                                شروع مشاوره
                                            </button>
                                            <button onclick="location.href = '{{url('/')}}'+'/consultation/'+'{{$item->id}}'" class="btn btn-lg col-12 my-4 about">
                                                لیست مشاوران
                                            </button>
                                            <a href="#">
                                                <p class="descrption">
                                                    <span class="circle-icon-dark-blue">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    درخواست قرارداد</p>
                                            </a>
                                            <a href="#">
                                                <p class="descrption">
                                                    <span class="circle-icon-dark-blue">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    درخواست مشاوره حضوری</p>
                                            </a>
                                            <a href="#">
                                                <p class="descrption">
                                                    <span class="circle-icon-dark-blue">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    ارسال پیام</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
                
            </div>

            <div class="row direction_ltr mb-4">

                <div class="col navbar-4">
                    @foreach ($items as $key => $item)

                        @if ($key>0)
                            <div class="line-top"></div>    
                        @endif
                        <a href="{{ route('user.consultation.show',$item->id) }}" class="d-flex">
                            <div class="circle">
                                @if ($key>0)
                                    <div class="">
                                @else
                                    <div class="point">
                                @endif
                                {{-- <div class="point"> --}}
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
                </div>
                <div class="col-10 my-auto" style="text-align: justify;direction: rtl;">
                    <h4>
                        The Best Business Phone Systems
                    </h4>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                </div>

            </div>

        </div>
    </div>
</section>

@endsection