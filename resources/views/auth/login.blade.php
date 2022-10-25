@extends('user.master')
@section('content')
<style>
    input.floating-input:focus {
        background-color: transparent !important;
    }
</style>
    <main class="flex-shrink-0">
        <div class="container text-center mt-4">
            {{-- <div class="icon icon-100 text-white text-center"> --}}
                <img src="{{ \App\Model\Setting::first()->logo_site }}" alt="{{ \App\Model\Setting::first()->title }}" style="width: 156px">
            {{-- </div> --}}
            <h2 class="my-4">{{ \App\Model\Setting::first()->title }}</h2>
        </div>
        <div class="container">
            <form method="POST" action="{{route('user.sign-up-using-mobile.store')}}" class="login-box">
                
                <input type="hidden" name="form_set" id="form_set" value="login">

                <div class="form-group floating-form-group">
                    <input type="text" name="mobile" id="mobile" class="form-control floating-input" style="text-align: left" required autofocus>
                    <label class="floating-label">موبایل خود را وارد کنید</label>
                </div>

                <div class="form-group floating-form-group">
                    <input type="password" name="password" id="password" class="form-control floating-input" required >
                    <label class="floating-label">رمزعبور را وارد کنید</label>
                </div>

                <div id="conf_password" class="d-none">

                    <div class="form-group floating-form-group">
                        <input type="password" name="conf_password" id="conf_password" class="form-control floating-input">
                        <label class="floating-label">تکرار رمزعبور را وارد کنید</label>
                    </div>

                    <div class="form-group floating-form-group">
                        <input type="text" name="f_name" id="f_name" class="form-control floating-input">
                        <label class="floating-label">نام خود را وارد کنید</label>
                    </div>

                    <div class="form-group floating-form-group">
                        <input type="text" name="l_name" id="l_name" class="form-control floating-input">
                        <label class="floating-label">نام خانوادگی خود را وارد کنید</label>
                    </div>

                    <div class="form-group floating-form-group">
                        <input type="text" name="code" id="code" class="form-control floating-input">
                        <label class="floating-label">کد ملی خود را وارد کنید</label>
                    </div>

                </div>

                <div id="reg_help" class="form-group my-4 text-secondary">
                    با کلیک روی دکمه زیر قوانین را مطالعه میکنم
                    <br>
                    <a href="#" data-toggle="modal" data-target="#modal" class="link">قوانین و مقررات</a>
                </div>

                <div id="log_help" class="form-group my-4 text-secondary">
                    رمز عبور خود را فراموش کردی ؟
                    <br>
                    <a href="#" data-toggle="modal" data-target="#modal-2" class="link">بازنشانی رمز عبور</a>
                </div>

                <button id="submit" type="submit" class="btn col-12 btn-block btn-danger mt-2">ورود</button>
                @csrf
            </form>
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <button onclick="changState('login')" class="link h6 d-none" id="reg_link">حساب کاربری دارید؟ از اینجا وارد شوید</button>
                    <button onclick="changState('register')" class="link h6" id="log_link">ایجاد حساب کاربری</button>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal" id="modal">
        <div class="modal-dialog modal-dialog-scrollable pt-4">
            <div class="modal-content" style="border-radius: 30px;">
                <div class="modal-body">
                    <h4 class="mb-3">{{App\Model\About::find(1)->title_rule}}</h4>
                    {!! App\Model\About::find(1)->text_rule !!}
                    <button data-dismiss="modal" class="btn btn-success col-12 btn-block mt-3">قوانین را قبول دارم </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-2">
        <div class="modal-dialog modal-dialog-scrollable pt-4">
            <div class="modal-content mt-5" style="border-radius: 30px;">
                <div class="modal-body">
                    <form method="GET" action="{{route('user.sign-up-using-mobile.remember-password')}}" class="login-box">
                        <h6>شماره موبایل خود را وارد کنید</h6>
                        <div class="form-group floating-form-group">
                            <input type="text" name="id" id="id" class="form-control floating-input" required autofocus>
                            <label class="floating-label">موبایل خود را وارد کنید</label>
                        </div>
        
                        <button id="submit" type="submit" class="btn col-12 btn-block btn-danger mt-2">ارسال</button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

{{-- <script>
    function changState(state) {
        switch (state) {
            case 'login':
                document.getElementById("conf_password").classList.add("d-none");
                document.getElementById("reg_link").classList.add("d-none");
                document.getElementById("reg_help").classList.add("d-none");
                document.getElementById("log_link").classList.remove("d-none");
                document.getElementById("log_help").classList.remove("d-none");
                document.getElementById("submit").classList.remove("btn-info");
                document.getElementById("submit").classList.add("btn-success");
                document.getElementById("submit").innerHTML = "ورود";
                document.getElementById("form_set").value = state;
                break;
            case 'register':
                document.getElementById("log_link").classList.add("d-none");
                document.getElementById("log_help").classList.add("d-none");
                document.getElementById("conf_password").classList.remove("d-none");
                document.getElementById("reg_link").classList.remove("d-none");
                document.getElementById("reg_help").classList.remove("d-none");
                document.getElementById("submit").classList.remove("btn-success");
                document.getElementById("submit").classList.add("btn-info");
                document.getElementById("submit").innerHTML = "ثبت نام";
                document.getElementById("form_set").value = state;
                break;
        }
    }
</script> --}}


<script>
    $(function(){
        $("input[name='mobile']").on('input', function (e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });
</script>
<script>
    function changState(state) {
        switch (state) {
            case 'register':
                document.getElementById("log_link").classList.add("d-none");
                document.getElementById("conf_password").classList.remove("d-none");
                document.getElementById("log_help").classList.add("d-none");
                document.getElementById("reg_link").classList.remove("d-none");
                // document.getElementById("reg_help").classList.remove("d-none");
                document.getElementById("submit").classList.remove("btn-danger");
                document.getElementById("submit").classList.add("btn-success");
                document.getElementById("submit").innerHTML = "ثبت نام";
                document.getElementById("form_set").value = state;
                break;
            case 'login':
                document.getElementById("reg_link").classList.add("d-none");
                document.getElementById("conf_password").classList.add("d-none");
                document.getElementById("log_link").classList.remove("d-none");
                document.getElementById("log_help").classList.remove("d-none");
                document.getElementById("submit").classList.remove("btn-success");
                document.getElementById("submit").classList.add("btn-danger");
                document.getElementById("submit").innerHTML = "ورود";
                document.getElementById("form_set").value = state;
                // document.getElementById("reg_help").classList.add("d-none");
                break;
            case 'remember-password':
                document.getElementById("remember-password").classList.remove("d-none");
                document.getElementById("sign-up").classList.add("d-none");
                break;
        }
    }
</script>
@endsection
