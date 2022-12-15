@extends('user.master')
@section('content')
<style>
    .ss img {
    width:68px;
    height:68px;
    border-radius:50%;
    object-fit: cover;
    }
    .ss img.online {
        box-shadow: 0 0 0 3px #67e91559, 3px 3px 12px rgb(26 229 14 / 70%); 
    }
    .ss img.ofline {
        box-shadow: 0 0 0 3px #e91f157d, 3px 3px 12px rgb(229 35 14 / 70%);;
    }
    .point {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: relative;
        right: 62px;
        bottom: 10px;
    }
    #likes {
        float: left;
        position: relative;
        top: -44px;
        left: 18px;
    }
</style>

    <div class="mt-5 pt-2">

        <div class="card m-2">
            <div class="card-body">
                <div class="row mb-0">
                    <div class="col-9 my-auto">
                        <h4>{{$item->user()->first_name.' '.$item->user()->last_name}}</h4>
                        <h6 class="text-secondary pt-2">{{ $item->title }}</h6>
                    </div>
                    <div class="col-3 text-end ss">
                        <img class="@if ($status=='online') online @elseif($status=='offline') ofline @endif" src="{{ url($item->user()->photo->path) }}" alt="avatar">
                        <div class="point {{$status=='online'?'bg-success':'bg-danger'}}"></div>
                    </div>
                </div>
            </div>
            <div class="card-body border-top border-color">
                <img src="{{$item->photo?url($item->photo->path):''}}" alt="{{$item->title}}" class="w-100 rounded p-1">
            </div>
            <div class="card-body border-top border-color">
                <div class="mx-auto pb-3">
                    {!! $item->text !!}
                </div>

                @if ($status=='online')
                    <h6>انتخاب پکیج مشاوره</h6>
                    <div class="col-12 my-3">
                        <a  href="{{route('user.call.request',[$item->id,'service'])}}" class="btn btn-success col-12 text-dark">
                            مشاوره رایگان
                        </a>
                    </div>
                @elseif($status=='offline')
                    <a  @unless(\App\Model\Evoke::where('user_id',auth()->user()->id)->where('consultation_id',$item->user_id)->count())
                        href="{{ route('user.consultation.evoke',$item->user_id) }}" @endunless class="btn btn-lg btn-primary col-12">آنلاین شد خبرم کن
                    </a>
                @endif
                
                <hr class="my-3">
                <div class="col-12">
                    <h6>افزودن به سبد خرید</h6>
                    <form action="{{ route('user.store.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="type" value="service">
                        <label for="count">تعداد را وارد کنید</label>
                        <input type="number" id="count" name="count" class="form-control my-3" min="1" required>

                        @if (auth()->user())
                            <button class="btn btn-lg btn-success col-12">ثبت سفارش</button>
                        @else
                            <a href="#" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-lg btn-success col-12">افزودن به سبد خرید</a>
                        @endif

                    </form>
                </div>

            </div>
        </div>

    </div>

    <script>
        function sendLike() {
            document.getElementById("form-like").submit();
        }
        function setLike(like) {
            document.getElementById("star").value = like;
            sendLike();
        }
    </script>
@endsection
