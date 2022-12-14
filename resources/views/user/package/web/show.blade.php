@extends('layouts.layout_first_page')
@section('content')
    <div class="container">
        <div class="card bg-light my-4">
            <div class="card-body">
                <img src="{{url($item->pic_card)}}" alt="{{$item->title}}" style="width: 100%;height: 400px;border-radius: 4px;">
                <div class="row m-3">
                    <div class="col my-auto">
                        <p>{{$item->title}}</p>
                    </div>
                    <div class="col-auto">
                        @if ($users->first()->photo)
                            <div class="mm" style="direction: ltr;">
                                <div class="d-none">{{$f = 0}}</div>
                                @foreach ($users as $user)
                                    @if ($user->photo)
                                        <img src="{{url($user->photo->path)}}"  alt="banner" style="position: relative;right: {{$f}}px;">
                                        <div class="d-none">{{$f += 14}}</div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="small text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-16" viewBox="0 0 512 512">
                                    <title>ionicons-v5-l</title>
                                    <rect x="32" y="80" width="448" height="256" rx="16" ry="16" transform="translate(512 416) rotate(180)" style="fill:none;stroke:#000;stroke-linejoin:round;stroke-width:32px"></rect>
                                    <line x1="64" y1="384" x2="448" y2="384" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line>
                                    <line x1="96" y1="432" x2="416" y2="432" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line>
                                    <circle cx="256" cy="208" r="80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></circle>
                                    <path d="M480,160a80,80,0,0,1-80-80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                    <path d="M32,160a80,80,0,0,0,80-80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                    <path d="M480,256a80,80,0,0,0-80,80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                    <path d="M32,256a80,80,0,0,1,80,80" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                </svg>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row mx-3 mb-1">
                    <div class="col">
                        @foreach ($users as $user)
                            {{$user->first_name.' '.$user->last_name.' - '}}
                        @endforeach
                        |@if($endItemSignUpDate) <span class="text-danger">??????????????</span> @else <span class="text-success">????????</span> @endif
                        {{-- <p class="small vm">
                            <span class=" text-secondary">4.5</span>
                            <span class=" text-secondary">| ????????</span>
                        </p> --}}
                    </div>
                    <div class="col-auto">
                        <p class="small text-secondary">
                            {{$item->price>0?number_format($item->price).' ?????????? ':'????????????'}}
                        </p>
                    </div>
                </div>
                <div class="card-body border-top border-color">
        
                    <h6>{{ $item->title }}</h6>
                    @if ($item->started_at)
                        <h6 class="mt-3">{{ ' ?????????? ?????????????? '.my_jdate($item->started_at,'d F Y') }}</h6>
                    @endif
                    <div class="text-secondary p-3">
                        {!! $item->text !!}
                    </div>
                    {{-- ?????????????? ?????????? ???????????? --}}
                    @if ($item->limited && $item->limited < $max)
                        <a href="#" class="mt-2 btn btn-secondary btn-block"> 
                            ?????????? ???????????? ?????????? ?????? ??????
                        </a>
                    {{-- ?????????????? ?????????? ???????????? ???????????? --}}
                    @elseif($endItemSignUpDate)
                        <a href="#" class="mt-2 btn btn-secondary btn-block"> 
                            ?????????? ?????? ?????? ???????????? ???? ?????????? ?????????? ??????
                        </a>
                    @else
                        {{-- ?????????????? ?????? ???????? ???????????? --}}
                        @if (auth()->user())
                            @if(App\Model\Basket::where('user_id',auth()->user()->id)->where('sale_id',$item->id)->where('type','package')->where('status','active')->exists())
                                <a class="btn btn-secondary" href="{{route('user.my-basket.show',auth()->user()->id)}}" >
                                    ?????? ???????????? ???????? ?????? ???????? ?????? - ?????????? ???????? ?????? ????
                                </a>
                            @else
                                <a @if (auth()->user()->amount > $item->price) href="{{route('user.add_basket',[$item->id,'package'])}}"
                                    @else href="{{route('user.user-web-transaction.index')}}" @endif class="mt-2 btn btn-primary btn-block"> 
                                    ???????? ???? ?????? ????????????
                                </a>
                            @endif
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="mt-2 btn btn-primary btn-block">
                                ???????? ???? ?????? ????????????
                            </a>
                        @endif

                        @if ($item->price>0 )
                            @unless(auth()->user() && App\Model\Basket::where('user_id',auth()->user()->id)->where('sale_id',$item->id)->where('type','package')->where('status','active')->exists())
                                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="mt-2 mx-2 btn btn-success btn-block">
                                    ???????? ???? ?????? ???????????? ???? ???? ??????????
                                </a>
                            @endunless
                        @endif

                    @endif
                    @if ($item->price>0 )
                        <p class="mt-3 mb-0 small text-danger">???????????? ???????????? ?????? ?????????? ???????? ??????????????</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('user.add_basket_with_offCode',[$item->id,'package']) }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="staticBackdropLabel">???? ?????????? ?????? ???? ???????? ????????</h6>
                    </div>
                    <div class="modal-body">
                        <label for="offcode">???? ??????????</label>
                        <input type="text" name="offcode" id="offcode" placeholder="???? ?????????????? ???? ???????? ????????" class="form-control mt-3">
                    </div>
                    <p class="mx-3 text-danger">?????????????????? ???? ?????????? ?????????????? ???????? ?????????????? ?????????? ????????????</p>
                    <div class="modal-footer" style="display: unset">
                        <button type="submit" class="btn btn-primary">???????? ???? ?????? ????????????</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">????????????</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  

    <script>
        function copy() {
            var copyText = document.getElementById("share");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            alert('???????? ???????????? ???? ???????????????? ?????????? ????');
        }
    </script>
@endsection
