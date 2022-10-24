<option value="0">Select Mandotory Pack</option>
@foreach ($mendotoryPack as $mp)
    <option value="{{ $mp->id }}">
        {{ $mp->raw->name }}
        {{ $mp->raw->unit_value . $mp->raw->unit }}
    </option>
@endforeach
