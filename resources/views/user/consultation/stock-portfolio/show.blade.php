@extends('layouts.layout_first_page')
@section('content')

{{-- <div id="top_banner">
    <img src="https://www.bourse.lu/img/banner-CAREERS.jpg" alt="banner">
    <div><h1 class="text-center">مجله خبری</h1></div>
</div> --}}
<style>
    section.blogs .blog-show img {
        width: 94%;
        height: 470px;
        border: 1px solid gray;
        margin: 17px 0px;
        margin-right: 3%;
    }
    section.blogs .items:hover img {
        /* padding: 8px; */
        width: 96%;
        height: 480px;
        margin: 12px 0px;
        margin-right: 2%;
        transition: 0.4s;
        opacity: 0.6;
    }
    video {
        width: 100%;
        height: auto;
    }
</style>

<section class="blogs"> 
    <div class="col-12">
        <div class="container">
    
                <div class="blog blog-show p-0">
                    <h1 class="text-center m-0">
                        <img src="{{asset('/assets/stock/1.png')}}" class="pb-2" style="max-height: 62px;width: unset;border: none;" alt="مانا باشید"> 
                        مانا باشید
                    </h1>
                    @if ($item->count())
                        <div class="items px-lg-4 border-bottom aos-init aos-animate " data-aos="flip-up" onmouseover="newIco(this, '{{$item->id}}')" onmouseout="oldIco(this, '{{$item->id}}')">
                            <h5 class="px-4">{{$item->title}}</h5>

                            @if ($item->photo)
                                <img class="rounded" src="{{url($item->photo)}}" alt="{{$item->title}}">
                            @elseif($item->video)
                                <video controls><source src="{{$item->video?url($item->video):''}}" type="video/mp4"></video>
                            @endif
                            
                            <h5 class="px-4 mb-3 fs-6">{{$item->short_text}}</h5>

                            <div class="px-2 px-lg-4">
                                {!! $item->text !!}
                            </div>

                            @if ($item->file)
                                <div class="mb-4">
                                    <a href="{{ url($item->file) }}" class="p-2 px-lg-3" target="_blank">{{$item->file_title?$item->file_title:'مشاهده فایل پیوست شده'}}</a>
                                </div>
                            @endif

                            @if ($item->photo && $item->video)
                                <video controls><source src="{{url($item->video)}}" type="video/mp4"></video>
                            @endif

                            <small class="px-4">
                                {{' نویسنده : '.$item->writer}}
                                <span class="text-secondary mx-1">{{my_jdate($item->updated_at,'d F Y')}}</span>
                            </small>

                            <h6 class="mt-5 text-center font-weight-bold">
                                <ins>
                                    <i>www.manabourse.com</i>
                                </ins>
                            </h6>

                        </div>
                    @else
                        <div class="items p-4 border-bottom">
                            <div class="hashtaq mb-4 py-2">
                                <a class="p-2 px-3" href="#">{{$type}}</a>
                            </div>
                            <a href="#"><h5>موردی یافت نشد</h5></a>
                        </div>
                    @endif
                </div>
            
        </div>
    </div>
</section>

<script>
    function newIco(x, index) {
        document.getElementById(`old${index}`).classList.add("d-none");
        document.getElementById(`new${index}`).classList.remove("d-none");
    }
    
    function oldIco(x, index) {
        document.getElementById(`new${index}`).classList.add("d-none");
        document.getElementById(`old${index}`).classList.remove("d-none");
    }
</script>
    
@endsection