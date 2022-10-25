<div class="modal fade" id="qarardad-moshavere-hozori" tabindex="-1" aria-labelledby="qarardad-moshavere-hozoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('user.forms.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qarardad-moshavere-hozoriLabel"></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="item_id" id="qarardad-id2">
                    <input type="hidden" name="type" id="qarardad-type2">
                    <input type="hidden" name="cons_id" id="qarardad-cons-id2">
                    <input type="hidden" name="title" id="qarardad-title2">

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name" class="col-form-label">نام مجموعه / نام و نام خانوادگی *</label>
                            <input type="text" placeholder="نام و نام خانوادگی یا نام شرکت خود را وارد کنید" class="form-control" name="name" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="uuid" class="col-form-label">شماره ثبت شرکت</label>
                            <input type="text" placeholder="این قسمت میتواند خالی باشد" class="form-control" name="uuid">
                        </div>
                        <div class="col-lg-6">
                            <label for="mobile" class="col-form-label">شماره تماس *</label>
                            <input type="number" placeholder="۹۱۳۱۶۲۸۸۶۶" class="form-control" name="mobile" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="code" class="col-form-label">شناسه ملی / کد ملی *</label>
                            <input type="text" placeholder="شناسه کسب و کار یا شماره ملی را وارد کنید" class="form-control" name="code" required>
                        </div>
                        <div class="col-12">
                            <label for="text" class="col-form-label">شرح درخواست *</label>
                            <textarea class="form-control" name="text" required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="attach" class="col-form-label">پیوست</label>
                            <input type="file" class="form-control" name="attach">
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <button type="submit" class="btn btn-primary">ارسال</button>
                    <button type="button" class="btn btn-secondary mx-3" data-bs-dismiss="modal">انصراف</button>
                </div>
            </div>
        </form>
    </div>
</div>