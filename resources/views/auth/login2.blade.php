<div class="modal fade" id="login">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ورود و ثبت نام</h4>
                <img src="/{{ \App\Model\Setting::first()->logo_site }}" alt="{{ \App\Model\Setting::first()->title }}" style="width: 96px">
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
    
                <main class="flex-shrink-0">
                    <div class="container">
                        <form method="GET" action="{{route('user.sign-up-using-website.remember-password')}}" id="remember-password" class="login-box-2 d-none">
                            <h6>جهت بازیابی رمز عبور شماره موبایل خود را وارد کنید</h6>
                            <div class="form-group floating-form-group col-lg-6">
                                <label class="floating-label my-2">موبایل خود را وارد کنید</label>
                                <input type="text" name="mobile" id="mobile156" class="form-control floating-input" required autofocus>
                            </div>

                            <button id="submit" type="submit" class="btn btn-primary mt-3" >بازیابی</button>
                            @csrf
                        </form>

                        <form method="POST" action="{{route('user.sign-up-using-website.store')}}" id="sign-up" class="login-box-1">
                            
                            <input type="hidden" name="form_set" id="form_set" value="login">

                            <div class="row">

                                <div class="form-group floating-form-group col-lg-6">
                                    <label class="floating-label my-2">موبایل خود را وارد کنید</label>
                                    <input type="text" name="mobile" id="mobile156" class="form-control floating-input" style="text-align: left" required autofocus>
                                </div>
    
                                <div class="form-group floating-form-group col-lg-6">
                                    <label class="floating-label my-2">رمزعبور را وارد کنید</label>
                                    <input type="password" name="password" id="password" class="form-control floating-input" required >
                                </div>

                            </div>

                            <div id="conf_password" class="d-none col-12">

                                <div class="row">

                                    <div class="form-group floating-form-group col-lg-6">
                                        <label class="floating-label my-2">تکرار رمزعبور را وارد کنید</label>
                                        <input type="password" name="conf_password" id="conf_password" class="form-control floating-input">
                                    </div>
    
                                    <div class="form-group floating-form-group col-lg-6">
                                        <label class="floating-label my-2">کد ملی خود را وارد کنید</label>
                                        <input type="text" name="code" id="code" class="form-control floating-input">
                                    </div>

                                    <div class="form-group floating-form-group col-lg-6">
                                        <label class="floating-label my-2">نام خود را وارد کنید</label>
                                        <input type="text" name="f_name" id="f_name" class="form-control floating-input">
                                    </div>
    
                                    <div class="form-group floating-form-group col-lg-6">
                                        <label class="floating-label my-2">نام خانوادگی خود را وارد کنید</label>
                                        <input type="text" name="l_name" id="l_name" class="form-control floating-input">
                                    </div>

                                </div>

                            </div>

                            <div id="log_help" class="form-group my-4 text-secondary">
                                رمز عبور خود را فراموش کردی ؟
                                <br>
                                <a href="#" onclick="changState('remember-password')" class="link">بازنشانی رمز عبور</a>
                            </div>

                            {{-- <button id="submit_22" type="submit" class="btn btn-primary mt-3">ورود</button> --}}
                            <button id="submit_22" type="submit" class="btn btn-primary mt-3">ارسال</button>
                            <button onclick="changState('login')" class="btn btn-secondary float-start mt-3 d-none" id="reg_link_22">حساب کاربری دارید؟ از اینجا وارد شوید</button>
                            <button onclick="changState('register')" class="btn btn-secondary float-start mt-3" id="log_link_22">ایجاد حساب کاربری</button>
                            @csrf
                        </form>
                    </div>
                </main>
            </div>
    
        </div>
    </div>
</div>

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
                document.getElementById("log_link_22").classList.add("d-none");
                document.getElementById("conf_password").classList.remove("d-none");
                document.getElementById("log_help").classList.add("d-none");
                document.getElementById("reg_link_22").classList.remove("d-none");
                // document.getElementById("reg_help").classList.remove("d-none");
                document.getElementById("submit_22").classList.remove("btn-primary");
                document.getElementById("submit_22").classList.add("btn-success");
                document.getElementById("submit_22").innerHTML = "ثبت نام";
                document.getElementById("form_set").value = state;
                break;
            case 'login':
                document.getElementById("reg_link_22").classList.add("d-none");
                document.getElementById("conf_password").classList.add("d-none");
                document.getElementById("log_link_22").classList.remove("d-none");
                document.getElementById("log_help").classList.remove("d-none");
                document.getElementById("submit_22").classList.remove("btn-success");
                document.getElementById("submit_22").classList.add("btn-primary");
                document.getElementById("submit_22").innerHTML = "ورود";
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