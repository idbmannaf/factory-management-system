<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0">
        <div class="header-container container-fluid px-lg-4">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="/">
                                <img alt="Order Management System" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="img/logo.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-links order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle-" href="/">
                                                Home
                                            </a>
                                        </li>
                                        @if (Route::has('login'))
                                        <li class="dropdown">
                                            @auth
                                            <a class="dropdown-item dropdown-toggle" href="#">
                                                <i class="fa fa-user"></i> &nbsp; {{ auth()->user()->email }}
                                            </a>
                                            @else
                                            <a class="dropdown-item dropdown-toggle" href="{{ route('login') }}">
                                                <i class="far fa-user"></i>
                                            </a>
                                            @endauth
                                            <ul class="dropdown-menu">
                                                @auth
                                                @if(Auth::user()->isAdmin())
            {{-- <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
              <i class="fas fa-th mr-2"></i> {{ __('Admin Dashboard') }}
            </a> --}}
            <li class="dropdown-submenu-">
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-th mr-2"></i> {{ __('Admin Dashboard') }}</a>
            </li>

            @endif

            @if(Auth::user()->hasDealerRole())

            @foreach(Auth::user()->dealers as $dealer)
              <li class="dropdown-submenu-">
                <a class="dropdown-item" href="{{ route('dealer.dashboard', $dealer) }}">
                    <i class="fas fa-user-circle mr-2"></i>
                    Dealer:  {{ custom_title($dealer->name, 10,'..') }}
                </a>
            </li>
              @endforeach
            @endif

            @if(Auth::user()->hasAgentRole())

            @foreach(Auth::user()->agents as $agent)
              <li class="dropdown-submenu-">
                <a class="dropdown-item" href="{{ route('agent.dashboard', $agent) }}">
                    <i class="fas fa-user-circle mr-2"></i>
                    Agent: {{ custom_title($agent->name,10,'..') }}
                </a>
            </li>
              @endforeach
              @endif
                                                <li class="dropdown-submenu-">
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                      </form>
                                                </li>
                                                @else
                                                <li class="dropdown-submenu-">
                                                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                                </li>
                                                <li class="dropdown-submenu-">
                                                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                                </li>
                                                @endauth
                                            </ul>
                                        </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2 mr-2 mr-lg-0">
                            <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                <a href="#" class="header-nav-features-toggle" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
                                <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed" id="headerTopSearchDropdown">
                                    <form role="search" action="page-search-results.html" method="get">
                                        <div class="simple-search input-group">
                                            <input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
                                            <span class="input-group-append">
                                                <button class="btn" type="submit">
                                                    <i class="fa fa-search header-nav-top-icon"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="header-nav-feature header-nav-features-cart d-inline-flex ml-2">
                                <a href="#" class="header-nav-features-toggle">
                                    <img src="img/icons/icon-cart.svg" width="14" alt="" class="header-nav-top-icon-img">
                                    <span class="cart-info d-none">
                                        <span class="cart-qty">1</span>
                                    </span>
                                </a>
                                <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed" id="headerTopCartDropdown">
                                    <ol class="mini-products-list">
                                        <li class="item">
                                            <a href="#" title="Camera X1000" class="product-image"><img src="img/products/product-1.jpg" alt="Camera X1000"></a>
                                            <div class="product-details">
                                                <p class="product-name">
                                                    <a href="#">Camera X1000 </a>
                                                </p>
                                                <p class="qty-price">
                                                     1X <span class="price">$890</span>
                                                </p>
                                                <a href="#" title="Remove This Item" class="btn-remove"><i class="fas fa-times"></i></a>
                                            </div>
                                        </li>
                                    </ol>
                                    <div class="totals">
                                        <span class="label">Total:</span>
                                        <span class="price-total"><span class="price">$890</span></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-dark" href="#">View Cart</a>
                                        <a class="btn btn-primary" href="#">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
