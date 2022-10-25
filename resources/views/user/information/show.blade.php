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
</style>

<section class="blogs"> 
    <div class="col-12">
        <div class="row">
    
            <div class="col-lg-8 pt-lg-4">
                <div class="blog blog-show">
                    @if ($item->count())
                        <div class="items p-4 border-bottom aos-init aos-animate " data-aos="flip-up" onmouseover="newIco(this, '{{$item->id}}')" onmouseout="oldIco(this, '{{$item->id}}')">
                            <h5 class="px-4">{{$item->title}}</h5>

                            <img class="rounded" src="{{url($item->photo)}}" alt="{{$item->title}}">
                            
                            <h5 class="px-4 mb-3 fs-6">{{$item->short_text}}</h5>
                            
                            <p class="px-4">{!! $item->text !!}</p>

                            <small class="px-4">
                                {{' نویسنده : '.$item->user()->first_name.' '.$item->user()->last_name}}
                                <span class="text-secondary mx-1">{{my_jdate($item->updated_at,'d F Y')}}</span>
                            </small>
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
    
            <div class="col-lg-4">
                <div class="cats">
    
                    <h6>جست‌و‌جو</h6>
                    
                    <form id="searchForm" action="{{ route('user.post.store') }}" method="POST">
                        @csrf
                        <div class="searchbox mt-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn"><i class="fas fa-search"></i></button>
                                </div>
                                <input type="text" onclick="manualySubmit()" class="form-control" id="inlineFormInputGroupSubmitable" placeholder="...جست‌و‌جو">
                            </div>
                        </div>
                    </form>
                    

                    <script>
                        function manualySubmit() {
                            if (event.key === "Enter") {
                                document.getElementById("searchForm").submit();
                            }
                        }
                    </script>
    
                    <h6 class="pt-5">تازه‌ها</h6>

                    @foreach ($latest as $item)
                        <div class="pt-4">
                            <div>
                                <a href="{{ route('user.post.show',$item->slug) }}" class="link">{{$item->title}}</a>
                            </div>
                            <span class="text-secondary">{{my_jdate($item->updated_at,'d F Y')}}</span>
                        </div>
                    @endforeach
                    
                    <h6 class="pt-5">آخرین دید‌گاه‌ها</h6>
                    
                    
                    <h6 class="pt-5">بایگانی</h6>
                    
                    <div class="pt-2"></div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="pt-2">
                            <a href="#" class="link">آگوست 2020</a>
                        </div>
                    @endfor
                    
                    <h6 class="pt-5">دسته‌ها</h6>
                       
                    <div class="pt-3">
                        <a href="{{ route('user.post.index.type','بلاگ') }}" class="link">بلاگ ها</a>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route('user.post.index.type','آموزش') }}" class="link">آموزش ها</a>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route('user.post.index.type','اطلاعیه') }}" class="link">اطلاعیه ها</a>
                    </div>

                </div>
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