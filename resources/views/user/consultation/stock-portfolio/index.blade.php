@extends('layouts.layout_first_page')
@section('content')
<style>
    .blogs .blog .card {border-radius: 20px;border: 2px solid #928c8c !important;}
    .blogs .blog .card-border-bottom {border-bottom: 2px solid #928c8c !important;}
    .blogs .blog .card .body {width: 148px;height: 148px;}
    
    .stock {background: #ecf0f3}
    .redu8 {border-radius: 8px}
    .c-blue {color: #214f7a}
    .header a {background: #008037}
    .stock .card {background: #f2f2f3 !important;border: none !important;}
    .stock .card-header {background: #5271ff3b !important}
    .stock a.green {background: #07b451;border-radius: 12px}
    .stock .text-darkness {color: #303642}
    .stock .left-lorem {border-bottom-left-radius: 15% 50%;border-top-left-radius: 15% 50%;box-shadow: -20px -10px 20px white;}
    .stock .right-lorem {border-bottom-right-radius: 15% 50%;border-top-right-radius: 15% 50%;box-shadow: 20px -10px 20px white;}
    .stock .icon {border-radius: 50%;width: 36px;height: 36px;background: black;text-align: center;}

    .stock , .blogs {max-width: 100% !important;overflow: hidden !important;}
</style>

@if (auth()->user() && auth()->user()->is_special())
    <section class="blogs"> 
        <div class="col-12">
            <div class="row">
        
                <div class="col-lg-4">
                    <div class="cats">
        
                        <h6>جست‌و‌جو</h6>
                        
                        <form id="searchForm" action="{{ route('user.stock-portfolio.store') }}" method="POST">
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
        
                        <h5 class="pt-5 fw-bold">تازه‌ها</h5>

                        @foreach ($latest as $item)
                            <div class="pt-4">
                                <h6>
                                    <a href="{{ route('user.stock-portfolio.show',$item->slug) }}" class="link">{{$item->title}}</a>
                                </h6>
                                <span class="text-secondary">{{my_jdate($item->updated_at,'d F Y')}}</span>
                            </div>
                        @endforeach
                        
                        <h5 class="pt-5 fw-bold">دسته‌ بندی ها</h5>
                        
                        @foreach ($cats as $cat)
                            <h6 class="pt-3">
                                <a href="{{ route('user.stock-portfolio.edit',$cat->slug) }}" class="link">{{$cat->title}}</a>
                            </h6>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-8 pt-3 pt-lg-4">
                    <div class="blog">

                        @if ( \Request::route()->getName()=='user.stock-portfolio.index' )
                            
                            <h1 class="text-center">آرشیو</h1>
                            <h4 class="text-center pb-3">گزارش لحظه های مهم بازار</h4>
                            @if ($items->count()==0)
                                <div class="items p-4 border-bottom">
                                    <div class="hashtaq mb-4 py-2">
                                        <a class="p-2 px-3" href="#">{{$id}}</a>
                                    </div>
                                    <a href="#"><h5>موردی یافت نشد</h5></a>
                                </div>
                            @endif
                            <div class="row">
                                @foreach ($items as $item)
                                    <div class="col-6 col-md-4 col-lg-3">
                                        <div class="card shadow m-1 mb-4">
                                            <div class="card-border-bottom text-center p-1">{{my_jdate($item->created_at,'Y/m/d')}}</div>

                                            <a href="{{ route('user.stock-portfolio.show',$item->slug) }}">
                                                <div class="body text-dark text-center mx-auto p-2">
                                                    <img src="{{asset('/assets/stock/1.png')}}" style="max-height: 48px;" alt="{{$item->title}}"> 
                                                    <h6 class="text-center m-0" style="line-height: 1.6;">{{$item->title}}</h6>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @else

                            @if ($items->count()==0)
                                <div class="items p-4 border-bottom">
                                    <a href="#"><h5>موردی یافت نشد</h5></a>
                                </div>
                            @endif
                            @foreach ($items as $item)
                                <div class="items p-4 border-bottom aos-init aos-animate " data-aos="flip-up" onmouseover="newIco(this, '{{$item->id}}')" onmouseout="oldIco(this, '{{$item->id}}')">
                                    
                                    <a href="{{ route('user.stock-portfolio.show',$item->slug) }}">
                                        <h5>{{$item->title}}</h5>
                                        <p class="py-2 mb-0">{{$item->short_text}}</p>
                                    </a>
                                    
                                    <div id="old{{$item->id}}" class="col-12 pt-2 old">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div id="new{{$item->id}}" class="col-12 pt-2 d-none">
                                        <i class="fa fa-close text-secondary"></i>
                                    </div>
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
    
        <div class="container py-4">
            <div class="row">
                @foreach (\App\Model\ServicePackagePrice::all() as $package)
                    <div class="col-lg mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold text-dark text-center m-0">{{$package->title}}</h4>
                            </div>
                            <div class="card-body">
                                <h4 class="font-weight-bold text-center m-0 py-2 c-blue">{{number_format( $package->price )}} ریال </h4>
                                {{-- <h5 class="font-weight-bold text-center text-dark m-0 pb-3"> ریال</h5> --}}

                                <div class="my-2">
                                    <h6 class="px-4">
                                        <i class="fa fa-circle" style="font-size: 6px;"></i>
                                        دسترسی به تمام تحلیل های ویژه</h6>
                                    <h6 class="px-4">
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
                                    <a href="#" data-bs-toggle="modal" @if (auth()->user()) data-bs-target="#ModalTicket" @else  data-bs-target="#login" @endif
                                         class="p-2 px-3 text-white font-weight-bold h5 green">ثبت سفارش</a>

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
                        <a href="#" 
                             class="p-2 px-3 text-white font-weight-bold h5 green">مراحل ثبت سفارش</a>
                        <h5 class="pt-3 text-darkness">۱-عضویت در سایت و انتخاب بسته اشتراکی</h5>
                        <h5 class="text-darkness">۲-پرداخت و ارسال فیش از طریق سایت</h5>
                        <h5 class="text-darkness">۳-تایید فیش واریزی و فعال شدن دسترسی</h5>
                        <h5 class="text-darkness">IR {{ env('SHABA_NUM') }}</h5>
                        <h5 class="text-darkness">شماره کارت {{ str_replace('-',' ',env('CARD_NUM')) }}</h5>
                        <h5 class="text-darkness">به نام : سارا ستاری نیا</h5>
                    </div>
                </div>
    
                <div class="col-lg my-4"></div>
    
                <div class="col-lg-4 text-center my-auto">
                    <img src="{{asset('/assets/stock/1.png')}}" class="p-2" style="max-height: 128px;border-radius: 50%;border: 20px solid white;" alt="مانابورس"> 
                    <h1 class="text-darkness text-center font-weight-bold pt-3">مانابورس</h1>
                </div>
            </div>
    
            <div class="row py-4">
                <div class="col-lg my-auto">
                    <h1 class="text-darkness font-weight-bold text-center">
                        راه های ارتباط با مانابورس
                    </h1>
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
                                <label class="form-group mb-1" for="fish_id">مبلغ :<span>(required)</span></label>
                                <input type="number" id="amount-form" name="subject" class="form-control">
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
</script>
    
@endsection
