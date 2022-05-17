<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand mb-0 h1" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard', '/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customers') ? 'active' : '' }}" href="{{ route('customers') }}">
                        <i class="fa-solid fa-people-group"></i>
                        Customer
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('inventories') ? 'active' : '' }}" href="{{ route('inventories') }}">
                        <i class="fa-solid fa-list"></i>
                        Inventory
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('invoices') ? 'active' : '' }}" href="{{ route('invoices') }}">
                        <i class="fa-solid fa-file-invoice"></i>
                        Invoice
                    </a>
                </li>
                {{--<li class="nav-item">
                   <a class="nav-link" href="{{ route('logout') }}">
                      <i class="fa-solid fa-right-from-bracket"></i>
                      Logout
                   </a>
                </li>--}}
            </ul>
        </div>
    </div>
</nav>
