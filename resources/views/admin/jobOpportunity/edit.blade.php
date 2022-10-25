@extends('layouts.admin')
@section('css')
<style>
    .dropdown-menu li a {
        color: rgba(0, 0, 0, 0.774);
    }
    .dropdown-menu li:hover {
        background: #2f665f;
    }
    .dropdown-menu li:hover a {
        color: white;
    }
</style>
@endsection
@section('content')

    <div class="col-12 m-lg-4">
        <div class="card p-4">
            <form action="{{ route('admin.job-opportunities.update',$item->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="row" id="fa" role="tabpanel" aria-labelledby="farsi-tab">
                    @if ( $item->sub_cat_id>0 )
                        <div class="col-lg-6 form-group">
                            <label for="sub_cat_id" class="form-label">* دسته بندی ها  :</label>
                            <select id="sub_cat_id" name="sub_cat_id" class="form-control select2">
                                @foreach ( \App\Model\JobOpportunity::where('sub_cat_id','==',0)->get(['id','title']) as $cat)
                                    <option value="{{$cat->id}}" {{$item->sub_cat_id==$cat->id?'selected':''}} >{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-lg-6 form-group">
                        <label for="title" class="form-label">* عنوان  :</label>
                        <input type="text" class="form-control" id="title" name="title"  value="{{ $item->title }}"  required/>
                    </div>
                    @if ( $item->sub_cat_id>0 )
                        <div class="col-lg-6 form-group">
                            <label for="history" class="form-label">* سابقه کاری  :</label>
                            <input type="text" class="form-control" id="history" name="history"  value="{{ $item->history }}"  required/>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="education" class="form-label">* مدرک تحصیلی :</label>
                            <input type="text" class="form-control" id="education" name="education"  value="{{ $item->education }}"  required/>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="type" class="form-label"> نوع همکاری  :</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}"  required/>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="amount" class="form-label">* حقوق :</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{ $item->amount }}"  required/>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="address" class="form-label"> آدرس :</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $item->address }}"  required/>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="description" class="form-label"> شرح فعالیت  :</label>
                            <textarea class="form-control textarea " id="description" name="description" required>{{ $item->description }}</textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="attach" class="form-label">* پیوست  :</label>
                            <input type="file" class="form-control" id="attach" name="attach" value="{{ $item->attach }}"/>
                        </div>
                        @if ($item->attach)
                            <div class="col-lg form-group my-auto">
                                <a href="{{$item->attach}}" download="">دانلود فایل</a>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="form-group">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <a href="{{ URL::previous() }}" class="btn btn-secondary mb-0"><i class="fa fa-remove mx-2"></i>انصراف</a>
                    <button type="submit" class="btn btn-success mx-3"><i class="fa fa-check mx-2"></i>ویرایش شود</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@section('js')
<script>
    slug('#title', '#slug');
</script>
@endsection
        