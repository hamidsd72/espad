<style>
    @media all and (min-width: 992px) {
        section.service_cats_items .items:hover .items_header {
            color: #f7020f !important;
        }
        .navbar-dark .navbar-nav .nav-link {
            padding: 20px 10px !important;
        }
        @foreach($ServiceCats as $key => $cat_css)
            .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a
            {
                background: {{$cat_css->bg_color}} !important;
                color: {{$cat_css->text_color}} !important;
            }
            .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover
            {
                background: {{$cat_css->bg_color_hover}} !important;
                color: #f7020f !important;
                /* color: {{$cat_css->text_color}} !important; */
            }
            .navbar-expand-lg {
                background: {{$cat_css->bg_color}} !important;
            }
            @if($key==0)
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:after
                {
                    background: {{$cat_css->bg_color}};
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:after
                {
                    background: {{$cat_css->bg_color_hover}};
                }
            @elseif($key==1 || $key==2 || $key==4 || $key==5 )
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:before {
                    /* border-color: {{$cat_css->bg_color}} transparent transparent transparent; */
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:before {
                    /* border-color: {{$cat_css->bg_color_hover}} transparent transparent transparent; */
                }
            @elseif($key==7)
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:before {
                    /* content: '';
                    position: relative;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 21px 20px 50px 0px;
                    border-color: {{$cat_css->bg_color}};
                    top: 0;
                    transition: all 0.6s;
                    -webkit-transition: all 0.6s;
                    clip-path: polygon(0% 0%, 100% 0%, -45% 100%, 0% 100%); */
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:before {
                    /* border-color: {{$cat_css->bg_color_hover}}; */
                }
            @else
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:before {
                    /* content: '';
                    position: relative;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 21px 20px 50px 0px;
                    border-color: {{$cat_css->bg_color}};
                    top: 0;
                    transition: all 0.6s;
                    -webkit-transition: all 0.6s;
                    clip-path: polygon(0% 0%, 100% 0%, -45% 100%, 0% 100%); */
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:before {
                    /* border-color: {{$cat_css->bg_color_hover}}; */
                }
            @endif
        @endforeach
        .navbar-expand-lg .navbar-nav {
            width: 100%;
        }
        .navbar-dark .navbar-nav .nav-link {
            font-size: 16px;
        }
        .navbar .logo_menu_d.d-show {
            right: 0px;
        }
        .navbar .search_top.d-show {
            left: 0px;
        }
    }
    @media only screen and (max-width: 1200px) {
        #main_nav .navbar-expand-lg .navbar-collapse {
            padding: 0px;
        }
        #main_nav .navbar-dark .navbar-nav .nav-link {
            padding: 0px;
        }
        #main_nav a.nav-link {
            font-size: 10px;
            font-weight: bold !important;
        }
    }
    .text_cd1e402 {
        background: #cd1e40;
        color: #fff !important;
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        width: 61px;
        height: 61px;
        text-align: center;
        line-height: 52px;
    }
    .search_992 {
        background: #e8e8e8;
        color: #3e4346 !important;
        position: absolute;
        right: 67px;
        top: 8px;
        height: calc(100% - 16px);
        width: 45px;
        height: 45px;
        text-align: center;
        line-height: 45px;
        transition: all 0.6s;
        -webkit-transition: all 0.6s;
        border-radius: 3px;
    }
    .navbar-dark .navbar-nav > li:nth-child(9) > a:before {
        right: -35px;
    }
    ul.pagination .page-item:not(:first-child) .page-link {
        margin-left: 0px !important;
    }
    ul.pagination .page-link {
        margin: 0px 6px !important;
        border-radius: 4px !important;
        padding: 8px 16px !important;
        color: black;
        font-weight: bold;
    }
    ul.pagination .page-item.active .page-link {
        background-color: #323a56;
        border-color: #323a56;
    }
    footer {
        background: #1B252E !important
    }
    section.video_items {
        background: #1B252E !important;
    }
    #spad_e_namad {
        padding: 0px;
        position: absolute;
    }
</style>
