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
    
                <div class="clearfix"></div>
                
                <div class="mt-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row mb-0">
                                <div class="col">
                                    <h6 class="text-dark my-1">
                                        {{-- <img src="/{{$ServiceCat->service_id ? is_file(\App\Model\ServiceCat::find($ServiceCat->service_id)->pic)? 
                                        \App\Model\ServiceCat::find($ServiceCat->service_id)->pic : 
                                        \App\Model\ServiceCat::find( \App\Model\ServiceCat::find($ServiceCat->service_id)->service_id )->pic : $ServiceCat->pic }}" style="height: 40px;width: 40px;border-radius:50%;">
                                        <span class="vm ml-2">{{$ServiceCat->title}}</span> --}}
                                    </h6>
                                </div>
                            </div>
                        </div>
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
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
