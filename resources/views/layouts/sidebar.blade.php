<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#" target="_blank">DutConv</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#" target="_blank">DTV</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ (request()->routeIs('product-units*')) ? 'active' : '' }}">
                <a href="{{ route('product-units.index') }}" class="nav-link">
                    <i class="fas fa-balance-scale"></i><span>Product Units</span>
                </a>
            </li>            
        </ul>
    </aside>
</div>