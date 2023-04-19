@extends('layouts.layout_first_page')
@section('content')
<style>
    .body {
        min-height: 480px;
    }
    #setMoney .card {border-radius: 20px;border: 3px solid #303642 !important;}
    #setMoney .card-border-bottom {border-bottom: 2px solid #928c8c !important;}
    #setMoney .card .body {width: 148px;height: 148px;}
    #setMoney .card .card-bottom-null {height: 18px;background: #303642;margin: auto 4px;}
    #setMoney a.green {background: #07b451;border-radius: 12px}

    
</style>

    <div class="body">
        <div class="container d-none" id="two-step">
            <div class="row">
                <div class="col-12 my-5">
                    <h5 class="p-4" id="show-price"></h5>
                </div>
                {{-- <div class="col">
                    <a href="#" class="btn btn-lg col-12 btn-primary">پرداخت از درگاه</a>
                </div> --}}
                <div class="col-md-6 col-lg-4 mx-auto">
                    
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ModalTicket" class="btn btn-lg col-12 btn-secondary">رسید بانکی</a>
                </div>
            </div>

            <div class="pt-5">
                <h4 class="text-center py-2">اطلاعات جهت پرداخت  (کارت به کارت)</h4>
                <h5 class="text-center">IR {{ env('SHABA_NUM') }}</h5>
                <h5 class="text-center"> شماره کارت {{ str_replace('-',' ',env('CARD_NUM')) }}</h5>
                <h5 class="text-center">به نام : سارا ستاری نیا</h5>
            </div>
        </div>

        <div id="one-step">
 
            <div class="container mt-5">
                <div class="col-md-10 col-lg-6 mx-auto">
                    <input type="number" name="price" id="price" class="form-control form-control-lg" onkeyup="changeAmount()" placeholder="مبلغ شارژ را وارد کنید">
                    <p class="my-1 text-danger d-none" id="e-price">حداقل مبلغ شارژ ۱۰۰۰۰ نومان میباشد</p>
                </div>
                <div class="row my-3">
                    <div class="col-12 col-md-6 col-lg-4 mx-auto">
                        <button onclick="setMoney2()" id="next-step" class="btn btn-lg col-12 btn-success mb-3 d-none">ایجاد فاکتور</button>
                    </div>
                </div>
            </div>
        
            <div id="setMoney" class="container">
                <div class="col-lg-8 col-md-10 mx-auto mb-4">
                    <h4>شارژ سریع</h4>
                    <small class="text-secondary text-uppercase">جهت انتخاب بسته کلیک کنید</small>
                </div>
                <div class="row">

                @for ($i = 0; $i < 5; $i++)
                    <div class="d-none">
                        @switch($i)
                            @case(0)
                                {{$amount   = 100000}}
                                @break
                            @case(1)
                                {{$amount   = 250000}}
                                @break
                            @case(2)
                                {{$amount   = 800000}}
                                @break
                            @case(3)
                                {{$amount   = 1200000}}
                                @break
                            @case(4)
                                {{$amount   = 2000000}}
                                @break
                        @endswitch
                    </div>
                
                    <div class="col-lg col-md-6 my-2">
                        {{-- <button onclick="setMoney('{{$amount}}')" class="btn btn-primary col-12">
                            <h5 class="text-center my-2">پکیج شماره {{$i+1}}</h5>
                            <h6 class="text-center mb-2"> انتخاب بسته  تومان</h6>
                        </button> --}}

                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold text-dark text-center m-0">بسته مکالمه</h4>
                            </div>
                            <div class="card-body">
                                <h4 class="font-weight-bold text-center m-0 py-2 c-blue">{{num2fa(number_format($amount))}} ریال </h4>

                                <h6 class="text-right text-dark m-0 pb-3">
                                    <img src="{{asset('/assets/stock/3.png')}}" style="max-height: 54px;" alt="مانابورس"> 
                                    فعالسازی سریع
                                </h6>

                                <div class="text-center pb-3">
                                    <a href="#" onclick="setMoney('{{$amount}}')" class="p-2 px-3 text-white font-weight-bold h5 green">ثبت سفارش</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    @endfor
                </div>
        
            </div>

        </div>
    </div>

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
                                <input type="hidden" name="category" value="رسید پرداخت">
                                <input type="hidden" id="amount-form" name="subject" >
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
        function changeAmount() {
            let amount = document.getElementById('price').value;
            if (document.getElementById('price').value > 9999) {
                document.getElementById('e-price').classList.add('d-none');
                document.getElementById('next-step').classList.remove('d-none');

            } else {
                document.getElementById('e-price').classList.remove('d-none');
                document.getElementById('next-step').classList.add('d-none');
            }
        }
        function setMoney(amount) {
            document.getElementById('one-step').classList.add('d-none');
            document.getElementById('two-step').classList.remove('d-none');
            document.getElementById('show-price').innerHTML = `مبلغ قابل پرداخت ${amount} تومان میباشد`;
            document.getElementById('amount-form').value = amount;
        }
        function setMoney2() {
            let amount = document.getElementById('price').value;
            document.getElementById('one-step').classList.add('d-none');
            document.getElementById('two-step').classList.remove('d-none');
            document.getElementById('show-price').innerHTML = `مبلغ قابل پرداخت ${amount} تومان میباشد`;
            document.getElementById('amount-form').value = amount;
        }
    </script>

@endsection