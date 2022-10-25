@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <form action="{{ route('admin.sub-item.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{ Form::hidden('page_name', 'پروفایل-دانش-بنیان', array('class' => 'form-control')) }}
                        <div class="col-lg-6">
                            <div class="form-group text-danger">
                                {{ Form::label('service_id', 'نام صفحه ') }}
                                <select name="service_id" class="form-control select2">
                                    @foreach ( \App\Model\Service::where('status','active')->get() as $key => $item)
                                        <option value="{{$item->id}}" @if($key==0) selected @endif>{{$item->title.' - '}}{{$item->category()?$item->category()->title:'________'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group text-danger">
                                {{ Form::label('section', ' محل دقیق حایگذاری داده') }}
                                {{ Form::number('section', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group text-danger">
                                {{ Form::label('sort', ' رتبه بندی نمایش ') }}
                                {{ Form::number('sort', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group text-danger">
                                {{ Form::label('status', ' وضعیت نمایش ') }}
                                <select name="status" class="form-control" id="sel1">
                                    <option value="active" selected>در حال نمایش</option>
                                    <option value="pending">نمایش غیرفعال است</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                {{ Form::label('title', ' تایتل') }}
                                {{ Form::text('title', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label for="exampleInputFile">اگر تصویر دارد و میخواهید تغییر دهید</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="pic" accept=".jpg,.png">
                                    <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label for="exampleInputFile">اگر ویدیو دارد و میخواهید تغییر دهید</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="video">
                                    <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {{ Form::label('link', ' اگر لینک دارد وارد کنید (بدون آدرس پایه)') }}
                                {{ Form::text('link', null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                {{ Form::label('text', ' توضیحات (نمایش بصورت کد ایمن)') }}
                                {{ Form::textarea('text', null, array('class' => 'form-control', 'onkeyup'=>'number_price(this.value)')) }}
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            {{ Form::button('ثبت', array('type' => 'submit', 'class' => 'btn btn-success ')) }}
                        </div>
                    </div>
                </form>
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