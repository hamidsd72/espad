@extends('layouts.layout_first_page')
@section('content')
    <div class="card">

        <div class="card-header">
            <h4 class="card-title">ورود و ثبت نام</h4>
            <img src="/{{ \App\Model\Setting::first()->logo_site }}" alt="{{ \App\Model\Setting::first()->title }}" style="width: 96px">
        </div>

        <div class="card-body">

            <main class="flex-shrink-0">
                <div class="container">
                    <form method="POST" action="{{route('user.sign-up-using-website.resend-password')}}" class="col-lg-6 mx-auto my-4">
                        <h5>جهت بازیابی رمز عبور کد تایید هویت و رمزعبور جدید را وارد کنید</h5>
                        <div class="form-group floating-form-group">
                            <label class="floating-label my-2">موبایل خود را وارد کنید</label>
                            <input type="text" name="mobile" id="mobile" class="form-control floating-input" value="{{$id}}" readonly>
                        </div>

                        <div class="form-group floating-form-group">
                            <label class="floating-label my-2">کد شش رقمی را وارد کنید</label>
                            <input type="number" name="acc_code" id="acc_code" class="form-control floating-input" required autofocus>
                        </div>

                        <div class="form-group floating-form-group">
                            <label class="floating-label my-2">رمزعبور را جدید وارد کنید</label>
                            <input type="password" name="password" id="password" class="form-control floating-input" required >
                        </div>
                        <div class="form-group floating-form-group">
                            <label class="floating-label my-2">تکرار رمزعبور جدید را وارد کنید</label>
                            <input type="password" name="conf_password" id="conf_password" class="form-control floating-input" required>
                        </div>
        
                        <button id="submit" type="submit" class="btn btn-primary mt-3">ارسال</button>
                        @csrf
                    </form>
                </div>
            </main>
        </div>

    </div>

    <script>
        $(function(){
            $("input[name='mobile']").on('input', function (e) {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
        });
    </script>

@endsection
