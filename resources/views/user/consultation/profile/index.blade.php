<style>
    .card { border: none }
    .consultation { background: #f4f9fc !important; }
    .card-consultation , .bg-consultation { background: #f4f4f4 !important; }
    div.text p { font-size: 18px; font-weight: bold; color: #4d4d4d }
    .c-bg-green { background: #00ad49 }
    .c-bg-gray { background: #d1d3d4 }
    .c-bg-gray2 { background: #d9d9d9 }
    .c-bg-white { background: #fffffe }
    @media only screen and (max-width: 640px) { div { font-size: 15px; } .range { display: none; } }
</style>

@if ($item->user())
    <div class="card card-consultation mt-4 mb-5">

        <div class="row bg-consultation p-2">

            <div class="col-lg-3 p-0 box-one">
                <div class="row px-4 pt-lg-3">
                    <div class="col-lg-4">
                        <div class="float-start">
                            <div class="d-lg-none my-auto">
                                <img src="{{ asset('assets/images/logo_card.png') }}" style="width: 156px" alt="spad">
                            </div>
                        </div>
                        <div class="mm">
                            <img src="{{ $item->user()->photo ? url($item->user()->photo->path) : asset('assets/images/b.png') }}"
                             class="@if($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                        </div>
                    </div>
                    <div class="col-lg p-0 text-lg-center my-auto">
                        <p class="my-auto fs-5 fw-bold">
                            {{$item->user()->first_name.' '.$item->user()->last_name}}
                        </p>
                        <p class="my-auto fs-6 fw-bold">{{$item->title}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg my-auto box-two text">
                {!!$item->text!!}
            </div>
            
            <div class="col-lg-2">
                <div class="d-none d-lg-block">
                    <img src="{{ asset('assets/images/logo_card.png') }}" class="w-100" alt="spad">
                </div>
                {{-- <div class="box-tree my-3 my-lg-4 border-right-gray text-center">
                    <a href="{{ route('user.consultation.profile',$item->id) }}" class="btn btn-lg col-10 mx-auto py-lg-2 mb-lg-5 fw-bold">مشاهده پروفایل</a>
                </div> --}}
            </div>

            <div class="col-12 p-0"></div>

            <div class="col-lg-1"></div>
            <div class="col-lg-2">
                <div class="d-none d-lg-block">
                    <div class="mm">
                        {{-- <div class="point card-point {{$status=='online'?'btn-success':'btn-danger'}}"></div> --}}
                        @if ($status=='online')
                            <a  
                            @if (auth()->user()) href="{{auth()->user()->amount > ($item->price)?route('user.call.request',[$item->id,'service']):route('user.user-web-transaction.index')}}"
                            @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="btn px-0">
                            <video style="width: 48px !important;height: 48px !important;" loop autoplay muted>
                                <source src="{{ asset('assets/images/ONLINE.mp4') }}" type="video/mp4">
                            </video>
                        </a>
                        @elseif($status=='offline')
                            <a  @if (auth()->user())
                                    @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                        href="{{ route('user.consultation.evoke',$item->id) }}"
                                    @endunless
                                @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="btn px-0">
                                <img style="width: 48px !important;height: 48px !important;" src="{{ asset('assets/images/OFFLINE.png') }}"/>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg text-end text-lg-start my-auto">
                <span class="range">امتیاز مشاور </span>
                @php
                    $star = 5 - $item->star;
                    $boldStar = $item->star;
                @endphp
                @if ($star > 0)
                    @for ($i = 0; $i < $star; $i++)
                        <i class="fa-regular fa-star text-warning "></i>
                    @endfor
                @endif
                @if ($star > 0)
                    @for ($i = 0; $i < $boldStar; $i++)
                        <i class="fa fa-star text-warning "></i>
                    @endfor
                @endif
            </div>
            
            <div class="col-6 col-lg-3 text-lg-center my-auto">
                تعداد مشاوره
                <i class='fas fa-phone text-danger mx-2'></i>
                {{\App\Model\CallRequest::where('consultant_id',$item->user_id)->count()}}
            </div>
            
            <div class="col-11 my-2 my-lg-0 mx-auto">
                <div class="row">

                    <div class="col-lg-9">

                        <div class="d-none d-lg-block">
                            <div class="row">
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">شنبه</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">یکشنبه</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">دوشنبه</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">سه شنبه</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">چهارشنبه</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">پنج شنبه</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">جمعه</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->subDay(2),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->subDay(),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek(),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(2),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(3),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(4),'Y/m/d') }}</div>
                                <div class="col-12"></div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->shanbe?$item->shanbe:'__'}} - {{$item->e_shanbe?$item->e_shanbe:'__'}}</div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->yekshanbe?$item->yekshanbe:'__'}} - {{$item->e_yekshanbe?$item->e_yekshanbe:'__'}}</div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->doshanbe?$item->doshanbe:'__'}} - {{$item->e_doshanbe?$item->e_doshanbe:'__'}}</div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->seshanbe?$item->seshanbe:'__'}} - {{$item->e_seshanbe?$item->e_seshanbe:'__'}}</div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->chaharshanbe?$item->chaharshanbe:'__'}} - {{$item->e_chaharshanbe?$item->e_chaharshanbe:'__'}}</div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->panjshanbe?$item->panjshanbe:'__'}} - {{$item->e_panjshanbe?$item->e_panjshanbe:'__'}}</div>
    
                                <div class="col text-center px-0 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->jome?$item->jome:'__'}} - {{$item->e_jome?$item->e_jome:'__'}}</div>
    
                            </div>
                        </div>

                        <div class="d-lg-none">
                            <div class="row">
    
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">شنبه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->subDay(2),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->shanbe?$item->shanbe:'__'}} - {{$item->e_shanbe?$item->e_shanbe:'__'}}</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">یکشنبه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->subDay(),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->yekshanbe?$item->yekshanbe:'__'}} - {{$item->e_yekshanbe?$item->e_yekshanbe:'__'}}</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">دوشنبه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek(),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->doshanbe?$item->doshanbe:'__'}} - {{$item->e_doshanbe?$item->e_doshanbe:'__'}}</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">سه شنبه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->seshanbe?$item->seshanbe:'__'}} - {{$item->e_seshanbe?$item->e_seshanbe:'__'}}</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">چهارشنبه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(2),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->chaharshanbe?$item->chaharshanbe:'__'}} - {{$item->e_chaharshanbe?$item->e_chaharshanbe:'__'}}</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">پنج شنبه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(3),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->panjshanbe?$item->panjshanbe:'__'}} - {{$item->e_panjshanbe?$item->e_panjshanbe:'__'}}</div>
                                <div class="col-12"></div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">جمعه</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-gray2 rounded">{{ my_jdate(\Carbon\Carbon::now()->startOfWeek()->addDay(4),'Y/m/d') }}</div>
                                <div class="col text-center px-0 py-1 py-lg-3 m-1 c-bg-white rounded">
                                    {{$item->jome?$item->jome:'__'}} - {{$item->e_jome?$item->e_jome:'__'}}</div>
    
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg my-auto">
                        <div class="row">

                            <div class="col-lg p-0">
                                <div class="c-bg-gray m-1 py-lg-4 rounded">
                                    <p class="pt-2 pt-lg-5 text-center">
                                        تعرفه
                                    </p>
                                    <div class="text-center">
                                        <i class="fa fa-angle-double-left h1 text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 p-0">

                                <div class="px-0 py-1 py-lg-2 text-center m-1 c-bg-green text-white rounded fw-bold">
                                    ۱۰ دقیقه
                                    <br>
                                    {{number_format($item->price*100).' ریال '}}
                                </div>

                                <div class="px-0 py-1 py-lg-1 text-center m-1 c-bg-green text-white rounded fw-bold">
                                    ۳۰ دقیقه
                                    <br>
                                    {{number_format($item->price*300).' ریال '}}
                                </div>

                                <div class="px-0 py-1 py-lg-1 text-center m-1 c-bg-green text-white rounded fw-bold">
                                    ۶۰ دقیقه
                                    <br>
                                    {{number_format($item->price*600).' ریال '}}
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class=" col-lg-11 mx-auto">
                <div class="row">

                    <div class="col-lg-3 mt-2 mt-lg-3">
                        <h5>
                            روش های ارتباط با مشاور
                            <i class="fa fa-angle-double-left text-white"></i>
                        </h5>
                    </div>

                    <div class="col-lg-3 mt-2 mt-lg-3">
                        @if ($status=='online')
                            <a  
                            @if (auth()->user()) href="{{auth()->user()->amount > ($item->price)?route('user.call.request',[$item->id,'service']):route('user.user-web-transaction.index')}}"
                            @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="btn p-0">
                            <h5 class="text-dark">
                                <i class='fas fa-phone text-success'></i>
                                درخواست مشاوره آنلاین
                            </h5>
                        </a>
                        @elseif($status=='offline')
                            <a  @if (auth()->user())
                                    @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                        href="{{ route('user.consultation.evoke',$item->id) }}"
                                    @endunless
                                @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="btn p-0">
                                <h5 class="text-dark">
                                    <i class='fas fa-phone text-danger'></i>
                                    آنلاین شد خبرم کن
                                </h5>
                            </a>
                        @endif
                    </div>

                    <div class="col-lg-3 mt-2 mt-lg-3">
                        <a href="javascript:void(0)" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" @if(auth()->user())
                            data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" @else data-bs-toggle="modal" data-bs-target="#login" @endif> 
                            <h5 class="text-dark">
                                <i class="fa fa-pencil-square" style="color: #ff1616"></i>
                                ثبت درخواست عقد قرارداد
                            </h5>
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endif

