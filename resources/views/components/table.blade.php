
@if ($mode == "normal")
    {!! $filter['flyout']() !!}
    <div id="control-{{$name}}" class="d-none">
        {!! $filter['button2']() !!}
        {!! $filter['button']() !!}
    </div>
@endif

<div id="{{$name}}" style="{{$style['colspan']}} width: 100%;" class="bg-white table-sm table-striped">
    <div class="overflow-auto">
        <table id="{{$name}}" class="citadel-table table dataTable"
            config="{{ json_encode($definition) }}">
            <thead>
                <tr>
                    {!! $columns !!}
                </tr>
            </thead>
            <tbody>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>
