<div class="modal fade" id="sendWebTicket">
    <div class="modal-dialog modal-lg">

        <div class="modal-content redu20"> 
            <div class="modal-header">
                <h4 class="modal-title">ارسال تیکت مشاوره</h4>
                <img src="/{{ \App\Model\Setting::first()->logo_site }}" alt="{{ \App\Model\Setting::first()->title }}" style="width: 96px">
            </div>
            <div class="modal-body">
                <div class="content">
                    <form method="post" action="{{route('user.contact.post')}}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label>دسته بندی</label>
                                <select id="category" name="category" class="form-control mb-4">
                                    @foreach ( \App\Model\ServiceCat::where('status', 'active')->get('title') as $key => $item)
                                        <option value="{{$item->title}}" @if($key==0) selected @endif>{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>موضوع:<span>(required)</span></label>
                                <input type="text" name="subject" class="form-control mb-4">
                            </div>
                            <div class="form-group">
                                <label>متن:<span>(required)</span></label>
                                <textarea name="text" class="form-control mb-4"></textarea>
                            </div>
                            <div class="mb-4">
                                <label>الحاق فایل</label>
                                <input type="file" name="attach" id="attach">  
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">ارسال پیام</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>