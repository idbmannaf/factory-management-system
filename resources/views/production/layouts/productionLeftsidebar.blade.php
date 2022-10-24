<!-- Main Sidebar Container -->
<?php
$requsitionCount = (new \App\Globals\Counts())->requisitionCount();
$productCount = (new \App\Globals\Counts())->porductCount();
$stocksCount = (new \App\Globals\Counts())->stocks();
$productionCount = (new \App\Globals\Counts())->production();
$afterProccessingProduct = (new \App\Globals\Counts())->afterProccessingProduct();
?>

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
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('cp/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div> --}}
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview" role="menu"
                data-accordion="true">
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
                            <a href="{{ route('production.dashboard') }}"
                                class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Dashboard') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPrefix('materials'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'Materials' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-users w3-text-blue"></i>
                            <p>
                                Materials
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('raw_materials_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.materials', ['type' => 'raw']) }}"
                                        class="nav-link {{ session('lsbsm') == 'RawMaterials' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Raw Materials<span class="badge bg-success"></span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('pack_materials_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.materials', ['type' => 'pack']) }}"
                                        class="nav-link {{ session('lsbsm') == 'PackMaterials' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pack Materials<span class="badge bg-success"></span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('stationery_materials_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.materials', ['type' => 'stationery']) }}"
                                        class="nav-link {{ session('lsbsm') == 'stationeryMaterials' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stationery Materials<span class="badge bg-success"></span></p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPrefix('req'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'requisitions' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                            <p>
                                {{ __('Requisition') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'all']) }}"
                                        class="nav-link {{ session('lsbsm') == 'all' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('All Requisition') }} <span
                                                class="badge bg-success">{{ $requsitionCount->total }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_add'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.packagingRequisition') }}"
                                        class="nav-link {{ session('lsbsm') == 'packagingRequisition' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Add Pack Requisition') }} </p>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a href="{{ route('production.newRequisition') }}"
                                        class="nav-link {{ session('lsbsm') == 'addRawRequisition' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Add Raw Requisition') }} </p>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a href="{{ route('production.stationaryRequisition') }}"
                                        class="nav-link {{ session('lsbsm') == 'addNewStationaryRequisition' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Add Stationary Requisition') }} </p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_pending'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'pending']) }}"
                                        class="nav-link {{ session('lsbsm') == 'pending' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Pending Requisition') }} <span
                                                class="badge bg-warning">{{ $requsitionCount->pending }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_approved'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'approved']) }}"
                                        class="nav-link {{ session('lsbsm') == 'approved' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Approved Requisition') }} <span
                                                class="badge bg-success">{{ $requsitionCount->approved }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_pending_purchase'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'pending_purchase']) }}"
                                        class="nav-link {{ session('lsbsm') == 'pending_purchase' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Pending Purchase Requi') }} <span
                                                class="badge bg-success">{{ $requsitionCount->pending_purchase }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_approved_purchase'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'approved_purchase']) }}"
                                        class="nav-link {{ session('lsbsm') == 'approved_purchase' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Approved Purchase Requi') }} <span
                                                class="badge bg-success">{{ $requsitionCount->approved_purchase }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_purchase'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'purchase']) }}"
                                        class="nav-link {{ session('lsbsm') == 'purchase' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Purchase Requisition') }} <span
                                                class="badge bg-danger">{{ $requsitionCount->purchase }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_collected'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'collected']) }}"
                                        class="nav-link {{ session('lsbsm') == 'collected' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Collected Requisition') }} <span
                                                class="badge bg-success">{{ $requsitionCount->collected }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('req_stocked'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.requisitions', ['type' => 'stocked']) }}"
                                        class="nav-link {{ session('lsbsm') == 'stocked' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Stocked Requisition') }} <span
                                                class="badge bg-success">{{ $requsitionCount->stocked }}</span></p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPrefix('stock_list'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'stockedMaterials' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-users w3-text-blue"></i>
                            <p>
                                Stocked Materials
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('raw_stock_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.stockedMaterials', ['type' => 'raw']) }}"
                                        class="nav-link {{ session('lsbsm') == 'rawStockedMaterials' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Raw Stocked <span class="badge bg-success">{{ $stocksCount->raw }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('pack_stock_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.stockedMaterials', ['type' => 'pack']) }}"
                                        class="nav-link {{ session('lsbsm') == 'packStockedMaterials' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pack Stocked <span class="badge bg-success">{{ $stocksCount->pack }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('stationery_stock_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.stockedMaterials', ['type' => 'stationery']) }}"
                                        class="nav-link {{ session('lsbsm') == 'stationeryStockedMaterials' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stationery Stocked <span
                                                class="badge bg-success">{{ $stocksCount->stationery }}</span></p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('ready_product'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'readyProducts' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                            <p>
                                {{ __('Ready Products') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('production.readyProducts') }}"
                                    class="nav-link {{ session('lsbsm') == 'readyProductsAll' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('All Products') }} </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                @endif

                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('sample_list'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'samples' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-users w3-text-blue"></i>
                            <p>
                                Samples
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('production.allSamples') }}"
                                    class="nav-link {{ session('lsbsm') == 'allSamples' ? ' active ' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Samples<span class="badge bg-success"></span></p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPrefix('products'))
                    <li class="nav-item has-treeview {{ session('lsbm') == 'product' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                            <p>
                                {{ __('Product Manufacturing') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('all_products'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'all']) }}"
                                        class="nav-link {{ session('lsbsm') == 'allProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('All Products') }} <span
                                                class="badge bg-success">{{ $productCount->total }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('pending_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'pending']) }}"
                                        class="nav-link {{ session('lsbsm') == 'pendingProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Pending Products') }} <span
                                                class="badge bg-warning">{{ $productCount->pending }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('confirmed_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'confirmed']) }}"
                                        class="nav-link {{ session('lsbsm') == 'confirmedProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Confirmed Products') }} <span
                                                class="badge bg-danger">{{ $productCount->confirmed }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('processing_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'processing']) }}"
                                        class="nav-link {{ session('lsbsm') == 'processingProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Processing Products') }} <span
                                                class="badge bg-danger">{{ $productCount->processing }}</span></p>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('packaging_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'packaging']) }}"
                                        class="nav-link {{ session('lsbsm') == 'packagingProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Packaging Products') }} <span
                                                class="badge bg-danger">{{ $afterProccessingProduct->packaging }}</span></p>
                                    </a>
                                </li>
                            @endif

                            {{-- @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('ready_to_stock_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'ready_to_stock']) }}"
                                        class="nav-link {{ session('lsbsm') == 'ready_to_stockProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Ready To Stock Products') }} <span
                                                class="badge bg-success">{{ $productCount->ready_to_stock }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endif --}}

                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('in_stocked_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'in_stocked']) }}"
                                        class="nav-link {{ session('lsbsm') == 'in_stockedProduct' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('in stocked Products') }} <span
                                                class="badge bg-success">{{ $afterProccessingProduct->stocked }}</span></p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('rejected_products_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.productManufacturing', ['type' => 'rejected']) }}"
                                        class="nav-link {{ session('lsbsm') == 'rejected' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Rejected Products') }} <span
                                                class="badge bg-danger">{{ $productCount->rejected }}</span></p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPrefix('pproduction'))
                    <li
                        class="nav-item has-treeview {{ session('lsbm') == 'dailyProductions' ? ' menu-open ' : '' }}">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                            <p>
                                {{ __('Daily Productions') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('production_list'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.dailyProduction', ['type' => 'all']) }}"
                                        class="nav-link {{ session('lsbsm') == 'allProductions' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('All Productions') }} <span
                                                class="badge bg-success">{{ $productionCount->total }}</span></p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('production_pending'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.dailyProduction', ['type' => 'pending']) }}"
                                        class="nav-link {{ session('lsbsm') == 'pendingProductions' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Pending Productions') }} <span
                                                class="badge bg-warning">{{ $productionCount->pending }}</span> </p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('production_rejected'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.dailyProduction', ['type' => 'rejected']) }}"
                                        class="nav-link {{ session('lsbsm') == 'rejectedProductions' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Rejected Productions') }} <span
                                                class="badge bg-danger">{{ $productionCount->rejected }}</span></p>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->selectRole('production')->permissionCount() < 1 ||
    auth()->user()->selectRole('production')->hasPermission('production_approved'))
                                <li class="nav-item ">
                                    <a href="{{ route('production.dailyProduction', ['type' => 'approved']) }}"
                                        class="nav-link {{ session('lsbsm') == 'approvedProductions' ? ' active ' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('Approved Productions') }} <span
                                                class="badge bg-success">{{ $productionCount->approved }}</span></p>
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
