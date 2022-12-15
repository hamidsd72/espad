
<style>
    .consultation {
        background: white;
    }
    .text-blue {
        color: #00788D;
    }
    .blue-orange p {
        margin-bottom: 4px;
    }
    .blue-orange:hover {
        color: #0a58ca !important;
    }
    .about .list-item2 img {
        width: 100%;
        height: 90px;
    }
    .about .list-item2 img.avatar {
        width: 48px;
        height: 48px;
        border-radius: 50px;
    }
    .about .top-consultation , .about .top-consultation .box {
        max-height: 276px;
    }
    .about .top-consultation img {
        width: 100%;
        height: 276px;
    }
    .app_name {
        color: #7c93ff
    }
    .about .top-consultation .background-layer {
        position: relative;
        height: 276px;
        top: -276px;
        background: #303642cc;
    }
    .about .top-consultation .background-layer-after {
        position: relative;
        height: 276px;
        width: 0px;
        top: -552px;
        background: #303642;
    }
    .about .top-consultation:hover .background-layer-after {
        width: 100%;
        transition: 1s;
    }
    .about .top-consultation:hover .app_name {
        color: transparent;
    }
    .about .top-consultation .data {
        position: relative;
        top: -820px;
    }
    .about .top-consultation .data .description {
        display: none;
    }
    .about .top-consultation:hover .data {
        top: -774px;
        transition: 1s;
    }
    .about .top-consultation:hover .description {
        display: unset;
        transition: 1s;
    }
    .about .top-consultation button {
        position: relative;
        top: -60px;
        width: 60px;
        height: 60px;
        border: none;
    }
    .about .top-consultation button .after {
        display: none;
    }
    .about .top-consultation:hover .before {
        display: none;
        transition: 1s;
    }
    .about .top-consultation:hover .after {
        display: unset;
        transition: 1s;
    }
    .about .top-consultation:hover .description p {
        text-align: center;
    }
    img.h-unset {
        height: unset !important;
    }
</style>

@if ($body??'')
    
    <div class="about">

        <div class="body bg-white">
            
            <div class="card mb-4">
                @foreach ($body->where('section',4) as $item)
                    <div class="card-header text-center p-4">
                        <a href="{{ $item->link?url($item->link):'' }}" class="text-blue h4 text-center">{{$item->title}}</a>
                    </div>
                @endforeach
                <div class="card-body row">
                    @foreach ($body->where('section',5) as $item)
                        <div class="col-lg-4 col-md-6 p-4 text-center">
                            <a href="{{ $item->link?url($item->link):'' }}" class="text-dark-violet h5 blue-orange fw-light">{{$item->title}}</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="p-4">
                @foreach ($body->where('section',6) as $item)
                    <h4 class="text-blue">{{$item->title}}</h4>
                @endforeach
                <div class="row">
                    @foreach ($body->where('section',7) as $item)
                        <div class="col-lg-6 text-center">

                            <div class="row list-item2 py-4">

                                <div class="col-lg-3 p-0">
                                    <img src="{{ $item->pic?url($item->pic):'' }}" alt="banner">
                                </div>

                                <div class="col">
                                    <a href="{{ $item->link?url($item->link):'' }}" class="blue-orange">
                                        <h5 class="text-dark fw-light blue-orange">
                                            {{$item->title}}
                                        </h5>
                                        <div class="mb-1 text-secondary blue-orange">
                                            {!! $item->text !!}
                                        </div>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

@endif