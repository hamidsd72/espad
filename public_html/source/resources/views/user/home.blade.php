@extends('layouts.layout_first_page')
@section('content')


    <main>
        <!--    slider-->
        <section class="slider_top">
            <!-- Swiper -->
            <div class="swiper mySwiper slider_single">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slider_top_card">
                            <img src="https://www.bourse.lu/img/slider-HP-LGX_DataHub.png" alt="...">
                            <div class="text_slider">
                                <div class="text_in">
                                    <h5>عنوان تست یک</h5>
                                    <p>متن تستی لورم یک</p>
                                    <a href="">لینک جزئیات 1
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider_top_card">
                            <img src="https://www.bourse.lu/img/slider-HP-LGX_CAI.jpg" alt="...">
                            <div class="text_slider">
                                <div class="text_in">
                                    <h5>عنوان تست دو</h5>
                                    <p>متن تستی لورم دو</p>
                                    <a href="">لینک جزئیات 2
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                <div class="swiper-slide">-->
                    <!--                    <div class="slider_top_card">-->
                    <!--                        <img src="https://www.bourse.lu/img/banner-security-tokens.jpg" alt="...">-->
                    <!--                        <div class="text_slider">-->
                    <!--                            <div class="text_in">-->
                    <!--                                <h5>عنوان تست سه</h5>-->
                    <!--                                <p>متن تستی لورم سه</p>-->
                    <!--                                <a href="">لینک جزئیات 3-->
                    <!--                                    <i class="fas fa-angle-left"></i>-->
                    <!--                                </a>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </main>

    
@endsection