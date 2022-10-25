<!doctype html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $setting->title }}</title>
        <!-- fav icon -->
        <link rel="icon" type="image/png" href="{{ $setting->icon_site }}">
        <!-- Bootstrap css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- fontawesome css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
            integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <!-- Swiper css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
        <!-- Fancybox css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
        <!-- custom css-->
        <link rel="stylesheet" href="https://adibhost.ir/new_spad/assets/css/css.css">
        <link rel="stylesheet" href="https://adibhost.ir/new_spad/assets/css/responsive.css">
    </head>
    <body>

        <header>
            <div class="container-lg">
                <div class="header_top_box  d-none d-lg-block pt-2">
                    <ul class="d-flex ul_menu_top">
                        <li>
                            <a href="" class="text_cd1e40">
                                <i class="fas fa-power-off"></i>
                                ورود/ثبت نام
                            </a>
                        </li>
                        <li>
                            <a href="">اطلاعیه ها</a>
                        </li>
                        <li>
                            <a href="">بیمه باران</a>
                        </li>
                        <li>
                            <a href="">دعوت به همکاری</a>
                        </li>
                        <li>
                            <a href="">مجله خبری</a>
                        </li>
                        <li>
                            <a href="">درباره ما/تماس باما</a>
                        </li>
                    </ul>
                </div>
                <div class="header_top_2 row">
                    <div class="col-lg-9 position-992-absolute d-none d-lg-block ps-5">
                        <div class="search-form">
                            <form action="" method="get" class="d-flex">
                                <button type="submit"><i class="fas fa-search"></i></button>
                                <input type="text" name="search" placeholder="جستجو...">
                                <select name="cat_id">
                                    <option value="">همه</option>
                                    <option value="1">دسته 1</option>
                                    <option value="2">دسته 2</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 text-start">
                        <a href="">
                            <img class="logo" src="{{ url( $setting->icon_site ) }}" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-default-lg py-0">
                <a href="" class="logo_menu_d">
                    <img src="{{ url( $setting->icon_site ) }}" alt="...">
                </a>
                <a href="javascript:void(0)" class="search_top"><i class="fas fa-search"></i> </a>
                <div class="container-fluid over-hidden">
                    <div class="navbar-brand d-inline-block d-lg-none" href="/">
                        <a href="" class="text_cd1e40">
                            <i class="fas fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="search_992">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button">
                        MENU
                        <i class="fas fa-bars menu_svg"></i>
                    </button>
                    <div class="collapse navbar-collapse container-lg" id="main_nav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="1" href="#" data-bs-toggle="dropdown">
                                    کالا
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_1" data-key="1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-1">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقیقی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقوقی
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقیقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقوقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="2" href="#" data-bs-toggle="dropdown">
                                    مشاوره
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_2" data-key="2"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-2">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاوران برتر
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاوران عمومی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاور اختصاصی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            روانشناسی آنلاین
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            اختیار معامله ومعاملات الگوریتمی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مدیریت ریسک و دارایی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            بورس کالا
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="3" href="#" data-bs-toggle="dropdown">
                                    آکادمی
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_3" data-key="3"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-3">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقیقی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقوقی
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقیقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقوقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="4" href="#" data-bs-toggle="dropdown">
                                    وبینار
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_4" data-key="4"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-4">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاوران برتر
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاوران عمومی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاور اختصاصی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            روانشناسی آنلاین
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            اختیار معامله ومعاملات الگوریتمی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مدیریت ریسک و دارایی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            بورس کالا
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="5" href="#" data-bs-toggle="dropdown">
                                    میزگرد
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_5" data-key="5"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-5">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقیقی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقوقی
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقیقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقوقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="6" href="#" data-bs-toggle="dropdown">
                                    سرمایه گذاری خارجی
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_6" data-key="6"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-6">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاوران برتر
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاوران عمومی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مشاور اختصاصی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            روانشناسی آنلاین
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            اختیار معامله ومعاملات الگوریتمی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            مدیریت ریسک و دارایی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            بورس کالا
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>مشاوران برتر</h5>
                                                                    <p>مشاوران برتر گروه اسپاد جزء برترین ها در کشور هستند</p>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu_in_a p-20" data-key="7" href="#" data-bs-toggle="dropdown">
                                    خدمات مالی و بورسی
                                    <i class="fas fa-angle-left d-inline-block d-lg-none menu_in_svg menu_in_svg_7" data-key="7"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-big dropdown-menu-7">
                                    <div class="container-lg">
                                        <div class="row">
                                            <div class="col-lg-4 py-lg-5 py-1">
                                                <h5 class="category_title d-lg-block d-none">دسترسی سریع</h5>
                                                <ul class="category">
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقیقی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="">
                                                            <i class="fas fa-angle-left d-inline-block d-lg-none"></i>
                                                            حقوقی
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-8 py-5 border-right-1 d-lg-block d-none">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقیقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-4 p-2">
                                                            <a href="">
                                                                <div class="card_menu">
                                                                    <h5>حقوقی</h5>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="d-flex d-lg-none ul_last_mobile">
                            <li>
                                <a href="">اطلاعیه ها</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-left"></i>
                            </li>
                            <li>
                                <a href="">بیمه باران</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-left"></i>
                            </li>
                            <li>
                                <a href="">دعوت به همکاری</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-left"></i>
                            </li>
                            <li>
                                <a href="">مجله خبری</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-left"></i>
                            </li>
                            <li>
                                <a href="">درباره ما/تماس باما</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-left"></i>
                            </li>
                        </ul>
                    </div> <!-- navbar-collapse.// -->
                </div> <!-- container-fluid.// -->
            </nav>
        </header>

        @yield('content')

        <footer>

        </footer>


        <!-- Jquery js-->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                crossorigin="anonymous"></script>
        <!-- Bootstrap js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
                integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
        <!-- fontawesome js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"
                integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Swiper js-->
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <!-- Fancybox js-->
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        <!-- sweetalert2 js-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- custom js-->
        <script src="https://adibhost.ir/new_spad/assets/js/js.js"></script>
    </body>
</html>