<style>
    .menu-overlay .main-menu .menu-container .nav-pills .nav-item .nav-link {
        text-align: right !important;
    }
    .menu-overlay .main-menu .menu-container > .icon {
        border: none;
        box-shadow: none;
        -webkit-box-shadow: none;
    }
</style>
<header class="header" style="min-height: 60px !important;">
    <div class="row mb-0 pt-1">
        <div class="col-auto px-0">
            {{-- <button class="menu-btn btn btn-link-default" type="button">
                <i class="fas fa-bars" style="font-size: 20px;"></i>
                <img src="{{ asset('assets/app/icons/fav.png') }}" alt="" class="icon-size-24">
            </button> --}}
        </div>
        <div class="text-left col">
            <a class="navbar-brand" href="#">
                <div class="icon icon-44 text-white" style="height: 40px;width: 40px;">
                    <img src="{{auth()->user()->photo? url(auth()->user()->photo->path) :asset('admin/img/user.png')}}" alt="avatar" style="width: 100%;">
                </div>
                {{-- <a href="#" class="px-3 text-dark h6">{{\App\Model\Setting::first()->title}}</a> --}}
                <a href="#" class="px-2 text-dark">{{auth()->user()->first_name.' '.auth()->user()->last_name}}</a>
            </a>
        </div>
        <div class="ml-auto col-auto">
            {{-- <a href="profile.html" class="icon icon-44 shadow-sm">
                <figure class="m-0 background">
                    <img src="{{ asset('admin/img/user.png') }}" alt="">
                </figure>
            </a> --}}
            <a href="{{route('admin.factor-buy.index')}}" class="text-dark mx-1">
                <i class="fa fa-shopping-cart"></i>
                <div class="d-none">{{$factor = App\Model\ServiceFactor::where('user_id',auth()->user()->id)->where('status',"pending")->count()}}</div>
                {{$factor?$factor:''}}                
            </a>
            <a href="{{route('user.notification.index')}}" class="text-dark mx-1">
                <i class="fa fa-envelope mx-2"></i>
                <div class="d-none">{{$notification = App\Model\Notification::where('user_id', auth()->user()->id)->where('status', 'pending')->count()}}</div>
                {{$notification?$notification:''}}                
            </a>
            <button class="menu-btn btn btn-link-default" type="button">
                <i class="fas fa-bars" style="font-size: 20px;"></i>
                {{-- <img src="{{ asset('assets/app/icons/fav.png') }}" alt="" class="icon-size-24"> --}}
            </button>
        </div>
    </div>
</header>

<div class="main-menu">
    <div class="menu-container">
        <div class="icon icon-100 position-relative">
            <figure class="background">
                <img src="/{{ \App\Model\Setting::first()->app_icon }}" alt="{{\App\Model\Setting::first()->title}}" >
            </figure>
        </div>
        <ul class="nav nav-pills flex-column ">
            <li class="nav-item">
                <a class="nav-link {{ \Request::route()->getName() == 'user.index' ? 'active py-1 me-4' : '' }}" href="{{route('user.index')}}">صفحه اصلی</a>
            </li>
            
            {{-- @foreach($ServiceCats as $service)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.services',$service->id) }}">مشاوره {{$service->title}}
                    </a>
                </li>
            @endforeach --}}

            <li class="nav-item {{ \Request::route()->getName() == 'admin.profile.edit' ? 'active py-1 me-4' : '' }}">
                <a href="{{route('admin.profile.edit')}}" class="nav-link">ویرایش پروفایل</a>
            </li>

            <li class="nav-item {{ \Request::route()->getName() == 'admin.password.edit' ? 'active py-1 me-4' : '' }}">
                <a href="{{route('admin.password.edit')}}" class="nav-link">ویرایش رمزعبور</a>
            </li>

            <li class="nav-item {{ \Request::route()->getName() == 'user.basket_index' ? 'active py-1 me-4' : '' }}">
                <a href="{{route('user.app.call.user_call_report')}}" class="nav-link">
                    مشاوره های من 
                </a>
            </li>

            <li class="nav-item {{ \Request::route()->getName() == 'user.basket_index' ? 'active py-1 me-4' : '' }}">
                <a href="{{route('user.basket_index',auth()->user()->id)}}" class="nav-link">
                    کارگاه های من
                </a>
            </li>

            <li class="nav-item {{ \Request::route()->getName() == 'user.user-transaction.index' ? 'active py-1 me-4' : '' }}">
                <a href="{{route('user.user-transaction.index')}}" class="nav-link">افزایش اعتبار</a>
            </li>

            {{-- <li class="nav-item {{ \Request::route()->getName() == 'admin.report.transaction.list' ? 'active py-1 me-4' : '' }}">
                <a href="{{route('admin.report.transaction.list')}}" class="nav-link">
                    تراکنش های من
                </a>
            </li> --}}
        </ul>
        <a class="text-danger my-1 d-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            خروج از حساب
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        {{-- <button class="btn btn-danger sqaure-btn close text-white"><svg xmlns='http://www.w3.org/2000/svg' class="icon-size-24" viewBox='0 0 512 512'> --}}
        <button class="btn btn-secondary sqaure-btn close text-white"><svg xmlns='http://www.w3.org/2000/svg' class="icon-size-24" viewBox='0 0 512 512'>
                <title>ionicons-v5-l</title>
                <line x1='368' y1='368' x2='144' y2='144' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px' />
                <line x1='368' y1='144' x2='144' y2='368' style='fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px' />
            </svg>
        </button>
    </div>
