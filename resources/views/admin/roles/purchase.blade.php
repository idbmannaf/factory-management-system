@extends('admin.layouts.adminMaster')
@section('title', 'Admin List')

@push('css')

<link href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css') }}">


@endpush

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Purchase All</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Purchase All</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<!-- Main content -->
<section class="content">


    <div class="container-fluid">

        <div class="">

            <div class="">


                <!-- Info cardes -->
                <div class="row">
                    <div class="col-md-12">

                        @include('alerts.alerts')

                        <div class="card card-widget">
                            <div class="card-header with-border">
                                <h3 class="card-title"><i class="fa fa-th"></i> All Purchase
                                    <span data-href="{{ route('downloadNow', ['type' => 'role', 'status' => 'admin']) }}"
                                        id="export" class="btn btn-success btn-sm float-right"
                                        onclick="exportTasks(event.target);"> <i class="fas fa-download"></i>
                                        Export</span>
                                </h3>
                                <div class="float-right">
                                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Add
                                        New Purchase</a>


                                </div>


                            </div>

                            <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Temp. Password</th>
                                            <th>NID</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($usersAll as $user)
                                            <tr>

                                                <td>{{ $user->user->name }}</td>
                                                <td>{{ $user->user->mobile }}</td>
                                                <td>{{ $user->user->password_temp }}</td>
                                                <td>{{ $user->user->nid }}</td>

                                                <td>

                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-sm btn-warning edit-cat" data-url="">Delete</button> -->
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-warning dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                Delete</button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>

                                                                    <form class="delete-admin"
                                                                        action="{{ route('admin.adminDelete', $user) }}"
                                                                        method="POST">
                                                                        {{ csrf_field() }}

                                                                        <button
                                                                            class="btn btn-xs btn-danger">Confirm</button>
                                                                    </form>


                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>





                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer text-center">
                                {{ $usersAll->render() }}
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->


            </div>
        </div>


    </div>



    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title ">Add New Purchase</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ route('admin.purchasePost') }}">
                        {{ csrf_field() }}


                        <div class="form-group" id="userField">
                            <label for="email">Email or Mobile:</label>


                            <select id="user" name="user" class="form-control select2-container step2-select select2"
                                data-placeholder="Name, Email, Usernam, or Mobile Number"
                                data-ajax-url="{{ route('admin.selectNewRole') }}" data-ajax-cache="true"
                                data-ajax-dataType="json" data-ajax-delay="200" style="width: 100%;">
                                <option>{{ old('user') }}</option>
                            </select>

                        </div>

                        <div class="form-group" id="addUserButton">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2" onclick="newuser()"
                                    style="cursor: pointer">
                                    <i class="fa fa-user-plus"></i> &nbsp; New user
                                </span>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>

            </div>

        </div>
    </div>


</section>

@push('js')
    <script>
        function newuser() {
            $('#userField').html(`
          <label for="user">New User Name:</label>
            <input type="text" name="name" class="form-control mb-3" placeholder="Name">
          <label for="user">New User Mobile:</label>
            <input type="text" name="new_user_mobile" class="form-control mb-3" placeholder="ex. 015XXXXXXXX">
          <label for="nid">National ID no.:</label>
            <input type="text" name="nid" class="form-control" placeholder="ex. 13XXXXXXXXXX">
            `)
            $('#addUserButton').remove()
        }
    </script>
    <script>
        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }
    </script>
@endpush


@endsection


@push('js')

<script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') }}"></script>

<script>
  $(document).ready(function () {
  $('.select2').select2({
    theme:'bootstrap4',
    minimumInputLength: 1,
    ajax: {
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        // alert(data[0].s);
        var data = $.map(data, function (obj) {
          obj.id = obj.id || obj.email;
          return obj;
        });
        var data = $.map(data, function (obj) {
          obj.text = obj.text || obj.email;
          return obj;
        });
        return {
          results: data,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      }
    },
  });
});
</script>
@endpush
