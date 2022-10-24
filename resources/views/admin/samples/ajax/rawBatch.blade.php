
<small>
    <b>Current Stock: </b> {{$raw->total_stock()}}
    <b>Total batch:</b> {{$raw->total_batch()}}
</small>

{{--<small>--}}
{{--    <b>Stocked Q:</b>--}}
{{--@if ($raw->firstBatch())--}}
{{--<b>1). </b> {{$raw->firstBatch()->total_quantity}}--}}
{{--@else--}}
{{--<b>0</b>--}}
{{--@endif--}}
{{--@if ($raw->secondBatch())--}}
{{--<b>, 2). </b>{{$raw->secondBatch()->total_quantity}}--}}
{{--@endif--}}
{{--@if ($raw->thirdBatch())--}}
{{--<b>,3). </b>{{$raw->thirdBatch()->total_quantity}}--}}
{{--@endif--}}

{{--</small>--}}
