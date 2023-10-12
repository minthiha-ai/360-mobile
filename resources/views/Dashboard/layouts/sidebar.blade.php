<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        {{-- <a href="/" class="logo logo-dark ">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="80">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="170">
                    </span>
        </a> --}}
        <!-- Light Logo-->
        {{-- <a href="/" class="logo logo-light ">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="80">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('images/logo.png') }}" alt="" height="170">
                    </span>
        </a> --}}
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" >
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link @yield('dashboard')" href="{{ route('home') }}"  >
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @yield('user_index')" href="{{ route('user.index') }}" >
                        <i class=" ri-team-line"></i> <span data-key="t-dashboards">Customers</span>
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @yield('advice_letters')" href="{{ route('advice.index') }}" >
                        <i class="ri-file-paper-line"></i> <span data-key="t-dashboards">Recommendation Letters</span>
                    </a>
                </li>


                <li class="menu-title"><span data-key="t-menu">Banner Manager</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#BannerDashboards" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="BannerDashboards">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Banner</span>
                    </a>
                    <div class="collapse menu-dropdown" id="BannerDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('banner.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-menu">Product Manager</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#ProductDashboards" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="ProductDashboards">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Products</span>
                    </a>
                    <div class="collapse menu-dropdown" id="ProductDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" data-key="t-crm"> Lists </a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="menu-title"><span data-key="t-menu">Blog Manager</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#ProductBlog" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="ProductBlog">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Blog</span>
                    </a>
                    <div class="collapse menu-dropdown" id="ProductBlog">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item @yield('blog_create')" >
                                <a href="{{ route('blog.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                            <li class="nav-item @yield('blog_index')" >
                                <a href="{{ route('blog.index') }}" class="nav-link" data-key="t-analytics"> List
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title"><span data-key="t-menu">Category Manager</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#ProductCategory" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="ProductCategory">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Category</span>
                    </a>
                    <div class="collapse menu-dropdown" id="ProductCategory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item @yield('category_create')" >
                                <a href="{{ route('category.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand.create') }}" class="nav-link" data-key="t-analytics">
                                    Brand
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-menu">Payment Manager</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#PaymentDashboards" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="PaymentDashboards">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Payment</span>
                    </a>
                    <div class="collapse menu-dropdown" id="PaymentDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('payment.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-menu">Region Manager</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#RegionDashboards" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="RegionDashboards">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Region</span>
                    </a>
                    <div class="collapse menu-dropdown" id="RegionDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('region.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title"><span data-key="t-menu">Deliveryfee Manager</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#DelifeeDashboards" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="DelifeeDashboards">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Delifee</span>
                    </a>
                    <div class="collapse menu-dropdown" id="DelifeeDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('deliveryfee.create') }}" class="nav-link" data-key="t-analytics"> Create
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="menu-title"><span data-key="t-menu">Order Manager</span></li>
                <li class="nav-item mb-5 pb-5 ">
                    <a class="nav-link menu-link" href="#OrderDashboards" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="OrderDashboards">
                        <i class="ri-product-hunt-fill"></i> <span data-key="t-dashboards">Order</span>
                    </a>
                    <div class="collapse menu-dropdown" id="OrderDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('orderList') }}" class="nav-link" data-key="t-analytics"> Order List
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/order_list?status=0') }}" class="nav-link" data-key="t-analytics"> Pending Order
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/order_list?status=1') }}" class="nav-link" data-key="t-analytics"> Confirmed Order
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/order_list?status=2') }}" class="nav-link" data-key="t-analytics"> Completed Order
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/order_list?status=3') }}" class="nav-link" data-key="t-analytics"> Cancel Order
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
