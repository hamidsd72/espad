@extends('layouts.layout_first_page')
@section('content')
    <div class="container">
        <div class="card bg-light my-4">
            <div class="card-body">
                <img src="{{url($item->pic_card)}}" alt="{{$item->title}}" style="width: 100%;height: 400px;border-radius: 4px;">
                <div class="row m-3">
                    <div class="col my-auto">
                        <p>{{$item->title}}</p>
                    </div>
                    <div class="col-auto">
                        @if ($users->first()->photo)
                            <div class="mm" style="direction: ltr;">
                                <div class="d-none">{{$f = 0}}</div>
                                @foreach ($users as $user)
                                    @if ($user->photo)
                                        <img src="{{url($user->photo->path)}}"  alt="banner" style="position: relative;right: {{$f}}px;">
                                        <div class="d-none">{{$f += 14}}</div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="small text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-16" viewBox="0 0 512 512">
                                    <title>ionicons-v5-l</title>
                                    <rect x="32" y="80" width="448" height="256" rx="16" ry="16" transform="translate(512 416) rotate(180)" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px"></rect>
                                    <line x1="64" y1="384" x2="448" y2="384" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line>
                                    <line x1="96" y1="432" x2="416" y2="432" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line>
                                    <circle cx="256" cy="208" r="80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></circle>
                                    <path d="M480,160a80,80,0,0,1-80-80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                    <path d="M32,160a80,80,0,0,0,80-80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                    <path d="M480,256a80,80,0,0,0-80,80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                    <path d="M32,256a80,80,0,0,1,80,80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                </svg>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row mx-3 mb-1">
                    <div class="col">
                        @foreach ($users as $user)
                            {{$user->first_name.' '.$user->last_name.' - '}}
                        @endforeach
                        |@if($endItemSignUpDate) <span class="text-danger">غیرفعال</span> @else <span class="text-success">فعال</span> @endif
                        {{-- <p class="small vm">
                            <span class=" text-secondary">4.5</span>
                            <span class=" text-secondary">| فعال</span>
                        </p> --}}
                    </div>
                    <div class="col-auto">
                        <p class="small text-secondary">
                            {{$item->price>0?number_format($item->price).' تومان ':'رایگان'}}
                        </p>
                    </div>
                </div>
                <div class="card-body border-top border-color">
        
                    <h6>{{ $item->title }}</h6>
                    @if ($item->started_at)
                        <h6 class="mt-3">{{ ' تاریخ برگزاری '.my_jdate($item->started_at,'d F Y') }}</h6>
                    @endif
                    <div class="text-secondary p-3">
                        {!! $item->text !!}
                    </div>
                    {{-- ولیدیشن ظرفیت کارگاه --}}
                    @if ($item->limited && $item->limited < $max)
                        <a href="#" class="mt-2 btn btn-secondary btn-block"> 
                            ظرفیت کارگاه تکمیل شده است
                        </a>
                    {{-- ولیدیشن تاریخ اعتبار کارگاه --}}
                    @elseif($endItemSignUpDate)
                        <a href="#" class="mt-2 btn btn-secondary btn-block"> 
                            تاریخ ثبت نام کارگاه به پایان رسیده است
                        </a>
                    @else
                        {{-- ولیدیشن های خرید کارگاه --}}
                        @if (auth()->user())
                            @if(App\Model\Basket::where('user_id',auth()->user()->id)->where('sale_id',$item->id)->where('type','package')->where('status','active')->exists())
                                <a class="btn btn-secondary" href="{{route('user.my-basket.show',auth()->user()->id)}}" >
                                    این کارگاه برای شما فعال است - نمایش آیتم های من
                                </a>
                            @else
                                <a @if (auth()->user()->amount >= $item->price) href="{{route('user.add_basket',[$item->id,'package'])}}"
                                    @else href="{{route('user.user-web-transaction.index')}}" @endif class="mt-2 btn btn-primary btn-block"> 
                                    شرکت در این کارگاه
                                </a>
                                @if ($item->price>0 )
                                    @if ($open_offline_payment)
                                        <buttum class="mt-2 btn btn-info btn-block">پردازش رسید ارسالی</buttum>
                                    @else
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalTicket" class="mt-2 btn btn-info btn-block"> 
                                            شرکت در این کارگاه (پرداخت آفلاین)
                                        </a>
                                    @endif
                                @endif
                            @endif
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="mt-2 btn btn-primary btn-block">
                                شرکت در این کارگاه
                            </a>
                        @endif

                        @if ($item->price>0 )
                            @unless(auth()->user() && App\Model\Basket::where('user_id',auth()->user()->id)->where('sale_id',$item->id)->where('type','package')->where('status','active')->exists())
                                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="mt-2 mx-2 btn btn-success btn-block">
                                    شرکت در این کارگاه با کد تخفیف
                                </a>
                            @endunless
                        @endif

                    @endif
                    @if ($item->price>0 )
                        <p class="mt-3 mb-0 small text-danger">درصورت پرداخت وجه امکان عودت نمیباشد</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('user.add_basket_with_offCode',[$item->id,'package']) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">کد تخفیف خود را وارد کنید</h6>
                    </div>
                    <div class="modal-body">
                        <label for="offcode">کد تخفیف</label>
                        <input type="text" name="offcode" id="offcode" placeholder="هش دریافتی را وارد کنید" class="form-control mt-3">
                    </div>
                    <p class="mx-3 text-danger">درصورتیکه کد تخفیف نامعتبر باشد درخواست انجام نمیشود</p>
                    <div class="modal-footer" style="display: unset">
                        <button type="submit" class="btn btn-primary">شرکت در این کارگاه</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  
    <!-- Modal send ticket -->
    <div class="modal fade" id="ModalTicket">
        <div class="modal-dialog modal-lg">
            <div class="modal-content redu20"> 
                <div class="modal-header">
                    <h4 class="modal-title">رسید پرداخت نقدی - کارت به کارت {{number_format($item->price)}}</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="content">
                        <form method="post" action="{{route('user.package.offline_payment.form_post')}}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <input type="hidden" name="item_id" value="{{$item->id}}">
                                <input type="hidden" name="model_type" value="App\Model\ServicePackage">
                                {{-- <input type="hidden" name="type" value="رسید پرداخت نقدی - کارت به کارت"> --}}
                                <div class="form-group">
                                    <label class="form-group mb-1" for="fish_id"> شماره فیش :<span>(required)</span></label>
                                    <input type="text" name="fish_id" class="form-control" id="fish_id">
                                </div>
                                <div class="form-group">
                                    <label class="form-group mt-3 mb-1" for="number"> چهار رقم آخر کارت :<span>(required)</span></label>
                                    <input type="number" name="card_number" class="form-control" id="number">
                                </div>
                                <div class="form-group">
                                    <label class="form-group mt-3 mb-1" for="bank">بانک خود را انتخاب کنید</label>
                                    <select class="form-control" name="bank">
                                        @foreach (\App\Model\Bank::orderByDesc('id')->get('title') as $key => $bank)
                                            <option value="{{$bank->title}}" @if ($key==0) selected @endif>{{$bank->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group my-3">
                                    تصویر رسید را وارد کنید  
                                    <input type="file" name="attach" class="form-control mt-2" id="attach" accept=".jpeg,.jpg,.png" required> 
                                </div>
                                <div class="form-button">
                                    <input type="submit" class="btn btn-lg btn-primary mt-2" value="ارسال رسید پرداخت" data-formid="contactForm">
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        function copy() {
            var copyText = document.getElementById("share");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            alert('آدرس کارگاه در کلیپبورد ذخیره شد');
        }
    </script>
@endsection
