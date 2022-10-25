@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <style>
        .radius20 {
            border-radius: 20px;
        }
    </style>
    <section class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="card res_table" style="background: transparent;">
                    <div class="card-header">
                        <h3 class="card-title float-right mt-2">{{$title2}}</h3>
                    </div>
                    <div class="radius20 bg-white card-body res_table_in mx-3 my-1 p-3">
                        <h6>{{' عنوان : '.$item->subject}}</h6>
                        <p class="my-3">{{' محتوا : '.$item->description}}</p>
                        @if ($item->atach)
                            <a href="{{url('/').'/'.$item->atach}}" 
                            class="float-right bg-highlight text-uppercase font-900 btn-s btn-full rounded-sm shadow-xl" target="_blank">نمایش فایل پیوست شده</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
