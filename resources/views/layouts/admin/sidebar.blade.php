<div style="width:250px; min-height:100vh; background:#198754; color:white;">

    <div class="p-3 fw-bold fs-5">
        ADMIN PANEL
    </div>

    <ul class="nav flex-column px-2">

        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                Dashboard
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('admin.produk.index') }}" class="nav-link text-white">
                Produk
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="{{ url('/') }}" class="nav-link text-warning">
                Ke Website
            </a>
        </li>

    </ul>

</div>