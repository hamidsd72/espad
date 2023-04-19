<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | {{$setting->title}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{url($setting->icon_site)}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-rtl.min.css')}}">
    
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{asset('admin/css/custom-style.css')}}">
    <!-- Persian Data Picker -->
    <link rel="stylesheet" href="{{asset('admin/css/persian-datepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/new/style.css') }}">
    <style>
        @font-face {
            font-family: 'Vazirmatn';
            src: url({{ asset('fonts/webfonts/Vazirmatn-Light.woff2') }}); /* IE9 Compat Modes */
            src: url({{ asset('fonts/webfonts/Vazirmatn-Light.woff2') }}) format('embedded-opentype'), /* IE6-IE8 */
            url({{ asset('fonts/webfonts/Vazirmatn-Light.woff2') }}) format('woff2'), /* Super Modern Browsers */
            url({{ asset('fonts/webfonts/Vazirmatn-Light.woff2') }}) format('woff'), /* Pretty Modern Browsers */
            url({{ asset('fonts/ttf/Vazirmatn-Light.ttf') }})  format('truetype'), /* Safari, Android, iOS */
        }
        body {
            font-size: 13px;
            font-family: "Vazirmatn" !important;
            line-height: 26px !important;
            color: #6c6c6c !important;
            background-color: #f0f0f0;
        }
        .custom-file-label {
            padding: 1.4rem 0.75rem !important;
            line-height: 0 !important;
        }
        .custom-file-label::after {
            height: 100%;
            line-height: 2;
            content: "انتخاب فایل";
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .btn {
            font-weight: normal !important;
            font-family: "Vazirmatn" !important;
        }
        .sidebar {
        overflow-y: initial;
        padding-top: 0.5rem;
        }
        .sidebar-dark-primary , .navbar-expand , .navbar-expand .navbar-nav .dropdown-menu {
        background-color: #2F2D51 !important;
        }
        .sidebar-dark-primary .sidebar a , .sidebar-dark-primary .nav-treeview>.nav-item>.nav-link , .dropdown-item , .navbar-light .navbar-nav .nav-link {
        color: white;
        }
        .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
        height: 45px;
        }

        #lorem a { 
        color: rgba(0, 0, 0, 0.719);
        }
        a.nav-link:hover {
        color: white !important;
        }
        .card-primary.card-outline , .res_table{
        border-radius: 20px;
        }
        .main-sidebar .brand-text, .sidebar .nav-link p, .sidebar .user-panel .info {
        color: white !important;
        }
        .footer-bar-1 .active-nav i, .footer-bar-1 .active-nav span, .footer-bar-3 .active-nav i{
        color: #2F2D51 !important;
        }
        .form-control {
        height: auto !important;
        }
        .small-box .icon {
        top: 10px;
        font-size: 60px;
        }
        .btn-info {
        background: #fe5722 !important;
        }
        .btn-danger {
        background: #20364b !important;
        }
        .bg-dark {
        background: #20364b !important;
        }
        .text-dark {
        color: #20364b !important;
        }
        .bg-violet {
        background: #2F2D51 !important
        } 
        .consultantCall {
            padding: 6px 8px;
            left: 2%;
            bottom: 3%;
            position: fixed;
            border-radius: 8px;
            z-index: 999;
            background: darkgrey;
        }
        .cke_reset {
            min-height: 480px !important;
        }
    </style>
    @yield('css')
    @role('مدیر')
        <style>
            .sidebar {overflow-y: auto !important;}
        </style>
    @endrole
    {{-- @unless(in_array(auth()->user()->getRoleNames()->first(),['مدیر','مدرس']))
        <style>
            .content-wrapper  , .main-footer , .main-header {
                margin-right: unset !important;
            }
        </style>
    @endunless --}}
    {{-- @livewireStyles --}}
