{{ $routeName = request()->route()->getName() }}
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/home">Cahaya Komputer</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/home">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $routeName === 'Admin' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    {{-- <li><a class="nav-link" href="index-0.html">General Dashboard</a></li> --}}
                    <li class="{{ $routeName === 'Admin' ? 'active' : '' }}"><a class="nav-link" href="/home">Home</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Data Master</li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Produk Katalog</a></li>
                </ul>
            </li> --}}
            <li class="{{ $routeName === 'ProductList' || $routeName === 'CreateProduct' ? 'active' : '' }}">
                <a class="nav-link" href="/products">
                    <i class="fas fa-cube"></i><span>Produk Katalog</span>
                </a>
            </li>
            {{-- <li><a class="nav-link" href="/home"><i class="fas fa-users"></i> <span>Pelanggan</span></a></li> --}}
            <li class="menu-header">Transaksi</li>
            <li class=" {{ $routeName === 'TransList' || $routeName === 'TransDetail' ? 'active' : '' }}"><a
                    class="nav-link" href="/transaksi">
                    <i class="fas fa-shopping-cart"></i><span>Daftar
                        Transaksi</span></a>
            </li>
            <li class="menu-header">Service</li>
            <li><a class="nav-link" href="/home"><i class="fas fa-money-bill"></i><span>Daftar
                        Service</span></a></li>
        </ul>
    </aside>
</div>
