@extends('user.master')
@section('content')
<style>
    .modal-dialog-scrollable .modal-content { border-radius: 30px; }
    div.collapse a.text-white {
        /* background: #80D4FF; */
        border-radius: 50px !important;
        padding: 6px 0px;
        font-size: 14px;
        font-weight: bold;
        float: left;
        text-align: center;
        width: 100%;
    }
    .bg-highlight {
        background-color: #80D4FF !important;
        background-color: #fe5722 !important;
    }
    .tab-controls a {
        font-size: 9px;
    }
    .tabs-rounded a:first-child {
        border-bottom-right-radius: 15px;
    }
    .tabs-rounded a:last-child {
        border-bottom-left-radius: 16px;
        border-top-left-radius: 15px;
    }
    .modal-dialog-scrollable .modal-content {
        margin-top: 14%;
    }
</style>

    <div class="mx-auto" style="max-width: 1000px;">

        {{-- searchbar --}}
        <div class="container mt-5 pt-4">
            <div class="form-group mb-0">
                <form action="{{route('user.services-search')}}" method="get">
                    @csrf
                    <div class="row mb-0">
                        <div class="col">
                            {{-- <input type="hidden" name="category_id" value="{{$ServiceCat->id}}"> --}}
                            <input type="text" class="form-control search" name="search" placeholder="یافتن مشاوران">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- end searchbar --}}
        <div class="card card-style" style="background: none;box-shadow: none;">
            <div id="tab-group-1">
    
                {{-- <div class="tab-controls tabs-medium tabs-rounded mt-3 mx-lg-3" data-highlight="bg-highlight">
                    @foreach ($SubService as $key => $sub)
                        @if ($key==0)
                            <a href="#" class="font-600 bg-highlight no-click " data-active="" data-bs-toggle="collapse" 
                            data-bs-target="#tab-1" aria-expanded="true">{{$sub->title}}</a>
                        @else
                            <a href="#" class="font-600 collapsed" data-bs-toggle="collapse" data-bs-target="#tab-{{$sub->id}}" aria-expanded="false">{{$sub->title}}</a>
                        @endif
                    @endforeach
                </div>  --}}

                <div class="clearfix"></div>
                
                {{-- @foreach ($SubService as $key => $sub)
                    @if ($key==0)
                        <div data-bs-parent="#tab-group-1" class="collapse show" id="tab-1">

                            @foreach ($items->where('category_id', $sub->id) as $item)
                                @include('user.partials.service-partial')
                            @endforeach 
                            
                        </div>
                    @else
                        <div data-bs-parent="#tab-group-1" class="collapse" id="tab-{{$sub->id}}">
                            
                            @foreach ($items->where('category_id', $sub->id) as $item)
                                @include('user.partials.service-partial')
                            @endforeach 

                        </div>
                    @endif
                @endforeach --}}
                @if ($SubService??'')
                    <div class="mt-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row mb-0">
                                    <div class="col">
                                        <h6 class="text-dark my-1">
                                            <img src="/{{$ServiceCat->pic}}"style="height: 40px;width: 40px;border-radius:50%;">
                                            <span class="vm ml-2">{{$ServiceCat->title}}</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            @if ($ServiceCat->slug=='اوراق-بهادار')
                            <div class="accordion" id="accordionExample">
                                @foreach (\App\Model\Group::all() as $key => $group)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$group->id}}">
                                            <button class="accordion-button {{$key==0?'':'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$group->id}}" 
                                            aria-expanded="{{$key==0?'true':'false'}}" aria-controls="collapse{{$group->id}}">
                                                {{$group->title}}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$group->id}}" class="accordion-collapse collapse {{$key==0?'show':''}}" aria-labelledby="heading{{$group->id}}" 
                                        data-bs-parent="#accordionExample"> 
                                            <div class="accordion-body">

                                                <div class="card-body">
                                                    <div class="row px-2 mb-0">
                                                        @foreach($SubService->where('group_id',$group->id) as $service)
                                                            <a href="{{ route('user.subServices',$service->id) }}" class="col-6 col-lg-4 px-2 mb-3 balabala">
                                                                <div>
                                                                    <label class="checkbox-lable pb-2" for="{{$service->title}}">
                                                                        <span class="image-boxed text-white">
                                                                            @if (is_file($ServiceCat->pic))                                        
                                                                                <img src="{{$ServiceCat->pic?url($ServiceCat->pic):''}}" alt="{{$service->title}}" class="img-fluid">
                                                                            @else
                                                                                <img src="{{\App\Model\ServiceCat::find($ServiceCat->service_id)->pic}}" alt="{{$service->title}}" class="img-fluid">
                                                                            @endif
                                                                        </span>
                                                                        <span class="p-2">{{$service->title}}</span>
                                                                    </label>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                              </div>
                            @else
                                <div class="card-body">
                                    <div class="row px-2 mb-0">
                                        @foreach($SubService as $service)
                                            <a href="{{ route('user.subServices',$service->id) }}" class="col-6 col-lg-4 px-2 mb-3 balabala">
                                                <div>
                                                    {{-- <input type="radio" name="facilitiestype" class="checkbox-boxed" id="{{$service->title}}"> --}}
                                                    <label class="checkbox-lable pb-2" for="{{$service->title}}">
                                                        <span class="image-boxed text-white">
                                                            @if ($service&&$service->pic)                                        
                                                                <img src="{{$service->pic?url($service->pic):''}}" alt="{{$service->title}}" class="img-fluid">
                                                            @else
                                                                <img src="{{$ServiceCat->pic?url($ServiceCat->pic):''}}" alt="{{$service->title}}" class="img-fluid">
                                                            @endif
                                                        </span>
                                                        <span class="p-2">{{$service->title}}</span>
                                                    </label>
                                                </div>
                                            </a>
                                        @endforeach
                                        {{-- @foreach($serviceCat as $service)
                                            <div class="splide__slide">
                                                <a href="/services/{{$service->id}}">
                                                    <div class="card card-style m-0" style="border-radius: 20px;">
                                                        <img src="{{url($service->pic)}}" alt="{{$service->title}}">
                                                        <a href="{{route('user.services',$service->id)}}" class="card-footer">
                                                            <p class="text-dark mb-1" style="text-align: right;">{{'دسته ی '.$service->title}}</p>
                                                            <p class="small text-secondary" style="text-align: right;">نمایش  این دسته </p>
                                                        </a>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach --}}
                                        
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if ($items??'')
                    @foreach ($items as $item)
                        <div class="d-none">{{$status='آنلاین'}}</div>
                        @if ($item->user())
                            @include('user.partials.service-partial')
                        @endif
                    @endforeach
    
                    @foreach ($items2 as $item)
                        <div class="d-none">{{$status='آفلاین'}}</div>
                        @if ($item->user())
                            @include('user.partials.service-partial')
                        @endif
                    @endforeach 
                @endif
            </div>
        </div>

    </div>

    <div class="container">
        @if ($items1??'')
            {{$items1->links()}}
        @endif
    </div>

    @include('user.forms.qarardad-moshavere')
    @include('user.forms.qarardad-moshavere-hozori')
    @include('user.forms.payam-moshavere')
    <script>
        function setUp(id , type, cons_id, title, subject) {
            document.getElementById('qarardad-id').value = id;
            document.getElementById('qarardad-type').value = type;
            document.getElementById('qarardad-cons-id').value = cons_id;
            document.getElementById('qarardad-title').value = title;
            document.getElementById('qarardad-moshavereLabel').innerHTML = subject;
        }
        function setUp2(id , type, cons_id, title, subject) {
            document.getElementById('qarardad-id2').value = id;
            document.getElementById('qarardad-type2').value = type;
            document.getElementById('qarardad-cons-id2').value = cons_id;
            document.getElementById('qarardad-title2').value = title;
            document.getElementById('qarardad-moshavere-hozoriLabel').innerHTML = subject;
        }
        function setUp3(id , type, cons_id, title, subject) {
            document.getElementById('qarardad-id3').value = id;
            document.getElementById('qarardad-type3').value = type;
            document.getElementById('qarardad-cons-id3').value = cons_id;
            document.getElementById('qarardad-title3').value = title;
            document.getElementById('qarardad-moshavereLabel').innerHTML = subject;
        }
    </script>
@endsection
