@extends('layouts.admin')
@section('css')
<style>
    .dropdown-menu li a { color: rgba(0, 0, 0, 0.774); }
    .dropdown-menu li:hover { background: #2f665f; }
    .dropdown-menu li:hover a { color: white; }
</style>
@endsection
@section('content')
    <section class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.stock-portfolio.custom.create',$id) }}" class="btn btn-info float-left">{{' افزودن '.$title1}}</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered pull-right w-100">
                    <thead>
                        <tr>
                            <th data-toggle="true">عنوان</th>
                            <th data-toggle="true">نمایش/عدم نمایش</th>
                            <th data-hide="phone">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>@if($item->status=='active') <span class="text-success">نمایش</span> @else <span class="text-danger">عدم نمایش</span> @endif </td>
                                <td class="table-td-icons">
                                    <a href="{{ route('admin.stock-portfolio.edit', $item->id) }}" title="ویرایش" class="badge bg-info"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" onclick="del_row('{{$item->id}}')" class="badge bg-danger mx-2" title="حذف"><i class="fa fa-trash"></i></a>
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
                location.href = '{{url('/')}}/admin/stock-portfolio/force/delete/'+id;
            }
        })
    }
</script>
@endsection
        