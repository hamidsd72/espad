@extends('layouts.layout_first_page')
@section('content')
<style>
    .text-{
        text-align: justify;
    }
</style>
<section class="about">
    <div class="container pb-4">

        <h6 class="text-secondary py-4">{{ $item->title }}</h6>

        <div class="body bg-white p-4">

            <div class="row">
                @foreach ($header->where('section',1) as $item)
                    <div class="col-lg mb-4">
                        <img src="{{$item->pic?url($item->pic):''}}" class="rounded" style="width: 100%;height: 280px;" alt="banner">
                    </div>
                    <div class="col-lg mb-4">
                        <a href="{{$item->link?url($item->link):''}}"><h2 class="py-4 d-flex"><div class="line"></div>{{$item->title}}</h2></a>
                        {!! $item->text !!}
                    </div>
                @endforeach
            </div>

            <div class="row">
                @foreach ($header->where('section',2) as $item)
                    <div class="col-lg mb-4">
                        <a href="{{$item->link?url($item->link):''}}"><h2 class="py-4 d-flex"><div class="line"></div>{{$item->title}}</h2></a>
                        {!! $item->text !!}
                    </div>
                    <div class="col-lg mb-4">
                        <img src="{{$item->pic?url($item->pic):''}}" class="rounded" style="width: 100%;height: 280px;" alt="banner">
                    </div>
                @endforeach
            </div>

            @foreach ($header->where('section',3) as $item)
                {!! $item->text !!}
            @endforeach

            <div class="border rounded p-2 p-lg-4 my-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            @foreach ($header->where('section',4) as $obj)
                                @foreach (explode(',',$obj->title) as $item)
                                    <th scope="col fw-bold" style="font-size: 14px;">{{ $item }}</th>
                                @endforeach
                            @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($header->where('section',5) as $obj)
                            <tr>
                                <th scope="row">{{$obj->sort}}</th>
                                @foreach (explode(',',$obj->title) as $item)
                                    <td class="fw-bold" style="font-size: 14px;">{{ $item }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>
            
            <h2 class="py-4 d-flex">
                <div class="line"></div>
                 درخواست کد تخفیف
            </h2>
            
            <form action="{{route('user.contact.post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="کد تخفیف">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <label for="subject" class="mb-2">کارگاه مشاوره را انتخاب کنید</label>
                        <select id="subject" name="subject" class="select2 form-control mb-2">
                            @foreach (\App\Model\ServicePackage::where('type','sample')->where('status','active')->get() as $key => $item)
                                <option value="{{$item->title}}" @if($key==0) selected @endif>{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="q1">{{$header->where('section',9)->where('sort',1)->first()->title}}</label>
                        <select id="q1" name="q1" class="form-control mb-2">
                            @foreach (explode( ',' , $header->where('section',9)->where('sort',1)->first()->link ) as $key => $item)
                                <option value="{{$item}}" @if($key==0) selected @endif>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="q2">{{$header->where('section',9)->where('sort',2)->first()->title}}</label>
                        <select id="q2" name="q2" class="form-control mb-2">
                            @foreach (explode( ',' , $header->where('section',9)->where('sort',2)->first()->link ) as $key => $item)
                                <option value="{{$item}}" @if($key==0) selected @endif>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="q3">{{$header->where('section',9)->where('sort',3)->first()->title}}</label>
                        <select id="q3" name="q3" class="form-control mb-2">
                            @foreach (explode( ',' , $header->where('section',9)->where('sort',3)->first()->link ) as $key => $item)
                                <option value="{{$item}}" @if($key==0) selected @endif>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="q4">{{$header->where('section',9)->where('sort',4)->first()->title}}</label>
                        <select id="q4" name="q4" class="form-control mb-2">
                            @foreach (explode( ',' , $header->where('section',9)->where('sort',4)->first()->link ) as $key => $item)
                                <option value="{{$item}}" @if($key==0) selected @endif>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="attach">فایل پیوست (اختیاری)</label>
                        <input class="form-control" name="attach" type="file">
                    </div> --}}

                    <div class="col-12 mb-4">
                        <label class="mb-2" for="text">شرح پیام</label>
                        <textarea name="text" class="form-control" rows="4" placeholder="شرح پیام" required></textarea>
                    </div>

                    <div class="col-lg-3 col-md-6 col-8">
                        <button type="submit" class="btn btn-primary col-12">ارسال درخواست</button>
                    </div>
                </div>
            </form>
            
        </div>

    </div>
</section>

@endsection