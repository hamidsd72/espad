@extends('layouts.admin')
@section('css')
@endsection
@section('content')

    <section class="container-fluid">
        <div class="card p-4">
            <form action="{{ route('admin.stock-portfolio-categories.update',$item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="row" id="fa" role="tabpanel" aria-labelledby="farsi-tab">
    
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">* تایتل فارسی  :</label>
                        <input type="text" class="form-control" id="title" name="title"  value="{{ $item->title }}" required/>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="name" class="form-label">* اسلاگ فارسی  :</label>
                        <input type="text" class="form-control" id="slug" name="slug"  value="{{ $item->slug }}" required/>
                    </div>
                    <div class="col-lg-3 form-group">
                        <label for="status" class="form-label">وضعیت  :</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" {{$item->status=='active'?'selected':''}}>فعال‍</option>
                            <option value="pending" {{$item->status=='pending'?'selected':''}}>غیرفعال</option>
                        </select>
                    </div>
                    {{-- <div class="col-12 form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                        <label for="text" class="form-label">* توضیحات فارسی :</label>
                        <textarea class="form-control textarea " id="text" name="text">{{ old('text') }}</textarea>
                    </div> --}}
                </div>
    
                <div class="form-group">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <a href="{{ URL::previous() }}" class="btn btn-secondary mb-0"><i class="fa fa-remove mx-2"></i>انصراف</a>
                    <button type="submit" class="btn btn-success mx-3"><i class="fa fa-check mx-2"></i>ویرایش شود</button>
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
