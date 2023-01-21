@extends('layouts.admin')
@section('css')
<style>
    .dropdown-menu li a {color: rgba(0, 0, 0, 0.774);}
    .dropdown-menu li:hover {background: #2f665f;}
    .dropdown-menu li:hover a {color: white;}
</style>
@endsection
@section('content')

    <section class="container-fluid">
        <div class="card p-4">
            <form action="{{ route('admin.stock-portfolio.store') }}" method="POST" enctype="multipart/form-data">
                <div class="row" id="fa" role="tabpanel" aria-labelledby="farsi-tab">
                    
                    <input type="hidden" id="cat_id" name="cat_id"  value="{{$id}}" />
                    <div class="col-lg-6 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="form-label">* تایتل فارسی  :</label>
                        <input type="text" class="form-control" id="title" name="title"  value="{{ old('title') }}" />
                    </div>
                    <div class="col-lg-6 form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug" class="form-label">* اسلاگ فارسی  :</label>
                        <input type="text" class="form-control" id="slug" name="slug"  value="{{ old('slug') }}" />
                    </div>
                    <div class="col-lg-9 form-group">
                        <label for="name" class="form-label">* خلاصه فارسی :</label>
                        <input type="text" class="form-control" id="short_text" name="short_text"  value="{{ old('short_text') }}" />
                    </div>
                    <div class="col-lg-3 form-group">
                        <label for="writer" class="form-label">* نام نویسنده  :</label>
                        <input type="text" class="form-control" id="writer" name="writer"  value="{{ old('writer') }}" />
                    </div>
                    <div class="col-12 form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                        <label for="text" class="form-label">* توضیحات فارسی :</label>
                        <textarea class="form-control textarea " id="text" name="text">{{ old('text') }}</textarea>
                    </div>
                    <div class="col-lg form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                        <label for="photo" class="form-label"> تصویر  :</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" value="{{ old('photo') }}"/>
                    </div>
                    <div class="col-lg form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                        <label for="exampleInputFile">اگر ویدیو دارد و میخواهید تغییر دهید</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="video" accept=".mp4">
                                <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12"></div>

                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">عنوان لینک فایل الحاقی</label>
                        <input type="text" class="form-control" id="file_title" name="file_title"/>
                    </div>
                    <div class="col-lg form-group">
                        <label for="exampleInputFile">اگر فایل الحاقی دارد و میخواهید تغییر دهید</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="file" accept=".pdf">
                                <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل (.pdf *)</label>
                            </div>
                        </div>
                    </div>
    
                </div>
    
                <div class="form-group">
                    {{ csrf_field() }}
                    <a href="{{ URL::previous() }}" class="btn btn-secondary mb-0"><i class="fa fa-remove mx-2"></i>انصراف</a>
                    <button type="submit" class="btn btn-success mx-3"><i class="fa fa-check mx-2"></i>ثبت شود</button>
                </div>
            </form>
        </div>
    </section>
    
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