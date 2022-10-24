<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Raw</th>
            <th>Raw Type</th>
            <th>Unit</th>
            <th>Unit Value</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @forelse($sample_items as $sampleItem)
            <tr>
                <td>{{$sampleItem->raw? $sampleItem->raw->name : ''}}</td>
                <td>{{$sampleItem->raw? $sampleItem->raw->type : ''}}</td>
                <td>{{$sampleItem->unit}}</td>
                <td>{{$sampleItem->unit_value}}</td>
                {{-- <td>{{\Carbon\Carbon::parse($sampleItem->created_at)->format('d M,Y')}}</td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-danger h5">No Samples Found</td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
            <tr>
            <th>{{$product->sample->name}}</th>
            <th></th>
            <th>{{$product->sample->unit}}</th>
            <th>{{$product->sample->unit_value}}</th>
        </tr>
        </tfoot>
    </table>
</div>
