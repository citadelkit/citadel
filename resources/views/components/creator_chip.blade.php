<div class="d-flex justify-content-start gap-3 align-items-center flex-row rounded shadow-sm bg-white border-primary p-3" style="width: 240px">
    <div class="container-avatar col-2">
        <img src="{{$picture_url}}" class="rounded-circle object-cover border" style="width: 40px; height: 40px" />
    </div>
    <div class="col text-left overflow-hidden">
        <strong class="overflow-hidden" style="text-overflow: ellipsis; word-wrap: normal;">{{$title}}</strong>
        <p class="mb-1 overflow-hidden" style="text-overflow: ellipsis; word-wrap: normal;">{{$subtitle}}</p>
    </div>
    <div class="">
        {{-- <a target="_blank" href="{{ $detail_url }}" class="badge badge-primary">Detail <x-material-icon style="font-size: 90%" icon="open_in_new"/></a> --}}
    </div>
</div>
