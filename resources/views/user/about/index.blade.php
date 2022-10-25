@extends('layouts.layout_first_page')
@section('content')
<style>
    .text-{
        text-align: justify;
    }
</style>
<section class="about">
    <div class="container pb-4">

        <h6 class="text-secondary py-4">درباره ما / تماس با ما</h6>

        <div class="body bg-white p-4">
            <div class="row">
                <div class="col-lg-6">
                        <h2 class="py-4 d-flex">
                            <div class="line"></div>
                            {{ $item->title_home }}
                        </h2>
                    
                        {!! $item->text_home !!}
                        
                        @foreach ($items->where('join_title','آدرس اول') as $item)
                            <div class="d-flex">
                                <img src="{{ url($item->join_pic) }}" alt="{{ $item->join_title }}" style="width: 24px;height: 24px;margin-left: 8px;">
                                {!! $item->join_text !!}
                            </div>
                        @endforeach
                        @foreach ($items->where('join_title','آدرس دوم') as $item)
                            <div class="d-flex">
                                <img src="{{ url($item->join_pic) }}" alt="{{ $item->join_title }}" style="width: 24px;height: 24px;margin-left: 8px;">
                                {!! $item->join_text !!}
                            </div>
                        @endforeach
                        @foreach ($items->where('join_title','تلفن') as $item)
                            <div class="d-flex">
                                <img src="{{ url($item->join_pic) }}" alt="{{ $item->join_title }}" style="width: 24px;height: 24px;margin-left: 8px;">
                                {!! $item->join_text !!}
                            </div>
                        @endforeach
                        @foreach ($items->where('join_title','فکس') as $item)
                            <div class="d-flex">
                                <img src="{{ url($item->join_pic) }}" alt="{{ $item->join_title }}" style="width: 24px;height: 24px;margin-left: 8px;">
                                {!! $item->join_text !!}
                            </div>
                        @endforeach
                </div>
                <div class="col-lg-6 my-auto">
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6471.997662025919!2d51.39949697383948!3d35.79996202066688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e062989720ed1%3A0x7db61b8a5a42893d!2z2K_Yp9mG2LTaqdiv2Ycg2LnZhNmI2YUg2LLZhduM2YYg2K_Yp9mG2LTar9in2Ycg2LTZh9uM2K8g2KjZh9i02KrbjA!5e0!3m2!1sfa!2s!4v1661333910918!5m2!1sfa!2s" width="100%" height="360" style="border-radius: 2px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                    <iframe src="{{ \App\Model\Setting::first('map')?\App\Model\Setting::first('map')->map:'' }}" width="100%" height="360" style="border-radius: 2px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <h2 class="py-4 d-flex">
                <div class="line"></div>
                تماس با ما
            </h2>
            
            <form action="{{ route('user.forms.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input value="contact" name="type" type="hidden">

                <div class="row">

                    <div class="col-12 mb-4">
                        <label class="mb-2" for="title">با کدام بخش می خواهید تماس بگیرید *</label>
                        <select name="title" class="form-control">
                            <option value="بخش مدیریت" selected>مدیریت</option>
                            <option value="بخش مشاوران" >مشاوران</option>
                        </select>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="name">نام و نام خانوادگی *</label>
                        <input class="form-control" name="name" placeholder="نام" required type="text">
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="mobile">شماره تماس *</label>
                        <input class="form-control" name="mobile" placeholder="۹۱۳۱۶۳۷۷۹۹" required type="text">
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="subject">عنوان *</label>
                        <input class="form-control" name="subject" placeholder="عنوان" required type="text">
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="attach"> فایل پیوست</label>
                        <input class="form-control" name="attach" type="file">
                    </div>

                    <div class="col-12 mb-4">
                        <label class="mb-2" for="text">شرح پیام</label>
                        <textarea name="text" class="form-control" rows="4" placeholder="شرح پیام" required></textarea>
                    </div>

                    <div class="col-lg-3 col-md-6 col-8">
                        <button type="submit" class="btn btn-primary col-12">ارسال فورم</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</section>

@endsection