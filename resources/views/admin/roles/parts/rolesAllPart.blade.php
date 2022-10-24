@push('css')
    <style>
        tr.nowrap td {
            white-space: nowrap;
        }

    </style>
@endpush
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4">
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
                    <small>All</small>
                </h1>
            </div>
            <div class="col-md-5">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="query" id="searchQuery"
                        placeholder="Name, Mobile, Role name, NID">
                    <input type="hidden" name="url" id="url" value="{{ route('admin.roles.search', [$type]) }}">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary"><i class="fa fa-search" id="searchIcon"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">
                            @if ($type == 'depo')
                                GM
                            @elseif($type == 'dealer')
                                SMO
                            @elseif($type == 'agent')
                                SR
                            @else

                            @endif
                        </a></li>
                    <li class="breadcrumb-item active">All</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">




    <!-- Info cardes -->
    <div class="row">
        <div class="col-md-12">

            @include('alerts.alerts')

            <div class="card card-widget">
                <div class="card-header with-border">
                    <h3 class="card-title"><i class="fa fa-th"></i> All @if ($type == 'depo')
                            GM
                        @elseif($type == 'dealer')
                            SMO
                        @elseif($type == 'agent')
                            SR
                        @else

                        @endif
                    </h3>

                    <div class="float-right">

                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Add New
                            @if ($type == 'depo')
                                GM
                            @elseif($type == 'dealer')
                                SMO
                            @elseif($type == 'agent')
                                SR
                            @else

                            @endif
                        </a>


                    </div>
                </div>

                <div class="card-body table-responsive" style="min-height: 75vh;">
                    <table class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Temp. password</th>

                                <th>Role Name</th>
                                <th>NID</th>
                                @if ($type == 'dealer')
                                    <th>Area</th>

                                @elseif($type == 'agent')
                                <th>Area</th>
                                    <th>SMO</th>
                                    <th>Account</th>

                                @endif
                                <th>Address</th>

                                {{-- <th>Contacts</th> --}}
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @include('admin.roles.parts.rolesTableBody')
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-center" id="pagination">
                    {{ $rolesAll->appends(['type' => $type])->render() }}
                </div>
            </div>

        </div>
    </div>
    <!-- /.row -->

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">{{ __('Add New') }}
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
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="card card-widget">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="" method="post"
                            action="{{ route('admin.roleAddNewPost', $type) }}">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group has-feedback{{ $errors->has('user') ? ' has-error' : '' }}"
                                    id="userField">
                                    <div class="input-group">
                                        <label for="user"> {{ __('User') }}:</label>

                                        <select id="user" name="user"
                                            class="form-control select2-container step2-select select2"
                                            data-placeholder="Mobile or Email"
                                            data-ajax-url="{{ route('admin.selectNewRole') }}" data-ajax-cache="true"
                                            data-ajax-dataType="json" data-ajax-delay="200" style="width: 100%;">
                                            <option>{{ old('user') }}</option>
                                        </select>
                                        @if ($errors->has('user'))
                                            <span class="help-block">{{ $errors->first('user') }}</span>
                                        @endif
                                    </div>
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

                                    <div class="form-group has-feedback{{ $errors->has('gm') ? ' has-error' : '' }}">
                                        <label for="gm">GM:</label>

                                        <select class="form-control select2" name="gm" id="gm">
                                            <option value="">Select GM</option>
                                            @foreach ($depo as $gm)
                                                <option value="{{ $gm->id }}">{{ $gm->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback{{ $errors->has('area') ? ' has-error' : '' }}">
                                        <label for="area">Area:</label>

                                        <input type="text" name="area" class="form-control" placeholder="Area....">
                                    </div>


                                @elseif($type == 'agent')
                                <div class="form-group has-feedback{{ $errors->has('area') ? ' has-error' : '' }}">
                                  <label for="area">Area:</label>

                                  <input type="text" name="area" class="form-control" placeholder="Area....">
                              </div>
                                    <div
                                        class=" form-group has-feedback{{ $errors->has('dealer') ? ' has-error' : '' }}">
                                        <label for="dealer">SMO:</label>
                                        <select style="width:100%;" class="form-control select2" name="dealer"
                                            id="dealer">
                                            <option value="">Select SMO</option>
                                            @foreach ($dealers as $dealer)
                                                <option value="{{ $dealer->id }}">{{ $dealer->name }}
                                                    ({{ $dealer->user ? $dealer->user->name : '' }}({{ $dealer->user ? $dealer->user->mobileOrEmail() : '' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div
                                        class=" form-group has-feedback{{ $errors->has('monthly_target') ? ' has-error' : '' }}">
                                        <label for="monthly_target">Monthly Target:</label>
                                        <input class="form-control" type="number" name="monthly_target"
                                            id="monthly_target" value="{{ old('monthly_target') }}"
                                            placeholder="ex. 100000">
                                    </div>
                                @endif

                                <div class="form-group has-feedback{{ $errors->has('nid ') ? ' has-error' : '' }}">
                                    <label for="nid">National ID no.</label>
                                    <input type="text" class="form-control" name="nid" id="nid"
                                        value="{{ old('nid') }}" placeholder="ex. 13XXXXXXXXXX" required>
                                </div>


                                <div class="form-group has-feedback{{ $errors->has('title ') ? ' has-error' : '' }}">
                                    <label for="title">
                                        Role Name:</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                        placeholder="@if ($type == 'depo') GM @elseif($type == 'distributor') Distributor @elseif($type == 'dealer') SMO @elseif($type == 'agent') SR @else @endif Name">

                                    @if ($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                    @endif

                                </div>



                                <div
                                    class="form-group has-feedback{{ $errors->has('address ') ? ' has-error' : '' }}">
                                    <label for="address"> {{ __('Address') }}</label>

                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="form-control" placeholder="{{ __('Address') }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>


                                <div
                                    class="form-group has-feedback{{ $errors->has('contact_numbers ') ? ' has-error' : '' }}">
                                    <label for="contact_numbers"> {{ __('Mobile Number') }}</label>

                                    <input type="text" name="contact_numbers" value="{{ old('contact_numbers') }}"
                                        class="form-control" placeholder="{{ __('Contact Numbers') }}">

                                    @if ($errors->has('contact_numbers'))
                                        <span class="help-block">{{ $errors->first('contact_numbers') }}</span>
                                    @endif
                                </div>

                                <div class="form-group  ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="active" id="active"
                                            {{ old('active') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="active">
                                            {{ __('Active') }}
                                        </label>
                                    </div>
                                </div>
                                @if (isset($categories))
                                    <div class="h5 mb-2">
                                        SR Commissions
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="form-group pb-3 border-bottom">
                                            <div class="input-group">

                                                <label class="col-sm-5 form-check-label" for="active">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="active_cat_{{ $category->id }}" checked
                                                        onchange="toggleCatComission({{ $category->id }},{{ $category->sr_commission }})">
                                                    {{ $category->name }}
                                                </label>
                                                <input class="col-sm-7 form-control" type="number" min="0" max="100"
                                                    step="0.01" value="{{ $category->sr_commission }}"
                                                    name="category_{{ $category->id }}"
                                                    id="category_{{ $category->id }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @endif

                                <button class="btn btn-sm btn-primary">Create @if ($type == 'depo')
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
                            <!-- /.card-body -->

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>




</section>


@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function toggleCatComission(id, value) {
            var checkBox = $('#active_cat_' + id)
            if (checkBox[0].checked == true) {
                $('#category_' + id).val(value)
            } else {
                $('#category_' + id).val(0)
            }
        }

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

        $('#searchQuery').on('keyup', function() {
            $('#searchIcon').toggleClass('fa fa-search')
            $('#searchIcon').toggleClass('fas fa-spinner fa-spin')
            var query = $('#searchQuery').val()
            var url = $('#url').val()
            axios.get(url + '?q=' + query).then(res => {
                $('#pagination').hide()
                $('#tableBody').html(res.data)
                $('#searchIcon').toggleClass('fa fa-search')
                $('#searchIcon').toggleClass('fas fa-spinner fa-spin')
            });
        });
    </script>
@endpush
