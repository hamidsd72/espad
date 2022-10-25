<script type="text/javascript" src="{{ asset('assets/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/new/jquery.cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/new/swiper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/new/nouislider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/new/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/new/color-scheme-demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/new/pwa-services.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
<script>
    "use strict"
    $(window).on('load', function() {

        /* range picker for filter */
        var html5Slider = document.getElementById('rangeslider');
        noUiSlider.create(html5Slider, {
            start: [0, 100],
            connect: true,
            range: {
                'min': 0,
                'max': 500
            }
        });

        var inputNumber = document.getElementById('input-number');
        var select = document.getElementById('input-select');

        html5Slider.noUiSlider.on('update', function(values, handle) {
            var value = values[handle];

            if (handle) {
                inputNumber.value = value;
            } else {
                select.value = Math.round(value);
            }
        });
        select.addEventListener('change', function() {
            html5Slider.noUiSlider.set([this.value, null]);
        });
        inputNumber.addEventListener('change', function() {
            html5Slider.noUiSlider.set([null, this.value]);
        });


        /* carousel */
        var swiper = new Swiper('.swiper-products', {
            slidesPerView: 'auto',
            spaceBetween: 0,
            pagination: 'false'
        });

    });
</script>
<script>
    @if(session()->has('err_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            text: "{{ session('err_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if(session()->has('err_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            text: "{{ session('err_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if(session()->has('flash_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "موفق",
            text: "{{ session('flash_message') }}",
            icon: "success",
            timer: 6000,
            timerProgressBar: true,
        })
    })
    ;@endif
    @if(session()->has('call_message'))
    $(document).ready(function () {
        Swal.fire({
            title: "",
            text: "{{ session('call_message') }}",
            icon: "warning",
            timer: 6000,
            timerProgressBar: true,
        })
    });
    @endif
    @if (count($errors) > 0)
    $(document).ready(function () {
        Swal.fire({
            title: "ناموفق",
            icon: "warning",
            html:
                    @foreach ($errors->all() as $key => $error)
                            '<p class="text-right mt-2 ml-5" dir="rtl"> {{$key+1}} : '  +
                    '{{ $error }}'+
                    '</p>'+
                    @endforeach
                            '<p class="text-right mt-2 ml-5" dir="rtl">' +
                    '</p>',
            timer:  @if(count($errors)>3)parseInt('{{count($errors)}}') * 1500 @else 6000 @endif,
            timerProgressBar: true,
        })
    });
    @endif

</script>

@yield('js')
