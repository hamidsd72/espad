{{-- @if ($page_name=="رفتن-به-میزگرد")
    <div class="col-lg-6 moshaver">
        <div class="p-2 p-lg-5 box">
            <a href="{{ route('user.consultation.edit', $item->slug ) }}"  class="text-center text-secondary">
                <img class="shadow" src="{{ url($item->pic_card) }}" alt="avatar">
                <button class="btn btn-dark bg-violet my-3 my-lg-4 px-lg-4">
                    <h4 class="d-none d-lg-block">{{$item->title}}</h4>
                    <h6 class="d-lg-none">{{$item->title}}</h6>
                </button>
                {!! $item->text !!}
            </a>
        </div>
    </div>
@else --}}
@if ($page_name=="امور-گمرک-و-ترخیص" || $page_name=="طلا")
    <div class="{{$body->where('section',3)->count()>3?'col-lg-6':'col-lg'}} moshaver">
        <div class="p-2 p-lg-5 box">
            <a href="{{ $item->link?url($item->link):'' }}"  class="text-center text-secondary">
                @if ($item->pic)
                    <img class="shadow" src="{{ url($item->pic) }}" alt="avatar">
                @endif
                <h4 class="text-center text-dark my-4 d-none d-lg-block">{{$item->title}}</h4>
                <h6 class="text-center text-dark mt-3 d-lg-none">{{$item->title}}</h6>
                {!! $item->text !!}
            </a>
        </div>
    </div>
@elseif ($page_name=="آیتم-طلا")
    <div class="col-lg moshaver">
        <div class="p-2 p-lg-5 box">
            <a href="{{ route('user.consultation.profile',$item->id) }}"  class="text-center text-secondary">
                @if ($body->where('section',5)->count())
                    <img class="shadow" src="{{ $body->where('section',5)->first()->pic?url($body->where('section',5)->first()->pic):'' }}" alt="avatar">
                @endif
                <h4 class="text-center text-dark my-4 d-none d-lg-block">{{$item->title}}</h4>
                <h6 class="text-center text-dark mt-3 d-lg-none">{{$item->title}}</h6>
            </a>
        </div>
    </div>
@else
    <div class="col-lg-3 col-md-6 moshaver">
        <div class="p-lg-4 box">
            <a href="{{ route('user.consultation.profile3',[$item->reagent_id,$item->id]) }}"  class="text-center text-secondary">
                <img src="{{ $item->photo?url($item->photo->path):'' }}" alt="avatar">
                <h6 class="text-dark mt-3">{{$item->title}}</h6>
                <p class="small my-2">{{$item->user()?$item->user()->first_name.' '.$item->user()->last_name:''}}</p>
                <div class="sub-title text-center">اسپاد گروپ</div>
            </a>
        </div>
    </div>
@endif


<style>
    .consultation {
        background: white !important;
    }
    .moshaver .box {
        border: 1px solid white;
        text-align: center;
        @unless ($page_name=="رفتن-به-میزگرد" || $page_name=="امور-گمرک-و-ترخیص" || $page_name=="طلا" || $page_name=="آیتم-طلا")
            max-height: 356px;
        @endunless
    }
    .moshaver .box img {
        width: 240px;
        height: 240px;
        border-radius: 50%;
        @unless ($page_name=="رفتن-به-میزگرد" || $page_name=="امور-گمرک-و-ترخیص" || $page_name=="طلا")
            width: 100%;
            height: auto;
            border-radius: 6px;
        @endunless
    }
    @media only screen and (min-width: 920px) {
        .moshaver .box img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            @unless ($page_name=="رفتن-به-میزگرد" || $page_name=="امور-گمرک-و-ترخیص" || $page_name=="طلا")
                width: 100%;
                height: auto;
                border-radius: 6px;
            @endunless
        }
    }
    .moshaver:hover div {
        padding: 12px !important;
        border-color: #f1f1f1;
        border-radius: 8px;
        transition: 0.4s;
    }
    .moshaver:hover div.my-2 {
        margin: -4px !important;
    }
    .moshaver:hover .sub-title {
        bottom: 114px;
        transition: 0.3s;
        border-radius: 0px;
    }
    .sub-title {
        position: relative;
        bottom: 98px;
        background: #f1f1f1;
        width: 100px;
        padding: 4px;
        border-radius: 4px 0px 4px 0px;
    }
    .bg-violet {
        background: #1d2d44;
    }
</style>
