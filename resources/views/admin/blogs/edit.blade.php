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
                    <div class="col-lg form-group">
                        <label for="name" class="form-label"> خلاصه فارسی :</label>
                        <input type="text" class="form-control" id="short_text" name="short_text"  value="{{ $item->short_text }}" />
                    </div>
                    @unless ($item->type=='سبد-سهام')
                        <div class="col-lg-6 form-group">
                            <label for="name" class="form-label"> عنوان سئو فارسی  :</label>
                            <input type="text" class="form-control" id="titleseo" name="titleseo" value="{{ $item->titleseo }}" />
                        </div>
                    @endunless
                    <div class="col-12 form-group">
                        <label for="name" class="form-label">* توضیحات فارسی :</label>
                        <textarea class="form-control textarea " id="text" name="text">{{ $item->text }}</textarea>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="writer" class="form-label">* نام نویسنده  :</label>
                        <input type="text" class="form-control" id="writer" name="writer"  value="{{ $item->writer }}" />
                    </div>
                    @unless ($item->type=='سبد-سهام')
                        <div class="col-lg-6 form-group">
                            <label for="name" class="form-label"> کلمه کلیدی سئو فارسی(با دقت وارد شود،برای انتخاب مقالات مشابه)  :</label>
                            <input type="text" class="form-control key_word" id="keywordsseo" name="keywordsseo" value="{{ $item->keywordsseo }}" />
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="name" class="form-label"> توضیحات سئو فارسی  :</label>
                            <input type="text" class="form-control " id="descriptionseo" name="descriptionseo" value="{{ $item->descriptionseo }}"/>
                        </div>
                    @endunless
                    <div class="col-lg form-group">
                        <label for="photo" class="form-label"> تصویر  :</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" />
                        @if ($item->photo)
                            <div class="my-1">
                                <img src="{{ url($item->photo) }}" alt="{{ $item->title }}" height="80px">
                            </div>
                        @endif
                    </div>
                    <div class="col-lg form-group">
                        <label for="exampleInputFile">اگر ویدیو دارد و میخواهید تغییر دهید</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="video" accept=".mp4">
                                <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                            </div>
                            @if($item->video)
                                <a href="{{url($item->video)}}" target="_black">مشاهده فایل در صفحه ای دیگر</a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-12"></div>

                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">عنوان لینک فایل الحاقی</label>
                        <input type="text" class="form-control" id="file_title" name="file_title"  value="{{ $item->file_title }}" />
                    </div>
                    <div class="col-lg form-group">
                        <label for="exampleInputFile">اگر فایل الحاقی دارد و میخواهید تغییر دهید</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="file" accept=".pdf">
                                <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل (.pdf *)</label>
                            </div>
                            @if($item->file)
                                <a href="{{url($item->file)}}" target="_black">مشاهده فایل در صفحه ای دیگر</a>
                            @endif
                        </div>
                    </div>

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
