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
                        </div>
                        @if($items->count())
                            @foreach($items as $item)
                                <div class="card-body res_table_in border mx-2 my-1 rounded">
                                    @if ($item->attach)
                                        <a href="{{ url($item->attach) }}" target="_blank" class="float-left ">
                                            <img src="{{ url($item->attach) }}" alt="{{$item->subject}}" style="height: 88px;">
                                        </a>
                                    @endif
                                    {{my_jdate($item->created_at,'d F Y').' - '.$item->user->first_name.' '.$item->user->last_name.' - '.$item->user->mobile}}
                                    <div >
                                        وضعیت : 
                                        @if($item->status=='pending')
                                            <span class="reply_email_no">در انتظار بررسی</span>
                                        @else
                                            <span class="reply_email_ok text-{{$item->status=='active'?'success':'danger'}}">بررسی شده : {{$item->status=='active'?'تایید':'رد'}}</span>
                                        @endif
                                        @if($item->admin_id)
                                            <h6>{{' بررسی شده توسط '.$item->admin->first_name.' '.$item->admin->last_name}}</h6>
                                        @endif
                                    </div>
                                    @if ($item->package)
                                        <p class="m-0 py-2">
                                            <span class="text-dark">{{$item->package->type=='sample'?'وبینار':'میزگرد'}}</span>
                                            {{' - '.$item->package->title.' - '.number_format($item->package->price)}}
                                        </p>
                                    @endif
                                    <h6 class="py-2">{{' مبلغ پکیج '.num2fa(number_format($item->price))}}</h6>
                                    
                                    <p class="m-0 pb-1">{{ ' شماره فیش '.json_decode($item->data)[0]->fish_id }}</p>
                                    <p class="m-0 pb-1">{{ ' ۴ رقم آخر کارت '.json_decode($item->data)[1]->number }}</p>
                                    <p class="m-0 pb-1">{{ ' نام بانک '.json_decode($item->data)[2]->bank }}</p>

                                    @role('مدیر')
                                        @if($item->status=='pending')
                                            <div class="mt-3">
                                                <a href="{{route('admin.offline_payment.request.action',[$item->id,'accept'])}}"
                                                    class="text-dark border border-success rounded p-1 px-3">تایید رسید</a>
                                                <a href="{{route('admin.offline_payment.request.action',[$item->id,'reject'])}}"
                                                    class="text-dark border border-danger rounded p-1 px-3 mx-4">عدم تایید رسید</a>
                                            </div>
                                        @endif
                                    @endrole
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="pag_ul">
                        @if ($items->count())
                            {{ $items->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection