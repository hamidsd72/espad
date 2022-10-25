@extends('layouts.admin')
@section('css')
<style>
    #description-text , #exampleInputFileBox {
        display: none;
    }
</style>
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- @if ($type=='مشاوره خصوصی') --}}
                        @include('admin.service.form')
                    {{-- @elseif($type=='وبینارها')
                        @include('admin.service.form2')
                    @elseif($type=='عریضه نویسی')
                        @include('admin.service.form3')
                    @elseif($type=='عقد قرارداد')
                        @include('admin.service.form4')
                    @elseif($type=='استعدادیابی')
                        @include('admin.service.form4')
                    @endif --}}
                </div>
            </div>
        </div>
    </section> 
@endsection
@section('js')
    <script>
        function changeInput() {
            let category = document.getElementById("category_id").value;
            if (category=='52' || category=='53' || category=='163') {
                document.getElementById("description-text").style.display = "block";
            } else if (category=='345' || category=='66') {
                document.getElementById("exampleInputFileBox").style.display = "block";
            } else  {
                document.getElementById("description-text").style.display = "none";
            }
        }
    </script>
    <script src="{{ asset('editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        var textareaOptions = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'fa'
        };
        $('.textarea').ckeditor(textareaOptions);
        slug('#title', '#slug');
        function number_price(a){
            $('#pp_price').text(a);
            $('#pp_price_1').text(a);
            $('#pp_price').text(function (e, n) {
                var lir1= n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return lir1;
            })
        }
        $(document).ready(function () {
            var a=$('#price').val();
            $('#pp_price').text(a);
            $('#pp_price_1').text(a);
            $('#pp_price').text(function (e, n) {
                var lir1= n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return lir1;
            })
        });
    </script>
@endsection
