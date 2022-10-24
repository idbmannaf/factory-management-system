@extends('admin.layouts.adminMaster')


@push('css')

 
@endpush



@section('content')

 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              {{ ucfirst($type) }}
              <small>All</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ ucfirst($type) }}</a></li>
              <li class="breadcrumb-item active">All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content"> 

      <div class="row">
      <div class="col-md-12">

        <div class="card card-primary">
          <div class="card-header">
            <div class="float-right">
            <a  class="btn btn-default w3-white" href="{{ route('admin.rolesAllType', $type) }}">All {{ ucfirst($type) }} At-a-glance</a>
              
            </div>
          </div>
          <div class="card-body bg-primary">
      

              @foreach($divisions as $div)
                
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title w3-white">
                      {{ $div->name }}
                    </h3>
                  </div>
                  <div class="card-body">
                     <div class="row">

                      @if($type == 'depot')
                      <?php $admins = $div->depots; ?>
                      @elseif($type == 'distributor')
                      <?php $admins = $div->distributors; ?>
                      @elseif($type == 'dealer')
                      <?php $admins = $div->dealers; ?>
                      @elseif($type == 'agent')
                        <?php $admins = $div->agents; ?>
                      @endif

                      @foreach($admins as $admin)
              
                        <div class="col-sm-3">
                          
                          <div class="card w3-round">
                            <div class="card-body w3-round {{ $admin->active ? 'w3-blue' : 'w3-light-gray' }}">
                              
                              @if($admin->active)
                                <i class="fa fa-check-circle fa-2x w3-text-white"></i>
                                <br>
                                <p>
                                  <span class="">{{ $admin->title }}</span> <br>
                                  Division: {{ $admin->division->name }} <br>

                                  @if($admin->district_id)
                                  District: {{ $admin->district_id ? $admin->district->name : '' }} <br>
                                  @endif
                                  @if($admin->upazila_id)
                                  Upazila: {{ $admin->upazila_id ? $admin->upazila->name : '' }}
                                  @endif
                                </p>                      
                              @else
                                <i class="fa fa-th fa-2x w3-text-gray"></i>
                                <br>
                                <p>
                                  <span class="">{{ $admin->title }}</span> <br>
                                  Division: {{ $admin->division->name }} <br>

                                  @if($admin->district_id)
                                  District: {{ $admin->district_id ? $admin->district->name : '' }} <br>
                                  @endif
                                  @if($admin->upazila_id)
                                  Upazila: {{ $admin->upazila_id ? $admin->upazila->name : '' }}
                                  @endif
                                </p>
                                 
                              @endif
                            </div>
                          </div>
                        </div>
                      @endforeach
                       
                     </div>
                  </div>
                </div>
              @endforeach



      
          </div>
        </div>
      </div>
      </div>

    </section>
	 
@endsection


@push('js')

@endpush