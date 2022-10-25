@extends('layouts.layout_first_page')
@section('content')
<style>
    .only-white p , .only-white h6 , .only-white h5 , .only-white h4 , .only-white h3 , .only-white h2 , .only-white h1 {
        color: white !important;
    }
    .hover-white:hover a {
        background: whitesmoke !important;
        color: #003b5c !important;
        transition: 0.4s;
    }
    #likes {
        float: left;
        position: relative;
        top: -46px;
    }
    #likes a:hover .svg-inline--fa {
        color: #ffc107 !important;
        transition: 0.2s;
    }
</style>
<div class="bg-light-yasi text-white p-3">
    <div class="container">
        <div class="row " id="top-consultation">
            <div class="col-2 my-lg-auto">
                <img class="float-lg-left" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
            </div>
            <div class="col">
                <h1 class="fw-bold text-right text-dark-violet my-lg-2 d-none d-lg-block">{{ ' دسته ی '.\App\Model\ServiceCat::find($item->category_id)->title  }}</h1>
                <h1 class="fw-bold text-right text-dark-violet d-lg-none fs-5">{{ ' دسته ی '.\App\Model\ServiceCat::find($item->category_id)->title  }}</h1>
                <h4 class="text-right text-dark d-none d-lg-block">{{ \App\Model\ServiceCat::find($item->category_id)->text }}</h4>
                <p class="text-right text-secondary mb-0">آخرین بروزرسانی : {{my_jdate(\App\Model\ServiceCat::find($item->category_id)->updated_at,'d F Y')}}</p>
            </div>
        </div>
    </div>
</div>

