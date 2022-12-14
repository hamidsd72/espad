@extends('user.master')
@section('css')
@endsection
@section('content')
    <!-- Main content -->
    <div class="col-12">
        <div class="card mt-5 pt-3">
            <div class="card-header">
                <h3 class="card-title float-right">{{$title2}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2 p-lg-3">
                @if(count($items))
                    <div class="row m-0">
                        <div class="col p-0 border">درخواست شده</div>
                        <div class="col p-0 border">وضعیت</div>
                        <div class="col p-0 border">خدمت</div>
                        <div class="col p-0 border">مدت تماس</div>
                        <div class="col p-0 border">هزینه تماس(تومان)</div>
                        <div class="col p-0 border">زمان درخواست</div>
                    </div>
                    <tbody>
                    @foreach($items as $item)
                    <div class="row m-0">
                        <div class="col p-0 border">{{$item->consultant?$item->consultant->first_name.' '.$item->consultant->last_name:$item->consultant_id}}</div>
                        <div class="col p-0 border">
                            {{$item->status_set($item->status,$item->end_call_id)}}
                        </div>
                        <div class="col p-0 border">{{$item->service() && $item->service()->category()?$item->service()->category()->title:''}}
                                {{-- - {{$item->service()?$item->service()->title:$item->service_id}} --}}
                        </div>
                        <div class="col p-0 border">
                            {{$item->time_call($item->start_call,$item->end_call,$item->time_service,$item->status)}}
                        </div>
                        <div class="col p-0 border">
                            @if($item->status=='end' || $item->status=='end_time')
                                {{number_format((int)$item->price_call)}} از {{number_format($item->price_service)}}
                            @else
                                __
                            @endif
                        </div>
                        <div class="col p-0 border">{{my_jdate($item->created_at,'Y/m/d H:i:s')}}</div>
                    </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">موردی یافت نشد</td>
                    </tr>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <div class="pag_ul">
            {{ $items->links() }}
        </div>
    </div>

    @if(count($items)>0)
        @foreach($items as $item)
            <div class="modal" id="role{{$item->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {{ Form::model($item,array('route' => array('admin.user-role.update'), 'method' => 'POST', 'files' => true)) }}
                            <div class="modal-header">
                                <h4 class="modal-title">تغییر رول کاربر</h4>
                                <button type="button" class="close" data-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <div class="form-group">
                                    <label for="role_name" >نوع رول</label>
                                    <select id="role_name" name="role_name" class="form-control col-lg-6 col-8">
                                        @foreach (\App\Model\Role::all() as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer row">
                                <div class="col">
                                    {{ Form::button('ویرایش', array('type' => 'submit', 'class' => 'btn btn-success col-12 ')) }}
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger col-12" data-dismiss="modal">بستن</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection
@section('js')
    <script>
        function active_row(id,type) {
            if(type=='blocked')
            {
                var text_user='پنل کاربر مسدود می شود';
            }
            if(type=='active')
            {
                var text_user='پنل کاربر فعال می شود';
            }
            Swal.fire({
                title: text_user ,
                text: 'برای تغییر وضعیت کاربر مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '{{url('/')}}/admin/user-active/'+id+'/'+type;
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
                    location.href = '{{url('/')}}/admin/user-destroy/'+id;
                }
            })
        }
    </script>
@endsection