</div>







    
    {{-- @if (Auth::user() && Auth::user()->first_name && Auth::user()->last_name)

        <div id="navbar1" class="nav-fixed navbar fixed-top navbar mx-auto px-3" style="max-width: 540px;padding-top: 12px;">
            <a href="/app" class="text-dark">سامانه آی مشاور</a>
            <div class="float-left pt-2">
                <a href="#" data-back-button="" class="text-dark shadow bg-white mx-1"><i class="fas fa-shopping-cart"></i></a>
                <a href="{{route('user.notification.index')}}" class="text-dark mx-1">
                    <i class="fas fa-bell">
                        @if (App\Model\Notification::where('user_id', auth()->user()->id)->where('status', 'pending')->count())
                            {{App\Model\Notification::where('user_id', auth()->user()->id)->where('status', 'pending')->count()}}
                        @endif
                    </i>
                </a>
                <a href="#" href="#" onclick="toggleNav()" class="text-dark"><i class="fas fa-bars"></i></a>
            </div>
        </div>

        <div id="navbar2" class="nav-fixed navbar fixed-top navbar mx-auto p-3" style="background: #ffffffd9;max-width: 540px;">
            <div class="float-right pt-1">
                <a href="{{route('user.notification.index')}}" class="text-dark mx-1">
                    <i class="fas fa-bell">
                        @if (App\Model\Notification::where('user_id', auth()->user()->id)->where('status', 'pending')->count())
                            {{App\Model\Notification::where('user_id', auth()->user()->id)->where('status', 'pending')->count()}}
                        @endif
                    </i>
                </a>
            </div> 
            <a href="/app" class="text-dark" style="margin-right: 6px;">سامانه آی مشاور</a>
            <div class="float-left pt-1">
                <a href="#" href="#" onclick="toggleNav()" class="text-dark"><i class="fas fa-bars"></i></a>
            </div>
        </div>
        
    @endif

    <div id="right" class="sidenav bg-white ">
        <div class="overflow-auto" style="max-height: 82%;">
            
            <a href="#" onclick="toggleNav()" class="close text-danger">بستن منو</a>
            
            <div class="memo">
                <h6 class="mt-1">منو اصلی</h6>
    
                <a href="{{route('user.index')}}">
                    <div class="row m-0">
                        <div class="col-2"><i class="fa fa-home"></i></div>
                        <div class="col">خانه</div>
                    </div>
                </a>
                <a href="{{ route('user.packages') }}">
                    <div class="row m-0">
                        <div class="col-2"><i class="fa fa-graduation-cap"></i></div>
                        <div class="col">کارگاه های آموزشی</div>
                    </div>
                </a>
                @foreach($ServiceCats as $service)
                    <a href="{{url('/').'/'.'services/'.$service->id}}">
                        <div class="row m-0">
                            <div class="col-2"><i class="fa fa-store-alt"></i></div>
                            <div class="col">مشاوره {{$service->title}}</div>
                        </div>
                    </a>
                @endforeach
    
            </div>
            
            <div class="memo">
    
                <h6>منو کاربری</h6>
    
                <a href="{{ route('admin.profile.show') }}">
                    <div class="row m-0">
                        <div class="col-2"><i class="fa fa-user-cog"></i></div>
                        <div class="col">حساب کاربری</div>
                    </div>
                </a>
                <a href="{{ route('user.tickets') }}">
                    <div class="row m-0">
                        <div class="col-2"><i class="fa fa-headset"></i></div>
                        <div class="col">درخواست پشتیبانی</div>
                    </div>
                </a>
                <a href="{{ route('user.contact.show') }}">
                    <div class="row m-0">
                        <div class="col-2"><i class="fa fa-heart"></i></div>
                        <div class="col">درباره ما</div>
                    </div>
                </a>
    
            </div>
            
            <section class="menu-header">
                <hr class="m-0">
                <p class="mb-1">I Moshaver</p>
                @foreach ($network as $net)
                    <a href="{{$net->address}}" class="box mx-2">
                        @switch($net->config)
                            @case("instagram")
                                <i class="fab fa-instagram"></i>
                                @break
                            @case("whatsapp")
                                <i class="fab fa-whatsapp"></i>
                                @break
                            @case("email")
                                <i class="fa fa-envelope"></i>
                                @break
                        @endswitch
                    </a>
                @endforeach
            </section>

        </div>
    </div>
        

<style>
    #nav-full {
        position: inherit;
        width: 100%;
        height: 100%;

    }
</style>

<script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
            document.getElementById("navbar1").style.display = "none";
            document.getElementById("navbar2").style.display = "block";
        } else {
            document.getElementById("navbar1").style.display = "block";
            document.getElementById("navbar2").style.display = "none";
        }
    }

    function toggleNav() {
        if (document.getElementById("right").offsetWidth > 0) {
            document.getElementById("right").style.width = "0px";
        } else {
            document.getElementById("right").style.width = "280px";
        }
    }
</script> --}}