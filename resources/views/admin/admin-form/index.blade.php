@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row"> 
                    <div class="col-12">
                        <div class="card res_table">
                            <div class="card-header">
                                <h3 class="card-title float-right">{{$title2}}</h3>
                            </div>
                            <div class="card-body res_table_in">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>درخواست</th>
                                        <th>آیتم</th>
                                        @if ($items[0]->type=='consultation')
                                            <th>نوع فرم</th>
                                        @endif
                                        <th>نام شخص</th>
                                        @if ($items[0]->type=='consultation')
                                            <th>نام مشاور</th>
                                        @endif
                                        <th>وضعیت</th>
                                        <th>نمایش جزييات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($items)>0)
                                    @foreach($items as $index=>$item)
                                    <tr>
                                        <td>
                                            @if ($item->type=='consultation')
                                                مشاوره
                                            @elseif($item->type=='job')
                                                استخدام
                                            @elseif($item->type=='contact')
                                                ارتباط با ما
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->type=='consultation')
                                                {{$item->item()?$item->item()->title:'__________'}}
                                            @elseif($item->type=='job')
                                                {{$item->job()?$item->job()->title:'__________'}}
                                            @elseif($item->type=='contact')
                                                {{$item->title?$item->title:'__________'}}
                                            @endif
                                        </td>
                                        @if ($item->type=='consultation')
                                            <td>{{$item->title}}</td>
                                        @endif
                                        <td>{{$item->user()?$item->user()->first_name.' '.$item->user()->last_name:'__________'}}</td>
                                        @if ($item->type=='consultation')
                                            <td>{{$item->consultation()?$item->consultation()->first_name.' '.$item->consultation()->last_name:'__________'}}</td>
                                        @endif
                                        <td class="{{$item->status=='pending'?'text-warning':'text-success'}}">{{$item->status=='pending'?'در انتظار پاسخ':'بررسی شده'}}</td>
                                        <td>
                                            <div class="d-flex">
                                                @role('مدیر')
                                                    @if ($item->status=='pending')
                                                            {{ Form::model($item,array('route' => array('admin.forms.update', $item->id), 'method' => 'PATCH', 'files' => true)) }}
                                                            {{ Form::button('بررسی شد', array('type' => 'submit', 'class' => 'btn btn-success py-0')) }}
                                                            {{ Form::close() }}
                                                    @else
                                                        __________
                                                    @endif
                                                @endrole
                                                <a href="{{route('admin.forms.edit',$item->id)}}" class="btn btn-primary py-0 mx-3">جزييات</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="pag_ul">
                            {{ $items->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </section>

@endsection
@section('js')
<script>
    function active_row(id,type) {
        if(type=='pending')
        {
            var text_user=' نمایش غیرفعال می شود';
        }
        if(type=='active')
        {
            var text_user=' نمایش فعال می شود';
        }
        Swal.fire({
            title: text_user ,
            text: 'برای تغییر وضعیت مطمئن هستید؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{url('/')}}/admin/service-active/'+id+'/'+type;
            }
        })
    }
</script>
@endsection
