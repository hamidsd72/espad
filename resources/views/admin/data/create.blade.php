@extends('layouts.layout_first_page')
@section('content')
<style>
    .text-{
        text-align: justify;
    }
</style>
<section class="about">
    <div class="container pb-4">

        <h6 class="text-secondary py-4">{{ $title1 }}</h6>

        <div class="body bg-white p-4">
            <h2 class="py-4 row">
                <div class="col-auto p-0 pt-3"><div class="line"></div></div>
                <div class="col-auto p-0">{{ $item->title }}</div>
            </h2>

            <div class="container py-4">
                @if ($item->video)
                    <video controls>
                        <source src="{{url($item->video)}}" type="video/mp4">
                    </video>
                @endif
            </div>

            {!! $item->text !!}
        </div>

    </div>
</section>

@endsection