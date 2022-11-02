@extends('user.master')
@section('content')
<style>
    .ss img {
    width:68px;
    height:68px;
    border-radius:50%;
    object-fit: cover;
    }
    .ss img.online {
        box-shadow: 0 0 0 3px #67e91559, 3px 3px 12px rgb(26 229 14 / 70%); 
    }
    .ss img.ofline {
        box-shadow: 0 0 0 3px #e91f157d, 3px 3px 12px rgb(229 35 14 / 70%);;
    }
    .point {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: relative;
        right: 62px;
        bottom: 10px;
    }
    #likes {
        float: left;
        position: relative;
        top: -44px;
        left: 18px;
    }
</style>

    <div class="mt-5 pt-2">

        <div class="card m-2">
            <div class="card-body">
                <div class="row mb-0">
                    <div class="col-9 my-auto">
                        <h4>{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                        <h6 class="text-secondary pt-2">{{ $item->title }}</h6>
                    </div>
                    <div class="col-3 text-end ss">
                        <img class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" src="{{ url($item->user()->photo->path) }}" alt="avatar">
                        <div class="point {{$status=='online'?'bg-success':'bg-danger'}}"></div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top border-color">
                <div class="row my-2">
                    <div class="col">
                        <div class="bg-light redu20 border p-2">
                            <div class="d-flex">
                                <h2 class="m-0 mx-1 fw-bold text-center">{{\App\Model\CallRequest::where('consultant_id',$item->user_id)->count()}}</h2>
                                <i class='fas fa-phone text-center h5'></i>
                            </div>
                            <h6 class="fw-bold text-center">
                                تماس ها
                            </h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-light redu20 border p-2">
                            <div class="d-flex">
                                <h2 class="m-0 mx-1 fw-bold text-center">{{$comments->count()}}</h2>
                                <i class='fas fa-comment text-center h5'></i>
                            </div>
                            <h6 class="fw-bold text-center">
                                نظرات
                            </h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-light redu20 border p-2">
                            <div class="d-flex">
                                <h2 class="m-0 mx-1 fw-bold text-center">{{intval( $likes->sum('star') / 5 ) + 1 }}</h2>
                                <span class="fa fa-star text-warning h5"></span>
                            </div>
                            <h6 class="fw-bold text-center">
                                امتیازات
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top border-color">
                <div class="mx-auto pb-3">
                    {!! $item->text !!}
                </div>

                @if ($status=='online')
                    <h6>انتخاب پکیج مشاوره</h6>
                    <div class="col-12 my-3">
                        <a  @if (auth()->user()->amount > $item->price*10) href="{{route('user.call.request',[$item->id,'service'])}}"
                            @else href="{{route('user.user-transaction.index')}}" @endif class="btn btn-success col-12 text-dark">
                            ۱۰ دقیقه {{number_format($item->price*10).' تومان '}}
                        </a>
                    </div>
                    <div class="col-12">
                        <a  @if (auth()->user()->amount > $item->price*30) href="{{route('user.call.request',[$item->id,'service'])}}"
                            @else href="{{route('user.user-transaction.index')}}" @endif class="btn btn-success col-12 text-dark">
                            ۳۰ دقیقه {{number_format($item->price*30).' تومان '}}
                        </a>
                    </div>
                    <div class="col-12 my-3">
                        <a  @if (auth()->user()->amount > $item->price*60) href="{{route('user.call.request',[$item->id,'service'])}}"
                            @else href="{{route('user.user-transaction.index')}}" @endif class="btn btn-success col-12 text-dark">
                            ۶۰ دقیقه {{number_format($item->price*60).' تومان '}}
                        </a>
                    </div>
                @elseif($status=='offline')
                    <a  @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                        href="{{ route('user.consultation.evoke',$item->user_id) }}" @endunless class="btn btn-lg btn-success">آنلاین شد خبرم کن
                    </a>
                @endif
                
            </div>
        </div>

        <div class="card mx-2">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link fw-bold active" id="tabhome1230-tab" data-toggle="tab" href="#tabhome1230" role="tab" aria-controls="tabhome1230" aria-selected="false">
                            نظرات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" id="tabhome2231-tab" data-toggle="tab" href="#tabhome2231" role="tab" aria-controls="tabhome2231" aria-selected="false">
                            پکیج و تالارها
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" id="tabhome3233-tab" data-toggle="tab" href="#tabhome3233" role="tab" aria-controls="tabhome3233" aria-selected="true">
                            جدول زمانی
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tabhome1230" role="tabpanel" aria-labelledby="tabhome1230-tab">
                        <h6>نظرات و ارسال امتیاز</h6>

                        <div class="comments py-3 " id="comments">
                            @foreach ($comments as $comment)
                                <div class="border rounded mb-3">
                                    <div class="row mb-0">
                                        <div class="col">
                                            <div class="row mb-0">
                                                <div class="col-4 ss text-start">
                                                    <img class="shadow border" src="{{ $comment->user()->photo ? url($comment->user()->photo->path) : asset('admin/img/user.png') }}" alt="avatar">
                                                </div>
                                                <div class="col my-auto fw-bold">
                                                    {{ $comment->user()->first_name.' '.$comment->user()->last_name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <img style="height: 68px;opacity: 0.4;" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
                                        </div>
                                    </div>
                                    <div class="mx-4 mb-2 px-lg-5">
                                        <hr>
                                        {{$comment->text}}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border rounded">
                            <form action="{{ route('user.comment.store') }}" method="POST" class="form">
                                <div class="row mb-0">
                                    <div class="col ">
                                        <div class="row mb-0">
                                            <div class="col-4 ss text-start">
                                                <img class="shadow border" src="{{ auth()->user()->photo ? url(auth()->user()->photo->path) : asset('admin/img/user.png') }}" alt="avatar">
                                            </div>
                                            <div class="col my-auto fw-bold">
                                                {{ auth()->user()->first_name.' '.auth()->user()->last_name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <img class="" style="height: 68px;opacity: 0.4;" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
                                    </div>
                                </div>
                                <div class="mx-3 mb-3">
                                    @csrf
                                    <input type="hidden" name="type" value="consultation">
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    <textarea name="text" rows="3" class="form-control mt-3" placeholder="لطفا نظر خود را درباره مشاور وارد کنید" required></textarea>
                                    <button type="submit" class="btn btn-primary py-0 mt-3">ارسال نظر</button>
                                </div>
                            </form>
            
                            @if ( $likes->where('user_id',auth()->user()->id)->count()<1 )
                                <div id="likes">
                                    <a href="#" onclick="setLike(5)"><i class="fa fa-star text-warning h6"></i></a>
                                    <a href="#" onclick="setLike(4)"><i class="fa fa-star text-warning h6"></i></a>
                                    <a href="#" onclick="setLike(3)"><i class="fa fa-star text-warning h6"></i></a>
                                    <a href="#" onclick="setLike(2)"><i class="fa fa-star text-warning h6"></i></a>
                                    <a href="#" onclick="setLike(1)"><i class="fa fa-star text-warning h6"></i></a>
                                </div>
                            @endif
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
                    <div class="tab-pane fade" id="tabhome2231" role="tabpanel" aria-labelledby="tabhome2231-tab">
                        <h6>پکیج ها و تالارها</h6>
                        @foreach ($services as $index => $service)
                            <div class="package">
                                <a href="{{ route('user.consultation.edit',$service->slug) }}">
                                    <div class="p-2 mt-2 text-dark text-center" style="background: #f2f5f766;@if($index%2==0) background: #dae1e566 !important; @endif">
                                        {{$service->title}}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    
                    </div>
                    <div class="tab-pane fade" id="tabhome3233" role="tabpanel" aria-labelledby="tabhome3233-tab">
                    
                        <div class="days">
                            <h6>جدول زمانی</h6>
                            <div class="row mb-0">
                                <div class="col p-2" style="color: #00788D;">روز های هفته</div>
                                <div class="col p-2" style="color: #00788D;">ساعت شروع کار</div>
                                <div class="col p-2" style="color: #00788D;">ساعت پایان کار</div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">شنبه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->shanbe))
                                        __________
                                    @else
                                        از ساعت {{$item->shanbe}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->shanbe))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_shanbe}}
                                    @endif
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">یکشنبه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->yekshanbe))
                                        __________
                                    @else
                                        از ساعت {{$item->yekshanbe}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->yekshanbe))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_yekshanbe}}
                                    @endif
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">دوشنبه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->doshanbe))
                                        __________
                                    @else
                                        از ساعت {{$item->doshanbe}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->doshanbe))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_doshanbe}}
                                    @endif
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">سه شنبه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->seshanbe))
                                        __________
                                    @else
                                        از ساعت {{$item->seshanbe}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->seshanbe))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_seshanbe}}
                                    @endif
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">چهارشنبه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->chaharshanbe))
                                        __________
                                    @else
                                        از ساعت {{$item->chaharshanbe}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->chaharshanbe))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_chaharshanbe}}
                                    @endif
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">پنج شنبه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->panjshanbe))
                                        __________
                                    @else
                                        از ساعت {{$item->panjshanbe}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->panjshanbe))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_panjshanbe}}
                                    @endif
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 p-2">جمعه ها</div>
                                <div class="col p-2 mx-1" style="background: #f2f5f766;">
                                    @if (is_null($item->jome))
                                        __________
                                    @else
                                        از ساعت {{$item->jome}}
                                    @endif
                                </div>
                                <div class="col p-2 mx-1" style="background: #dae1e566;">
                                    @if (is_null($item->jome))
                                        __________
                                    @else
                                        تا ساعت {{$item->e_jome}}
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendLike() {
            document.getElementById("form-like").submit();
        }
        function setLike(like) {
            document.getElementById("star").value = like;
            sendLike();
        }
    </script>
