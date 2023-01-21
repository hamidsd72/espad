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
                            @role('مدیر')
                                {{ Form::model($item,array('route' => array('admin.forms.update', $item->id), 'method' => 'PATCH', 'files' => true)) }}
                            @endrole
                            <div class="row mb-0">
                                <h2 class="col-12 mb-4">شرح فرم</h2>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>نوع درخواست</h6>
                                        @if ($item->type=='consultation')
                                            مشاوره
                                        @elseif($item->type=='job')
                                            استخدام
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>نام آیتم</h6>
                                        {{$item->item()?$item->item()->title:'__________'}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>نوع فرم</h6>
                                        {{$item->title?$item->title:'__________'}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>نام مشاور</h6>
                                        {{$item->consultation()?$item->consultation()->first_name.' '.$item->consultation()->last_name:'__________'}}
                                    </div>
                                </div>
                                <h2 class="col-12 mb-4">جزييات</h2>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>نام ونام خاتوادگی</h6>
                                        {{$item->name}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>شماره شناسه ملی</h6>
                                        {{$item->uuid?$item->uuid:'__________'}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>شماره تماس</h6>
                                        {{$item->mobile}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                        <h6>شناسه ملی</h6>
                                        {{$item->code?$item->code:'__________'}}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h6>شرح درخواست</h6>
                                        {{$item->text}}
                                    </div>
                                </div>
                                @if ($item->attach)
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <a href="/{{$item->attach}}">
                                                <h6>نمایش فایل پیوست</h6>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @role('مدیر')
                                @if ($item->type=='consultation')
                                    <a href="{{route('admin.forms.show', 'consultation')}}" class="btn btn-secondary mb-0">بازگشت</a>
                                @elseif($item->type=='job')
                                    <a href="{{route('admin.forms.show', 'job')}}" class="btn btn-secondary mb-0">بازگشت</a>
                                @elseif($item->type=='contact')
                                    <a href="{{route('admin.forms.show', 'contact')}}" class="btn btn-secondary mb-0">بازگشت</a>
                                @endif
                                @if ($item->status=='pending')
                                    <div class="float-left">
                                        <a href="#" type="button" class="btn btn-success" data-toggle="modal" data-target="#sendNotification">
                                            پاسخ دادن
                                        </a>
                                    </div>
                                    {{ Form::button('فرم بررسی شد', array('type' => 'submit', 'class' => 'btn btn-info mr-2')) }}
                                @endif
                                {{ Form::close() }}
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="sendNotification">
        <div class="modal-dialog">
            <div class="modal-content">
                {{ Form::open(array('route' => 'admin.notification.store', 'method' => 'POST', 'files' => true)) }}
                                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">ارسال پاسخ به کاربر</h4>
                    </div>
            
                    <!-- Modal body -->
                    <div class="modal-body">
                        
                        {{Form::hidden('type', 'single', array())}}
                        {{Form::hidden('user_id', $mobile, array())}}

                        <div class="form-group">
                            {{Form::label('subject', ' عنوان اعلان *')}}
                            {{Form::text('subject', null, array('class' => 'form-control','required'))}}
                        </div>
                        
                        <div class="form-group">
                            {{Form::label('description', ' توضیحات اعلان *')}}
                            {{Form::textarea('description', null, array('class' => 'form-control','required'))}}
                        </div>

                        <div class="form-group">
                            {{Form::label('file', 'پیوست')}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="attach" name="attach">
                                    <label class="custom-file-label" dir="ltr" for="exampleInputFile">انتخاب فایل</label>
                                </div>
                            </div>
                            <p class="text-danger">_<small>حداکثر سایز هر پیوست 10Mb می باشد</small></p>
                        </div>

                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mx-3" data-dismiss="modal">انصراف</button>
                        {{ Form::button('ارسال اعلان', array('type' => 'submit', 'class' => 'btn btn-success')) }}
                    </div>
                    
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection

