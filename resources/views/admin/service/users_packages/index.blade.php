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

                                <button type="button" class="btn btn-secondary float-left" data-toggle="modal" data-target="#filter">
                                    @if(isset($id)) گروه {{App\Model\ServicePackage::find($id)->title}} @else فیلتر کردن گروه ها @endif
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body res_table_in">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>نام و نام خانوادگی</th>
                                        <th>موبایل</th>
                                        <th>ایمیل</th>
                                        <th>واتساپ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($items)>0)
                                    @foreach($items as $item)
                                    <tr>
                                        <td>@item($item->first_name) @item($item->last_name)</td>
                                        <td>@item($item->mobile)</td>
                                        <td>@item($item->email)</td>
                                        <td>@item($item->whatsapp)</td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">موردی یافت نشد</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <!-- /.card-body -->
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
                            @if(isset($id)) گروه {{App\Model\ServicePackage::find($id)->title}} @else فیلتر کردن گروه ها @endif
                            
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-height: 680px;overflow-y: auto;">
                            @foreach($ServiceCats as $ServiceCat)
                                <li style="padding: 6px;"><a class="text-dark" href="{{route('admin.users.service.package.list',$ServiceCat->id )}}" title="Courses">{{$ServiceCat->title}}</a></li>
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