@extends('layouts.layout_first_page')
@section('content')
<style>
    a.hover-orange:hover h4 {
        color: #ffa06a;
    }
    .p-ln-24 p {
        line-height: 24px;
        text-align: justify;
    }
    .head-2 a {
        font-size: 16px;
        color: black
    }
    @media all and (min-width: 992px) {
        .head-2 a {
            font-weight: bold;
            font-size: 24px;
        }
    }
</style>

<section class="about">
    <div class="consultation">
            
        <div class="container pb-4">
            <div class="body p-4">
                
                @foreach ($items as $item)
                    <div class="d-none">{{$status='online'}}</div>
                    @include('user.consultation.profile.index')
                @endforeach

                @foreach ($items2 as $item)
                    <div class="d-none">{{$status='offline'}}</div>
                    @include('user.consultation.profile.index')
                @endforeach

            </div>
        </div>

    </div>
</section>

@if (auth()->user())
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
@endif

@endsection
