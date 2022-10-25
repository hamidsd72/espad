<div class="col-lg-6">
    <div class="card mb-4">
        <div class="card-body row kala p-0">
            <div class="col-lg-4">
                @if ($item->user()->photo)
                    <img src="{{ url($item->user()->photo->path) }}" class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                @else
                    <img src="{{ asset('assets/images/b.png') }}" alt="avatar">
                @endif
            </div>
            <div class="col-lg my-auto">
                <div class="p-3 p-lg-0">
                    <h4 class="text-dark-violet">{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                    <h6 class="my-3 my-lg-2 text-secondary">{{$item->title}}</h6>
                    @if ($status=='online')
                        <a  @if (auth()->user())
                                @if (auth()->user()->amount > $item->price) href="{{route('user.call.request',[$item->id,'service'])}}"
                                @else href="{{route('user.user-web-transaction.index')}}" @endif
                            @else
                                href="#" data-bs-toggle="modal" data-bs-target="#login"
                            @endif class="btn btn-success my-1 mb-2">
                            <i class="fas fa-phone-alt mx-1"></i>
                            {{-- <img src="https://img.icons8.com/external-flat-icons-inmotus-design/56/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design.png"/> --}}
                            شروع مشاوره
                        </a>
                    @elseif($status=='offline')
                        <a  @if (auth()->user())
                                @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                    href="{{ route('user.consultation.evoke',$item->id) }}"
                                @endunless
                            @else
                                href="#" data-bs-toggle="modal" data-bs-target="#login"
                            @endif class="btn btn-secondary my-1 mb-2">
                            <i class="fas fa-phone-alt mx-1"></i>
                            {{-- <img src="https://img.icons8.com/external-flat-icons-inmotus-design/56/000000/external-Call-round-mobile-ui-set-flat-icons-inmotus-design-3.png"/> --}}
                            آنلاین شد خبرم کن
                        </a>
                    @endif
                    <div>
                        <a href="{{ route('user.consultation.profile',$item->id) }}" class="text-dark-violet h6">مشاهده پروفایل</a>
                    </div>
                    <div class="mt-1">
                        <a href="javascript:void(0)" onclick="setUp('{{$item->id}}', 'consultation', '{{$item->user_id}}', 'قرارداد','{{$item->title}}')" @if(auth()->user())
                            data-bs-toggle="modal" data-bs-target="#qarardad-moshavere" @else data-bs-toggle="modal" data-bs-target="#login" @endif class="text-dark-violet h6">
                            درخواست عقد قرارداد
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>