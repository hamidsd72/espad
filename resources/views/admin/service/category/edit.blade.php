@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            {{ Form::model($item,array('route' => array('admin.service.category.update', $item->id), 'method' => 'POST', 'files' => true)) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('title', '* نام') }}
                                        {{ Form::text('title',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('slug', '* نامک') }}
                                        {{ Form::text('slug',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('bg_color', 'رنگ بک گراند') }}
                                        {{ Form::color('bg_color',null, array('class' => 'w-100 d-block')) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('bg_color_hover', 'رنگ بک گراند(هاور)') }}
                                        {{ Form::color('bg_color_hover',null, array('class' => 'w-100 d-block')) }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('text_color', 'رنگ متن') }}
                                        {{ Form::color('text_color',null, array('class' => 'w-100 d-block')) }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('view', 'محل نمایش') }}
                                        <select class="form-control" name="view">
                                            <option value="header" @if ($item->view=="header") selected @endif>نوبار دوم</option>
                                            <option value="body" @if ($item->view=="body") selected @endif>۶ آیتم</option>
                                            <option value="both" @if ($item->view=="both") selected @endif>هردو</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('view_mod', ' قالب نمایش') }}
                                        <select class="form-control" name="view_mod">
                                            <option value="sample" @if ($item->view=="sample") selected @endif>قالب شیشه ای (قدیم)</option>
                                            <option value="new" @if ($item->view=="new") selected @endif>قالب سرمه ای (جدید)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <label for="exampleInputFile">تصویر کارت</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="pic" accept=".jpeg,.jpg,.png" >
                                            <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                        </div>
                                    </div>
                                    @if($item->pic!=null)
                                        <img src="{{url($item->pic)}}" class="mt-2" height="100">
                                    @endif
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('text', 'توضیحات کوتاه (برای ۶ آیتم الزامی میباشد) ') }}
                                        {{ Form::text('text',null, array('class' => 'form-control')) }}
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{ Form::label('text', 'متن منو دوم (حداکثر 200 کاراکتر)') }}
                                        {{ Form::text('text',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{ Form::label('description', 'توضیحات منو کارت مشاوران (حداکثر 250 کاراکتر)') }}
                                        {{ Form::textarea('description',null, array('class' => 'form-control textarea', 'onkeyup'=>'number_price(this.value)')) }}
                                    </div>
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
                        <!-- /.card-body -->
                    </div><!-- /.card -->
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