@endsection

































{{-- @extends('layouts.user')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endsection
 
@section('content')
    <section class="main-banner-in">
    <span class="shape-1 animate-this" style="transform: translateX(-17.5782px) translateY(-9.99425px);">
        <img src="{{url('source/asset/user/images/shape-1.png')}}" alt="shape">
    </span>
        <span class="shape-2 animate-this" style="transform: translateX(-17.5782px) translateY(-9.99425px);">
        <img src="{{url('source/asset/user/images/shape-2.png')}}" alt="shape">
    </span>
        <span class="shape-3 animate-this" style="transform: translateX(-17.5782px) translateY(-9.99425px);">
        <img src="{{url('source/asset/user/images/shape-3.png')}}" alt="shape">
    </span>
        <span class="shape-4 animate-this" style="transform: translateX(-17.5782px) translateY(-9.99425px);">
        <img src="{{url('source/asset/user/images/shape-4.png')}}" alt="shape">
    </span>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="h1-title">مشخصات خدمات</h1>
                </div>
            </div>
        </div>
    </section>
    <!--Banner End-->

    <!--Banner Breadcrum Start-->
    <div class="main-banner-breadcrum">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-breadcrum">
                        <ul>
                            <li><a href="{{url("/")}}">خانه</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li><a href="#">خدمات</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Banner Breadcrum End-->

    <?php
    $admin = App\User::where('id',1)->first();
    ?>
    <!--Course Detail Start-->
    <section class="main-course-detail-in">
        <div class="container" dir="rtl">
            <div class="row">
                <!--Course Detail Info Start-->
                <div class="col-xl-8 col-lg-7">
                    <div class="course-detail-box">
                        <h2 class="h2-title">{{$item->title}}</h2>
                        <div class="course-detail-user-box">
                            <div class="row align-items-center">
                                <div class="col-xxl-5 col-xl-12 col-lg-12">
                                    <div class="course-detail-instructor-date-box">
                                        <div class="course-detail-instructor">
                                            <div class="course-detail-instructor-img">
                                                <img style="width: 50px;" src="{{$admin->photo? url($admin->photo->path) :asset('admin/img/user.png')}}" class="rounded-circle" alt="instructor">
                                            </div>
                                            <div class="course-detail-instructor-text">

                                            </div>
                                        </div>
                                        <div class="course-detail-date">
                                            <a href="javascript:void(0);"><p dir="ltr">{{date('d M, Y',
                                                strtotime($item->created_at))}}</p></a>
                                            <span>آخرین اپدیت</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-7 col-xl-12 col-lg-12">
                                    <div class="course-detail-rating-tag-box">
                                        <div class="course-detail-rating-box">
                                            <a href="javascript:void(0);">
                                                <div class="course-detail-rating-star">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <p>5.00(2k)</p>
                                                </div>
                                            </a>
                                            <span></span>
                                        </div>
                                        <div class="course-detail-tag-box">
                                            <ul>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="course-detail-img wow fadeInUp animated" data-wow-delay=".4s">

                                <img src="{{$item->photo!=null?url($item->photo->path):''}}" alt="course">

                        </div>
                        <h3 class="h3-title">توضیحات</h3>
                        {!! $item->text !!}
                        <div class="course-detail-point">
                            @if($item->join)
                                <h3 class="h3-title">پکیج های دارای این سرویس</h3>
                                <ul>
                                    @foreach($item->join as $key=>$join_item)

                                        <li><i class="fa fa-check-circle" aria-hidden="true"></i><a class="px-2" href="{{route('user.package',$join_item->slug)}}" target="_blank"> {{$join_item->title}}</a></li>

                                    @endforeach
                                </ul>
                            @endif
                                @if (Auth::check())
                                    @if(count($item->join))

                                        @if(App\Model\Basket::where('user_id',auth()->user()->id)->whereIn('sale_id',$item->join_id($item->id))->where('status','active')->where('type','package')->exists())
                                            <p> ویدیو</p>
                                            <iframe style="width: 100%; height:300px;"  allowfullscreen
                                                    src="{{$item->video_link}}">
                                            </iframe>
                                        @endif
                                    @else
                                        @if(App\Model\Basket::where('user_id',auth()->user()->id)->where('sale_id',$item->id)->where('status','active')->where('type','service')->exists())
                                            <p> ویدیو</p>
                                            <iframe style="width: 100%; height:300px;"  allowfullscreen
                                                    src="{{$item->video_link}}">
                                            </iframe>
                                        @endif
                                    @endif


                                @endif
                        </div>

                    </div>
                </div>
                <!--Course Detail Info End-->
                <!--Sidebar Start-->
                <div class="col-xl-4 col-lg-5">
                    <div class="course-detail-sidebar">
                        <div class="get-the-course">
                            <div class="courses-sidebar-title">
                                <div class="sidebar-title-line"></div>
                                <h3 class="h3-title">همین حالا سفارش دهید</h3>
                            </div>

                            <div class="get-course-line"></div>

                            <div class="get-course-price">
                                <h3 class="h3-title">{{price($item->price)}}تومان </h3>
                            </div>

                            @if (!Auth::check())
                                برای خرید باید وارد پنل کاربری خود شوید!
                                <hr/>
                            @else
                                @if(count($item->join))
                                    @if(App\Model\Basket::where('user_id',auth()->user()->id)->whereIN('sale_id',$item->join_id($item->id))->where('status','active')->where('type','package')->exists())
                                        این سرویس در پکیج خریداری شده شما موجود است.
                                    @else
                                        <a href="{{route('user.add_basket',[$item->id,'service'])}}" class="sec-btn">اضافه به سبد خرید</a>
                                    @endif
                                @else
                                    @if(App\Model\Basket::where('user_id',auth()->user()->id)->where('sale_id',$item->id)->where('status','active')->where('type','service')->exists())
                                        این سرویس توسط شما خریداری شده.
                                    @else
                                        <a href="{{route('user.add_basket',[$item->id,'service'])}}" class="sec-btn">اضافه به سبد خرید</a>
                                    @endif
                                @endif

                            @endif
                        </div>

                    </div>
                </div>
                <!--Sidebar End-->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection --}}
