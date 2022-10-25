@if ($item->user())
    <div class="card card-consultation mt-4 mb-5 col-lg-11 mx-auto">
        <div class="row bg-consultation">
            <div class="col-lg p-0 bg-white box-one">
                <div class="row pt-2">
                    <div class="col-12">
                        <div class="text-center d-none d-lg-block">
                            <img src="{{ asset('assets/images/logo_card.png') }}"  style="width: 210px;" alt="spad">
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="d-lg-none">
                            <div class="logo-box text-center">
                                <div class="mm">
                                    @if ($item->user()->photo)
                                        <img src="{{ url($item->user()->photo->path) }}" class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                                    @else
                                        <img src="{{ asset('assets/images/b.png') }}" alt="avatar">
                                    @endif
                                    <div class="point card-point {{$status=='online'?'btn-success':'btn-danger'}}"></div>
                                </div>
                            </div>
                            @if ($status=='online')
                                {{-- <a  @if (auth()->user())
                                        @if (auth()->user()->amount > $item->price) href="{{route('user.call.request',[$item->id,'service'])}}"
                                        @else href="{{route('user.user-web-transaction.index')}}" @endif
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="btn btn-sm py-0 col-8"> --}}
                                    <a href="{{ route('user.consultation.profile',$item->id) }}" >                                
                                        <img class="me-1" style="width: 58px !important;height: 58px !important;" src="https://img.icons8.com/external-flat-icons-inmotus-design/56/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/>
                                    </a>
                                {{-- </a> --}}
                            @elseif($status=='offline')
                                <a  @if (auth()->user())
                                        @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                            href="{{ route('user.consultation.evoke',$item->id) }}"
                                        @endunless
                                    @else
                                        href="#" data-bs-toggle="modal" data-bs-target="#login"
                                    @endif class="btn btn-sm py-0 mx-4">
                                    {{-- <img src="{{ asset('assets/images/call.gif') }}" style="width: 32px !important;height: 32px !important;" alt="call"> --}}
                                    <img style="width: 58px !important;height: 58px !important;" src="https://img.icons8.com/external-flat-icons-inmotus-design/56/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="col-9 mx-auto my-3 mb-lg-0 h1 bg-secondary">
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
                            <div class="mm">
                                @if ($item->user()->photo)
                                    <img src="{{ url($item->user()->photo->path) }}" class="@if($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                                @else
                                    <img src="{{ asset('assets/images/b.png') }}" alt="avatar">
                                @endif
                                <div class="point card-point {{$status=='online'?'btn-success':'btn-danger'}}"></div>
                                @if ($status=='online')
                                    {{-- <a  @if (auth()->user())
                                            @if (auth()->user()->amount > $item->price) href="{{route('user.call.request',[$item->id,'service'])}}"
                                            @else href="{{route('user.user-web-transaction.index')}}" @endif
                                        @else
                                            href="#" data-bs-toggle="modal" data-bs-target="#login"
                                        @endif class="btn float-start py-0"> --}}
                                        {{-- <img src="{{ asset('assets/images/call.gif') }}" style="width: 48px !important;height: 48px !important;" alt="call"> --}}
                                        <a href="{{ route('user.consultation.profile',$item->id) }}" >                                
                                            <img class="border float-start" src="https://img.icons8.com/external-flat-icons-inmotus-design/68/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/>
                                        </a>
                                    {{-- </a> --}}
                                @elseif($status=='offline')
                                    <a  @if (auth()->user())
                                            @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                                href="{{ route('user.consultation.evoke',$item->id) }}"
                                            @endunless
                                        @else href="#" data-bs-toggle="modal" data-bs-target="#login" @endif class="btn float-start py-0">
                                        {{-- <img src="{{ asset('assets/images/call.gif') }}" style="width: 48px !important;height: 48px !important;" alt="call"> --}}
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
                            <img src="{{ asset('assets/images/msg-icon.png') }}" alt="banner">
                            <h4 class="text-white text-center">اسپاد استاک</h4>
                        </div>
                    </div>
                    <a href="{{ route('user.consultation.profile',$item->id) }}" class="btn btn-lg col-10 mx-auto py-lg-2 mb-lg-5 fw-bold">مشاهده پروفایل</a>
                </div>
            </div>
        </div>
    </div>
@endif