<div class="left-sidebar d-flex flex-column p-4">
    <div class="logo-title-container d-flex align-items-center mb-5">
        <div class="logo me-3">
            <img src="{{ asset('images/logo.png') }}" alt="The Journal Logo" class="header-logo-img" />
        </div>
        <h1 class="m-0 sidebar-title">The Journal</h1>
    </div>

    <nav class="nav flex-column gap-3">
        <a id="add-entry" class="d-flex align-items-center justify-content-center gap-2" href="{{ route('journals/create') }}">
            <i class="bi bi-plus"></i> New Entry
        </a>

        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <i class="bi bi-journals"></i> Your Journal
        </a>
                <a class="nav-link d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <i class="bi bi-person-circle"></i> Profile
        </a>
        <a class="nav-link d-flex align-items-center gap-2" href="{{ url('/trash') }}">
            <i class="bi bi-trash"></i> Recently deleted
        </a>
    </nav>

    <div class="sign-out-container mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link nav-link d-flex align-items-center gap-2 text-decoration-none">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>
