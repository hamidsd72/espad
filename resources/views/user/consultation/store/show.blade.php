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

<section class="about bg-light">
    <div class="container">
        <div class="body p-3 p-lg-4">

            <div class="row mb-2">

                <div class="col-lg-6 moshaver">
                    <h4 class="pb-4 d-flex mb-0">
                        <div class="line pt-4"></div>
                        {{$item->title}}
                    </h4>
                    <div class="d-none d-lg-block">{!! $item->text !!}</div>
                </div>

                <div class="col-lg-2"></div>
                <div class="col-lg bg-light p-4" style="border-radius: 8px;">
                    <img src="{{ $item->photo?url($item->photo->path):'' }}" class="w-100 mb-2" style="border-radius: 6px" alt="banner">
                </div>

                <div class="d-lg-none">{!! $item->text !!}</div>

            </div>

            <div class="row bg-light my-3">

                <div class="col-lg p-4">
                    <div class="px-4">
                        <img class="mx-2 mb-3" width="128px" src="{{ asset('assets/images/type_logo.png') }}" alt="banner">
                        <div class="row mx-lg-4">
                            <div class="col-auto">
                                <div class="mm">
                                    <img src="{{ $item->user()->photo?url($item->user()->photo->path):'' }}" class="w-100" alt="avatar">
                                </div>
                            </div>
                            <div class="col my-auto">
                                <h6>{{ $item->user()->first_name.' '.$item->user()->last_name }}</h6>
                            </div>
                        </div>
                        <p class="py-2 text-secondary">{!! $item->user()?$item->user()->text:'' !!}</p>
                    </div>

                    <div class="btn btn-success">
                        @if ($status=='online')
                            <a @if (auth()->user()) href="{{route('user.call.request',[$item->id,'service'])}}" 
                                @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="d-flex text-light mx-5">
                                    <i class="fas fa-phone p-2 fs-5"></i><p class="m-0 p-2 fs-6 fw-bold">تماس</p>
                            </a>
                        @elseif($status=='offline')
                            <a  @if (auth()->user())
                                    @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                                        href="{{ route('user.consultation.evoke',$item->user_id) }}"
                                    @endunless
                                @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="d-flex text-light">
                                    <p class="m-0 fs-6 p-2 fw-bold">آنلاین شد خبرم کن</p>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5 p-4">
                    <h4 class="mb-3">افزودن به سبد خرید</h4>
                    
                    <form action="{{ route('user.store.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="type" value="service">
                        <label for="count">تعداد را وارد کنید</label>
                        <input type="number" id="count" name="count" class="form-control my-3" min="1" required>

                        @if (auth()->user())
                            <button class="btn btn-lg btn-success col-12">ثبت سفارش</button>
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-lg btn-success col-12">افزودن به سبد خرید</a>
                        @endif

                    </form>

                </div>

            </div>

        </div>
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
