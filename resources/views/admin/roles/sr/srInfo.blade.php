@if (isset($agent))
<div class="card">
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item">SR : {{ $agent->name }} </li>
            <li class="list-group-item">SR Name: {{ $agent->user->name }} </li>
            <li class="list-group-item">Mobile: {{ $agent->mobile ?? $agent->user->mobile }} </li>
            <li class="list-group-item">SMO: {{ $agent->dealer->name }}</li>
            <li class="list-group-item">GM: {{ $agent->depo->name }}</li>
        </ul>
    </div>
</div>
@endif