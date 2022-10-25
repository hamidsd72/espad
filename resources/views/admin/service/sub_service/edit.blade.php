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
                            {{ Form::model($item,array('route' => array('admin.sub_service.update', $item->id), 'method' => 'PATCH', 'files' => true)) }}
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('service_id', '* نام دسته اصلی') }}
                                        <select id="service_id" name="service_id" class="form-control select2">
                                            @foreach ($items as $cat)
                                                <option value="{{$cat->id}}" @if($cat->id==$item->service_id) selected @endif >{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('group_id', '* دسته بندی آیتم های اوراق بهادار') }}
                                        <select id="group_id" name="group_id" class="form-control select2">
                                            @foreach (\App\Model\Group::all() as $group)
                                                <option value="{{$group->id}}" @if($item->group_id==$group->id) selected @endif >{{$group->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('title', '* نام') }}
                                        {{ Form::text('title',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('slug', '* نامک') }}
                                        {{ Form::text('slug',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('sub_text1', 'متن خط اول, لینک (با ویرگول جدا کنید) ') }}
                                        {{ Form::text('sub_text1',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('sub_text2', 'متن خط دوم, لینک (با ویرگول جدا کنید) ') }}
                                        {{ Form::text('sub_text2',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('sub_text3', 'متن خط سوم, لینک (با ویرگول جدا کنید) ') }}
                                        {{ Form::text('sub_text3',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('tsub_ext4', 'متن خط چهارم, لینک (با ویرگول جدا کنید) ') }}
                                        {{ Form::text('sub_text4',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
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