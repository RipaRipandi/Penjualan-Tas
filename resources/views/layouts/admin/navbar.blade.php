<nav class="navbar navbar-dark bg-success px-4">
    
    <span class="navbar-brand">Admin</span>

    <div class="d-flex align-items-center gap-3">

        <span class="text-white">
            {{ Auth::user()->name ?? 'Admin' }}
        </span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm btn-light">
                Logout
            </button>
        </form>

    </div>

</nav>