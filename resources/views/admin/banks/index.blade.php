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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-12">
                        <div class="card res_table">
                            <div class="card-header">
                                @if (auth()->user()->getRoleNames()->first()=='مدیر')
                                    <div class="text-left">
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#create">
                                            افزودن
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body res_table_in pt-0">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        @if (auth()->user()->getRoleNames()->first()=='مدیر')
                                            <th>عملیات</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($items)>0)
                                    @foreach($items as $item)
                                        <form action="{{ route('admin.banks.update',$item->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <tr>
                                                <td>
                                                    <input type="text" name="title" id="title" value="{{$item->title}}" required >
                                                </td>
                                                @if (auth()->user()->getRoleNames()->first()=='مدیر')
                                                    <td class="text-center">
                                                        <button type="submit" class="btn badge bg-primary mx-3 py-0" >ویرایش</button>
                                                        {{-- <a href="{{route('admin.service.edit',$item->id)}}" class="badge bg-primary mx-2" title="ویرایش"><i class="fa fa-edit"></i> </a> --}}
                                                        <a href="javascript:void(0);" onclick="del_row('{{$item->id}}')" class="badge bg-danger" title="حذف"><i class="fa fa-trash"></i> </a>
                                                    </td>
                                                @endif
                                            </tr>

                                        </form>
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

    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.banks.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ایجاد بانک جدید</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="title" id="title" placeholder="نام بانک را وارد کنید" class="form-control" required >
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success " >ثبت شود</button>
                        <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </form>
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
                location.href = '{{url('/')}}/admin/banks/'+id;
            }
        })
    }
</script>
@endsection
