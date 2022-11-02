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
                        <div class="card-header">
                            <h3 class="card-title float-right">{{$title2}}</h3>

                        </div>
                        <div class="card-body res_table_in">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>شماره فاکتور</th>
                                    @if(auth()->user()->hasRole('مدیر'))
                                        <th>سفارش دهنده</th>
                                    @endif
                                    <th>مبلغ سفارش</th>
                                    <th>مبلغ پرداخت شده</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>تاریخ</th>
                                    <th>ساعت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($items)>0)

                                    @foreach($items as $key=>$item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            @if(Auth::user()->hasRole('مدیر'))
                                                <td>
                                                    <p class="my-0"> {{$item->user?$item->user->first_name.' '.$item->user->last_name:''}}</p>
                                                </td>
                                            @endif
                                            <td><span>@item($item->sum_price?price($item->sum_price):price($item->all_price))</span> تومان</td>
                                            <td><span>{{$item->sum_off_price?price($item->sum_off_price):'---'}}</span>  تومان@if($item->off_code) <span class="badge badge-warning">کد تخفیف : {{$item->off_code}}</span> @endif</td>
                                            <td>
                                                <span class="badge badge-{{$item->status=='active'?'success':'danger'}}">
                                                {!! $item->check_status($item->status) !!}
                                                </span>
                                            </td>
                                            <td>
                                                {{my_jdate($item->created_at,"d F Y")}}
                                            </td>
                                            <td>
                                                {{my_jdate($item->created_at,"H:i")}}
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                   data-target="#modal_{{$key}}"
                                                   class="badge bg-primary ml-1"
                                                   title="مشاهده"><i class="fa fa-eye"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{Auth::user()->hasRole('مدیر')?'8':'7'}}" class="text-center">موردی یافت نشد</td>
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


    @if(count($items)>0)
        @foreach($items as $key=>$item)
            <!-- Modal -->
            <div class="modal fade" id="modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">وضعیت فاکتور :
                                    <span class="badge badge-{{$item->status=='active'?'success':'danger'}}">
                                    {!! $item->check_status($item->status) !!}</span>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div>
                                <span>شماره فاکتور :</span> {{$item->id}}
                            </div>
                            @if($item->baskets and count($item->baskets->where('type','package')))

                            <div class="default_buy">
                                <h6>پکیج های این فاکتور</h6>
                                <div>
                                    @foreach($item->baskets->where('type','package') as $key1=>$basket)
                                        {{$key1!=0?" _ ":""}}
                                        <span>
                                            {{$basket->package?$basket->package->title:''}}
                                        </span>
                                        @if($item->status=='active')
                                        <a target="_blank" class="badge bg-primary mx-2" title="مشاهده پکیج " href="{{route('user.package',$basket->package?$basket->package->slug:'')}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if($item->baskets and count($item->baskets->where('type','service')))
                                <div class="default_buy ">
                                    <h6>سرویس های این فاکتور</h6>
                                    <div>

                                        @foreach($item->baskets->where('type','service') as $key2=>$basket)
                                            {{$key2!=0?" _ ":""}}
                                            <span> {{$basket->service?$basket->service->title:''}}
                                            </span>
                                        @if($item->status=='active')
                                            <a target="_blank" class="badge bg-primary mx-2" title="مشاهده سرویس" href="{{route('user.service',$basket->service?$basket->service->slug:'')}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endif
                                        @endforeach

                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-12 mt-3">
                                <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">بستن</button>
                                @if ($item->status=='cancel' || $item->status=='pending')
                                    <a class="float-left btn btn-{{$item->status=='cancel'?'success':'dark'}}"  href="{{ route('admin.factor-buy.edit',$item->id) }}">
                                        {{$item->status=='cancel'?'درخواست مجدد خرید':'انصراف از کردن خرید'}}
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <tr>
                @if(Auth::user()->hasRole('مدیر'))
                    <td>{{$item->id}}</td>
                    <td>
                        <p class="my-0"> {{$item->user?$item->user->first_name.' '.$item->user->last_name:''}}</p>
                    </td>
                @endif
                <td><span>@item($item->sum_price?price($item->sum_price):price($item->all_price))</span> تومان</td>
                <td><span>{{$item->sum_off_price?price($item->sum_off_price):'---'}}</span>  تومان@if($item->off_code) <span class="badge badge-warning">کد تخفیف : {{$item->off_code}}</span> @endif</td>
                <td>
                    <span class="badge badge-{{$item->status=='active'?'success':'danger'}}">
                    {!! $item->check_status($item->status) !!}
                    </span>
                </td>
                <td>
                    {{my_jdate($item->created_at,"d F Y")}}
                </td>
                <td>
                    {{my_jdate($item->created_at,"H:i")}}
                </td>
                <td class="text-center">
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_{{$key}}" class="badge bg-primary ml-1" title="مشاهده">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr> --}}
        @endforeach
    @endif
@endsection
@section('js')
    <script>
        function active_row(id, type) {
            if (type == 'cancel') {
                var text_user = ' سفارش کنسل می شود';
            }
            if (type == 'working') {
                var text_user = ' سفارش تایید می شود';
            }
            if (type == 'active') {
                var text_user = ' سفارش انجام شد';
            }
            Swal.fire({
                title: text_user,
                text: 'برای تغییر وضعیت مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '{{url('/')}}/admin/service-buy-active/' + id + '/' + type;
                }
            })
        }

    </script>
@endsection