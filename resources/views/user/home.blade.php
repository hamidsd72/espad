@extends('layouts.layout_first_page')
@section('content')

@if($key==0)
    .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:after
    {
        background: {{$cat_css->bg_color}};
    }
    .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:after
    {
        background: {{$cat_css->bg_color_hover}};
    }
<main id="home">
    <!-- slider-->
    {{-- <section class="slider_top">
        <div class="swiper mySwiper slider_single">
            <div class="swiper-wrapper">
                @foreach ($sliders as $item)
                    <div class="swiper-slide">
                        <div class="slider_top_card">
                            <img src="{{$item->photo->path}}" alt="{{$item->title}}">
                            <div class="text_slider">
                                <div class="text_in">
                                    <h5>{{$item->title}}</h5>
                                    <p>{{$item->description}}</p>
                                    <a href="{{$item->link}}">
                                        <div class="scale-up-center">
                                            {{$item->link_title}}
                                            <i class="fas fa-angle-left"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}
    <a href="#">
        <img class="float-lg-left" width="148px" src="{{ asset('assets/images/banner.jpg') }}" alt="banner">
    </a>

    <section class="service_cats_items">
        <div class="container">
            <div class="col-12">
                <div class="row" >
                    {{-- @foreach($serviceCats->take(6) as $key => $service)
                        <div class="col-lg-4 mb-lg-5">
                            <div class="row direction_ltr items @if ($key==1||$key==4) border-gray @endif">
                                <div class="col-4 col-lg-12 my-auto">
                                    <img src="{{is_null($service->pic)?'https://www.bourse.lu/img/+news-HP-LUXSE-Avis-LuxRI_2022.jpg':url($service->pic)}}" alt="{{$service->title}}">
                                </div>
                                <div class="col-8 col-lg-12 px-lg-5">
                                    <a href="#" target="_blank">
                                        <div class="items_header">
                                            {{$service->title}}
                                        </div>
                                    </a>
                                    <div class="items_description mb-3 mb-lg-4">
                                        {{$service->description}}
                                        توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                    </div>
                                    <a href="{{ route('user.services',$service->id) }}" class="items_footer text-center text-light">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        نمایش
                                    </a>
                                </div>
                            </div>
                            @unless ($key==5) <hr class="d-lg-none mx-3 my-5">  @endunless
                        </div>
                    @endforeach --}}
                    <div class="col-lg-4 mb-lg-5">
                        <div class="row direction_ltr items">
                            <div class="col-4 col-lg-12 my-auto">
                                <img src="https://cdn.isna.ir/d/2020/02/29/3/61584261.jpg" alt="">
                            </div>
                            <div class="col-8 col-lg-12 px-lg-5">
                                <a href="#" target="_blank">
                                    <div class="items_header pt-lg-2">
                                        مالیات
                                    </div>
                                </a>
                                <div class="items_description mb-3 mb-lg-4">
                                    توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                </div>
                                <a href="#" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    نمایش
                                </a>
                            </div>
                        </div>
                        <hr class="d-lg-none mx-3 my-5">
                    </div>

                    <div class="col-lg-4 mb-lg-5">
                        <div class="row direction_ltr items border-gray">
                            <div class="col-4 col-lg-12 my-auto">
                                <img src="https://static4.donya-e-eqtesad.com/servev2/5wiBxiLiuPYG/aztreVakjSU,/%D9%82%DB%8C%D9%85%D8%AA-%D8%B7%D9%84%D8%A7-%D8%A7%D9%85%D8%B1%D9%88%D8%B2.jpg" alt="">
                            </div>
                            <div class="col-8 col-lg-12 px-lg-5">
                                <a href="#" target="_blank">
                                    <div class="items_header pt-lg-2">
                                        طلا
                                    </div>
                                </a>
                                <div class="items_description mb-3 mb-lg-4">
                                    توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                </div>
                                <a href="#" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    نمایش
                                </a>
                            </div>
                        </div>
                        <hr class="d-lg-none mx-3 my-5">
                    </div>

                    <div class="col-lg-4 mb-lg-5">
                        <div class="row direction_ltr items">
                            <div class="col-4 col-lg-12 my-auto">
                                <img src="https://iran-gharardad.com/wp-content/uploads/2018/10/%D9%82%D8%B1%D8%A7%D8%B1%D8%AF%D8%A7%D8%AF-%D9%81%D8%B1%D9%88%D8%B4-%D8%A7%D9%82%D8%B3%D8%A7%D8%B7%DB%8C-%DA%A9%D8%A7%D9%84%D8%A7.jpg" alt="">
                            </div>
                            <div class="col-8 col-lg-12 px-lg-5">
                                <a href="#" target="_blank">
                                    <div class="items_header pt-lg-2">
                                        امور قرارداد ها
                                    </div>
                                </a>
                                <div class="items_description mb-3 mb-lg-4">
                                    توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                </div>
                                <a href="#" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    نمایش
                                </a>
                            </div>
                        </div>
                        <hr class="d-lg-none mx-3 my-5">
                    </div>

                    <div class="col-lg-4 mb-lg-5">
                        <div class="row direction_ltr items">
                            <div class="col-4 col-lg-12 my-auto">
                                <img src="https://www.radcommercialgroup.com/wp-content/uploads/2020/12/%D8%AA%D8%B1%D8%AE%DB%8C%D8%B5-%DA%A9%D8%A7%D9%84%D8%A7-1-1024x732.jpg" alt="">
                            </div>
                            <div class="col-8 col-lg-12 px-lg-5">
                                <a href="#" target="_blank">
                                    <div class="items_header pt-lg-2">
                                        امور گمرک و ترخیص
                                    </div>
                                </a>
                                <div class="items_description mb-3 mb-lg-4">
                                    توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                </div>
                                <a href="#" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    نمایش
                                </a>
                            </div>
                        </div>
                        <hr class="d-lg-none mx-3 my-5">
                    </div>

                    <div class="col-lg-4 mb-lg-5">
                        <div class="row direction_ltr items border-gray">
                            <div class="col-4 col-lg-12 my-auto">
                                <img src="https://hamedamiri.com/wp-content/uploads/2017/07/%D8%AF%D8%B9%D8%A7%D9%88%DB%8C-%D8%AD%D9%82%D9%88%D9%82%DB%8C.jpg" alt="">
                            </div>
                            <div class="col-8 col-lg-12 px-lg-5">
                                <a href="#" target="_blank">
                                    <div class="items_header pt-lg-2">
                                        دعاوی حقوقی
                                    </div>
                                </a>
                                <div class="items_description mb-3 mb-lg-4">
                                    توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                </div>
                                <a href="#" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    نمایش
                                </a>
                            </div>
                        </div>
                        <hr class="d-lg-none mx-3 my-5">
                    </div>

                    <div class="col-lg-4 mb-lg-5">
                        <div class="row direction_ltr items">
                            <div class="col-4 col-lg-12 my-auto">
                                <img src="https://cdn.baharnews.ir/images/docs/000140/n00140417-b.jpg" alt="">
                            </div>
                            <div class="col-8 col-lg-12 px-lg-5">
                                <a href="#" target="_blank">
                                    <div class="items_header pt-lg-2">
                                        کسب و کار های نوین
                                    </div>
                                </a>
                                <div class="items_description mb-3 mb-lg-4">
                                    توضیحات مربوط به این آیتم یک یا دو سطر باشد تراز باشد
                                </div>
                                <a href="#" class="items_footer text-center text-light">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    نمایش
                                </a>
                            </div>
                        </div>
                    </div>





                </div>
                <div class="pt-4 pt-lg-0 blue_link">
                    <a href='#'>
                        نمایش همه موارد
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="nothing_items py-5">
        <div class="container">
            <div class="section-content-text" style="min-height: 30px;"><h2 class="title-3 text-center">متن عنوان این سکشن </h2></div>
            <div class="row">
                <div class="col-lg-6 items">
                    <div class="row px-lg-5">
                        <div class="col-4">
                            <span class="counter">01</span>
                            <img src="https://www.bourse.lu/img/button-LISTING.jpg" alt="">
                        </div>
                        <div class="col-8 my-auto">
                            <h6 class="text-secondary pt-4 pt-lg-0">عنوان پست</h6>
                            <h3>توضیحات مربوط به این پست یک یا دو خط باشد</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 items">
                    <div class="row px-lg-5">
                        <div class="col-4">
                            <span class="counter">02</span>
                            <img src="https://www.bourse.lu/img/button-MARKET_DATA.jpg" alt="">
                        </div>
                        <div class="col-8 my-auto">
                            <h6 class="text-secondary pt-4 pt-lg-0">عنوان پست</h6>
                            <h3>توضیحات مربوط به این پست یک یا دو خط باشد</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4 blue_link">
                <a href="#">
                    نمایش همه موارد
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="video_items py-5 text-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/eJFE2/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>
                    <h5 class="footer_video pt-2">توضیحات مربوط به این ویدیو یک یا دو خط باشد</h5>
                </div>

                <div class="col-lg-6">
                    <div class="row pt-4 pt-lg-0">
                        <div class="col-6">
                            <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/eJFE2/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>
                            <h5 class="footer_video pt-2">توضیحات مربوط به این ویدیو یک یا دو خط باشد</h5>
                        </div>
    
                        <div class="col-6">
                            <style>.h_iframe-aparat_embed_frame{position:relative;}.h_iframe-aparat_embed_frame .ratio{display:block;width:100%;height:auto;}.h_iframe-aparat_embed_frame iframe{position:absolute;top:0;left:0;width:100%;height:100%;}</style><div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/eJFE2/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>
                            <h5 class="footer_video pt-2">توضیحات مربوط به این ویدیو یک یا دو خط باشد</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="title_site p-4 p-lg-5 scale-up-center">
        محل نمایش شعار سایت یک الی دو خط
    </section>
</main>
    
@endsection