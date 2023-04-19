@extends('layouts.layout_first_page')
@section('content')

{{-- <div id="top_banner">
    <img src="https://www.bourse.lu/img/banner-CAREERS.jpg" alt="banner">
    <div><h1 class="text-center">مجله خبری</h1></div>
</div> --}}

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

                    @foreach ($latest as $item)
                        <div class="pt-4">
                            <div>
                                <a href="{{ route('user.post.show-by-slug',[$item->id ,$item->slug]) }}" class="link">{{$item->title}}</a>
                            </div>
                            <span class="text-secondary">{{my_jdate($item->updated_at,'d F Y')}}</span>
                        </div>
                    @endforeach
                    
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

            <div class="col-lg-8 pt-lg-4">
                <div class="blog">
                    @if ($items->count()==0)
                        <div class="items p-4 border-bottom">
                            <div class="hashtaq mb-4 py-2">
                                <a class="p-2 px-3" href="#">{{$type}}</a>
                            </div>
                            <a href="#"><h5>موردی یافت نشد</h5></a>
                        </div>
                    @endif
                    @foreach ($items as $item)
                        <div class="items p-4 border-bottom aos-init aos-animate " data-aos="flip-up" onmouseover="newIco(this, '{{$item->id}}')" onmouseout="oldIco(this, '{{$item->id}}')">
                            <div class="hashtaq mb-4 py-2">
                                <a class="p-2 px-3" href="#">{{$type??' همه پست ها '}}</a>
                            </div>
                            
                            <a href="{{ route('user.post.show-by-slug',[$item->id ,$item->slug]) }}">
                                <h5>{{$item->title}}</h5>
                                <p class="py-2 mb-0">{{$item->short_text}}</p>
                            </a>
                            
                            <small class="px-4">
                                {{' نویسنده : '.$item->writer}}
                                <span class="text-secondary mx-1">{{my_jdate($item->updated_at,'d F Y')}}</span>
                            </small>
                            <div class="pt-3"><button class="btn btn-outline-info redu20" onclick="window.location.href='{{ route('user.post.show-by-slug',[$item->id ,$item->slug]) }}'">مشاهده</button></div>
                            {{-- <div id="old{{$item->id}}" class="col-12 pt-2 old">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div id="new{{$item->id}}" class="col-12 pt-2 d-none">
                                <i class="fa fa-close text-secondary"></i>
                            </div> --}}
                        </div>
                    @endforeach
                    @if ($items->count())
                        <div class="pagy">{{$items->links()}}</div>
                    @endif
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