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

                            <div class="container mt-5 border rounded p-3">
                                <h5 class="text-right">افزودن</h5>
                                <hr>
                                {{ Form::open(array('route' => array('admin.service.package.price.store'), 'method' => 'post')) }}
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            {{ Form::text('title',null, array('class' => 'form-control','placeholder'=>'عنوان پکیج را وارد کنید')) }}
                                        </div>
                                        <div class="col-lg-2 mb-2">
                                            {{ Form::number('day',null, array('class' => 'form-control','onkeyup'=>'number_month(this.value)','placeholder'=>'مدت رو به ماه وارد کنید')) }}
                                            <span id="price_span" class="span_p"><span id="pp_month"></span> ماه </span>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            {{ Form::number('price',null, array('class' => 'form-control','onkeyup'=>'number_price(this.value)','placeholder'=>'هزینه رو به ریال وارد کنید')) }}
                                            <span id="price_span" class="span_p"><span id="pp_price"></span> ریال </span>
                                        </div>
                                        <button type="submit" class="btn btn-success ">ثبت شود</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                        <div class="card-body res_table_in">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>ماه</th>
                                    <th>هزینه</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($items)>0)
                                    @foreach($items as $key=>$item)

                                        <tr>
                                            <td>@item($item->title)</td>
                                            <td>@item($item->day)</td>
                                            <td>@item(number_format($item->price)) ریال</td>
                                            {{-- <td>@item($item->type($item->status))</td> --}}
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="del_row('{{$item->id}}')" class="badge bg-danger ml-1"
                                                        title="حذف"><i class="fa fa-trash"></i></a>
                                                {{-- @if($item->status=='active')
                                                    <a href="javascript:void(0);"
                                                        onclick="active_row('{{$item->id}}','pending')"
                                                        class="badge bg-success ml-1"
                                                        title=" نمایش فعال است غیرفعال شود؟"><i class="fa fa-check"></i>
                                                    </a>
                                                @endif
                                                @if($item->status=='pending')
                                                    <a href="javascript:void(0);"
                                                        onclick="active_row('{{$item->id}}','active')"
                                                        class="badge bg-warning ml-1"
                                                        title="نمایش غیر فعال است فعال شود؟"><i class="fa fa-close"></i>
                                                    </a>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">موردی یافت نشد</td>
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
        function active_row(id, type) {
            if (type == 'pending') {
                var text_user = ' نمایش غیرفعال می شود';
            }
            if (type == 'active') {
                var text_user = ' نمایش فعال می شود';
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
                    location.href = '{{url('/')}}/admin/service-package-price-active/' + id + '/' + type;
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
                    location.href = '{{url('/')}}/admin/service-package-price-destroy/' + id;
                }
            })
        }

        function number_price(a) {
            $('#pp_price').text(a);
            $('#pp_price').text(function (e, n) {
                var lir1 = n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return lir1;
            })
        }

        function number_month(a) {
            $('#pp_month').text(a);
        }

        $(document).ready(function () {
            var a = $('#price').val();
            $('#pp_price').text(a);
            $('#pp_price').text(function (e, n) {
                var lir1 = n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return lir1;
            })
            var b = $('#month_time').val();
            $('#pp_month').text(b);

        });
    </script>
@endsection