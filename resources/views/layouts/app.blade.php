<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Manang Betch Menu')</title>

    <!-- Bootstrap CSS (or use Tailwind if you prefer) -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Custom UP Maroon Theme -->
    <style>
      :root {
        --up-maroon: #800000;
        --up-maroon-dark: #5c0000;
        --up-maroon-light: #a01010;
      }
      .bg-maroon {
        background-color: var(--up-maroon) !important;
      }
      .btn-maroon {
        background-color: var(--up-maroon);
        border-color: var(--up-maroon);
        color: white;
      }
      .btn-maroon:hover {
        background-color: var(--up-maroon-dark);
        border-color: var(--up-maroon-dark);
        color: white;
      }
      .card-header.bg-maroon {
        background-color: var(--up-maroon) !important;
        color: white;
      }
    </style>

    @stack('styles')
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-maroon">
      <div class="container">
        <a class="navbar-brand" href="{{ route('menu-items.index') }}">
          <i class="fas fa-utensils"></i> Manang Betch Snack House
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('menu-items.index') }}">
                <i class="fas fa-list"></i> Menu
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('menu-items.create') }}">
                <i class="fas fa-plus"></i> Add Item
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('menu-items.trashed') }}">
                <i class="fas fa-trash"></i> Trash
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mt-3">
      @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
        ></button>
      </div>
      @endif @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
        ></button>
      </div>
      @endif
    </div>

    <!-- Main Content -->
    <main class="container my-4">@yield('content')</main>

    <!-- okay, so yield is like a placeholder telling Laravel "hey, when you render a view that extends this layout, put the content of the section named 'content' here". So when we create our index.blade.php, create.blade.php, etc., and we define a section like @section('content') ... @endsection, whatever is inside that section will be injected into this layout at the place where yield('content') is.-->

    <!-- Footer -->
    <footer class="bg-maroon text-white text-center py-3 mt-5">
      <p class="mb-0">
        &copy; {{ date('Y') }} Manang Betch Snack House Karenderya
      </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
  </body>
</html>