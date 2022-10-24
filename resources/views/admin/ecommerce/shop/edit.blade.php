@extends('admin.layouts.adminMaster')

@push('css')
<style>

</style>
@endpush

@section('content')

<div class="card-">
    <div class="card-header w3-purple h3">
        Shop : {{ $shop->name }}
    </div>
    <div class="card-body">
        @include('alerts.alerts')
    </div>
        <div class="container">
            <form action="{{ route('admin.shop.update', $shop) }}" method="post">
                @csrf
            <div class="row">
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card-header h5">
                            Shop Informations
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="agent">Agent</label>
                                <select style="width:100%;" class="form-control select2" name="agent" id="agent">
                                    @foreach ($agents as $agent)
                                        <option {{$shop->agent_id == $agent->id ? 'selected' : ''}} value="{{ $agent->id }}">{{ $agent->name }}
                                            ({{ $agent->user ? $agent->user->name ?? '' : '' }}({{ $agent->user ? $agent->user->mobileOrEmail() : '' }})
                                             </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Shop Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $shop->name }}">
                            </div>
                            <div class="form-group">
                                <label for="owner_name">Owner Name</label>
                                <input type="text" class="form-control" name="owner_name" value="{{ $shop->owner_name }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Contact Number</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $shop->mobile }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description">{{ $shop->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" class="form-control" name="address" id="address">{{ $shop->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="due_amount">Initial Amount</label>
                                <input type="number" class="form-control" name="due_amount" id="due_amount" value="{{ $shop->due_amount }}">
                            </div>
                            <div class="form-group">
                                <label for="monthly_target">Monthly Target</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="monthly_target" id="monthly_target" placeholder="ex. 10000" value="{{ $shop->monthly_target }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="active" id="active" @if($shop->active) checked @endif>
                                <label for="active">Approve</label>
                            </div>
                        </div>
                    </div>
                    @if ($shop->commissions->count() > 0)
                    <div class="card">
                        <div class="card-header h5">
                            Shop Commissions
                        </div>
                        <div class="card-body">
                        <ul class="list-group">
                            @foreach ($shop->commissions as $com)
                            <li class="list-group-item">{{ $com->category->name }} : {{ $com->commission }}%</li>

                            @endforeach
                          </ul>
                        </div>
                    </div>
                    @endif

                    <div class="text-center pt-3">
                        <button class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="container px-5">
                            @if (isset($categories))
                        <div class="card-header h5 mb-2">
                        Update Shop Commissions
                        </div>
                        @foreach ($categories as $category)
                        <div class="form-group pb-3 border-bottom">
                        <div class="input-group">

                            <label class="col-sm-5 form-check-label" for="active">
                                <input class="form-check-input" type="checkbox" id="active_cat_{{ $category->id }}" checked onchange="toggleCatComission({{ $category->id }},{{ $category->shop_commission }})">
                                {{ $category->name }}
                            </label>
                            <input class="col-sm-7 form-control" type="number" min="0"  max="100" step="0.01" value="{{ $category->shop_commission }}" name="category_{{ $category->id }}" id="category_{{ $category->id }}">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        </div>

                    </div>

                <div class="text-center pt-3">
                    <button class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection


@push('js')
<script>
function toggleCatComission(id,value) {
            var checkBox = $('#active_cat_'+id)
            if (checkBox[0].checked == true) {
              $('#category_'+id).val(value)
            }else{
              $('#category_'+id).val(0)
            }
          }
</script>
@endpush
