@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <section class="content">
        <div class="d-none">{{$sec=1}}</div>
        @foreach ($cats as $cat)
            <div class="row my-lg-5">
            <h4 class="col-12 py-2">سکشن شماره {{$cat->section}}</h4>
                @foreach ($items as $item)
                    
                    @if ($item->section==$cat->section)
                        <div class="col-lg @if( $items->where('section',$cat->section)->count()>3 ) col-lg-4 @endif">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    {{ Form::model($item,array('route' => array('admin.data.update', $item->id), 'method' => 'PATCH', 'files' => true)) }}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group text-danger">
                                                    {{ Form::label('section', ' محل دقیق حایگذاری داده') }}
                                                    {{ Form::number('section',$item->section, array('class' => 'form-control')) }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group text-danger">
                                                    {{ Form::label('sort', ' رتبه بندی نمایش ') }}
                                                    {{ Form::number('sort',$item->sort, array('class' => 'form-control')) }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group text-danger">
                                                    {{ Form::label('status', ' وضعیت نمایش ') }}
                                                    <select name="status" class="form-control" id="sel1">
                                                        <option value="active" @if($item->status=='active') selected @endif>در حال نمایش</option>
                                                        <option value="pending" @if($item->status=='pending') selected @endif>نمایش غیرفعال است</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{ Form::label('title', ' تایتل') }}
                                                    {{ Form::text('title',$item->title, array('class' => 'form-control')) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputFile">اگر تصویر دارد و میخواهید تغییر دهید</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="pic" accept=".jpg,.png">
                                                        <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                                    </div>
                                                </div>
                                                @if($item->pic)
                                                    <img src="{{url($item->pic)}}" alt="تصویر یافت نشد" class="pt-2" height="100">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputFile">اگر ویدیو دارد و میخواهید تغییر دهید</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="video">
                                                        <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                                    </div>
                                                </div>
                                                @if($item->video)
                                                    <a href="{{url($item->video)}}" target="_black">مشاهده فایل در صفحه ای دیگر</a>
                                                @endif
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    {{ Form::label('link', ' اگر لینک دارد وارد کنید (بدون آدرس پایه)') }}
                                                    {{ Form::text('link',$item->link, array('class' => 'form-control')) }}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    {{ Form::label('text', ' توضیحات (نمایش بصورت کد ایمن)') }}
                                                    {{ Form::textarea('text',$item->text, array('class' => 'form-control textarea', 'onkeyup'=>'number_price(this.value)')) }}
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                {{ Form::button('ویرایش', array('type' => 'submit', 'class' => 'btn btn-success ')) }}
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                @endforeach
            </div>
        @endforeach
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