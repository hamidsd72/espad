@extends('layouts.layout_first_page')
@section('content')
<style>
    .body {
        min-height: 480px;
    }
</style>

    <div class="body">
        <div class="container d-none" id="two-step">
            <div class="row">
                <div class="col-12 my-5">
                    <h5 class="p-4" id="show-price"></h5>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-lg col-12 btn-primary">پرداخت از درگاه</a>
                </div>
                <div class="col">
                    
                    <a href="#" data-bs-toggle="modal" data-bs-target="#ModalTicket" class="btn btn-lg col-12 btn-secondary">رسید بانکی</a>
                </div>
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
                <div class="col-lg-8 col-md-10 mx-auto mb-3">
                    <h4>شارژ سریع</h4>
                    <small class="text-secondary text-uppercase">جهت انتخاب بسته کلیک کنید</small>
                </div>
                <div class="row">

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
                
                    <div class="col-lg-4 col-md-6 my-2">
                        <button onclick="setMoney('{{$amount}}')" class="btn btn-primary col-12">
                            <h5 class="text-center my-2">پکیج شماره {{$i+1}}</h5>
                            <h6 class="text-center mb-2"> انتخاب بسته {{$text}} تومان</h6>
                        </button>
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