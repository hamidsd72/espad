<div class="col-lg-3 col-md-6 moshaver">
    <div class="p-3 rounded" style="border:1px dashed #04d2c8;margin: 24px">
        <a href="{{ route('user.consultation.profile2',[$item->reagent_id,$item->id]) }}" >
            <img src="{{ $item->photo?url($item->photo->path:'' ) }}" width="100%" class="rounded shadow" alt="avatar">
        </a>
    </div>
    <a href="{{ route('user.consultation.profile2',[$item->reagent_id,$item->id]) }}"  class="text-center text-secondary">
        <h5 class="text-dark text-center pt-2">{{$item->title}}</h5>
        <p class="small">{{$item->user()?$item->user()->first_name.' '.$item->user()->last_name:''}}</p>
    </a>
</div>

<style>
    .consultation {
        background: white !important;
    }
    p {
        text-align: center !important;
    }
    .moshaver div:hover {
        margin-top: 8px !important;
        margin-bottom: 40px !important;
        transition: 0.4s;
    }
    .moshaver h5:hover , .moshaver p:hover {
        color: #04d2c8 !important;
        transition: 0.2s;
    }
</style>