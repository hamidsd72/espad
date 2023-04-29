@extends('layouts.layout_first_page')
@section('content')

{{-- <div id="top_banner">
    <img src="https://www.bourse.lu/img/banner-CAREERS.jpg" alt="banner">
    <div><h1 class="text-center">مجله خبری</h1></div>
</div> --}}
<style>
    section.blogs .blog-show img {
        width: 94%;
        border: 1px solid gray;
        margin: 17px 0px;
        margin-right: 3%;
    }
    section.blogs .items:hover img {
        width: 96%;
        margin: 12px 0px;
        margin-right: 2%;
        transition: 0.4s;
    }
    video {
        width: 100%;
        height: auto;
    }
</style>

<section class="blogs">
    <div class="col-12">
        <div class="row">
    
            <div class="col-lg-4">
                <div class="cats">
    
                    <h6>جست‌و‌جو</h6>
                    
                    <form id="searchForm" action="{{ route('user.post.store') }}" method="POST">
                        @csrf
                        <div class="searchbox mt-4">
                            <div class="input-group">
                                <input type="text" onclick="manualySubmit()" class="form-control" id="inlineFormInputGroupSubmitable" placeholder="...جست‌و‌جو">
                                <div class="input-group-prepend">
                                    <button class="btn"><i class="fas fa-search"></i></button>
                                </div>
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

                    @foreach ($latest as $new)
                        <div class="pt-4">
                            <div>
                                <a href="{{ route('user.post.show-by-slug',[$new->id ,$new->slug]) }}" class="link">{{$new->title}}</a>
                            </div>
                            <span class="text-secondary">{{my_jdate($new->updated_at,'d F Y')}}</span>
                        </div>
                    @endforeach
                    
                    {{-- <h6 class="pt-5">آخرین دید‌گاه‌ها</h6>
                    
                    
                    <h6 class="pt-5">بایگانی</h6>
                    
                    <div class="pt-2"></div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="pt-2">
                            <a href="#" class="link">آگوست 2020</a>
                        </div>
                    @endfor --}}
                    
                    <h6 class="pt-5">دسته‌ها</h6>
                       
                    <div class="pt-3">
                        <a href="{{ route('user.post.index.type','بلاگ') }}" class="link">اخبار بنیادی و تحلیل ها</a>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route('user.post.index.type','آموزش') }}" class="link">اموزش های بورسی</a>
                    </div>
                    <div class="pt-3">
                        <a href="{{ route('user.post.index.type','اطلاعیه') }}" class="link"> کدال و مجامع</a>
                    </div>

                </div>
            </div>

            <div class="col-lg-8 pt-lg-4">
                <div class="blog blog-show">
                    <div class="items p-4 border-bottom aos-init aos-animate " data-aos="flip-up" onmouseover="newIco(this, '{{$blog->id}}')" onmouseout="oldIco(this, '{{$blog->id}}')">
                        <h5 class="px-4">{{$blog->title}}</h5>

                        @if ($blog->photo)
                            <img class="rounded" src="{{url($blog->photo)}}" alt="{{$blog->title}}">
                        @elseif($blog->video)
                            <video controls><source src="{{$blog->video?url($blog->video):''}}" type="video/mp4"></video>
                        @endif
                        
                        <h5 class="px-4 mb-3 fs-6">{{$blog->short_text}}</h5>
                        
                        <p class="px-4">{!! $blog->text !!}</p>

                        @if ($blog->file)
                            <div class="mb-4">
                                <a href="{{ url($blog->file) }}" class="p-2 px-lg-3" target="_blank">{{$blog->file_title?$blog->file_title:'مشاهده فایل پیوست شده'}}</a>
                            </div>
                        @endif

                        @if ($blog->photo && $blog->video)
                            <video controls><source src="{{url($blog->video)}}" type="video/mp4"></video>
                        @endif
                        
                        @unless ($type=='اطلاعیه')
                            <small class="px-4">
                                {{' نویسنده : '.$blog->writer}}
                                <span class="text-secondary mx-1">{{my_jdate($blog->updated_at,'d F Y')}}</span>
                            </small>
                        @endunless
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