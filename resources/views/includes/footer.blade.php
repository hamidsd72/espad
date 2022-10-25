<footer class="footer mt-auto pb-0 pt-2 text-center">
    <div class="container">
        <div class="row mb-0">
            
            <div class="col-auto text-dark">{{\App\Model\Setting::first()?\App\Model\Setting::first()->title:''}}</div>
            <div class="col">
                @foreach ($network as $net)
                    @if ($net->config=="email")
                        <a href="#" onclick='sedarMail("{{$net->address}}")' class="box mx-2 text-dark">
                            <i class="fas fa-envelope" style="font-size: 20px;"></i>
                        </a>
                    @else
                        <a href="{{$net->address}}" class="box mx-2">
                            <i class="fab fa-{{$net->config}}" style="font-size: 20px;"></i>
                        </a>
                    @endif
                @endforeach
            </div>
            
        </div>

            
        @foreach ($joins->where('join_title','آدرس اول') as $item)
            <div class="d-flex">
                {!! $item->join_text !!}
            </div>
        @endforeach
        <div class="float-end">
            @foreach ($joins->where('join_title','تلفن') as $item)
                <div class="d-flex">
                    {!! $item->join_text !!}
                </div>
            @endforeach
        </div>
        @foreach ($joins->where('join_title','آدرس دوم') as $item)
            <div class="d-flex">
                {!! $item->join_text !!}
            </div>
        @endforeach

    </div>
    <div class="container text-center mt-2">
        <span class="text-secondary">All rights reserved by AdibGroup 2022</span>
    </div>
</footer>

<script>
    function sedarMail(mail) {
        location.href = "mailto:"+mail;
    }
</script>