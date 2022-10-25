@extends('layouts.layout_first_page')
@section('content')

<section class="about">
    <div class="container pb-4">

        <h6 class="text-secondary py-4">خدمات مالی و بورسی</h6>

        <div class="body bg-white p-4">

            <h2 class="py-4 d-flex">
                <div class="line"></div>
                فورم مشاوره {{$slug}}
            </h2>
            
            <form action="#">
                <div class="row">

                    <input name="type" type="hidden">
                    <input name="category" type="hidden">

                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="">نام شرکت / مجموعه *</label>
                        <input class="form-control" id="" name="" placeholder="نام" required type="text">
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="">شماره ثبت *</label>
                        <input class="form-control" id="" name="" placeholder="نام خانوادگی" required type="number">
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="">شماره تماس *</label>
                        <input class="form-control" id="" name="" placeholder="عنوان" required type="tell">
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <label class="mb-2" for="">شناسه ملی *</label>
                        <input class="form-control" id="" name="" placeholder="عنوان" required type="number">
                    </div>

                    <div class="col-12 mb-4">
                        <label class="mb-2" for="">طرح موضوع</label>
                        <textarea id="" name="" class="form-control" rows="4" placeholder="شرح پیام" required></textarea>
                    </div>

                    <div class="col-lg-3 col-md-6 col-8">
                        <button type="submit" class="btn btn-primary col-12">ارسال فورم</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</section>


@endsection