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
        <div class="card res_table">
            <div class="card-header border-0">
                <h4 class="w-100">
                    <a href="#" data-toggle="modal" data-target="#create" class="btn btn-primary float-left">افزودن</a>
                </h4>
            </div>
            <div class="card-body res_table_in pt-0">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="border-bottom-0">#</th>
                        <th class="border-bottom-0">عنوان</th>
                        <th class="border-bottom-0">مسیر فایل</th>
                        <th class="border-bottom-0">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ($items)
                            @foreach($items as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->title}}</td>
                                    <td>{{url($row->path)}}</td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="del_row('{{$row->id}}')" class="badge bg-danger mx-2" title="حذف"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pag_ul">
            {{ $items->appends(request()->query())->links() }}
        </div>
    </section>
  
    <div class="modal" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">آپلود فایل</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('route' => array('admin.file-upload.store'), 'method' => 'POST','files'=>true)) }}
                        <div class="form-group">
                            {{Form::label('title', ' نام قایل ')}}
                            {{Form::text('title', null, array('class' => 'form-control','required'))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('path', ' فایل ')}}
                            {{Form::file('path', null, array('class' => 'form-control','required'))}}
                        </div>
                        <div class="d-flex">
                            {{Form::submit('ارسال',array('class'=>'btn btn-primary'))}}
                            <button type="button" class="btn btn-secondary mx-3" data-dismiss="modal">انصراف</button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

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
                location.href = '{{url('/')}}/admin/file-upload/force/delete/'+id;
            }
        })
    }
</script>
@endsection