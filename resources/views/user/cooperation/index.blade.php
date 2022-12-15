@extends('layouts.layout_first_page')
@section('content')
<style>
    .links ul {
        list-style: unset !important;
    }
    .accordion-button::after {
        margin: unset;
        position: absolute;
        width: 2rem;
        height: 2rem;
        background-size: 2rem;
        background-image: url({{asset('/assets/images/plus.png')}});
    }
    .accordion-button:not(.collapsed)::after {
        background-image: url({{asset('/assets/images/minus.png')}});
    }
</style>
    {{-- <div id="top_banner">
        <img src="https://www.bourse.lu/img/banner-CAREERS.jpg" alt="banner">
        <div><h1 class="text-center">دعوت به همکاری</h1></div>
    </div> --}}

    <section class="about">
        <div class="container jobs pb-4">

            <h6 class="text-secondary py-4">دعوت به همکاری</h6>

            <div class="body bg-white p-3 p-lg-4">

                <div class="row">
                    @if ( $body->where('section',1)->count() )
                        <div class="accordion" id="accordionExample">
                            @foreach ($body->where('section',1) as $content)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$content->id}}">
                                        {{-- <button class="accordion-button {{$body->where('section',102)->first()->id==$content->id?'':'collapsed'}}" type="button" data-bs-toggle="collapse" --}}
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            {{-- data-bs-target="#collapse{{$content->id}}" aria-expanded="{{$body->where('section',102)->first()->id==$content->id?'true':'false'}}" aria-controls="collapse{{$content->id}}"> --}}
                                            data-bs-target="#collapse{{$content->id}}" aria-expanded="false" aria-controls="collapse{{$content->id}}">
                                            <p class="m-0 px-5 fw-bold">{{ $content->title }}</p>
                                        </button>
                                    </h2>
                                    {{-- <div id="collapse{{$content->id}}" class="accordion-collapse collapse {{$body->where('section',102)->first()->id==$content->id?'show':''}}"  --}}
                                    <div id="collapse{{$content->id}}" class="accordion-collapse collapse" 
                                        aria-labelledby="heading{{$content->id}}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body text-dark">
                                            {!! $content->text !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <h2 class="py-4 d-flex">
                    <div class="line"></div>
                    موقعیت‌های شغلی</h2>
                <div class="row" id="jobs">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">دسته بندی ها</div>
                            <div class="card-body py-0">
                                @foreach ($items as $item)
                                   @if($item->id==$id)
                                        <h6 class="my-2 p-2 job border-right">
                                            <a href="javascript:void(0)" class="px-2 text-dark">{{$item->title}}</a>
                                        </h6>
                                    @else
                                        <h6 class="my-2 p-2 job">
                                            <a href="{{ route('user.cooperation.show',$item->id) }}" class="px-2 text-dark">{{$item->title}}</a>
                                        </h6>
                                   @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">

                        {{-- <input type="text" class="form-control mb-4" placeholder="جستجو در بین مشاغل"> --}}

                        <div class="row">
                            @foreach ($sub_items->where('sub_cat_id', $id) as $item)
                                <div class="col-xl-4 col-lg-6 mb-4">

                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="my-1">{{$items->first()->title}}</h6>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$item->title}}</p>
                                            <div class="row">
                                                <div class="col-6"><button type="button" data-bs-toggle="modal" data-bs-target="#jobForm{{$item->id}}" 
                                                    class="btn btn-sm btn-outline-warning col-12">ارسال رزومه</button></div>
                                                <div class="col-6"><button type="button" data-bs-toggle="modal" data-bs-target="#details{{$item->id}}" 
                                                    class="btn btn-sm btn-outline-violet col-12">نمایش جزئیات</button></div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>

                                {{-- modal 1 --}}
                                <div class="modal fade" id="jobForm{{$item->id}}" tabindex="-1" aria-labelledby="jobFormModal{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="jobFormModal">ارسال رزومه برای {{$item->title}}</h5>
                                            </div>
                                            <div class="modal-body">
                                            
                                                <form action="{{ route('user.forms.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                                    <input type="hidden" name="type" value="job">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-4">
                                                            <label class="mb-2" for="name">نام و نام خانوادگی *</label>
                                                            <input class="form-control" name="name" placeholder="نام" required type="text" required>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label for="mobile" class="col-form-label">شماره تماس *</label>
                                                            <input type="number" placeholder="۹۱۳۱۶۲۸۸۶۶" class="form-control" name="mobile" required>
                                                        </div>
                                                        <div class="col-lg-12 mb-4">
                                                            <label class="mb-2" for="attach">رزومه</label>
                                                            <input class="form-control" name="attach" required type="file">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6"><button type="submit" class="btn btn-sm btn-primary col-12">ارسال فرم</button></div>
                                                        <div class="col-6"><button type="button" class="btn btn-sm btn-secondary col-12" data-bs-dismiss="modal">بستن</button></div>
                                                    </div>
                                                </form>
                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- modal 2--}}
                                <div class="modal fade" id="details{{$item->id}}" tabindex="-1" aria-labelledby="detailsModal{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailsModal">جزئیات {{$item->title}}</h5>
                                            </div>
                                            <div class="modal-body">
                                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        سابقه کار :
                                                        <div class="my-2">
                                                            <span class="bg-dark text-white p-1 rounded">{{$item->history}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        مدرک تحصیلی :
                                                        <div class="my-2">
                                                            <span class="bg-dark text-white p-1 rounded">{{$item->education}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        نوع همکاری :
                                                        <div class="my-2">
                                                            @for ($i = 0; $i < count(explode(',',$item->type)); $i++)
                                                                <span class="bg-dark text-white p-1 mx-1 rounded">
                                                                    {{ (explode(',',$item->type))[$i] }}
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        حقوق :
                                                        <div class="my-2">
                                                            <span class="bg-dark text-white p-1 rounded">{{$item->amount}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        آدرس :
                                                        <div class="my-2">
                                                            @for ($i = 0; $i < count(explode(',',$item->address)); $i++)
                                                                <span class="bg-dark text-white p-1 mx-1 rounded">
                                                                    {{ (explode(',',$item->address))[$i] }}
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-4">
                                                        شرح موقعیت شغلی :
                                                        <p class="my-3">
                                                            {{$item->description}}
                                                        </p>
                                                    </div>
                                                    @if ($item->attach)
                                                        <div class="col-12 mb-4">
                                                            <p class="my-3">
                                                                <a href="{{$item->attach}}" download="">دانلود فایل</a>
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>


                                                <div class="row">
                                                    <div class="col-6"><button type="button" class="btn btn-success col-12" data-bs-toggle="modal" data-bs-target="#jobForm{{$item->id}}" >ارسال رزومه</button></div>
                                                    <div class="col-6"><button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">بستن</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            @unless ($sub_items->where('sub_cat_id', $id)->count())
                                <p class="my-4 text-center text-danger">
                                    موردی یافت نشد
                                </p>
                            @endunless
                        </div>
                    </div>
                </div>

        </div>
    </section>

    @if (\Request::route()->getName()=='user.cooperation.show')
        <script>
            var scrollDiv = document.getElementById("jobs").offsetTop;
            window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
        </script>
    @endif

@endsection