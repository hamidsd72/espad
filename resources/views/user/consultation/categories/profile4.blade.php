@extends('layouts.layout_first_page')
@section('content')
<style>
    section.bg-light {
        background: #fff !important;
    }
    section.about .navbar-4 .line-top {
        border-right: 2px solid #157347;
        height: 28px;
        margin-right: 9px;
    }
    section.about .navbar-4 .circle {
        border: 2px solid #157347;
        width: 20px;
        height: 20px;
        border-radius: 50px;
    }
    section.about .navbar-4 .point2 {
        background: #157347;
        width: 14px;
        height: 14px;
        border-radius: 50px;
        margin: auto;
        margin-top: 1px;
    }
    section.about .navbar-4 a:hover div.text-secondary {
        color: #157347 !important;
    }
    section.about .navbar-4 div.selected {
        color: #157347 !important;
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
    .table-bordered>:not(caption)>*>* {
        text-align: center;
    }
</style>

<div class="bg-light-yasi text-white p-3">
    <div class="container">
        <div class="row " id="top-consultation">
            <div class="col-2 my-lg-auto">
                <img class="float-lg-left" src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
            </div>
            <div class="col">
                <h1 class="fw-bold text-right text-dark-violet my-lg-2 d-none d-lg-block">{{ \App\Model\ServiceCat::find($item->category_id)->title  }}</h1>
                <h1 class="fw-bold text-right text-dark-violet d-lg-none fs-5">{{ \App\Model\ServiceCat::find($item->category_id)->title  }}</h1>
                <h4 class="text-right text-dark d-none d-lg-block">{{ \App\Model\ServiceCat::find($item->category_id)->text }}</h4>
                <p class="text-right text-secondary mb-0">آخرین بروزرسانی : {{my_jdate(\App\Model\ServiceCat::find($item->category_id)->updated_at,'d F')}}</p>
            </div>
        </div>
    </div>
</div>

<section class="about bg-light">
    <div class="container">
        <div class="body p-3 p-lg-4">

            <div class="row mb-2">

                <div class="col-lg-6 moshaver">

                    @if ($sub_items->where('section',1)->count())
                        <h4 class="pb-4 d-flex mb-0">
                            <div class="line"></div>
                            {{$item->title}}
                        </h4>
                        <div class="px-4 bg-light" style="border-radius: 6px;">
                            <img class="m-3" width="128px" src="{{ asset('assets/images/type_logo.png') }}" alt="banner">
                            <div class="row mx-lg-4">
                                <div class="col-4 col-lg-3">
                                    <div class="mm">
                                        <img src="{{ url($sub_items->where('section',1)->sortBy('sort')->first()->pic) }}" width="100%" class="" alt="avatar">
                                    </div>
                                </div>
                                <div class="col my-auto">
                                    <h6>{{$sub_items->where('section',1)->sortBy('sort')->first()->title}}</h6>
                                </div>
                            </div>
                            <p class="py-3 pb-lg-4 text-secondary">{!! $sub_items->where('section',1)->sortBy('sort')->first()->text !!}</p>
                        </div>
                    @endif

                    @if ($sub_items->where('section',2)->count())
                        <h4 class="py-4 d-flex mb-0">
                            <div class="line"></div>
                            {{$sub_items->where('section',2)->sortBy('sort')->first()->title}}
                        </h4>
                        <p class="py-3 pb-lg-4 text-secondary">{!! $sub_items->where('section',2)->sortBy('sort')->first()->text !!}</p>
                    @endif

                </div>
                <div class="col-lg-2"></div>
                <div class="col bg-light p-4" style="border-radius: 8px;">
                    {{-- <img src="{{ url($item->user()->photo->path) }}" class="mb-2" style="border-radius: 6px;width: 100%" alt="banner"> --}}
                    <img src="{{ $item->photo?url($item->photo->path):'' }}" class="mb-2" style="border-radius: 6px;width: 100%" alt="banner">
                    <div class="col-lg-10 mx-auto">
                        <div class="btn btn-success p-1 col-12">
                            @if ($status=='online')
                                @if (auth()->user() && auth()->user()->amount > $item->price)
                                    <a href="{{route('user.call.request',[$item->id,'service'])}}" class="d-flex text-light me-5">
                                        <i class="fas fa-phone p-2 fs-5 me-5 "></i><p class="m-0 p-1 fs-5 fw-bold">تماس</p>
                                    </a>
                                @endif
                            @elseif($status=='offline')
                                <a  @if (auth()->user())
                                        @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                                            href="{{ route('user.consultation.evoke',$item->user_id) }}"
                                        @endunless
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="d-flex text-light me-4 me-lg-5">
                                        <img src="https://img.icons8.com/external-flat-icons-inmotus-design/40/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/>
                                        <p class="m-0 fs-5 p-1 fw-bold">آنلاین شد خبرم کن</p>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-2">
                        <h5 class="pb-4">
                            وبینار ها
                        </h5>
                        <div class="navbar-4">
                            @foreach ($services as $key => $service)
                                @if ($key>0)
                                    <div class="line-top"></div>    
                                @endif
                                <a href="{{ route('user.consultation.edit',$service->slug) }}" class="d-flex">
                                    <div class="circle">
                                        <div class=""></div>
                                    </div>
                                    <div class="mx-2 text-secondary">
                                        {{$service->title}}
                                        <div class="float-start pe-lg-5 me-lg-5">{{$service->price>0?price( $service->price ).'تومان':'رایگان'}}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

            <div class="d-none d-lg-block">

                <div class="row mt-4">
                    <div class="col-6 text-end">
                        <img src="{{ asset('assets/images/qqq.png') }}" style="max-height:96px;transform: rotateY(180deg);" alt="banner">
                        <div class="text-end text-white fs-4" style="position: relative;top: -74px;right: 58px;">
                            زمان های گفتگو
                        </div>
                    </div>
                    <div class="col-6 text-start">
                        <img src="{{ asset('assets/images/qqq.png') }}" style="max-height:96px" alt="banner">
                        <div class="text-start text-white fs-4 fst-italic fw-bold" style="position: relative;top: -74px;left: 58px;">
                            spadstock.com
                        </div>
                    </div>
                </div>

                <table class="table table-bordered mt-2 mb-4">
                    <thead>
                        <tr>
                            <th scope="col">ایام هفته</th>
                            <th scope="col">شنبه</th>
                            <th scope="col">یکشنبه</th>
                            <th scope="col">دوشنبه</th>
                            <th scope="col">سه شنبه</th>
                            <th scope="col">چهارشنبه</th>
                            <th scope="col">پنج شنبه</th>
                            <th scope="col">جمعه</th>
                            <th scope="col">تعرفه ها</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="background: #dae1e566;">
                                ساعت 
                            </th>
                            <th style="background: #dae1e566;">
                                {{$item->shanbe?$item->shanbe:'__'}} - 
                                {{$item->e_shanbe?$item->e_shanbe:'__'}}
                            </th>
                            <td style="background: #dae1e566;">
                                {{$item->yekshanbe?$item->yekshanbe:'__'}} - 
                                {{$item->e_yekshanbe?$item->e_yekshanbe:'__'}}
                            </td>
                            <td style="background: #dae1e566;">
                                {{$item->doshanbe?$item->doshanbe:'__'}} - 
                                {{$item->e_doshanbe?$item->e_doshanbe:'__'}}
                            </td>
                            <td style="background: #dae1e566;">
                                {{$item->seshanbe?$item->seshanbe:'__'}} - 
                                {{$item->e_seshanbe?$item->e_seshanbe:'__'}}
                            </td>
                            <td style="background: #dae1e566;">
                                {{$item->chaharshanbe?$item->chaharshanbe:'__'}} - 
                                {{$item->e_chaharshanbe?$item->e_chaharshanbe:'__'}}
                            </td>
                            <td style="background: #dae1e566;">
                                {{$item->panjshanbe?$item->panjshanbe:'__'}} - 
                                {{$item->e_panjshanbe?$item->e_panjshanbe:'__'}}
                            </td>
                            <td style="background: #dae1e566;">
                                {{$item->jome?$item->jome:'__'}} - 
                                {{$item->e_jome?$item->e_jome:'__'}}
                            </td>
                            <td class="col-2" style="background: #dae1e566;">
                                ۱۰ دقیقه
                                {{number_format($item->price*10).' تومان '}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="background: #f2f5f766;">
                                تاریخ
                            </th>
                            <th style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->subDay(2),'d F') }}
                            </th>
                            <td style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->subDay(),'d F') }}
                            </td>
                            <td style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek(),'d F') }}
                            </td>
                            <td style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(),'d F') }}
                            </td>
                            <td style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(2),'d F') }}
                            </td>
                            <td style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(3),'d F') }}
                            </td>
                            <td style="background: #f2f5f766;">
                                {{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(4),'d F') }}
                            </td>
                            <td style="background: #f2f5f766;">
                                ۳۰ دقیقه
                                {{number_format($item->price*30).' تومان '}}
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                ۶۰ دقیقه
                                {{number_format($item->price*60).' تومان '}}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="d-lg-none">
                <div class="col-12">
                    <div class="col-12 p-1 p-lg-4" style="color: #00788D;">تعرفه ها</div>
                    <div class="col-12 p-2 p-lg-4 m-1 text-center small" style="background: #f2f5f766;">
                            ۱۰ دقیقه
                        {{number_format($item->price*10).' تومان '}}
                    </div>
                    <div class="col-12 p-2 p-lg-4 m-1 text-center small" style="background: #dae1e566;">
                            ۳۰ دقیقه
                        {{number_format($item->price*30).' تومان '}}
                    </div>
                    <div class="col-12 p-2 p-lg-4 m-1 text-center small" style="background: #f2f5f766;">
                            ۶۰ دقیقه
                        {{number_format($item->price*60).' تومان '}}
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-auto p-2 p-lg-4" style="color: #00788D;">روز های هفته</div>
                        <div class="col-auto p-2 p-lg-4" style="color: #00788D;">ساعت کاری</div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-2 p-lg-4">شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->shanbe?$item->shanbe:'____'}} - 
                            {{$item->e_shanbe?$item->e_shanbe:'____'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">یکشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->yekshanbe?$item->yekshanbe:'____'}} - 
                            {{$item->e_yekshanbe?$item->e_yekshanbe:'____'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">دوشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->doshanbe?$item->doshanbe:'____'}} - 
                            {{$item->e_doshanbe?$item->e_doshanbe:'____'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">سه شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->seshanbe?$item->seshanbe:'____'}} - 
                            {{$item->e_seshanbe?$item->e_seshanbe:'____'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">چهارشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->chaharshanbe?$item->chaharshanbe:'____'}} - 
                            {{$item->e_chaharshanbe?$item->e_chaharshanbe:'____'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">پنج شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->panjshanbe?$item->panjshanbe:'____'}} - 
                            {{$item->e_panjshanbe?$item->e_panjshanbe:'____'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">جمعه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->jome?$item->jome:'____'}} - 
                            {{$item->e_jome?$item->e_jome:'____'}}
                        </div>
                    </div>
                </div>

            </div>

            @if ($comments->count())
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
                                    <img class="" style="height: 100px;opacity: 0.4;" src="{{ asset('assets/images/msg-icon2.png') }}" alt="banner">
                                </div>
                            </div>
                            <div class="mx-4 mb-3 px-lg-5">
                                <hr>
                                {{$comment->text}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if (auth()->user())
                <div class="border rounded mt-4">
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
                                <img class="" style="height: 100px;opacity: 0.4;" src="{{ asset('assets/images/msg-icon2.png') }}" alt="banner">
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
            @endif

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
        @if ( $sub_items->where('section','>',2)->count() )
        <div class="container">
            <div class="col-12 row m-0">
                @foreach ($sub_items->where('section','>',2)->sortBy('sort') as $item)
                    <div class="col-lg-4">
                        <div class="card bg-white mb-3" style="height: auto;">
                            <div class="card-header @if($item->sort==1) bg-dark-violet @else bg-ligh-gray @endif fs-6 fw-bold text-white text-center">
                                {{$item->title}}
                            </div>
                            <div class="card-body p-2 p-lg-3 px-lg-4">
                                <div class="text-center">
                                    @if (is_file($item->pic))
                                        <img style="width: 100%;height: 206px;" src="{{url($item->pic)}}" alt="banner">
                                    @endif
                                    @if (is_file($item->video))
                                        <video controls>
                                            <source src="{{url($item->video)}}" type="video/mp4">
                                        </video>
                                    @endif
                                    <div @if (!$item->link) style="margin-bottom: 36px" @endif></div>
                                </div>
                                @if ($item->link)
                                    <a href="{{$item->link?url($item->link):''}}" class="text-light-orange">
                                        <div class="text-end fw-bold mt-3">
                                            نمایش بیشتر
                                            <i class="fa fa-angle-left"></i>
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
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
