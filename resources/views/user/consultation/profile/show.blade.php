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
    .table-bordered>:not(caption)>*>* {
        text-align: center;
    }
</style>
<div class="bg-light-yasi text-white p-3">
    <div class="container">
        <div class="row " id="top-consultation">
            <div class="col-2 my-lg-auto text-lg-start">
                <img src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
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

<section class="about bg-white">
    <div class="container">
        <div class="body p-4">
        
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
                                            <div class="col-xl-6 col-lg-8 float-start p-0">
                                                @if ($status=='online')
                                                    <div class="row">
                                                        @if (auth()->user() && auth()->user()->amount > $item->price)
                                                            <div class="col p-0 text-center">
                                                                <a href="{{route('user.call.request',[$item->id,'service'])}}" class="btn btn-success p-0 col-11 mx-auto py-3">
                                                                    <h6 class="p-0 pt-1 text-center fw-bold">
                                                                        تماس
                                                                        <i class="fas fa-phone text-white"></i>
                                                                    </h6>
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <div class="col p-0 hover-white">
                                                            <a  @if (auth()->user())
                                                                    @if (auth()->user()->amount > $item->price*10) href=""
                                                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                                @else
                                                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                                @endif class="border float-start text-white h6 text-center rounded shadow col-11 mx-auto py-1">
                                                                <h6 class="pt-2 text-center fw-bold">
                                                                    ۱۰ دقیقه
                                                                </h6>
                                                                <small style="font-size: 10px;">
                                                                    {{number_format($item->price*10).' تومان '}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                        <div class="col p-0 hover-white">
                                                            <a  @if (auth()->user())
                                                                    @if (auth()->user()->amount > $item->price*30) href=""
                                                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                                @else
                                                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                                @endif class="border float-start text-white h6 text-center rounded shadow col-11 mx-auto py-1">
                                                                <h6 class="pt-2 text-center fw-bold">
                                                                    ۳۰ دقیقه
                                                                </h6>
                                                                <small style="font-size: 10px;">
                                                                    {{number_format($item->price*30).' تومان '}}
                                                                </small>
                                                            </a>
                                                        </div>
                                                        <div class="col p-0 hover-white">
                                                            <a  @if (auth()->user())
                                                                    @if (auth()->user()->amount > $item->price*60) href=""
                                                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                                @else
                                                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                                @endif class="border float-start text-white h6 text-center rounded shadow col-11 mx-auto py-1">
                                                                <h6 class="pt-2 text-center fw-bold">
                                                                    ۶۰ دقیقه
                                                                </h6>
                                                                <small style="font-size: 10px;">
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
                                                        @if (auth()->user()->amount > $item->price*10) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                    @else
                                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                    @endif class="btn btn-light col-12">
                                                    پکیج ۱۰ دقیقه
                                                    <small style="font-size: 12px;">
                                                        {{number_format($item->price*10).' تومان '}}
                                                    </small>
                                                </a>
                                                <a  @if (auth()->user())
                                                        @if (auth()->user()->amount > $item->price*30) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                    @else
                                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                    @endif class="btn btn-light col-12 my-3">
                                                        پکیج ۳۰ دقیقه
                                                    <small style="font-size: 12px;">
                                                        {{number_format($item->price*30).' تومان '}}
                                                    </small>
                                                </a>
                                                <a  @if (auth()->user())
                                                        @if (auth()->user()->amount > $item->price*60) href="{{route('user.call.request',[$item->id,'service'])}}"
                                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                                    @else
                                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                    @endif class="btn btn-light col-12">
                                                        پکیج ۶۰ دقیقه
                                                    <small style="font-size: 12px;">
                                                        {{number_format($item->price*60).' تومان '}}
                                                    </small>
                                                </a>
                                            @elseif($status=='offline')
                                                <a  @if (auth()->user())
                                                        @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                                                            href="{{ route('user.consultation.evoke',$item->user_id) }}"
                                                        @endunless
                                                    @else
                                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                                    @endif class="btn btn-light col-12">
                                                    آنلاین شد خبرم کن
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
                                        نظر دادن
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

                @foreach ($header as $head)
                    <p class="fs-6 my-3">{!! $head->text !!}</p>
                @endforeach
                
                @if ($services->count())
                    <div class="mb-4">
                        @foreach ($services as $index => $service)
                            <a href="{{ route('user.consultation.edit',$service->slug) }}">
                                <div class="row">
                                    @if ($service->photo->path)
                                        <div class="col-auto text-start">
                                            <img src="{{url($service->photo->path)}}" height="46px;" alt="banner">
                                        </div>
                                    @endif
                                    <div class="col-auto my-auto fs-6">
                                        {{$service->title}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

            </div>

            <div class="d-lg-none">
                <div class="col-12 p-1 p-lg-4" style="color: #00788D;">تعرفه ها</div>
                <div class="col-12 p-2 p-lg-4 m-1 text-center small" style="background: #f2f5f766;">
                    مشاوره ۱۰ دقیقه
                    {{number_format($item->price*10).' تومان '}}
                </div>
                <div class="col-12 p-2 p-lg-4 m-1 text-center small" style="background: #dae1e566;">
                    مشاوره ۳۰ دقیقه
                    {{number_format($item->price*30).' تومان '}}
                </div>
                <div class="col-12 p-2 p-lg-4 m-1 text-center small" style="background: #f2f5f766;">
                    مشاوره ۶۰ دقیقه
                    {{number_format($item->price*60).' تومان '}}
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-auto p-2 p-lg-4" style="color: #00788D;">روز های هفته</div>
                        <div class="col-auto p-2 p-lg-4" style="color: #00788D;">ساعت کاری</div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-2 p-lg-4">شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->shanbe?$item->shanbe:'__'}} - 
                            {{$item->e_shanbe?$item->e_shanbe:'__'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">یکشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->yekshanbe?$item->yekshanbe:'__'}} - 
                            {{$item->e_yekshanbe?$item->e_yekshanbe:'__'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">دوشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->doshanbe?$item->doshanbe:'__'}} - 
                            {{$item->e_doshanbe?$item->e_doshanbe:'__'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">سه شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->seshanbe?$item->seshanbe:'__'}} - 
                            {{$item->e_seshanbe?$item->e_seshanbe:'__'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">چهارشنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->chaharshanbe?$item->chaharshanbe:'__'}} - 
                            {{$item->e_chaharshanbe?$item->e_chaharshanbe:'__'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">پنج شنبه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->panjshanbe?$item->panjshanbe:'__'}} - 
                            {{$item->e_panjshanbe?$item->e_panjshanbe:'__'}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 p-2 p-lg-4">جمعه ها</div>
                        <div class="col p-2 p-lg-4 mx-1" style="background: #f2f5f766;">
                            {{$item->jome?$item->jome:'__'}} - 
                            {{$item->e_jome?$item->e_jome:'__'}}
                        </div>
                    </div>
                </div>

                @if ($services->count())
                    <div class="col-12 p-1 p-lg-4" style="color: #00788D;">وبینار ها</div>
                    @foreach ($services as $index => $service)
                        <a href="{{ route('user.consultation.edit',$service->slug) }}">
                            <div class="p-2 my-2 text-dark" style="background: #f2f5f766;@if($index%2==0) background: #dae1e566 !important; @endif">
                                <div class="row">
                                    <div class="col-auto">
                                        @if ($service->photo)
                                        <img src="{{url($service->photo->path)}}" height="40px" alt="banner">
                                        @endif
                                    </div>
                                    <div class="col-auto my-auto fs-6">
                                        {{$service->title}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
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
            @endif

            @if (auth()->user())
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
