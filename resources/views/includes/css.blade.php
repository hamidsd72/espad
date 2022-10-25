<style>    
    @media all and (min-width: 992px) {
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
                color: {{$cat_css->text_color}} !important;
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
                    border-color: {{$cat_css->bg_color}} transparent transparent transparent;
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:before {
                    border-color: {{$cat_css->bg_color_hover}} transparent transparent transparent;
                }
            @elseif($key==7)
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:before {
                    content: '';
                    position: relative;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 21px 20px 50px 0px;
                    border-color: {{$cat_css->bg_color}};
                    top: 0;
                    right: -45px;
                    transition: all 0.6s;
                    -webkit-transition: all 0.6s;
                    clip-path: polygon(0% 0%, 100% 0%, -45% 100%, 0% 100%);
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:before {
                    border-color: {{$cat_css->bg_color_hover}};
                }
            @else
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:before {
                    content: '';
                    position: relative;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 21px 20px 50px 0px;
                    border-color: {{$cat_css->bg_color}};
                    top: 0;
                    right: -29px;
                    transition: all 0.6s;
                    -webkit-transition: all 0.6s;
                    clip-path: polygon(0% 0%, 100% 0%, -45% 100%, 0% 100%);
                }
                .navbar-dark .navbar-nav > li:nth-child({{$key+1}}) > a:hover:before {
                    border-color: {{$cat_css->bg_color_hover}};
                }
            @endif
        @endforeach
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
        background: linear-gradient(325.1deg,#006d95,#003b5c) !important;
    }
    section.video_items {
        background: #2B363F !important;
    }
</style>

