@extends('layouts.admin')
@section('css')
<style>
    .dropdown-menu li a {
        color: rgba(0, 0, 0, 0.774);
    }
    .dropdown-menu li:hover {
        background: #2f665f;
    }
    .dropdown-menu li:hover a {
        color: white;
    }
</style>
@endsection
@section('content')

    <div class="col-12 m-lg-4">
        <div class="card p-4">
            <form action="{{ route('admin.post.update',$item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="row" id="fa" role="tabpanel" aria-labelledby="farsi-tab">
    
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">* تایتل فارسی  :</label>
                        <input type="text" class="form-control" id="title" name="title"  value="{{ $item->title }}" />
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">* اسلاگ فارسی  :</label>
                        <input type="text" class="form-control" id="slug" name="slug"  value="{{ $item->slug }}" />
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">* خلاصه فارسی :</label>
                        <input type="text" class="form-control" id="short_text" name="short_text"  value="{{ $item->short_text }}" />
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label"> عنوان سئو فارسی  :</label>
                        <input type="text" class="form-control" id="titleseo" name="titleseo" value="{{ $item->titleseo }}" />
                    </div>
                    <div class="col-12 form-group">
                        <label for="name" class="form-label">* توضیحات فارسی :</label>
                        <textarea class="form-control textarea " id="text" name="text">{{ $item->text }}</textarea>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label"> کلمه کلیدی سئو فارسی(با دقت وارد شود،برای انتخاب مقالات مشابه)  :</label>
                        <input type="text" class="form-control key_word" id="keywordsseo" name="keywordsseo" value="{{ $item->keywordsseo }}" />
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label"> توضیحات سئو فارسی  :</label>
                        <input type="text" class="form-control " id="descriptionseo" name="descriptionseo" value="{{ $item->descriptionseo }}"/>
                    </div>
                    <div class="col-lg form-group">
                        <label for="photo" class="form-label">* تصویر  :</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" />
                    </div>
                    @if ($item->photo)
                        <div class="col-lg form-group my-auto">
                            <img src="{{ url($item->photo) }}" alt="{{ $item->title }}" width="100px">
                        </div>
                    @endif
                </div>
    
                <div class="form-group">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <a href="{{ URL::previous() }}" class="btn btn-secondary mb-0"><i class="fa fa-remove mx-2"></i>انصراف</a>
                    <button type="submit" class="btn btn-success mx-3"><i class="fa fa-check mx-2"></i>ویرایش شود</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@section('js')
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
        