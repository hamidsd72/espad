@extends('user.master')
@section('content')

<div class="pt-5 mt-4"></div>

    <div class="container d-none" id="two-step">
        <div class="row mb-5">
            <div class="col-12">
                <h5 class="p-4" id="show-price"></h5>
            </div>
            <div class="col">
                <a href="#" class="btn col-12 btn-danger">پرداخت از درگاه</a>
            </div>
            <div class="col">
                <a href="#" data-toggle="modal" data-target="#ModalTicket" class="btn col-12 btn-dark">رسید بانکی</a>
            </div>
        </div>
    </div>

    <div id="one-step">

        <div class="container">
            <div class="col-12 col-md-6 col-lg-4 mx-auto my-2">
                <h6 class="mb-3">لطفا مبلغ شارژ را وارد نمایید</h6>
                <input type="number" name="price" id="price" class="form-control redu20" onkeyup="changeAmount()" placeholder="مبلغ شارژ را وارد کنید">
                <p class="my-1 text-danger d-none" id="e-price">حداقل مبلغ شارژ ۱۰۰۰۰ نومان میباشد</p>
            </div>
            <div class="row mb-2">
                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                    <button onclick="setMoney2()" id="next-step" class="btn col-12 btn-dark mb-3 d-none">ایجاد فاکتور</button>
                </div>
            </div>
        </div>
    
        <div id="setMoney" class="px-4">
            <h6 class="mb-3">شارژ سریع</h6>
            @for ($i = 0; $i < 6; $i++)
                <div class="d-none">
                    @switch($i)
                        @case(0)
                            {{$amount   = 100000}}
                            {{$text     = '۱۰۰,۰۰۰'}}
                            @break
                        @case(1)
                            {{$amount   = 200000}}
                            {{$text     = '۲۰۰,۰۰۰'}}
                            @break
                        @case(2)
                            {{$amount   = 400000}}
                            {{$text     = '۴۰۰,۰۰۰'}}
                            @break
                        @case(3)
                            {{$amount   = 800000}}
                            {{$text     = '۸۰۰,۰۰۰'}}
                            @break
                        @case(4)
                            {{$amount   = 1000000}}
                            {{$text     = '۱۰۰۰,۰۰۰'}}
                            @break
                        @case(5)
                            {{$amount   = 2000000}}
                            {{$text     = '۲۰۰۰,۰۰۰'}}
                            @break
                    @endswitch
                </div>
            
                <div class="px-2 mb-3">
                    <input type="radio" name="cards" class="checkbox-boxed" id="card{{$i+1}}" @if($i==10) checked @endif>
                    <label onclick="setMoney('{{$amount}}')" class="checkbox-lable payment-card-large shadow redu20 " for="card{{$i+1}}">
                        <span class="image-boxed text-white p-2 h-auto text-left">
                            <span class="h6 mb-0">پکیج شماره {{$i+1}}</span>
                            <span class="h6 my-1">{{$text}} تومان</span>
                        </span>
                        <span>انتخاب بسته</span>
                    </label>
                </div>
    
            @endfor
    
        </div>

    </div>

    <!-- Modal send ticket -->
    <div class="modal fade" id="ModalTicket" role="dialog">
        <div class="modal-dialog">

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
                                <div class="form-field form-text">
                                    <label class="contactEmailField color-theme" for="contactEmailField"> شماره فیش :<span>(required)</span></label>
                                    <input type="text" name="fish_id" class="round-small col-12" id="contactEmailField">
                                </div>
                                <div class="form-field form-text">
                                    <label class="contactEmailField color-theme" for="contactEmailField"> جهار رقم آخر کارت :<span>(required)</span></label>
                                    <input type="number" name="card_number" class="round-small col-12" id="contactEmailField">
                                </div>
                                <div class="form-group">
                                    <label class="form-group mt-3 mb-1" for="bank">بانک خود را انتخاب کنید</label>
                                    <select class="form-control select2" name="bank">
                                        @foreach (\App\Model\Bank::orderByDesc('id')->get('title') as $key => $bank)
                                            <option value="{{$bank->title}}" @if ($key==0) selected @endif>{{$bank->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-4">
                                    <input type="file" name="attach" class="form-control" id="attach" accept=".jpeg,.jpg,.png" required> تصویر رسید را وارد کنید  
                                </div>
                                <div class="form-button">
                                    <input type="submit" class="btn btn-info col-12" value="ارسال رسید پرداخت" data-formid="contactForm">
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