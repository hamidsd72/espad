<style>
    section.about .page-hoghoghi {
        padding: 0px !important;
        max-width: 100% !important;
    }
    .body {
        padding: 0px !important;
    }
    section.about , section.about .consultation , .inside-nav {
        background: white !important;
    }
    section.about .header-img {
        background-image: url("{{$header->where('section', 2)->first() ? url($header->where('section', 2)->first()->pic) : 'https://www.dadgaran.com/Portals/0/Images/slider/slide3.jpg'}}");
        height: 380px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        opacity: 0.6;
    }
    section.about .sec {
        max-height: 380px;
    }
    .hoghoghi .text-gold {
        color: #bc9049 !important;
    }
    .hoghoghi a.bg-gold {
        background: #bc9049;
        border-radius: 50px;
    }
    .hoghoghi .box {
        border: 2px dotted #bcbcbc;
        min-height: 156px;
    }
    .hoghoghi .box:hover {
        background: #bc9049;
        transition: 0.4s;
    }
    .hoghoghi .box:hover img {
        filter: brightness(500%);
        transition: 0.6s;
    }
    .hoghoghi .sec2 {
        position: relative;
        top: -320px;
    }
    .bottom-box-gold {
        position: absolute;
        bottom: 0px;
        left: 0px;
        background: #bc9049;
        padding-right: 20px;
        clip-path: polygon(0% 0%, 85% 0%, 100% 100%, 0% 100%, 0 50%);
    }
    @media only screen and (max-width: 640px) {
        section.about .header-img {
            height: 240px;
        }
        section.about .sec {
            max-height: 240px;
        }
        .hoghoghi .sec2 {
            margin-top: 48px;
        }
        .hoghoghi .sec2 {
            position: relative;
            top: -220px;
        }
    }
</style>


<div class="hoghoghi mb-3">
    <div class="sec">
        <div class="header-img"></div>
    
        @foreach ($header->where('section', 2) as $attr)
            <div class="sec2 me-lg-5 pe-lg-5">
                <div class="mx-lg-5 px-lg-5">
                    <div class=" d-none d-lg-block">
                        <h1 class="fw-bold text-gold m-lg-4">{{$attr->title}}</h1>
                        <h2 class="text-light pt-lg-2 pb-lg-4 m-lg-4">{!! $attr->text !!}</h2>
                        <a class="h5 text-light p-lg-2 px-lg-4 bg-gold me-lg-4" href="{{$attr->link?url($attr->link):''}}">تماس و مشاوره</a>
                    </div>
                    <div class="d-lg-none">
                        <h4 class="text-gold mx-4">{{$attr->title}}</h4>
                        <p class="text-light mx-4">{!! $attr->text !!}</p>
                        <a class="text-light p-1 px-3 mx-4 bg-gold" href="{{$attr->link?url($attr->link):''}}">تماس و مشاوره</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="container">
        @foreach ($header->where('section', 3) as $attr)
            <div class="sec3 my-lg-5">
                <div class="d-none d-lg-block">
                    <h3 class="fw-bold text-center mb-3" style="color: #003b5c">{{$attr->title}}</h3>
                    <hr class="mx-auto mb-lg-4" style="width: 56px;color: #003b5c;height: 2px;">
                    <h6 class="text-center">{!! $attr->text !!}</h6>
                </div>

                <div class="d-lg-none">
                    <h6 class="fw-bold d-lg-none text-gold text-center">{{$attr->title}}</h6>
                    <p class="d-lg-none text-center fw-light">{!! $attr->text !!}</p>
                </div>
            </div>
        @endforeach
    
        @if (\App\Model\ServiceCat::where('status', 'active')->where('type', 'sub_service')->where('service_id', $item->id )->count())
            <div class="sec4">
                <div class="row">
                    @foreach ($body->where('section', 4) as $attr)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-6 my-2 mt-lg-4">
                            <div class="box p-3 p-lg-4 text-center rounded">
                                <a href="{{$attr->link?url($attr->link):''}}">
                                    <img src="{{$attr->pic?url($attr->pic):''}}" alt="icon">
                                    <p class="m-0 text-dark text-center fw-bold">{{$attr->title}}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    <div class="row">
        <div class="d-none">{{$status='online'}}</div>
        @foreach ($items as $item)
            <div class="col-lg-6">

                <div class="card mt-4">
                    <div class="card-body row p-0">
                        <div class="col-5 col-lg-4">
                            @if ($item->user()->photo)
                                <img src="{{ url($item->user()->photo->path) }}" style="width:100%" class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                            @else
                                <img src="{{ asset('assets/images/b.png') }}" style="width:100%" alt="avatar">
                            @endif
                        </div>
                        <div class="col my-auto">
                            <h4 class="text-gold mb-0 py-2">{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                            <h6 class="my-lg-2 text-secondary">{{$item->title}}</h6>
                            <div class="mt-lg-1 mb-5 mb-lg-0">
                                <a href="javascript:void(0)" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" @if(auth()->user())
                                    data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" @else data-bs-toggle="modal" data-bs-target="#login" @endif class="text-dark-violet h6">
                                    درخواست عقد قرارداد
                                </a>
                            </div>
                            <div class="bottom-box-gold">
                                <a href="{{ route('user.consultation.profile',$item->id) }}" class="btn text-light">مشاهده پروفایل</a>
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>
        @endforeach

        <div class="d-none">{{$status='offline'}}</div>
        @foreach ($items2 as $item)
            <div class="col-lg-6">

                <div class="card mt-4">
                    <div class="card-body row p-0">
                        <div class="col-5 col-lg-4">
                            @if ($item->user()->photo)
                                <img src="{{ url($item->user()->photo->path) }}" style="width:100%" class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                            @else
                                <img src="{{ asset('assets/images/b.png') }}" style="width:100%" alt="avatar">
                            @endif
                        </div>
                        <div class="col my-auto">
                            <h4 class="text-gold mb-0 py-2">{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                            <h6 class="my-lg-2 text-secondary">{{$item->title}}</h6>
                            <div class="mt-lg-1 mb-5 mb-lg-0">
                                <a href="javascript:void(0)" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" @if(auth()->user())
                                    data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" @else data-bs-toggle="modal" data-bs-target="#login" @endif class="text-dark-violet h6">
                                    درخواست عقد قرارداد
                                </a>
                            </div>
                            <div class="bottom-box-gold">
                                <a href="{{ route('user.consultation.profile',$item->id) }}" class="btn text-light">مشاهده پروفایل</a>
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>
            @endforeach
        </div>
    </div>

</div>