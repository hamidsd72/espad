@extends('layouts.admin')
@section('css')

@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card res_table">
                        <div class="card-header pb-0">
                            <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#filter">
                                @if(isset($category_id)) گروه {{App\Model\ServiceCat::where('id',$category_id)->first()->title}} @else فیلتر کردن گروه ها @endif
                            </button>
                            <a href="{{route('admin.sub_service.create')}}" class="float-left btn btn-info"><i class="fa fa-circle-o mtp-1 ml-1"></i>افزودن</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body res_table_in">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>دسته اصلی</th>
                                    <th>عنوان</th>
                                    <th>تعداد آیتم</th>
                                    <th>ترتیب</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($items)>0)
                                @foreach($items as $item)
                                <tr>
                                    <td>@item($item->head_service()?$item->head_service()->title:'_________')</td>
                                    <td>@item($item->title)</td>
                                    <td>@item(count($item->service))</td>
                                    <td class="vertical-align-middle text-center" width="100">
                                        <form action="{{route('admin.service.category.sort')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <input type="number" min="0" name="sort" class="form-control text-center" onchange="this.form.submit()" value="{{$item->sort}}">
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.sub_service.edit',$item->id)}}" class="badge bg-primary ml-1" title="ویرایش"><i class="fa fa-edit"></i> </a>
                                        <a href="javascript:void(0);" onclick="del_row('{{$item->id}}')" class="badge bg-danger ml-1" title="حذف"><i class="fa fa-trash"></i> </a>
                                        @if($item->status=='active')
                                            <a href="javascript:void(0);" onclick="active_row('{{$item->id}}','pending')" class="badge bg-success ml-1" title="نمایش فعال است غیرفعال شود؟"><i class="fa fa-check"></i> </a>
                                        @endif
                                        @if($item->status=='pending')
                                            <a href="javascript:void(0);" onclick="active_row('{{$item->id}}','active')" class="badge bg-warning ml-1" title="نمایش غیر فعال است فعال شود؟"><i class="fa fa-close"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">موردی یافت نشد</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="pag_ul">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filterLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">فیلتر بر اساس گروه های ایجاد شده</h5>
                </div>
                <div class="modal-body">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(isset($category_id)) گروه {{App\Model\ServiceCat::where('id',$category_id)->first()->title}} @else فیلتر کردن گروه ها @endif
                            
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($ServiceCats as $ServiceCat)
                                <li style="padding: 6px;"><a class="text-dark" href="{{route('admin.sub_service.filter',$ServiceCat->id )}}" title="Courses">{{$ServiceCat->title}}</a></li>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    </div>

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
                location.href = '{{url('/')}}/admin/sub_service/active/'+id+'/'+type;
            }
        })
    }
    function del_row(id) {
        Swal.fire({
            text: 'برای حذف مطمئن هستید؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{url('/')}}/admin/sub_service/destroy/'+id;
            }
        })
    }
</script>
@endsection