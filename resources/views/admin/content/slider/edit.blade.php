@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            {{ Form::model($item,array('route' => array('admin.slider.update', $item->id), 'method' => 'POST', 'files' => true)) }}
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        {{ Form::label('status', '* محل نمایش') }}
                                        <select id="status" name="status" onchange="changeInput()" class="form-control">
                                            <option value="in_app" @if($item->status=='in_app') selected @endif>اسلابدر اپلیکیشن</option>
                                            <option value="in_home" @if($item->status=='in_home') selected @endif>اسلابدر صفحه اصلی</option>
                                            <option value="in_all" @if($item->status=='in_all') selected @endif>همه صفحات</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        {{ Form::label('title', '* عنوان') }}
                                        {{ Form::text('title',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-12"></div>
                                <div id="description" class="col-12 @if($item->status=='in_app') d-none @endif">
                                    <div class="form-group">
                                        {{ Form::label('description', 'متن پایین عنوان') }}
                                        {{ Form::text('description',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-12"></div>
                                <div id="link_title" class="col-lg @if($item->status=='in_app') d-none @endif">
                                    <div class="form-group">
                                        {{ Form::label('link_title', 'عنوان لینک') }}
                                        {{ Form::text('link_title',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        {{ Form::label('link', 'لینک') }}
                                        {{ Form::url('link',null, array('class' => 'form-control text-left dir-ltr','placeholder'=>'http://sedarcard.com')) }}
                                    </div>
                                </div>
                                <div class="col-lg mb-2">
                                    <label for="exampleInputFile">* تصویر(300*1200)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" accept=".jpeg,.jpg,.png">
                                            <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12"></div>
                                <div class="offset-lg-6 col-lg-6 mb-2">
                                    @if($item->photo)
                                        <img class="w-100 obj-contain" src="{{url($item->photo->path)}}" height="150">
                                    @endif
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    {{ Form::button('ویرایش', array('type' => 'submit', 'class' => 'btn btn-success col-12')) }}
                                </div>
                                <div class="col">
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary col-12">بازگشت</a>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{ asset('editor/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('editor/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        function changeInput() {
            if (document.getElementById("status").value=='in_app') {
                document.getElementById("description").classList.add("d-none");
                document.getElementById("link_title").classList.add("d-none");
            } else {
                document.getElementById("description").classList.remove("d-none");
                document.getElementById("link_title").classList.remove("d-none");
            }
        }
    </script>
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