</head>
<body class="hold-transition sidebar-mini">
{{-- @livewire('calling') --}}
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/')}}" target="_blank" class="nav-link">@item($setting->title)</a>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown has-treeview">
                <a class="nav-link" data-toggle="dropdown" href="#">
                        @item(Auth::user()->first_name) @item(auth()->user()->last_name)
                        <i class="right fa fa-angle-down mr-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-sm">
                    <a href="{{route('admin.profile.show')}}" class="dropdown-item">
                        <i class="fa fa-user ml-1"></i>
                        پروفایل
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('user.logout.web')}}" class="dropdown-item">خروج</a>
                </div>
            </li>

        </ul>
    </nav>

    @if ($consultantCall)
        <div class="consultantCall">
            <div class="d-flex">
                <a href="{{route('user.call.user_call_report')}}" class="text-light">
                    <span class="h6">در حال مکالمه</span>
                    <i class="fa fa-refresh fa-spin"></i>
                </a>
            </div>
        </div>
    @endif
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 pr-lg-2">
        <!-- Brand Logo -->
        <a href="javascript:void(0);" class="brand-link">
            <img src="{{url($setting->logo_site)}}" alt="AdminLTE Logo" class="brand-image">
            <span class="brand-text font-weight-light">پنل
                @role('مدیر')مدیریت@endrole
                @role('حقوقی')کارشناس حقوقی@endrole
                @role('ویزا')کارشناس ویزا@endrole
                @role('استعدادیابی')کارشناس استعدادیابی@endrole
                @role('تور')کارشناس تور و گردشگری@endrole
                @role('کاربر')کاربری@endrole
                @role('مدرس')مشاور@endrole
            </span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr;">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{Auth::user()->photo? url(Auth::user()->photo->path) :asset('admin/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{route('admin.profile.show')}}" title="نمایش پروفایل" class="d-block">@item(auth()->user()->mobile)</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>
                                    داشبورد
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview border-bottom">
                                <li class="nav-item">
                                    <a href="{{route('admin.profile.edit')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>ویرایش پروفایل</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.password.edit')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>ویرایش رمز عبور</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @role('مدیر')
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        کاربران
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{route('admin.user.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>لیست همه کاربران</p>
                                        </a>
                                    </li>
                                    @foreach (\App\Model\Role::all() as $item)
                                        <li class="nav-item">
                                            <a href="{{route('admin.user.list.roles',$item->name)}}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>لیست {{$item->name}}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        تیکت مشاوره
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{route('admin.contact.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>لیست همه تیکت ها
                                                <span class="mx-1 text-white">
                                                    {{\App\Model\Contact::whereNotIn('category',['رسید پرداخت','کد تخفیف'])->where('answered', 'no')->orderBy('id','desc')->where('belongs_to_item', '=', 0)->count()}}
                                                </span>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.contact.list.type','unread')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>در انتظار پاسخ
                                                <span class="mx-1 text-danger">
                                                    {{\App\Model\Contact::whereNotIn('category',['رسید پرداخت','کد تخفیف'])->where('reply',0)->where('answered', 'no')->orderBy('id','desc')->where('belongs_to_item', '=', 0)->count()}}
                                                </span>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.contact.list.type','read')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>پاسخ داده شده
                                                <span class="mx-1 text-success">
                                                    {{\App\Model\Contact::whereNotIn('category',['رسید پرداخت','کد تخفیف'])->where('reply','>',0)->where('answered', 'no')->orderBy('id','desc')->where('belongs_to_item', '=', 0)->count()}}
                                                </span>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-icon fa fa-cog"></i>
                                    <p>
                                        محتوا
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    
                                    <li class="nav-item">
                                        <a href="{{route('admin.ads-tours.index')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تورهای گردشگری</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.customer.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مشتریان</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.guide.edit')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>راهنمای نحوه خرید</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                        @endrole
                        @if(in_array(auth()->user()->getRoleNames()->first(),['مدیر','مدرس']))
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        @role('مدیر')
                                            پکیج های مشاوران
                                        @endrole
                                        @role('مدرس')
                                            پکیج های من
                                        @endrole
                                        {{-- دسته بندی --}}
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{route('admin.service.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>پکیج های مشاوره</p>
                                        </a>
                                    </li>
                                    @role('مدیر')
                                        {{-- <li class="nav-item">
                                            <a href="#" data-toggle="modal" data-target="#create" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>ایجاد پکیج جدید</p>
                                            </a>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a href="{{route('admin.service.create')}}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>ایجاد پکیج جدید</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.service.package.list')}}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>کارگاه ها</p>
                                            </a>
                                        </li>
                                    @endrole
                                </ul>
                            </li>
                        @endif
                        @role('مدیر')
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        دسته بندی ها
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{route('admin.service.category.list')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>منو اصلی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.sub_service.index')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>زیردسته های منو اصلی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.group.index')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دسته بندی های اوراق بهادار</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{route('admin.service.learn.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>لیست خدمات آموزشگاهی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.learn.package.category.list')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دسته بندی پکیج ها</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.service.learn.package.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>پکیج آموزشگاهی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.service.buy.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>
                                                لیست خرید
                                                @if($order>0)
                                                        <span class="right badge badge-danger">جدید</span>
                                                @endif
                                            </p>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                        @endrole                            
                        <li class="nav-item has-treeview">
                            <a href="javascript:void(0);" class="nav-link">
                            <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>سبد سهام<i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview border-bottom">
                                @role('مدیر')
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','سبد-سهام')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>محتوا</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.stock-portfolio-categories.index')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دسته های سبد سهام</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.service.package.price.list')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>پکیج قیمت سبد سهام</p>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','unread-special')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای عضویت در انتظار
                                            <span class="text-danger mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','کاربر ویژه')->where('reply',0)->where('answered', 'no')->count()}}
                                                @else 
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','کاربر ویژه')->where('reply',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','read-special')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای عضویت دریافتی
                                            <span class="text-success mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','کاربر ویژه')->where('reply','>',0)->where('answered', 'no')->count()}}
                                                @else 
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','کاربر ویژه')->where('reply','>',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @role('مدیر')
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        فرم ها
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{route('admin.forms.index')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> فرم های بررسی شده
                                                {{ \App\Model\UserForm::where('status','active')->count() }}
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.forms.show', 'consultation')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> فرم های مشاوره در انتظار
                                                {{ \App\Model\UserForm::where('status','pending')->where('type','consultation')->count() }}
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.forms.show', 'job')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> فرم های استخدام در انتظار
                                                {{ \App\Model\UserForm::where('status','pending')->where('type','job')->count() }}
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.forms.show', 'contact')}}" class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> فرم های ارتباط با ما در انتظار
                                                {{ \App\Model\UserForm::where('status','pending')->where('type','contact')->count() }}
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endrole
                        <li class="nav-item has-treeview">
                            <a href="javascript:void(0);" class="nav-link">
                            <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>
                                    گزارشات
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview border-bottom">
                                @role('مدیر')
                                    <li class="nav-item">
                                        <a href="{{route('admin.users.service.package.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> کاربران کارگاه ها</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.report.transaction.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p> تراکنش ها</p>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item">
                                    <a href="{{route('admin.offline_payment.list','pending')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای کارگاه ها در انتظار
                                            <span class="text-danger mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\OfflinePayment::where('status', 'pending')->count()}}
                                                @else
                                                    {{\App\Model\OfflinePayment::where('user_id',auth()->user()->id)->where('status', 'pending')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.offline_payment.list','not_pending')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای کارگاه ها پاسخ داده
                                            <span class="text-danger mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\OfflinePayment::where('status', '!=', 'pending')->count()}}
                                                @else
                                                    {{\App\Model\OfflinePayment::where('user_id',auth()->user()->id)->where('status', '!=', 'pending')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','unread-pay')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای مشاوره در انتظار
                                            <span class="text-danger mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','رسید پرداخت')->where('reply',0)->where('answered', 'no')->count()}}
                                                @else
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','رسید پرداخت')->where('reply',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','read-pay')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>لیست رسیدهای مشاوره دریافتی
                                            <span class="text-success mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','رسید پرداخت')->where('reply','>',0)->where('answered', 'no')->count()}}
                                                @else
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','رسید پرداخت')->where('reply','>',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','unread-special')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای عضویت در انتظار
                                            <span class="text-danger mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','کاربر ویژه')->where('reply',0)->where('answered', 'no')->count()}}
                                                @else
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','کاربر ویژه')->where('reply',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','read-special')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>رسیدهای عضویت دریافتی
                                            <span class="text-success mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','کاربر ویژه')->where('reply','>',0)->where('answered', 'no')->count()}}
                                                @else
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','کاربر ویژه')->where('reply','>',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="{{route('admin.contact.list.pay','unread-offCode')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>درخواست های کد تخفیف 
                                            <span class="text-danger mx-1">
                                                @if(auth()->user()->getRoleNames()->first() == 'مدیر')
                                                    {{\App\Model\Contact::where('category','=','کد تخفیف')->where('reply',0)->where('answered', 'no')->count()}}
                                                @else
                                                    {{\App\Model\Contact::where('user_id',auth()->user()->id)->where('category','=','کد تخفیف')->where('reply',0)->where('answered', 'no')->count()}}
                                                @endif
                                            </span>
                                        </p>
                                    </a>
                                </li>
                                @role('مدیر')
                                    <li class="nav-item">
                                        <a href="{{route('admin.call.request')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تماس های مشاوره</p>
                                        </a>
                                    </li>
                                @endrole
                            </ul>
                        </li>
                        @role('مدیر')
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        تنظیمات اصلی
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    {{-- <li class="nav-item">
                                        <a href="{{route('admin.form-price.index')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>قیمت فرم ها</p>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{route('admin.notification.index')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>ارسال اعلان و پیام</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.slider.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>اسلایدر</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.banks.index')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>لیست بانک ها</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.network-setting.index')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>شبکه های اجتماعی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.setting.edit')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تنظیمات</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.meta.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>Meta</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        موقعیت های شغلی
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.job-opportunities.type','دسته') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>دسته های شغلی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.job-opportunities.type','موقعیت') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>موقعیت های شغلی</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('admin.job-opportunities.index') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>فرم های متقاضیان</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.job-opportunities.index') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>فرم های بررسی شده</p>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        محتوا صفحات
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.post.index.type','بلاگ') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مجله خبری</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.post.index.type','اطلاعیه') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>اطلاعیه ها</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.post.index.type','آموزش') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>آموزش ها</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.customer.list')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مشتریان</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','دعوت-به-همکاری')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه دعوت به همکاری</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','اصلی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه اصلی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','فوتر')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>فوتر</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','دعاوی-حقوقی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه دعاوی حقوقی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','سرمایه-گذاری-خارجی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه سرمایه گذاری خارجی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','کسب-و-کارهای-نوین')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه کسب و کار نوین</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','مشاوران')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه مشاوران</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','پروفایل-مشاور')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه پروفایل مشاور</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','مشاورین-برتر')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>نمایش مشاورین برتر</p>
                                        </a>
                                    </li>
                                </ul>
                            </li> 
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        محتوا صفحات زیردسته ها
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','مدیریت-ریسک-و-دارایی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مدیریت ریسک و دارایی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','اختیار-معامله-و-معاملات-الگوریتمی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>اختیار معامله و معاملات الگوریتمی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','مشاورین-برتر')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مشاورین برتر</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','اصلاح-ساختاری')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>اصلاح ساختاری</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','تامین-مالی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>تامین مالی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','سبد-گردانی')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>سبد گردانی</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.data.show','کد-تخفیف-')}}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>صفحه کد تخفیف</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.sub-item.show', 'پروفایل-دانش-بنیان' ) }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>آیتم های پروفایل دانش بنیان ها</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon px-2"></i>
                                    <p>
                                        آیتم های صفحات
                                        <i class="fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview border-bottom">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.item.index') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مدیریت همه</p>
                                        </a>
                                    </li>
                                    @foreach (\App\Model\Item::where('page_name','!=','پروفایل-دانش-بنیان')->distinct()->get('page_name') as $item)
                                        <li class="nav-item">
                                            <a href="{{ route('admin.item.show', $item->page_name ) }}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>{{$item->page_name}}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <a href="{{route('admin.file-upload.index')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>آپلود فایل</p>
                            </a>
                            <a href="{{route('admin.about.edit')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>درباره ما</p>
                            </a>
                            <a href="{{route('admin.rule.edit')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>قوانین</p>
                            </a>
                            <a href="{{route('admin.off.list')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon px-2"></i>
                                <p>کد های تخفیف</p>
                            </a>
                        @endrole
                    </ul>
                </nav>
            </div>
        </div>
    </aside>
    
    <div class="content-wrapper">
        <div class="content-header d-none d-lg-block">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title1??''}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li id="lorem" class="breadcrumb-item active">
                                @if (\Request::route()->getName()=='admin.profile.show')
                                    <a href="{{route('user.index')}}">
                                @elseif (\Request::route()->getName()=='user.forms.index')
                                    <a href="{{route('admin.profile.show')}}">
                                @else
                                    <a href="{{url()->previous()}}">
                                @endif
                                        {{-- {{ \Request::route()->getName() }} --}}
                                        {!! $title2??'' !!}
                                        <i class='fa fa-arrow-left'></i>
                                    </a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <hr class="mt-0">
        <!-- /.content-header -->

        <!-- Content Header (Page header) -->

        @yield('content')
    </div>

    <footer class="main-footer text-left mb-5 pb-4 mb-lg-0" style="font-size: smaller;">
        <strong>copyright &copy; 2022 <a href="https://adib-it.com/">Adib Group</a></strong>
    </footer>
    
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">انتخاب دسته اصلی جهت افزودن خدمت</h5>
                </div>
                <div class="modal-body">
                    @foreach(\App\Model\ServiceCat::where('slug','!=','کد-تخفیف')->where('type','service')->get(['id','title','pic']) as $ServiceCat)
                        <a class="btn btn-danger my-2 m-lg-2" href="{{route('admin.service.create',$ServiceCat->id)}}">
                            <img src="{{url('/').'/'.$ServiceCat->pic}}" alt="{{$ServiceCat->title}}" style="width:50px;height:50px;border-radius:50%;margin: 12px;">
                            <br>
                            {{$ServiceCat->title}}
                        </a>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>--}}
{{--<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->--}}
{{--<script>--}}
{{--    $.widget.bridge('uibutton', $.ui.button)--}}
{{--</script>--}}
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{--<!-- Morris.js charts -->--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
{{--<script src="{{asset('admin/plugins/morris/morris.min.js')}}"></script>--}}
{{--<!-- Sparkline -->--}}
{{--<script src="{{asset('admin/plugins/sparkline/jquery.sparkline.min.js')}}"></script>--}}
{{--<!-- jvectormap -->--}}
{{--<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>--}}
{{--<!-- jQuery Knob Chart -->--}}
{{--<script src="{{asset('admin/plugins/knob/jquery.knob.js')}}"></script>--}}
{{--<!-- daterangepicker -->--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>--}}
{{--<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>--}}
{{--<!-- datepicker -->--}}
{{--<script src="{{asset('admin/plugins/datepicker/bootstrap-datepicker.js')}}"></script>--}}

{{--<!-- Slimscroll -->--}}
{{--<script src="{{asset('admin/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>--}}
<!-- FastClick -->
{{--<script src="{{asset('admin/plugins/fastclick/fastclick.js')}}"></script>--}}
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/js/demo.js')}}"></script> 
<!-- Persian Data Picker -->
<script src="{{asset('admin/js/persian-date.min.js')}}"></script>
<script src="{{asset('admin/js/persian-datepicker.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>

<script>
    new ClipboardJS('.copy_btn');
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    @if(session()->has('err_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            text: "{{ session('err_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if(session()->has('err_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            text: "{{ session('err_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if(session()->has('flash_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "موفق",
            text: "{{ session('flash_message') }}",
            icon: "success",
            timer: 6000,
            timerProgressBar: true,
        })
    })
    ;@endif
    @if(session()->has('call_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "",
            text: "{{ session('call_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if (count($errors) > 0)
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            icon: "warning",
            html:
                @foreach ($errors->all() as $key => $error)
                '<p class="text-right mt-2 ml-5" dir="rtl"> {{$key+1}} : '  +
                    '{{ $error }}'+
                '</p>'+
                @endforeach
                '<p class="text-right mt-2 ml-5" dir="rtl">' +
                    '</p>',
            timer:  @if(count($errors)>3)parseInt('{{count($errors)}}') * 1500 @else 6000 @endif,
            timerProgressBar: true,
        })
    });
    @endif


    $(document).ready(function () {
        $('.numberPrice').text(function (index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
</script>
@yield('js')

{{-- @livewireScripts --}}
</body>
</html>
                        

{{-- function ConvertNumberToPersion() {
    let persian = { 0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹' };
    function traverse(el) {
        if (el.nodeType == 3) {
            var list = el.data.match(/[0-9]/g);
            if (list != null && list.length != 0) {
                for (var i = 0; i < list.length; i++)
                    el.data = el.data.replace(list[i], persian[list[i]]);
            }
        }
        for (var i = 0; i < el.childNodes.length; i++) {
            traverse(el.childNodes[i]);
        }
    }
    traverse(document.body);
}

ConvertNumberToPersion() --}}
