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
                            @if(count($items)>0)
                                @foreach($items as $item)

                                    @if (\Request::route()->getName()=='admin.contact.list.pay')
                                        <div class="card-body res_table_in border mx-2 my-1 rounded">
                                            @if ($item->attach)
                                                <a href="{{ url($item->attach) }}" target="_blank" class="float-left ">
                                                    <img src="{{ url($item->attach) }}" alt="{{$item->subject}}" style="height: 88px;">
                                                </a>
                                            @endif
                                            @if ($item->category=='کد تخفیف')
                                                {{my_jdate($item->created_at,'d F Y').' - '.$item->user()->first_name.' '.$item->user()->last_name.' - '.$item->user()->mobile}}
                                            @else
                                                <span >
                                                    وضعیت : 
                                                    @if($item->reply>0)
                                                        <span class="reply_email_ok text-success">بررسی شده</span>
                                                    @else
                                                        <span class="reply_email_no">در انتظار بررسی</span>
                                                    @endif
                                                </span>
                                            @endif

                                            <h6 class="my-3">{{' موضوع : '.(is_numeric($item->subject)?number_format($item->subject):$item->subject)}}</h6>
                                            <div class="d-none">{{$counter=1}}</div>
                                            @if ($item->text)
                                                @if ($item->category=='کد تخفیف')
                                                    @foreach (explode( ',' , $item->text ) as $key => $query)
                                                        <p class="my-1">
                                                            @if ($counter < 5)
                                                                {{' پاسخ به سوال '.$counter.' : '.$query}}
                                                            @else
                                                                {{' شرح درخواست : '.$query}}
                                                            @endif
                                                        </p>
                                                        <div class="d-none">{{$counter+=1}}</div>
                                                    @endforeach
                                                @else
                                                    <h6 class="pt-1">{{$item->text}}</h6>
                                                @endif
                                            @endif
                                            
                                            @if ($item->category!='کد تخفیف')
                                                @if($item->reply==0)
                                                    <div class="mt-3">
                                                        <a href="{{ route('admin.contact.list.pay.accept',$item->id) }}" class="text-dark border border-success rounded p-1 px-3 mx-2">تایید رسید</a>

                                                        <a href="{{ route('admin.contact.list.pay.reject',$item->id) }}" class="text-dark border border-danger rounded p-1 px-3 mx-2">عدم تایید رسید</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-body res_table_in border mx-2 my-1 rounded">
                                            {{-- <span>
                                                نوع : 
                                                @if($item->answered == "yes")
                                                    <span class="reply_email_ok text-success">دریافتی</span>
                                                @else
                                                    <span class="reply_email_no">ارسالی</span>
                                                @endif
                                            </span> --}}
                                            <span >
                                                وضعیت : 
                                                {{-- @if($item->answered == "no") --}}
                                                    @if($item->reply>0)
                                                        <span class="reply_email_ok text-success">پاسخ داده شده</span>
                                                    @else
                                                        <span class="reply_email_no">در انتظار پاسخ</span>
                                                    @endif
                                                {{-- @else
                                                    <span class="reply_email_no text-info">پیام از مشاور</span>
                                                @endif --}}
                                            </span>
                                            <h6 class="pt-1">{{' دسته ی : '.$item->category}}</h6>
                                            <h6 class="pt-1">{{' موضوع : '.$item->subject}}</h6>
                                            <p class="m-0">{{' توضیحات : '.$item->text}}</p>
                                            @if ($item->attach)
                                                <a class="text-dark pt-1" href="/{{ $item->attach }}" target="_blank">
                                                    <i class="fa fa-paperclip mt-2"></i>
                                                    مشاهده فایل پیوست شده
                                                </a>
                                            @endif

                                            @foreach($sub_items->where('belongs_to_item', '=', $item->id) as $sub_item)
                                                <div class="card-body res_table_in border mx-1 my-1 rounded">
                                                    <span>
                                                        وضعیت : 
                                                        @if($sub_item->reply>0)
                                                            <span class="reply_email_ok text-success">پاسخ داده شده</span>
                                                        @else
                                                            <span class="reply_email_no">در انتظار پاسخ</span>
                                                        @endif
                                                    </span>
                                                    <h6 class="pt-1">{{' دسته ی : '.$sub_item->category}}</h6>
                                                    <h6 class="pt-1">{{' موضوع : '.$sub_item->subject}}</h6>
                                                    <p class="m-0">{{' توضیحات : '.$sub_item->text}}</p>
                                                    @if ($sub_item->attach)
                                                        <a class="text-dark pt-1" href="/{{ $sub_item->attach }}" target="_blank">
                                                            <i class="fa fa-paperclip mt-2"></i>
                                                            مشاهده فایل پیوست شده
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                            <a href="#" href="javascript:void(0);" data-toggle="modal" data-target="#ModalAnsweTicket{{$item->id}}" 
                                            class="float-left text-dark border border-secondary rounded p-1 px-3">پاسخ تیکت مشاوره</a>
                                        </div>
                                    @endif
                                    
                                @endforeach
                            @else
                                <div>
                                    <td colspan="3" class="text-center">موردی یافت نشد</td>
                                </div>
                            @endif

                        </div>
                        <div class="pag_ul">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
        </div>

        @foreach($items as $item)
            <div class="modal fade" id="ModalAnsweTicket{{$item->id}}" role="dialog">
                <div class="modal-dialog">
 
                    <div class="modal-content"> 
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">تیکت مشاوره {{$item->subject}}</h6>
                        </div>
                        <div class="modal-body">
                            <div class="content">
                                    <form method="post" action="{{ route('admin.contact.send.ticket',$item->id) }}" enctype="multipart/form-data">
                                        @csrf
                                    <fieldset>
                                        <input type="hidden" name="belongs_to_item" value="{{$item->id}}" id="contactbelongs_to_itemField">
                                        <input type="hidden" name="category" value="{{$item->category}}" id="contactbelongs_to_itemField">

                                        <div class="form-field form-email">
                                            <label class="contactEmailField color-theme" for="contactEmailField">موضوع:<span>(required)</span></label>
                                            <input type="text" name="subject" value="{{$item->subject}}" class="round-small form-control" id="contactEmailField">
                                        </div>
                                        <div class="form-field form-text">
                                            <label class="contactMessageTextarea color-theme" for="contactMessageTextarea">متن:<span>(required)</span></label>
                                            <textarea name="text" class="round-small form-control" id="contactMessageTextarea"></textarea>
                                        </div>
                                        <div class="my-4">
                                            <input type="file" name="attach" id="attach">  الحاق فایل  
                                        </div>
                                        <div class="form-button">
                                            <input type="submit" class="btn bg-highlight text-uppercase font-900 btn-m btn-full rounded-sm  shadow-xl contactSubmitButton" value="ارسال پیام" data-formid="contactForm">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

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
                location.href = '{{url('/')}}/admin/contact-destroy/'+id;
            }
        })
    }
</script>
@endsection