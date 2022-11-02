@extends('layouts.user')

@section('content')
    <div class="login_pag" dir="rtl" style="padding-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5 pt-3">
                    <h4 class="text-right">سبد خرید شما</h4>
                    <hr>
                    <div class="container-fluid">
                        <div class="row">
                            @if(count($baskets)>0)
                                <div class="col-lg-9 col-md-8">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach($baskets as $key=>$item)
                                                <div data-aos="zoom-in-left" class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mt-4">
                                                    <div class="card_basket card_basket{{$item['type']=='service'?'_1':'_2'}}">
                                                        <span class="type_basket">{{$item['type']=='service'?'سرویس':'پکیج'}}</span>
                                                        <a href="{{route('user.basket.del',[$item['sale_id'],$item['type']])}}" data-url="{{route('user.basket.del',[$item['sale_id'],$item['type']])}}" data-title="{{$item['item']->title}}" class="del_basket del_basket_a" title="حذف از سبد خرید" aria-label="حذف از سبد خرید"><i class="fa fa-trash"></i></a>
                                                        <a
                                                                @if($item['type']=='service')
                                                                href="{{route('user.service',[$item['item']->id,$item['item']->slug])}}"
                                                                @else
                                                                href="{{route('user.package',$item['item']->slug)}}"
                                                                @endif
                                                        >
                                                            <div class="img">
                                                                <img src="{{url($item['item']->photo->path)}}" alt="{{$item['item']->title}}">
                                                            </div>
                                                            <div class="text">
                                                                <h2> {{$item['item']->title}} </h2>
                                                                <p>{{number_format($item['item']->price)}} <small> تومان</small></p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                                <div class="col-lg-3 col-md-4" style="margin-bottom: 10px;">
                                    <h5 class="text-right mb-2 f-size-16"><strong>جمع فاکتور : </strong> <span class="all_price_basket f-size-14">{{number_format($all_price)}}</span> <small>تومان</small></h5>
                                    <h5 class="text-right basket_d_none d-none f-size-16" id="off_show"><strong>میزان تخفیف : </strong> <span class="off_price_basket f-size-14"></span> <small>درصد</small></h5>
                                    <hr/>
                                    <h5 class="text-right basket_d_none d-none f-size-16" id="off_show2"><strong>هزینه پرداخت : </strong> <span class="pay_price_basket f-size-14"></span> <small>تومان</small></h5>
                                    <div class="col-12 off_code_div p-0" id="off_code_div">
                                        <input type="text" dir="ltr" id="off_basket_code" class="text-left off_basket form-control w-100" placeholder="کد تخفیف" >
                                        <input type="hidden" id="price_basket" value="{{$item['item']->price}}">
                                        <button id="off_basket_button" class="btn btn-success off_basket_button w-100 mt-1" data-url="{{route('user.index')}}">اعمال تخفیف</button>
                                    </div>
                                    <form action="{{route('user.basket.pay')}}" method="post" class="col-12 p-0 mt-4">
                                        @csrf
                                        <input type="hidden" name="off_code_basket" class="off_code_basket">
                                        @if(auth()->check())
                                            <div class="col-12 mt-2 d-flex payment_type">
                                                <input type="radio" class="d-none" name="bank_name" value="zarinpal" checked>
                                                <img src="{{url('source/asset/user/zarinpal.png')}}" style="max-width: 50%;" class="img_payment active" alt="zarinpal">
                                            </div>
                                            <button type="submit" class="btn btn-info w-100 mt-2">پرداخت</button>
                                        @else
                                            <a href="{{route('user.mobile')}}"
                                               class="btn btn-info">ثبت نام
                                            </a>
                                            <a href="{{route('login')}}"
                                               class="btn btn-outline-warning">ورود
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            @else
                                <div class="col-md-8 mx-auto alert alert-danger text-center">
                                    سبد خرید شما خالی می باشد
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="login_page_footer"></div>

@endsection
