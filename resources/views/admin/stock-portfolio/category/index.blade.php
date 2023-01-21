@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <section class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.stock-portfolio-categories.create') }}" class="btn btn-info float-left">{{' افزودن '.$title1}}</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered pull-right w-100">
                    <thead>
                    <tr>
                        <th data-toggle="true">عنوان</th>
                        <th data-toggle="true">تعداد آیتم</th>
                        <th data-toggle="true">ترتیب</th>
                        <th data-toggle="true">نمایش/عدم نمایش</th>
                        <th data-hide="phone">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->items()->count() }}</td>
                            <td>@if($item->status=='active') <span class="text-success">نمایش</span> @else <span class="text-danger">عدم نمایش</span> @endif</td>

                            <td class="vertical-align-middle text-center" width="100">
                                <form action="{{route('admin.stock-portfolio-categories.sort',$item->id)}}" method="post">
                                    @csrf
                                    <input type="number" min="0" name="sort" class="form-control text-center" onchange="this.form.submit()" value="{{$item->sort}}">
                                </form>
                            </td>

                            <td class="table-td-icons">
                                <a href="{{ route('admin.stock-portfolio.show', $item->id) }}" class="badge bg-success p-1">مدیریت محتوا</a>
                                <a href="{{ route('admin.stock-portfolio-categories.edit', $item->id) }}" title="ویرایش" class="badge bg-info mx-2"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" onclick="del_row('{{$item->id}}')" class="badge bg-danger" title="حذف"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pag_ul">
                {{ $items->links() }}
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
                location.href = '{{url('/')}}/admin/stock-portfolio-categories/force/delete/'+id;
            }
        })
    }
</script>
@endsection
        