{{-- @if ($item->user())
    <div class="card card-consultation mt-4 mb-5 col-lg-11 mx-auto">
        <div class="row bg-consultation">
            <div class="col-lg p-0 bg-white box-one">
                <div class="row pt-2 pt-lg-0">
                    <div class="col-12">
                        <div class="text-center d-none d-lg-block">
                            <img src="{{ asset('assets/images/logo_card.png') }}"  style="width: 210px;" alt="spad">
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="d-lg-none">
                            <div class="logo-box text-center">
                                <div class="mm mb-lg-3">
                                    @if ($item->user()->photo)
                                        <img src="{{ url($item->user()->photo->path) }}" class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                                    @else
                                        <img src="{{ asset('assets/images/b.png') }}" alt="avatar">
                                    @endif
                                    <div class="point card-point {{$status=='online'?'btn-success':'btn-danger'}}"></div>
                                </div>
                            </div>
                            @if ($status=='online')
                                    <a href="{{ route('user.consultation.profile',$item->id) }}" >                                
                                        <img class="me-4" style="width: 58px !important;height: 58px !important;" src="https://img.icons8.com/external-flat-icons-inmotus-design/56/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/>
                                    </a>
                            @elseif($status=='offline')
                                <a  @if (auth()->user())
                                        @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                            href="{{ route('user.consultation.evoke',$item->id) }}"
                                        @endunless
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="btn btn-sm py-0 mx-4">
                                    <img style="width: 58px !important;height: 58px !important;" src="https://img.icons8.com/external-flat-icons-inmotus-design/56/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="col-9 mx-auto my-3 m-lg-0 h1 bg-secondary">
                    </div>
                </div>
                <div class="row px-4 pt-lg-3">
                    <div class="col-12">
                        <div class="d-flex pb-3">
                            <img style="height: 48px;" src="https://img.icons8.com/material-rounded/48/000000/microphone.png"/>
                            <h6 class="fw-bold text-dark-violet px-2 text-end">
                                {{$item->user()->first_name.' '.$item->user()->last_name}}
                                <p class="text-secondary font-12 pt-1 mb-0 text-end">{{$item->title}}</p>
                            </h6>
                        </div>
                        <div class="d-none d-lg-block">
                            <div class="mm mb-lg-3">
                                @if ($item->user()->photo)
                                    <img src="{{ url($item->user()->photo->path) }}" class="@if($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                                @else
                                    <img src="{{ asset('assets/images/b.png') }}" alt="avatar">
                                @endif
                                <div class="point card-point {{$status=='online'?'btn-success':'btn-danger'}}"></div>
                                @if ($status=='online')
                                        <a href="{{ route('user.consultation.profile',$item->id) }}" >                                
                                            <img class="border float-start" src="https://img.icons8.com/external-flat-icons-inmotus-design/68/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/>
                                        </a>
                                @elseif($status=='offline')
                                    <a  @if (auth()->user())
                                            @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                                href="{{ route('user.consultation.evoke',$item->id) }}"
                                            @endunless
                                        @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="btn float-start py-0">
                                        <img class="border mt-lg-2" style="width: 48px !important;height: 48px !important;" src="https://img.icons8.com/external-flat-icons-inmotus-design/68/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 pt-3 px-4 py-lg-2 px-lg-3 box-two">
                <div class="d-none d-lg-block">
                    <h4 class="text-white fw-bold p-1 p-lg-3">روش ارتباط با مشاور را انتخاب کنید</h4>
                    <h4 class="btn btn-lg btn-primary fs-5">
                        <span class="mx-2">
                            <i class="fa fa-phone h5 mb-0"></i>
                        </span>
                        تعداد 
                        {{\App\Model\CallRequest::where('consultant_id',$item->user_id)->count()}}
                        مشاوره تلفنی
                    </h4>     
                    <br>
                    <a href="javascript:void(0)" onclick="setUp2('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'حضوری','{{$item->title}}')" @if(auth()->user())
                        data-bs-toggle="modal" data-bs-target="#qarardad-moshavere-hozori" @else data-bs-toggle="modal" data-bs-target="#login" @endif>
                        <h4 class="btn btn-lg btn-primary">
                            <span class="mx-2">
                                <i class="fa fa-users h5 mb-0"></i>
                            </span>
                            درخواست مشاوره حضوری
                        </h4>
                    </a>
                    <br>
                    <a href="javascript:void(0)" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" @if(auth()->user())
                        data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" @else data-bs-toggle="modal" data-bs-target="#login" @endif> 
                        <h4 class="btn btn-lg btn-primary">
                            <span class="mx-2">
                                <i class="fa fa-pencil-square h5 mb-0"></i>
                            </span>
                            درخواست عقد قرارداد
                        </h4>
                    </a>
                </div>
                <div class="d-lg-none">
                    <h6 class="text-white fw-bold pb-2">روش ارتباط با مشاور را انتخاب کنید</h6>
                    <h4 class="text-white fs-6 pt-2 btn btn-primary mb-0">
                        <span class="mx-2">
                            <i class="fa fa-phone h6 mb-0"></i>
                        </span>
                        تعداد 
                        {{\App\Model\CallRequest::where('consultant_id',$item->user_id)->count()}}
                        مشاوره تلفنی
                    </h4>
                    <a href="javascript:void(0)" onclick="setUp2('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'حضوری','{{$item->title}}')" @if(auth()->user())
                        data-bs-toggle="modal" data-bs-target="#qarardad-moshavere-hozori" @else data-bs-toggle="modal" data-bs-target="#login" @endif class="btn btn-primary py-0 my-2">
                        <h4 class="text-white fs-6 pt-2">
                            <span class="mx-2">
                                <i class="fa fa-users h6 mb-0"></i>
                            </span>
                            درخواست مشاوره حضوری
                        </h4>
                    </a>
                    <a href="javascript:void(0)" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" @if(auth()->user())
                        data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" @else data-bs-toggle="modal" data-bs-target="#login" @endif class="btn btn-primary py-0">
                        <h4 class="text-white fs-6 pt-2">
                            <span class="mx-2">
                                <i class="fa fa-pencil-square h6 mb-0"></i>
                            </span>
                            درخواست عقد قرارداد
                        </h4>
                    </a>
                </div>
            </div>
            
            <div class="col-lg">
                <div class="box-tree my-3 my-lg-4 border-right-gray text-center">
                    <div class="d-none d-lg-block">
                        <div class="logo-box text-center">
                            <img src="{{ asset('assets/images/msg-icon2.png') }}" alt="banner">
                            <h4 class="text-white text-center">اسپاد استاک</h4>
                        </div>
                    </div>
                    <a href="{{ route('user.consultation.profile',$item->id) }}" class="btn btn-lg col-10 mx-auto py-lg-2 mb-lg-5 fw-bold">مشاهده پروفایل</a>
                </div>
            </div>
        </div>
    </div>
@endif --}}

