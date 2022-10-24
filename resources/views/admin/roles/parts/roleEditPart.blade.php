<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    @if ($type == 'depo')
                        GM
                    @elseif($type == 'distributor')
                        Distributor
                    @elseif($type == 'dealer')
                        SMO
                    @elseif($type == 'agent')
                        SR
                    @else

                    @endif
                    <small>Edit</small>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">
                            @if ($type == 'depo')
                                GM
                            @elseif($type == 'distributor')
                                Distributor
                            @elseif($type == 'dealer')
                                SMO
                            @elseif($type == 'agent')
                                SR
                            @else

                            @endif
                        </a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<!-- Main content -->
<section class="content">




    <!-- Info cardes -->
    <div class="row">
        <div class="col-md-6">

            @include('alerts.alerts')

            <div class="card card-widget">
                <div class="card-header with-border">
                    <h3 class="card-title"><i class="fa fa-edit"></i> Edit @if ($type == 'depo')
                            GM
                        @elseif($type == 'distributor')
                            Distributor
                        @elseif($type == 'dealer')
                            SMO
                        @elseif($type == 'agent')
                            SR
                        @else

                        @endif
                    </h3>

                </div>

                <div class="card-body">

                    <form class="" method="post"
                        action="{{ route('admin.roleEditPost', ['type' => $type, 'role' => $admin]) }}">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback{{ $errors->has('user') ? ' has-error' : '' }}"
                            id="userField">
                            <label for="user"> {{ __('User') }}:</label>

                            <select id="user" name="user" class="form-control select2-container step2-select select2"
                                data-placeholder="Mobile or Email" data-ajax-url="{{ route('admin.selectNewRole') }}"
                                data-ajax-cache="true" data-ajax-dataType="json" data-ajax-delay="200"
                                style="width: 100%;">

                                @if ($admin->user)
                                    <option value="{{ $admin->user_id }}">
                                        {{ $admin->user->mobileOrEmail() . ' (' . $admin->user->name ?? '' . ')' }}
                                    </option>
                                @endif
                            </select>
                            @if ($errors->has('user'))
                                <span class="help-block">{{ $errors->first('user') }}</span>
                            @endif
                        </div>

                        <div class="form-group" id="addUserButton">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" onclick="newuser()"
                                    style="cursor: pointer">
                                    <i class="fa fa-user-plus"></i> &nbsp; New user
                                </span>
                            </div>
                        </div>

                        @if ($type == 'dealer')
                            <div class="form-group has-feedback{{ $errors->has('area') ? ' has-error' : '' }}">
                                <label for="area">Area:</label>

                                <input type="text" name="area" class="form-control" placeholder="Area...."
                                    value="{{ $admin->area }}">
                            </div>
                            <div class="form-group has-feedback{{ $errors->has('gm') ? ' has-error' : '' }}">
                                <label for="gm">GM:</label>

                                <select class="form-control select2" name="gm" id="gm">
                                    <option value="">Select GM</option>
                                    @foreach ($depos as $gm)
                                        <option {{ $gm->id == $admin->depo_id ? 'selected' : null }}
                                            value="{{ $gm->id }}">{{ $gm->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                        @elseif($type == 'agent')

                            <div class="form-group has-feedback{{ $errors->has('area') ? ' has-error' : '' }}">
                                <label for="area">Area:</label>
                                <input type="text" name="area" class="form-control" placeholder="Area...."
                                    value="{{ $admin->area }}">
                            </div>
                            <div class=" form-group has-feedback{{ $errors->has('dealer') ? ' has-error' : '' }}">
                                <label for="dealer">SMO:</label>

                                <select style="width:100%;" class="form-control select2" name="dealer" id="dealer">
                                    <option value="{{ $admin->dealer_id }}">
                                        {{ $admin->dealer ? $admin->dealer->title : null }}
                                        ({{ $admin->dealer->user ? $admin->dealer->user->name ?? '' : '' }}({{ $admin->dealer->user ? $admin->dealer->user->mobileOrEmail() : '' }})
                                        >> ({{ $admin->area }})</option>
                                    @foreach ($dealers as $dealer)
                                        <option value="{{ $dealer->id }}">{{ $dealer->title }}
                                            ({{ $dealer->user ? $dealer->user->name ?? '' : '' }}({{ $dealer->user ? $dealer->user->mobileOrEmail() : '' }})
                                            >> ({{ $dealer->area }}) </option>
                                    @endforeach
                                </select>
                            </div>

                            <div
                                class=" form-group has-feedback{{ $errors->has('monthly_target') ? ' has-error' : '' }}">
                                <label for="monthly_target">Monthly Target:</label>
                                <input class="form-control" type="number" name="monthly_target" id="monthly_target"
                                    value="{{ old('monthly_target') ?? $admin->monthly_target }}"
                                    placeholder="ex. 100000">
                            </div>
                        @endif

                        <div class="form-group has-feedback{{ $errors->has('nid ') ? ' has-error' : '' }}">
                            <label for="nid">National ID no.</label>
                            <input type="text" class="form-control" name="nid" id="nid" value="{{ $admin->nid }}">
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('title ') ? ' has-error' : '' }}">
                            <label for="title">
                                @if ($type == 'depo')
                                    GM
                                @elseif($type == 'distributor')
                                    Distributor
                                @elseif($type == 'dealer')
                                    SMO
                                @elseif($type == 'agent')
                                    SR
                                @else

                                @endif Name:
                            </label>

                            <input type="text" name="title" value="{{ old('title') ?: $admin->name ?? '' }}"
                                class="form-control" placeholder="{{ ucfirst($type) }} Name">

                            @if ($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif

                        </div>

                        <div class="form-group has-feedback{{ $errors->has('address ') ? ' has-error' : '' }}">
                            <label for="address"> {{ __('Address') }}</label>

                            <input type="text" name="address" value="{{ old('address') ?: $admin->address }}"
                                class="form-control" placeholder="{{ __('Address') }}">

                            @if ($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            @endif
                        </div>


                        <div
                            class="form-group has-feedback{{ $errors->has('contact_numbers ') ? ' has-error' : '' }}">
                            <label for="contact_numbers"> {{ __('Contact Numbers') }}</label>

                            <input type="text" name="contact_numbers"
                                value="{{ old('contact_numbers') ?: $admin->contact_numbers }}"
                                class="form-control" placeholder="{{ __('Contact Numbers') }}">

                            @if ($errors->has('contact_numbers'))
                                <span class="help-block">{{ $errors->first('contact_numbers') }}</span>
                            @endif
                        </div>

                        <div class="form-group  ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="active" id="active"
                                    {{ $admin->active ? 'checked' : '' }}>

                                <label class="form-check-label" for="active">
                                    {{ __('Active') }}
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-primary">Update @if ($type == 'depo')
                                GM
                            @elseif($type == 'distributor')
                                Distributor
                            @elseif($type == 'dealer')
                                SMO
                            @elseif($type == 'agent')
                                SR
                            @else

                            @endif</button>


                </div>

            </div>

        </div>

        <div class="col-sm-6">
            <div class="card card-widget">
                @if ($type == 'agent')

                    <div class="card-header with-border">
                        <h3 class="card-title">Sr Commissions</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($srCommissions as $com)
                                <li class="list-group-item">{{ $com->category->name ?? '' }} :
                                    {{ $com->commission }}%</li>

                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="container px-4">
                    @if (isset($categories))
                        <div class="text-bold mb-2">
                            Change Commissions
                        </div>
                        @foreach ($categories as $category)
                            <div class="form-group pb-3 border-bottom">
                                <div class="input-group">
                                    <label class="col-sm-5 form-check-label" for="active">
                                        <input class="form-check-input" type="checkbox"
                                            id="active_cat_{{ $category->id }}"
                                            onchange="toggleCatComission({{ $category->id }},{{ $category->sr_commission }})">
                                        {{ $category->name ?? '' }}
                                    </label>
                                    <input class="col-sm-7 form-control" type="number" min="0" max="100" step="0.01"
                                        value="" name="category_{{ $category->id }}"
                                        id="category_{{ $category->id }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
            </form>
            {{-- <div class="card card-widget">
            <div class="card-header with-border">
              <h3 class="card-title"><i class="fas fa-table"></i>
              Balance Transfer to @if ($type == 'depo')
                  GM
            @elseif($type == 'distributor')
            Distributor
            @elseif($type == 'dealer')
            SMO
            @elseif($type == 'agent')
            SR
              @else

              @endif
              : (Current Balance: {{ env('CURRENCY_CODE') }} {{ $admin->balance }})
            </h3>

            </div>

            <div class="card-body">

              <form method="post" action="{{ route('admin.paymentAddToRole',['type' => $type, 'role'=> $admin]) }}">

                @csrf

                <div class="form-group has-feedback{{ $errors->has('amount ') ? ' has-error' : '' }}">
                <label for="amount">Amount: </label>

                  <input type="number" min="1" step="1" max="{{ $wb->system_balance }}" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="New Amount">

                  @if ($errors->has('amount'))
                    <span class="help-block">{{ $errors->first('amount') }}</span> <br>
                  @endif
                  <span class="help-block w3-text-tiny">System Balance: {{ env('CURRENCY_CODE') }} {{ $wb->system_balance }}</span>

              </div>


              <div class="form-group has-feedback{{ $errors->has('description ') ? ' has-error' : '' }}">
                <label for="description"> {{ __('Note') }}</label>

                  <input type="text" name="description" value="{{ old('description')}}" class="form-control" placeholder="{{ __('Note') }}">

                  @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                  @endif
              </div>

              <button class="btn btn-sm btn-primary">Add New Amount</button>

              </form>

              <br>

              <div class="text-muted">Last Transaction</div>

              @if ($rtp = $admin->lastSystemBalanceReceived())
                 <div class="text-muted">
                  {{ env('CURRENCY_CODE') }} {{ $rtp->transfer_amount }} ({{ $rtp->created_at }}) ({{ $rtp->note }})
                 </div>
              @endif

            </div>
          </div> --}}



            {{-- <div class="card card-widget">
            <div class="card-header with-border">
              <h3 class="card-title"><i class="fas fa-table"></i>
              Balance Receive from @if ($type == 'depo')
                  GM
            @elseif($type == 'distributor')
            Distributor
            @elseif($type == 'dealer')
            SMO
            @elseif($type == 'agent')
            SR
              @else

              @endif: (Current Balance: {{ env('CURRENCY_CODE') }} {{ $admin->balance }})</h3>

            </div>

            <div class="card-body">

              <form method="post" action="{{ route('admin.paymentReceiveFromRole',['type' => $type, 'role'=> $admin]) }}">

                @csrf

                <div class="form-group has-feedback{{ $errors->has('receive_amount ') ? ' has-error' : '' }}">
                <label for="receive_amount">Amount: </label>

                  <input type="number" min="1" step="1" max="{{ $admin->balance }}" name="receive_amount" value="{{ old('receive_amount') }}" class="form-control" placeholder="Receivable Amount">

                  @if ($errors->has('receive_amount'))
                    <span class="help-block">{{ $errors->first('receive_amount') }}</span> <br>
                  @endif
                  <span class="help-block w3-text-tiny">System Balance: {{ env('CURRENCY_CODE') }} {{ $wb->system_balance }}</span>

              </div>

              <div class="form-group has-feedback{{ $errors->has('note ') ? ' has-error' : '' }}">
                <label for="note"> {{ __('Note') }}</label>

                  <input type="text" name="note" value="{{ old('note')}}" class="form-control" placeholder="{{ __('Note') }}">

                  @if ($errors->has('note'))
                    <span class="help-block">{{ $errors->first('note') }}</span>
                  @endif
              </div>

              <button class="btn btn-sm btn-primary">Receive Amount</button>

              </form>

              <br>

              <div class="text-muted">Last Transaction</div>

              @if ($sfa = $admin->lastSentToSystemBalance())
                 <div class="text-muted">
                  {{ env('CURRENCY_CODE') }} {{ $sfa->transfer_amount }} ({{ $sfa->created_at }}) ({{ $sfa->note }})
                 </div>
              @endif




            </div>
          </div> --}}

        </div>
    </div>
    <!-- /.row -->



</section>

@push('js')
    <script>
        function newuser() {
            $('#userField').html(`
      <label for="user">New User Name:</label>
        <input type="text" name="name" class="form-control mb-3" placeholder="Name">
      <label for="user">New User Mobile:</label>
        <input type="text" name="new_user_mobile" class="form-control" placeholder="ex. 015XXXXXXXX">
        `)
            $('#addUserButton').remove()
        }
        $('#distributor').on('change', function() {
            var distributor = $('#distributor').val();
            $.ajax({
                url: `/ajax/distributor/${distributor}/upazila/get`,
                success: function(result) {

                    $('#upazila').html(`
              `)
                    result.forEach(element => {
                        $('#upazila').append(`
                  <option value="${element.id}">${element.name} / ${element.bn_name}</option>
                `)
                    });
                }
            });
        });
        $('#depo').on('change', function() {
            var depo = $('#depo').val();
            $.ajax({
                url: `/ajax/depo/${depo}/district/get`,
                success: function(result) {
                    $('#district').html(`
              `)
                    result.forEach(element => {
                        $('#district').append(`
                  <option value="${element.id}">${element.name} / ${element.bn_name}</option>
                `)
                    });
                }
            });
        });

        function toggleCatComission(id, value) {
            var checkBox = $('#active_cat_' + id)
            if (checkBox[0].checked == true) {
                $('#category_' + id).val(value)
            } else {
                $('#category_' + id).val(0)
            }
        }
    </script>
@endpush