<section class="about bg-white">
    <div class="container pb-4">

        <div class="body p-4">
            {{-- <div class="col-xl-6 col-lg-7 col-md-10 mx-auto my-4">
                <a href="{{URL::previous()}}">
                    <div class="bg-light-orange text-center text-white py-1 fs-2 fw-bold">
                        {{ \App\Model\ServiceCat::find($item->category_id)->title }}
                    </div>
                </a>
            </div> --}}

            <div class="card">
                <div class="row bg-dark-violet p-3 pt-lg-5">
                    <div class="col-lg-8 my-auto">
                        <div class="border-left-gray text-center">
                            <div class="ps-lg-5">
                                <div class="row">
                                    <div class="col-3 col-lg-2 mm my-auto">
                                        <img class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" src="{{ url($item->user()->photo->path) }}" alt="avatar">
                                        <div class="point {{$status=='online'?'btn-success':'btn-danger'}}"
                                        style="position: relative;right: 68px;bottom: 10px;"></div>
                                    </div>
                                    <div class="col">
                                        <div class="d-none d-lg-block">
                                            <div class="col-xl-6 col-lg-7 float-start p-0">
                                                @if ($status=='online')
                                                    <div class="row">
                                                        <div class="col p-0 hover-white">
                                                            <a  @if (auth()->user())
                                                                    @if (auth()->user()->amount > $item->price*10) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                                @else
                                                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                                @endif class="float-start text-white h6 text-center rounded shadow p-2">
                                                                {{-- <img src="https://img.icons8.com/external-flat-icons-inmotus-design/24/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/> --}}
                                                                <h5 class="pt-2 text-center fw-bold">
                                                                    ۱۰ دقیقه
                                                                </h5>
                                                                <small style="font-size: 12px;">
                                                                    {{number_format($item->price*10).' تومان '}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                        <div class="col p-0 hover-white">
                                                            <a  @if (auth()->user())
                                                                    @if (auth()->user()->amount > $item->price*30) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                                @else
                                                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                                @endif class="float-start text-white h6 text-center rounded shadow p-2">
                                                                {{-- <img src="https://img.icons8.com/external-flat-icons-inmotus-design/24/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/> --}}
                                                                <h5 class="pt-2 text-center fw-bold">
                                                                    ۳۰ دقیقه
                                                                </h5>
                                                                <small style="font-size: 12px;">
                                                                    {{number_format($item->price*30).' تومان '}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                        <div class="col p-0 hover-white">
                                                            <a  @if (auth()->user())
                                                                    @if (auth()->user()->amount > $item->price*60) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                                @else
                                                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                                @endif class="float-start text-white h6 text-center rounded shadow p-2">
                                                                {{-- <img src="https://img.icons8.com/external-flat-icons-inmotus-design/24/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/> --}}
                                                                <h5 class="pt-2 text-center fw-bold">
                                                                    ۶۰ دقیقه
                                                                </h5>
                                                                <small style="font-size: 12px;">
                                                                    {{number_format($item->price*60).' تومان '}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @elseif($status=='offline')
                                                    <a  @if (auth()->user())
                                                            @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                                                                href="{{ route('user.consultation.evoke',$item->user_id) }}"
                                                            @endunless
                                                        @else
                                                            href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                        @endif class="float-start text-white h6 text-center">
                                                        <img src="https://img.icons8.com/external-flat-icons-inmotus-design/40/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/>
                                                        <h5 class="pt-2 text-center fw-bold">
                                                            آنلاین شد
                                                            خبرم کن
                                                        </h5>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <h4 class="text-white text-start text-lg-end fw-bold pt-lg-3 pb-lg-2">{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                                        <h6 class="text-white text-start text-lg-end ms-lg-5 ps-lg-5">{{$item->title}}</h6>
                                    </div>

                                    <div class="d-lg-none">
                                        <div class="col-12 mt-2 mb-4">
                                            @if ($status=='online')
                                                <a  @if (auth()->user())
                                                        @if (auth()->user()->amount > $item->price) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                    @else
                                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                    @endif class="btn btn-sm btn-light col-12">
                                                    <img class="mx-2" src="{{ asset('assets/images/call.gif') }}" class="rounded" style="width: 24px !important;height: 24px !important;" alt="call">
                                                    تماس
                                                </a>
                                            @elseif($status=='offline')
                                                <a  @if (auth()->user())
                                                        @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                                                            href="{{ route('user.consultation.evoke',$item->user_id) }}"
                                                        @endunless
                                                    @else
                                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                    @endif class="btn btn-sm btn-light col-12">
                                                    <img class="mx-2" src="https://img.icons8.com/external-flat-icons-inmotus-design/22/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/>
                                                    {{-- <img class="mx-2" src="{{ asset('assets/images/call.gif') }}" class="rounded" style="width: 24px !important;height: 24px !important;" alt="call"> --}}
                                                    آنلاین شد
                                                    خبرم کن
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg my-auto box-5">
                        <div class="me-lg-5">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex">
                                        <h2 class="m-0 ms-3 fw-bold text-white">{{\App\Model\CallRequest::where('consultant_id',$item->user_id)->count()}}</h2>
                                        <i class='fas fa-phone text-white h5'></i>
                                    </div>
                                    <h6 class="fw-bold text-white">
                                        تماس ها
                                    </h6>
                                </div>
                                <div class="col" onclick="goToComments()" style="cursor: pointer;">
                                    <div class="d-flex">
                                        <h2 class="m-0 ms-3 fw-bold text-white">{{$comments->count()}}</h2>
                                        <i class='fas fa-comment text-white h5'></i>
                                    </div>
                                    <h6 class="fw-bold text-white">
                                        نظرات دادن
                                    </h6>
                                </div>
                                <div class="col" onclick="goToLikes()" style="cursor: pointer;">
                                    <div class="d-flex">
                                        <h2 class="m-0 ms-3 fw-bold text-white">{{intval( $likes->sum('star') / 5 ) + 1 }}</h2>
                                        <span class="fa fa-star text-warning h5"></span>
                                    </div>
                                    <h6 class="fw-bold text-white">
                                        امتیاز دادن
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">    
                        <div class=" only-white">
                            <div class="p-2 p-lg-4">{!!$item->text!!}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <h5 class="pt-4 mt-lg-2 fw-bold">جدول زمانی</h5>
                    <div class="row">
                        <div class="col-4 p-2 p-lg-4" style="color: #00788D;">روز های هفته</div>
                        <div class="col p-2 p-lg-4" style="color: #00788D;">ساعت شروع کار</div>
                        <div class="col p-2 p-lg-4" style="color: #00788D;">ساعت پایان کار</div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-2 p-lg-4">شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->shanbe}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_shanbe}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">یکشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->yekshanbe}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_yekshanbe}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">دوشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->doshanbe}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_doshanbe}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">سه شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->seshanbe}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_seshanbe}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">چهارشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->chaharshanbe}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_chaharshanbe}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">پنج شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->panjshanbe}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_panjshanbe}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">جمعه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;"> از ساعت {{$item->jome}}</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #dae1e566;"> تا ساعت {{$item->e_jome}}</div>
                    </div>
                </div>
                <div class="col-lg-2 d-none d-lg-block"></div>
                <div class="col-lg">
                    <div class="col-12">
                        <img src="{{ asset('assets/images/qqq.png') }}" class="rounded p-2 px-lg-5 mx-auto" style="max-height:128px" alt="banner">
                    </div>

                    <div class="row p-2">
                        <div class="col p-2 p-lg-4 mx-1 text-center" style="background: #f2f5f766;">
                            مشاوره ۱۰ دقیقه
                            <br>
                            {{number_format($item->price*10).' تومان '}}
                        </div>
                        <div class="col p-2 p-lg-4 mx-1 text-center" style="background: #dae1e566;">
                            مشاوره ۳۰ دقیقه
                            <br>
                            {{number_format($item->price*30).' تومان '}}
                        </div>
                        <div class="col p-2 p-lg-4 mx-1 text-center" style="background: #f2f5f766;">
                            مشاوره ۶۰ دقیقه
                            <br>
                            {{number_format($item->price*60).' تومان '}}
                        </div>
                    </div>
                    
                    @foreach ($services as $index => $service)
                        <a href="{{ route('user.consultation.edit',$service->slug) }}">
                            <div class="col p-2 p-lg-4 mb-2 text-dark text-center" style="background: #f2f5f766;@if($index%2==0) background: #dae1e566 !important; @endif">{{$service->title}}</div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="comments py-3 py-lg-5" id="comments">
                @foreach ($comments as $comment)
                    <div class="border rounded mb-3">
                        <div class="row">
                            <div class="col my-auto">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-3 mm text-start">
                                        <img class="border" src="{{ $comment->user()->photo ? url($comment->user()->photo->path) : asset('admin/img/user.png') }}" alt="avatar">
                                    </div>
                                    <h6 class="m-0 col">{{ $comment->user()->first_name.' '.$comment->user()->last_name }}</h6>
                                </div>
                            </div>
                            <div class="col text-start">
                                <img class="" style="height: 100px;opacity: 0.4;" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
                            </div>
                        </div>
                        <div class="mx-4 mb-3 px-lg-5">
                            <hr>
                            {{$comment->text}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="border rounded">
                <form action="{{ route('user.comment.store') }}" method="POST" class="form">
                    <div class="row">
                        <div class="col my-auto">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 col-6 mm text-start">
                                    <img class="border" src="{{ auth()->user()->photo ? url(auth()->user()->photo->path) : asset('admin/img/user.png') }}" alt="avatar">
                                </div>
                                <h6 class="m-0 col">
                                    {{ auth()->user()->first_name.' '.auth()->user()->last_name }}
                                </h6>
                            </div>
                        </div>
                        <div class="col text-start">
                            <img class="" style="height: 100px;opacity: 0.4;" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
                        </div>
                    </div>
                    <div class="mx-4 mb-3 px-lg-5">
                        @csrf
                        <input type="hidden" name="type" value="consultation">
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <textarea name="text" rows="3" class="form-control" placeholder="لطفا نظر خود را درباره مشاور وارد کنید" required></textarea>
                        <button type="submit" class="btn btn-primary mt-3">ارسال نظر</button>
                    </div>
                </form>

                @if ( $likes->where('user_id',auth()->user()->id)->count()<1 )
                    <div id="likes" class="ps-lg-5 ms-4">
                        <a href="javascript:void(0);" onclick="setLike(5)">
                            <span class="fa fa-star text-dark h5"></span>
                        </a>
                        <a href="javascript:void(0);" onclick="setLike(4)">
                            <span class="fa fa-star text-dark h5"></span>
                        </a>
                        <a href="javascript:void(0);" onclick="setLike(3)">
                            <span class="fa fa-star text-dark h5"></span>
                        </a>
                        <a href="javascript:void(0);" onclick="setLike(2)">
                            <span class="fa fa-star text-dark h5"></span>
                        </a>
                        <a href="javascript:void(0);" onclick="setLike(1)">
                            <span class="fa fa-star text-dark h5"></span>
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <form action="{{ route('user.like.store') }}" method="POST" id="form-like" class="likes d-none">
            <div class="mx-4 mb-3 px-lg-5">
                @csrf
                <input type="hidden" name="type" value="consultation">
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <input type="text" name="star" id="star">
                <button type="submit" class="btn btn-sm btn-light">لایک</button>
            </div>
        </form>

    </div>
</section>

<script>
    function goToComments() {
        var scrollDiv = document.getElementById("comments").offsetTop;
        window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
    }
    function goToLikes() {
        var scrollDiv = document.getElementById("likes").offsetTop;
        window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
    }
    function sendLike() {
        document.getElementById("form-like").submit();
    }
    function setLike(like) {
        document.getElementById("star").value = like;
        sendLike();
    }
</script>
@endsection
