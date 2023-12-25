<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menus</div>
            <div class="d-flex flex-column gap-2">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.customer.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                    Customers
                </a>
                <a class="nav-link" href="{{ route('admin.product.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                    Products
                </a>
                <a class="nav-link" href="{{ route('admin.payment.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill"></i></div>
                    Payments
                </a>
                <a class="nav-link" href="{{ route('admin.contact.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                    Admin Contacts
                </a>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ session('user_name') }}
    </div>
</nav>