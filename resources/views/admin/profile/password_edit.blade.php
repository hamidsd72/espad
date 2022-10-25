@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-9 m-auto">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-circle"
                                     src="{{$item->photo? url($item->photo->path) :asset('admin/img/user.png')}}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">@item($item->first_name) @item($item->last_name)</h3>
                            <hr>
                            {{ Form::model($item, array('route' => array('admin.password.update', $item->id), 'method' => 'POST','class'=>'container-fluid')) }}
                                <div class="row">
                                    <div class="col-sm-9 m-auto">
                                        <div class="form-group">
                                            {{ Form::label('password', 'رمز عبور') }}
                                            {{ Form::password('password', array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-9 m-auto">
                                        <div class="form-group">
                                            {{ Form::label('password_confirmation', 'تکرار رمز عبور') }}
                                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 mx-auto">
                                    <div class="row">
                                        <div class="col">
                                            {{ Form::button('ویرایش', array('type' => 'submit', 'class' => 'btn btn-info col-12')) }}
                                        </div>
                                        <div class="col">
                                            <a href="{{ URL::previous() }}" class="btn btn-secondary col-12">بازگشت</a>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')

@endsection