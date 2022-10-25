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
                            @if ($id??'')
                                <a href="{{route('admin.item.create.type',$id)}}" class="float-left btn btn-info"><i class="fa fa-circle-o mtp-1 ml-1"></i>افزودن</a>
                            @else
                                <a href="{{route('admin.item.create')}}" class="float-left btn btn-info"><i class="fa fa-circle-o mtp-1 ml-1"></i>افزودن</a>
                            @endif
                        </div>
                        <div class="card-body res_table_in">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>محل آیتم</th>
                                    <th>ترتیب</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if( $items->count() )
                                    @foreach($items as $item)
                                    <tr>
                                        <td>@item($item->title)</td>
                                        <td>@item($item->section)</td>
                                        <td>@item($item->sort)</td>
                                        <td class="text-center">
                                            <a href="{{route('admin.item.edit',$item->id)}}" class="badge bg-primary ml-1" title="ویرایش"><i class="fa fa-edit"></i> </a>
                                            <a href="javascript:void(0);" onclick="del_row('{{$item->id}}')" class="badge bg-danger ml-1" title="حذف"><i class="fa fa-trash"></i> </a>
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
                    </div>
                    <div class="pag_ul">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
<script>
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
                location.href = '{{url('/')}}/admin/delete/item/'+id;
            }
        })
    }
</script>
@endsection