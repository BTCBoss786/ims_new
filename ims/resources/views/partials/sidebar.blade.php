<aside class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" data-bs-backdrop="false" tabindex="-1" id="offcanvas">
   <div class="offcanvas-body">
      <div class="navbar-dark">
         <ul class="navbar-nav">
            <li class="mb-1">
               <div class="text-muted small fw-bold text-uppercase">Core</div>
            </li>
            <li>
               <a href="{{ route('dashboard') }}" class="nav-link py-1 ps-3 @if (Route::is('dashboard')) active @endif">Dashboard</a>
            </li>
            <li class="mt-4 mb-1">
               <div class="text-muted small fw-bold text-uppercase">Master</div>
            </li>
            <li>
               <a href="{{ route('customer.index') }}" class="nav-link py-1 ps-3 @if (Route::is('customer.*')) active @endif">Customer</a>
            </li>
            <li>
               <a href="{{ route('inventory.index') }}" class="nav-link py-1 ps-3 @if (Route::is('inventory.*')) active @endif">Inventory</a>
            </li>
            <li class="mt-4 mb-1">
               <div class="text-muted small fw-bold text-uppercase">Transaction</div>
            </li>
            <li>
               <a href="{{ route('invoice.index') }}" class="nav-link py-1 ps-3 @if (Route::is('invoice.*')) active @endif">Invoice</a>
            </li>
         </ul>
      </div>
   </div>
</aside>