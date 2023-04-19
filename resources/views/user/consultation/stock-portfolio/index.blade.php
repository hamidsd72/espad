@extends('layouts.layout_first_page')
@section('content')
<style>
    .blogs .blog .card {border-radius: 12px;border: none !important;max-width: 128px;padding: 3px}
    .blogs .blog .card:hover {padding: 0px;transition: 0.3s;}
    .blogs .blog .card-border-bottom {border-bottom: 2px solid #928c8c !important;}
    .blogs .blog .card .body {height: 136px;}
    .blogs .blog .card .card-bottom-null {height: 18px;background: #303642;margin: auto 4px;}
    .stock {background: #ecf0f3}
    .redu8 {border-radius: 8px}
    .c-blue {color: #214f7a}
    .header a {background: #008037}
    .stock .card {background: #f2f2f3 !important;border: none !important;}
    .stock .card-header {background: #5271ff3b !important}
    .stock a.green {background: #07b451;border-radius: 12px}
    .stock .text-darkness {color: #303642}
    .stock .icon {border-radius: 50%;width: 36px;height: 36px;background: black;text-align: center;}
    .stock , .blogs {max-width: 100% !important;overflow: hidden !important;}
    .bg-0 {background: #355764;color: whitesmoke}
    .bg-1 {background: #5a8f7b;color: whitesmoke}
    .bg-2 {background: #ffbd59;color: #1D2D44}
    .bg-3 {background: #81cacf;color: whitesmoke}
    .bg-4 {background: #ced8df;color: #1D2D44}
    .bg-0 a {background: #355764;color: whitesmoke}
    .bg-1 a {background: #5a8f7b;color: whitesmoke}
    .bg-2 a {background: #ffbd59;color: #1D2D44}
    .bg-3 a {background: #81cacf;color: whitesmoke}
    .bg-4 a {background: #ced8df;color: #1D2D44}
    a.link {color: #23394b !important;font-weight: bold;}
    a.link:hover {color: black !important;font-size: 18px !important;background: ghostwhite;}
    .section.blogs .cats {background: #ced8df}
    .day-show {position: absolute;left: -22px;width: 42px;height: 42px;border-radius: 50px;border: 4px solid white;top: 8px;padding-top: 6px;}
</style>
@if (auth()->user() && auth()->user()->is_special())
    <section class="blogs"> 
        <div class="col-12">
            <div class="row">
        
                <div class="col-lg-4">
                    <div class="cats">
                        @if ($data->where('section',99)->first() && $data->where('section',99)->first()->pic)
                            <img src="{{url($data->where('section',99)->first()->pic)}}" class="w-100" alt="manabource">
                        @endif
                            
                        <h6>جست‌و‌جو</h6>
                        
                        <form id="searchForm" action="{{ route('user.stock-portfolio.store') }}" method="POST">
                            @csrf
                            <div class="searchbox mt-4">
                                <div class="input-group">
                                    <input type="text" name="search" onclick="manualySubmit()" class="form-control" id="inlineFormInputGroupSubmitable" placeholder="...جست‌و‌جو">
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
        
                        <h5 class="pt-5 fw-bold">تازه‌ها</h5>

                        @foreach ($latest as $item)
                            <div class="pt-4">
                                <h6>
                                    <a href="{{ route('user.stock-portfolio.show-by-slug',[$item->id ,$item->slug]) }}" class="link fw-bold">{{$item->title}}</a>
                                </h6>
                                <span class="text-secondary">{{my_jdate($item->updated_at,'d F Y')}}</span>
                            </div>
                        @endforeach
                        
                        <h5 class="pt-5 fw-bold">دسته‌ بندی ها</h5>
                        
                        @foreach ($cats as $cat)
                            <div class="d-flex pt-2">
                                <img src="{{$cat->pic?url($cat->pic->path):''}}" alt="{{$cat->title}}" style="height: 36px" class="rounded">
                                <h6 class="mt-2 mx-2" ><a href="{{ route('user.stock-portfolio.edit',$cat->slug) }}" class="link fs-16 fw-bold" >{{$cat->title}}</a></h6>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-8 pt-3">
                    <div class="blog">

                        @if ( \Request::route()->getName()=='user.stock-portfolio.index' )
                            
                            {{-- <h1 class="text-center">آرشیو</h1> --}}
                            <div class="row">
                                <div class="col-lg"></div>
                                @if ($data->where('section',1)->first() && $data->where('section',1)->first()->pic)
                                    <div class="col-auto p-0">
                                        <img src="{{url($data->where('section',1)->first()->pic)}}" style="max-height: 200px;" alt="manabource">
                                    </div>
                                @endif
                                <div class="col-auto my-auto p-0">
                                    {!! $data->where('section',1)->first() ? $data->where('section',1)->first()->text : 'گزارش لحظه های مهم بازار' !!}
                                </div>
                                <div class="col-lg"></div>
                            </div>
                                
                            <h4 class="text-center pb-3">
                            </h4>
                            @if ($items->count()==0)
                                <div class="items p-4 border-bottom">
                                    <div class="hashtaq mb-4 py-2">
                                        <a class="p-2 px-3" href="#">{{$id}}</a>
                                    </div>
                                    <a href="#"><h5>موردی یافت نشد</h5></a>
                                </div>
                            @endif
                            @php $pic = $data->where('section', 2)->where('sort', 1)->first() @endphp
                            @php $index = 0; @endphp
                            @foreach($items->chunk(5) as $rows)
                                <div class="row">            
                                    @foreach ($rows as $item)
                                        <div class="col-md-4 col-lg mx-auto mx-lg-0 mb-4">
                                            <div class="card mx-auto bg-{{$index}}">
                                                <a href="{{ route('user.stock-portfolio.show-by-slug',[$item->id ,$item->slug]) }}">
                                                    <div class="body text-center mx-auto">
                                                        <img src="{{$pic ? url($pic->pic) :asset('/assets/stock/1.png')}}" style="max-height: 48px;" alt="{{$item->title}}">
                                                        <h6 class="text-center my-1">MANA</h6>
                                                        <p class="text-center m-0 px-2">{{$item->title}}</p>
                                                    </div>
                                                </a>
                                                <div class="p-1 text-center">{{my_jdate($item->created_at,'F Y')}}</div>
                                                <div class="day-show text-center bg-{{$index}}">{{my_jdate($item->created_at,'d')}}</div>
                                            </div>
                                        </div>
                                        @php if($index > 3) {$index = 0;} else {$index += 1;}  @endphp
                                    @endforeach
                                </div>
                            @endforeach

                        @else

                            @if ($items->count()==0)
                                <div class="items p-4 border-bottom">
                                    <a href="#"><h5>موردی یافت نشد</h5></a>
                                </div>
                            @endif
                            @foreach ($items as $item)
                                <div class="items p-4 border-bottom aos-init aos-animate " data-aos="flip-up" onmouseover="newIco(this, '{{$item->id}}')" onmouseout="oldIco(this, '{{$item->id}}')">
                                    
                                    <a href="{{ route('user.stock-portfolio.show-by-slug',[$item->id ,$item->slug]) }}">
                                        <h5>{{$item->title}}</h5>
                                        @if ($item->short_text)
                                            <p class="py-2 mb-0">{{$item->short_text}}</p>
                                        @endif
                                    </a>
                                    
                                    <div class="pt-3"><button class="btn btn-outline-info redu20" onclick="window.location.href='{{ route('user.stock-portfolio.show-by-slug',[$item->id ,$item->slug]) }}'">مشاهده</button></div>
                                    {{-- <div id="old{{$item->id}}" class="col-12 pt-2 old">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div id="new{{$item->id}}" class="col-12 pt-2 d-none">
                                        <i class="fa fa-close text-secondary"></i>
                                    </div> --}}
                                </div>
                            @endforeach

                        @endif

                        @if ($items->count())
                            <div class="pagy">{{ $items->links() }}</div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@else
    <section class="stock">
    
        {{-- <div class="float-start bg-secondary" style="clip-path: polygon(0% 0%, 100% 0%, 100% 0%, 0% 100%, 25% 100%, 0 100%);height: 160px;width: 180px">
            <h6 class="mt-5 fw-bold text-white" style="rotate: -42deg;margin-right: 48px;">{{$data->count() ? $data->first()->title : 'بسته های تخفیفی'}}</h6>
        </div> --}}

        <div class="header text-center">
            <div class="d-none d-lg-block">
                <h1 class="text-center py-3 c-blue">برای دسترسی به این صفحه باید کاربر ویژه مانابورس باشید</h1>
            </div>
            <div class="d-lg-none">
                <h6 class="text-center py-3 c-blue">برای دسترسی به این صفحه باید کاربر ویژه مانابورس باشید</h6>
            </div>
            <a href="#" class="p-1 text-white font-weight-bold redu8 h5">
                <img src="{{asset('/assets/stock/4.png')}}" style="max-height: 64px;" alt="مانابورس"> 
                تهیه اشتراک ویژه
                <img src="{{asset('/assets/stock/4.png')}}" style="max-height: 64px;" alt="مانابورس"> 
            </a>
        </div>

        @if ($old_user)
            <div id="lorem" class="container p-4">
                <div class="col-md-9 col-lg-6 col-xl-5 mx-auto">
                    <div class="row">
                        <div class="col ">
                            {{auth()->user()->first_name.' '.auth()->user()->last_name}}
                        </div>
                        <div class="col-8 p-0">
                            برای مشاهده تحلیل ها, اشتراک ویژه خود را تمدید کنید
                        </div>
                        <div class="col-12 py-3 text-center">
                            برای مشاهده پکیج های اشتراک ویژه و تمدید اشتراک روی دکمه زیر کلیک کنید.
                        </div>
                        <div class="col-12 text-center">
                            <a href="#" onclick="changeBox()" class="btn btn-primary">متوجه شدم</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div id="servicePackagePrice" class="container py-4 {{$old_user?'d-none':''}}">
            <div class="row">
                @foreach (\App\Model\ServicePackagePrice::orderBy('sort')->get() as $package)
                    <div class="col-lg mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold text-dark text-center m-0">{{$package->title}}</h4>
                            </div>
                            <div class="card-body">
                                <h4 class="font-weight-bold text-center m-0 pt-2 pb-3 c-blue" style="{{ intVal($package->off_price) > 0 ? 'text-decoration: line-through' : '' }}">
                                    {{number_format( $package->price )}} ریال </h4>
                                    
                                @if (intVal($package->off_price) > 0)
                                    <h4 class="font-weight-bold text-center m-0 c-blue">{{number_format( $package->off_price )}} ریال </h4>
                                    <span class="badge bg-danger" style="position: relative;top: -44px;right: 24px;">تخفیف</span>
                                @endif

                                @if ($data->where('section', 100)->count() && $data->where('section', 100)->first()->text)
                                    <div class="mx-3 mb-4 p-1 py-3 text-center text-white" style="background: #2e343e;border-radius: 50px;">
                                        {{$data->where('section', 100)->first()->title}}    
                                    </div>
                                @endif

                                <div class="my-2">
                                    <h6 class="px-3">
                                        <i class="fa fa-circle" style="font-size: 6px;"></i>
                                        دسترسی به تمام تحلیل های ویژه</h6>
                                    <h6 class="px-3">
                                        <i class="fa fa-circle" style="font-size: 6px;"></i>
                                        دسترسی به لحظه های مهم بازار</h6>
                                </div>

                                <h6 class="text-right text-dark m-0 pb-3">
                                    <img src="{{asset('/assets/stock/3.png')}}" style="max-height: 54px;" alt="مانابورس"> 
                                    دسترسی سریع
                                </h6>

                                <div class="text-center pb-3">
                                    {{-- $package->day --}}
                                    {{-- <a href="#" @if (auth()->user()) onclick="alert('سرویس فعلا دردسترس نیست. لطفا از طریق سفارش آفلاین اقدام نمایید')" @else data-bs-toggle="modal" data-bs-target="#login" @endif class="p-1 text-white font-weight-bold h5 green">
                                        سفارش آنلاین 
                                    </a> --}}
                                    @if (auth()->user())
                                        <a href="#" onclick="changeAmount('{{$package->off_price?$package->off_price:$package->price}}')" class="p-2 px-3 text-white font-weight-bold h5 green">ثبت سفارش</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalTicket" id="openToModalTicket" class="p-2 px-3 text-white font-weight-bold h5 green d-none">ثبت سفارش</a>
                                    @else
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="p-2 px-3 text-white font-weight-bold h5 green">ثبت سفارش</a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    
        <div class="col-12">
    
            <div class="row py-4">
                <div class="col-lg-4">
                    <div class="left-lorem p-4 m-2 m-lg-0">
                        {{-- <a href="#" data-bs-toggle="modal" @if (auth()->user()) data-bs-target="#ModalTicket" @else  data-bs-target="#login" @endif --}}
                        <a href="#" class="p-2 px-3 text-white font-weight-bold h5 green">مراحل ثبت سفارش</a>
                        <h5 class="text-darkness pt-3">واریز مبلغ موردنظر از طریق شماره شبا یا شماره کارت</h5>
                        <h5 class="text-darkness">ثبت سند واریزی</h5>
                        <h5 class="text-darkness">بارگذاری و ارسال رسید پرداخت</h5>
                        <h5 class="text-darkness">تایید رسید و فعال شدن دسترسی</h5>
                    </div>
                </div>
    
                <div class="col-lg my-4"></div>
    
                <div class="col-lg-4">
                    <div class="pb-2 text-darkness" style="direction: ltr;">
                        <h5 class="text-center m-0 py-1">شماره کارت</h5>
                        <div><h4 class="text-center">{{ str_replace('-',' ',env('CARD_NUM')) }}</h4></div>
                    </div>
    
                    <div class="pb-2 text-darkness" style="direction: ltr;">
                        <h5 class="text-center m-0 py-1">شماره شبا</h5>
                        <div><h4 class="text-center">IR {{ env('SHABA_NUM') }}</h4></div>
                    </div>
                    
                    <div class="text-center pb-4">
                        <a href="#" class="p-2 px-3 text-white font-weight-bold h5 green">به نام سارا ستاری نیا</a>
                    </div>
                </div>
            </div>
    
            <div class="row py-4">
                <div class="col-lg my-auto">
                    <div class="row">
    
                        <div class="col-lg"></div>

                        <div class="col-lg-auto my-auto">
                            <h1 class="text-darkness font-weight-bold text-center">
                                راه های ارتباط با مانابورس
                            </h1>
                        </div>
    
                        <div class="col-lg-4 text-center text-lg-end">
                            <img src="{{asset('/assets/stock/1.png')}}" class="p-2 my-1 me-lg-3" style="max-height: 128px;border-radius: 50%;border: 20px solid white;" alt="مانابورس"> 
                        </div>

                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="right-lorem pt-2 px-4 m-2 m-lg-0">
                        <div class="pb-2 text-darkness d-flex" style="direction: ltr;">
                            <div class="p-1 icon">
                                <i class="fa fa-phone text-white pt-1"></i>
                            </div>
                            <h5 class="m-0 pt-2 px-2 ">
                                021-91074000 / 747 - 748
                            </h5>
                        </div>
                        
                        <div class="pb-2 text-darkness d-flex" style="direction: ltr;">
                            <div class="p-1 icon">
                                <i class="fa fa-envelope text-white pt-1"></i>
                            </div>
                            <h5 class="m-0 pt-2 px-2 ">
                                info@manabourse.com
                            </h5>
                        </div>
    
                        <div class="pb-2 text-darkness d-flex" style="direction: ltr;">
                            <div class="p-1 icon">
                                <i class="fa fa-globe text-white pt-1"></i>
                            </div>
                            <h5 class="m-0 pt-2 px-2 ">
                                www.manabourse.com
                            </h5>
                        </div>
                        
                        <div class="pb-2 text-darkness d-flex" style="direction: ltr;">
                            <div class="p-1 icon">
                                <i class="fab fa-telegram-plane text-white pt-1"></i>
                            </div>
                            <h5 class="m-0 pt-2 px-2 ">
                                t.me/manabourse
                            </h5>
                        </div>
                        
                        <div class="pb-2 text-darkness d-flex" style="direction: ltr;">
                            <div class="p-1 icon">
                                <i class="fa fa-mobile text-white pt-1"></i>
                            </div>
                            <h5 class="m-0 pt-2 px-2 ">
                                09398435746
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    
    </section>
@endif

<!-- Modal send ticket -->
<div class="modal fade" id="ModalTicket">
    <div class="modal-dialog modal-lg">
        <div class="modal-content redu20"> 
            <div class="modal-header">
                <h4 class="modal-title">رسید پرداخت نقدی - کارت به کارت</h4>
            </div>
            <div class="modal-body">
                
                <div class="content">
                    <form method="post" action="{{route('user.contact.post')}}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <input type="hidden" name="category" value="کاربر ویژه">
                            {{-- <input type="hidden" name="type" value="رسید پرداخت نقدی - کارت به کارت"> --}}
                            <div class="form-group">
                                <label class="form-group mb-1" for="amount" id="label_amount_id">مبلغ :<span>(required)</span></label>
                                <input id="amount_id" type="number" id="amount-form" name="subject" class="form-control">
                            </div>
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
    function newIco(x, index) {
        document.getElementById(`old${index}`).classList.add("d-none");
        document.getElementById(`new${index}`).classList.remove("d-none");
    }
    
    function oldIco(x, index) {
        document.getElementById(`new${index}`).classList.add("d-none");
        document.getElementById(`old${index}`).classList.remove("d-none");
    }
    
    function changeBox() {
        document.querySelector('#lorem').classList.add("d-none");
        document.querySelector('#servicePackagePrice').classList.remove("d-none");
    }

    function changeAmount(val) {
        document.querySelector('#amount_id').value = val;
        document.querySelector('#openToModalTicket').click();
    }
    
</script>
@endsection
