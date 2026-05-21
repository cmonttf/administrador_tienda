<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Panel de Administración')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex min-vh-100">
        <!-- Sidebar fija DESKTOP / Offcanvas MÓVIL -->
        <div class="bg-white sidebar-desktop offcanvas-lg offcanvas-start shadow-lg" tabindex="-1" id="sidebarMenu">
            <div class="p-4 border-bottom bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-gear-fill me-2"></i>Admin Panel</h5>
            </div>
            <nav class="sidebar-nav p-2 mt-3">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door fs-5 me-3"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('admin.mantencion') ? 'active' : '' }}" href="{{ route('admin.mantencion') }}">
                    <i class="bi bi-people fs-5 me-3"></i>Usuarios
                </a>
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-box-seam fs-5 me-3"></i>Productos
                </a>
            </nav>
        </div>

        <!-- Botón hamburguesa MÓVIL -->
        <button class="btn btn-primary d-lg-none position-fixed start-0 top-0 m-3 z-3 shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" style="border-radius: 0 0.5rem 0.5rem 0;">
            <i class="bi bi-list fs-4"></i>
        </button>

        <!-- Contenido Principal -->
        <div class="flex-grow-1 main-content-desktop">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom px-3 py-2">
                <div class="container-fluid">
                    <h2 class="navbar-brand mb-0 h4 fw-bold text-primary">@yield('page-title', 'Dashboard')</h2>
                    <div class="navbar-nav ms-auto align-items-center">
                        <span class="nav-link px-3 text-muted">{{ auth()->user()->name ?? 'Admin' }}</span>
                        <form method="POST" action="{{ route('admin.mantencion') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </nav>

            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield("scipts")
</body>
</html>
