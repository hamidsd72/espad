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
                            {{ Form::model($item,array('route' => array('admin.about.update', $item->id), 'method' => 'POST', 'files' => true)) }}
                                <div class="row">

                                    <div class="col-sm-12">
                                        <h5 class="text-center mb-2 mt-2"> درباره ما صفحه اصلی</h5>
                                        <hr>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {{ Form::label('title_home', '* عنوان درباره ما(صفحه اصلی)') }}
                                            {{ Form::text('title_home',null, array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="exampleInputFile">تصویر درباره ما(صفحه اصلی)</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="pic_home" accept=".jpg,.png">
                                                <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        @if(is_file($item->pic_home))
                                            <img src="{{url('/'.$item->pic_home)}}" class="mt-2" height="100">
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            {{ Form::label('text_home', '* توضیحات درباره ما(صفحه اصلی)') }}
                                            {{ Form::textarea('text_home',null, array('class' => 'form-control textarea')) }}
                                        </div>
                                    </div>

                                    <div class="d-none">
                                        {{ Form::text('title_target',null, array('class' => 'form-control')) }}
                                        {{ Form::textarea('text_target',null, array('class' => 'form-control textarea')) }}
                                        {{ Form::text('title',null, array('class' => 'form-control')) }}
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="pic" accept=".jpg,.png">
                                        @if(is_file($item->pic))
                                        <img src="{{url($item->pic)}}" class="mt-2" height="100">
                                        @endif
                                        {{ Form::textarea('text',null, array('class' => 'form-control textarea')) }}
                                        @if(count($items)>0)
                                            @foreach($items as $val)
                                                {{ Form::text('title_join[]',$val->title, array('class' => 'form-control')) }}
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="pic_join[]" accept=".jpg,.png">
                                                <input name="pic_join1[]" value="{{$val->pic}}" hidden>
                                                {{ Form::textarea('text_join[]',$val->text, array('class' => 'form-control textarea')) }}
                                            @endforeach
                                        @endif
                                    </div>
                                <div class="col-6">
                                    {{ Form::button('ویرایش', array('type' => 'submit', 'class' => 'btn btn-success col-12')) }}
                                </div>
                                <div class="col-6">
                                    <a href="{{ URL::previous() }}" class="btn btn-secondary col-12">بازگشت</a>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        @foreach ($items as $join)
                            <div class="card-body box-profile">
                                <div class="row border">
                                    <div class="col-lg-12">
                                        <h5 class="text-center mb-2 mt-2"> محتوا به درباره ما </h5>
                                        <hr>
                                    </div>
                                    <div class="col-12 p-2 p-lg-3">
                                        {{ Form::model($join,array('route' => array('admin.about-join.update', $join->id), 'method' => 'PATCH', 'id' => 'about-join'.$join->id, 'files' => true)) }}
                                            <div class="row mb-0">
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        {{ Form::text('join_title',$join->join_title, array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="join_pic" accept=".jpg,.png">
                                                            <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                                        </div>
                                                    </div>
                                                    @if(is_file($join->join_pic))
                                                        <img src="{{url('/'.$join->join_pic)}}" class="mt-2" height="100">
                                                    @endif
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        {{ Form::label('join_text', '* توضیحات') }}
                                                        {{ Form::textarea('join_text',$join->join_text, array('class' => 'form-control textarea')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            {{ Form::button('ویرایش این آیتم', array('type' => 'submit', 'class' => 'btn btn-info float-right')) }}
                                        {{ Form::close() }}

                                        {{ Form::model($join,array('route' => array('admin.about-join.destroy', $join->id), 'method' => 'DELETE')) }}
                                            {{ Form::button('حذف این آیتم', array('type' => 'submit', 'class' => 'btn btn-danger float-left')) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="card-body box-profile">
                            {{ Form::model($item,array('route' => array('admin.about-join.store'), 'method' => 'POST', 'files' => true)) }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5 class="text-center mb-2 mt-2"> اضافه کردن محتوا به درباره ما </h5>
                                        <hr>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            {{ Form::label('join_title', '* عنوان') }}
                                            {{ Form::text('join_title',null, array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="exampleInputFile">تصویر</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="join_pic" accept=".jpg,.png">
                                                <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            {{ Form::label('join_text', '* توضیحات') }}
                                            {{ Form::textarea('join_text',null, array('class' => 'form-control textarea')) }}
                                        </div>
                                    </div>
                                    {{ Form::button('الحاق به درباره ما', array('type' => 'submit', 'class' => 'btn btn-success')) }}
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
        var textareaOptions = {
            filebrowserImageBrowseUrl: '{{ url('filemanager?type=Images') }}',
            filebrowserImageUploadUrl: '{{ url('filemanager/upload?type=Images&_token=') }}',
            filebrowserBrowseUrl: '{{ url('filemanager?type=Files') }}',
            filebrowserUploadUrl: '{{ url('filemanager/upload?type=Files&_token=') }}',
            language: 'fa'
        };
        $('.textarea').ckeditor(textareaOptions);

        function del_row(id) {
            Swal.fire({
                text: 'برای حذف مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '{{url('/')}}/admin/about-destroy/'+id;
                }
            })
        }

        $('#add_append').click(function () {
            $('#append').append('<div class="col-sm-12"><hr></div><div class="col-sm-6">\n' +
                '                                    <div class="form-group">\n' +
                '                                        {{ Form::label('title_join', '* عنوان') }}\n' +
                '                                        {{ Form::text('title_join[]',null, array('class' => 'form-control')) }}\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="col-sm-6">\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="col-sm-6">\n' +
                '                                    <label for="exampleInputFile">تصویر</label>\n' +
                '                                    <div class="input-group">\n' +
                '                                            <input type="file" name="pic_join[]" accept=".jpg,.png">\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="col-sm-6">\n' +
                '                                </div>\n' +
                '                                <div class="col-sm-12">\n' +
                '                                    <div class="form-group">\n' +
                '                                        {{ Form::label('text_join', '* توضیحات') }}\n' +
                '                                        {{ Form::textarea('text_join[]',null, array('class' => 'form-control textarea')) }}\n' +
                '                                    </div>\n' +
                '                                </div>')
            $('.textarea').ckeditor(textareaOptions);
        })
    </script>
@endsection