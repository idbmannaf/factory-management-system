<!-- Main Sidebar Container -->
<?php
$requsitionCount = (new \App\Globals\Counts())->requisitionCount();
$productCount = (new \App\Globals\Counts())->porductCount();
$stocksCount = (new \App\Globals\Counts())->stocks();
$productionCount = (new \App\Globals\Counts())->production();
$afterProccessingProduct = (new \App\Globals\Counts())->afterProccessingProduct();

?>
<aside class="main-sidebar sidebar-light-primary elevation-4 " style="overflow: scroll;">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-primary- w3-green text-center">
        {{-- <img src="{{ asset('img/dhpl.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8"> --}}
        <img class="" style="max-width: 80px; max-height:80px" src="{{ asset('img/dhpl.jpg') }}"
             alt="{{ env('APP_NAME') }}">
        {{-- <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview" role="menu"
                data-accordion="true">
                <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt w3-text-blue"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('admin.dashboard') }}"
                               class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview {{ session('lsbm') == 'roles' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle w3-text-blue"></i>
                        <p>
                            Role
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.adminsAll') }}"
                               class="nav-link  {{ session('lsbsm') == 'adminsAll' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Admins</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.production') }}"
                               class="nav-link  {{ session('lsbsm') == 'allProduction' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Production</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.accounts') }}"
                               class="nav-link  {{ session('lsbsm') == 'allAccounts' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Accounts</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.purchase') }}"
                               class="nav-link  {{ session('lsbsm') == 'allPurchase' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchases</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.factory_manager') }}"
                               class="nav-link  {{ session('lsbsm') == 'allFactoryManager' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Factory Manager</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'Materials' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle w3-text-blue"></i>
                        <p>
                            Materials
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('admin.materials',['type'=>'raw'])}}"
                               class="nav-link  {{ session('lsbsm') == 'RowMaterials' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Raw Materials</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.materials',['type'=>'pack'])}}"
                               class="nav-link  {{ session('lsbsm') == 'PackagingMaterials' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Packaging</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('admin.materials',['type'=>'stationery'])}}"
                               class="nav-link  {{ session('lsbsm') == 'stationeryMaterials' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stationeries</p>
                            </a>
                        </li>
                    </ul>

                </li>



                <li class="nav-item has-treeview {{ session('lsbm') == 'users' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-users w3-text-blue"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('admin.ecommerce.users') }}" class="nav-link {{ session('lsbsm') == 'all' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'suppliers' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle w3-text-blue"></i>
                        <p>
                           Supplier
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('admin.allSupplier')}}"
                               class="nav-link  {{ session('lsbsm') == 'allSubppliers' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Supplier</p>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'requisition' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Requisition') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.packagingRequisition') }}"
                                class="nav-link {{ session('lsbsm') == 'packagingRequisition' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Pack Requisition') }} </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.newRequisition') }}"
                                class="nav-link {{ session('lsbsm') == 'addRawRequisition' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Raw Requisition') }} </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.stationaryRequisition') }}"
                                class="nav-link {{ session('lsbsm') == 'addNewStationaryRequisition' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Add Stationary Requisition') }} </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'all']) }}" class="nav-link {{ session('lsbsm') == 'all' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Requisition') }} <span class="badge bg-success">{{$requsitionCount->total}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'pending']) }}" class="nav-link {{ session('lsbsm') == 'pending' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Requisition') }} <span class="badge bg-danger">{{$requsitionCount->pending}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'approved']) }}" class="nav-link {{ session('lsbsm') == 'approved' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Approved Requisition') }} <span class="badge bg-success">{{$requsitionCount->approved}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'pending_purchase']) }}" class="nav-link {{ session('lsbsm') == 'pending_purchase' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Purchase Requi') }} <span class="badge bg-success">{{$requsitionCount->pending_purchase}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'approved_purchase']) }}" class="nav-link {{ session('lsbsm') == 'approved_purchase' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Approved Purchase Requi') }} <span class="badge bg-success">{{$requsitionCount->approved_purchase}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'purchase']) }}" class="nav-link {{ session('lsbsm') == 'purchase' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Purchase Requisition') }} <span class="badge bg-success">{{$requsitionCount->purchase}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'collected']) }}" class="nav-link {{ session('lsbsm') == 'collected' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Collected Requisition') }} <span class="badge bg-danger">{{$requsitionCount->collected}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.requisitionList',['type'=>'stocked']) }}" class="nav-link {{ session('lsbsm') == 'stocked' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Stocked Requisition') }} <span class="badge bg-success">{{$requsitionCount->stocked}}</span></p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'stockedMaterials' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-users w3-text-blue"></i>
                        <p>
                            Stocked Materials
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>


                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('admin.stockedMaterials',['type'=>'raw']) }}" class="nav-link {{ session('lsbsm') == 'rawStockedMaterials' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Raw Stocked <span class="badge bg-success">{{$stocksCount->raw}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.stockedMaterials',['type'=>'pack']) }}" class="nav-link {{ session('lsbsm') == 'packStockedMaterials' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pack Stocked  <span class="badge bg-success">{{$stocksCount->pack}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.stockedMaterials',['type'=>'stationery']) }}" class="nav-link {{ session('lsbsm') == 'stationeryStockedMaterials' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stationery Stocked  <span class="badge bg-success">{{$stocksCount->stationery}}</span></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'category' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-users w3-text-blue"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories',['type'=>'raw']) }}" class="nav-link {{ session('lsbsm') == 'allRawCategory' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Raw Categories <span class="badge bg-success"></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('categories',['type'=>'pack']) }}" class="nav-link {{ session('lsbsm') == 'allPackCategory' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Pack Categories <span class="badge bg-success"></p>
                            </a>
                        </li>

                    </ul>
                </li>
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
                            <a href="{{ route('admin.allSamples') }}" class="nav-link {{ session('lsbsm') == 'allSamples' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Samples<span class="badge bg-success"></span></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'product' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Product Manufacturing') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'all'])}}"
                                class="nav-link {{ session('lsbsm') == 'allProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Products') }}  <span class="badge bg-success">{{$productCount->total}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'pending'])}}"
                                class="nav-link {{ session('lsbsm') == 'pendingProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Products') }} <span class="badge bg-danger">{{$productCount->pending}}</span></p>
                            </a>
                        </li><li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'confirmed'])}}"
                                class="nav-link {{ session('lsbsm') == 'confirmedProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Confirmed Products') }} <span class="badge bg-success">{{$productCount->confirmed}}</span></p>
                            </a>
                        </li><li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'processing'])}}"
                                class="nav-link {{ session('lsbsm') == 'processingProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Processing Products') }} <span class="badge bg-success">{{$productCount->processing}}</span></p>
                            </a>
                        </li><li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'packaging'])}}"
                                class="nav-link {{ session('lsbsm') == 'packagingProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Packaging Products') }} <span class="badge bg-success">{{$afterProccessingProduct->packaging}}</span></p>
                            </a>
                        {{-- </li><li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'ready_to_stock'])}}"
                                class="nav-link {{ session('lsbsm') == 'ready_to_stockProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Ready To Stock Products') }} <span class="badge bg-danger">{{$productCount->ready_to_stock}}</span></p>
                            </a>
                        </li> --}}
                        <li class="nav-item ">
                            <a href="{{route('admin.productManufacturing',['type'=>'in_stocked'])}}"
                                class="nav-link {{ session('lsbsm') == 'in_stockedProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('in stocked Products') }} <span class="badge bg-success">{{$afterProccessingProduct->stocked}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.productManufacturing', ['type' => 'rejected']) }}"
                                class="nav-link {{ session('lsbsm') == 'rejectedProduct' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Rejected Products') }} <span
                                        class="badge bg-danger">{{ $productCount->rejected }}</span></p>
                            </a>
                        </li>

                    </ul>
                </li>
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
                            <a href="{{route('admin.readyProducts')}}"
                                class="nav-link {{ session('lsbsm') == 'readyProductsAll' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Products') }} </p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item has-treeview {{ session('lsbm') == 'dailyProductions' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Daily Productions') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('admin.dailyProduction',['type'=>'all'])}}"
                               class="nav-link {{ session('lsbsm') == 'allProductions' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('All Productions') }}  <span class="badge bg-success">{{$productionCount->total}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.dailyProduction',['type'=>'pending'])}}"
                               class="nav-link {{ session('lsbsm') == 'pendingProductions' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Pending Productions') }} <span class="badge bg-warning">{{$productionCount->pending}}</span> </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.dailyProduction',['type'=>'rejected'])}}"
                               class="nav-link {{ session('lsbsm') == 'rejectedProductions' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Rejected Productions') }}  <span class="badge bg-danger">{{$productionCount->rejected}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.dailyProduction',['type'=>'approved'])}}"
                               class="nav-link {{ session('lsbsm') == 'approvedProductions' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Approved Productions') }}  <span class="badge bg-success">{{$productionCount->approved}}</span></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ session('lsbm') == 'report' ? ' menu-open ' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon w3-text-blue fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Reports') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{route('admin.report',['type'=>'payment'])}}"
                               class="nav-link {{ session('lsbsm') == 'payment' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Supplier Payment') }} </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.report',['type'=>'supplierdue'])}}"
                               class="nav-link {{ session('lsbsm') == 'supplierdue' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Supplier Due') }} </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('admin.report',['type'=>'supplierorder'])}}"
                               class="nav-link {{ session('lsbsm') == 'supplierorder' ? ' active ' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Supplier Orders') }} </p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

