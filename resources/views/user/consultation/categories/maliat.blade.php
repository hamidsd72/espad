@if ($item->user())
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body row p-0">
                <div class="col-lg-4">
                    @if ($item->user()->photo)
                        <img src="{{ url($item->user()->photo->path) }}" style="width:100%" class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" alt="avatar">
                    @else
                        <img src="{{ asset('assets/images/b.png') }}" style="width:100%" alt="avatar">
                    @endif
                </div>
                <div class="col-lg my-auto">
                    <div class="p-3 p-lg-0">
                        <h4 class="text-dark-violet border-bottom-gold py-1">{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                        <h6 class="my-3 my-lg-2 text-secondary">{{$item->title}}</h6>
                        @if ($status=='online')
                            <a  @if (auth()->user())
                                    @if (auth()->user()->amount > $item->price) href="{{route('user.call.request',[$item->id,'service'])}}"
                                    @else href="{{route('user.user-web-transaction.index')}}" @endif
                                @else
                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                @endif class="btn btn-success my-1 mb-2">
                                <i class="fas fa-phone-alt mx-1"></i>
                                شروع مشاوره
                            </a>
                        @elseif($status=='offline')
                            <a  @if (auth()->user())
                                    @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('item_id',$item->id)->count())
                                        href="{{ route('user.consultation.evoke',$item->id) }}"
                                    @endunless
                                @else
                                    href="#" data-bs-toggle="modal" data-bs-target="#login"
                                @endif class="btn btn-secondary text-white my-1 mb-2">
                                <i class="fas fa-phone-alt mx-1"></i>
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
@endif
