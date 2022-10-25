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
                            {{ Form::model($item,array('route' => array('admin.off.update', $item->id), 'method' => 'POST', 'files' => true)) }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('user_id', 'مورد استفاده کاربران') }}
                                        <select name="user_id" class="form-control user_selected_off select2">
                                            <option value="0">همه کاربران</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{old('user_id',$item->user_id)==$user->id?'selected':''}}>{{$user->first_name.' '.$user->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('item_id', 'نام پکیج را وارد کنید') }}
                                        <select name="item_id" class="form-control select2">
                                            @foreach($packages as $key => $val)
                                                <option value="{{$val->id}}" {{$item->item_id==$val->id?'selected':''}}>{{$val->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('title', '* عنوان') }}
                                        {{ Form::text('title',null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('code', '* کد تخفیف') }}
                                        {{ Form::text('code',null, array('class' => 'form-control text-left dir-ltr','placeholder'=>'بین 5 تا 10 کاراکتر')) }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('percent', '* درصد تخفیف') }}
                                        {{ Form::number('percent',null, array('class' => 'form-control text-left dir-ltr','placeholder'=>'بین 1 تا 100 ')) }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 inventory_off" @if($item->user_id>0) style="display: none" @endif>
                                    <div class="form-group">
                                        {{ Form::label('inventory', '* تعداد اعتبار') }}
                                        {{ Form::number('inventory',null, array('class' => 'form-control text-left dir-ltr','placeholder'=>'حداقل 1 عدد ')) }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('expiry_date', '* تاریخ انقضا') }}
                                        {{ Form::text('expiry_date',null, array('class' => 'form-control date_p')) }}
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
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $('.date_p').persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            altField: '.observer-example-alt',
            initialValue:false,
        });
    </script>
@endsection