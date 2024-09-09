<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- need to remove -->
                <li class="nav-item">
                    <a href="{{ route('admindashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="{{ route('plan') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Plan</p>
                    </a>
                </li> -->
                @if(Auth::user()->usertype_id == 1)
                <li class="nav-item">
                    <a href="{{ route('category') }}" class="nav-link">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>Category</p>
                    </a>
                </li> 
                @endif
                <!-- <li class="nav-item">
                    <a href="{{ route('attribute') }}" class="nav-link">
                        <i class="nav-icon fa fa-tag"></i>
                        <p>Attribute</p>
                    </a>
                </li>   

                <li class="nav-item">
                    <a href="{{ route('catattribute') }}" class="nav-link">
                        <i class="nav-icon fa fa-link"></i>
                        <p>Link Attribute</p>
                    </a>
                </li>   -->
                @if(Auth::user()->usertype_id == 3)
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>Products</p>
                        </a>
                </li>    
                @endif

                <li class="nav-item">
                    <a href="{{ route('orders') }}" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>Pending Orders</p>
                        </a>
                </li>    

                @if(Auth::user()->usertype_id == 1)
                <li class="nav-item">
                    <a href="{{ route('seller') }}" class="nav-link">
                        <i class="nav-icon fa fa-store"></i>
                        <p>Seller</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>

</aside>


