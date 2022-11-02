<style>
    .product-card-small .product-image-small {
        height: 180px !important;
        width: 100% !important;
        width: 180px !important;
        border-radius: 50% !important;
        margin: auto;

    }
    .mmm-p .mm-p img {
        width:180px;
        height:180px;
        border-radius:50%;
        object-fit: cover;
    }
    .mmm-p .mm-p img.online {
        box-shadow: 0 0 0 3px #67e91559, 3px 3px 12px rgb(26 229 14 / 70%);
    }
    .mmm-p .mm-p img.ofline {
        box-shadow: 0 0 0 3px #e91f157d, 3px 3px 12px rgb(229 35 14 / 70%);;
    }
    .mmm-p .abs {
        position: relative;
        top: -28px;
        right: 224px;
        font-size: 16px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
    }
</style>
<div style="color: #F3F7FA ;">display is none</div>
<div class="card product-card-small">
    <div class="card-body">
        @if (in_array(\Request::route()->getName(),['user.subServices','user.subServices2']))
            <div class="text-dark h6 text-center"><span class="fw-bold">{{$ServiceCat->head_service()?$ServiceCat->head_service()->title:''}}</span> {{$ServiceCat->title}}</div>
        @else
            <div class="text-dark h6 text-center">در همه دسته ها</div>
        @endif
        <div class="mmm-p pt-2">
            <div class="mm-p text-center">
                @if ($item->photo)
                    <img src="{{ url($item->photo->path) }}" alt="{{$item->title}}" class="{{$status=='آفلاین'?'ofline':'online'}}">                
                @else
                    <img src="{{ url($item->user()->photo->path) }}" alt="{{$item->user()->last_name}}" class="{{$status=='آفلاین'?'ofline':'online'}}">                
                @endif
            </div>
            <div class="abs @if ($status=='آنلاین') bg-success @else bg-danger @endif"></div>
        </div>
        @if ($item->photo)
            <p class="text-dark h6">{{$item->title}}</p>
            {!! $item->text !!}
        @else
            <p class="text-dark h6">{{$item->user()?$item->user()->first_name.' '.$item->user()->last_name:''}}</p>
            <span class="text-dark h6">{{$item->title}}</span>
        @endif
        <hr class="border-top border-color my-2">
        <div class="p-2">
            <h6>روش های ارتباط با مشاور</h6>
            <div class="row mb-0">
                <div class="col">
                    <a href="#" onclick="setUp2('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'حضوری','{{$item->title}}')" 
                        data-bs-toggle="modal" data-bs-target="#qarardad-moshavere-hozori" class="btn btn-danger col-12 my-1">
                        مشاوره حضوری
                    </a>
                </div>
                <div class="col">
                    <a href="#" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" 
                        data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" class="btn btn-danger col-12 my-1">
                        عقد قرارداد
                    </a>
                </div>
            </div>
            @if ($item->photo)
                <a href="{{ route('user.service',[$item->id, str_replace(" ","-",$item->user()->first_name).'-'.str_replace(" ","-",$item->user()->last_name)]) }}"
                     class="btn btn-dark col-12 py-2 mt-2">نمایش اطلاعات بیشتر</a>
            @else
                <a href="{{ route('user.service',[$item->id, str_replace(" ","-",$item->user()->first_name).'-'.str_replace(" ","-",$item->user()->last_name)]) }}"
                     class="btn btn-dark col-12 py-2 mt-2">رفتن به پروفایل مشاور</a>
            @endif
        </div>
    </div>
</div>

