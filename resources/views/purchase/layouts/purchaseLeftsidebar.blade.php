
<?php
$requsitionCount = (new \App\Globals\Counts())->requisitionCount();
$productCount = (new \App\Globals\Counts())->porductCount();
$stockCount = (new \App\Globals\Counts())->stocks();
$productionCount = (new \App\Globals\Counts())->production();
?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-indigo elevation-2">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-indigo text-center">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
           <img class="" style="max-width: 80px; max-height:80px" src="{{ asset('img/dhpl.jpg') }}" alt="">
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ route('purchase.dashboard') }}" class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Dashboard') }}</p>
                </a>
              </li>
            </ul>
          </li>

          @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
          auth()->user()->selectRole('purchase')->hasPrefix('req'))
          <li class="nav-item has-treeview {{ session('lsbm') == 'requisition' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
                <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                <p>
                    {{ __('Requisition') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">


                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_list'))
                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'all']) }}" class="nav-link {{ session('lsbsm') == 'all' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('All Requisition') }} <span class="badge bg-success">{{$requsitionCount->total}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_pending'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'pending']) }}" class="nav-link {{ session('lsbsm') == 'pending' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Pending Requisition') }} <span class="badge bg-warning">{{$requsitionCount->pending}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_approved'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'approved']) }}" class="nav-link {{ session('lsbsm') == 'approved' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Approved Requisition') }} <span class="badge bg-danger">{{$requsitionCount->approved}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_pending_purchase'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'pending_purchase']) }}" class="nav-link {{ session('lsbsm') == 'pending_purchase' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Pending Purchase Requi') }} <span class="badge bg-success">{{$requsitionCount->pending_purchase}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_approved_purchase'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'approved_purchase']) }}" class="nav-link {{ session('lsbsm') == 'approved_purchase' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Approved Purchase Requi') }} <span class="badge bg-danger">{{$requsitionCount->approved_purchase}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_purchase'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'purchase']) }}" class="nav-link {{ session('lsbsm') == 'purchase' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Purchase Requisition') }} <span class="badge bg-success">{{$requsitionCount->purchase}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_collected'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'collected']) }}" class="nav-link {{ session('lsbsm') == 'collected' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Collected Requisition') }} <span class="badge bg-success">{{$requsitionCount->collected}}</span></p>
                    </a>
                </li>
                @endif

                @if (auth()->user()->selectRole('purchase')->permissionCount() < 1 ||
                auth()->user()->selectRole('purchase')->hasPermission('req_stocked'))

                <li class="nav-item ">
                    <a href="{{ route('purchase.requisitions',['type'=>'stocked']) }}" class="nav-link {{ session('lsbsm') == 'stocked' ? ' active ' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('Stocked Requisition') }} <span class="badge bg-success">{{$requsitionCount->stocked}}</span></p>
                    </a>
                </li>
                @endif


            </ul>
        </li>
        @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
