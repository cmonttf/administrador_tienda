<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Panel de Administración')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Menú Lateral -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
            </div>
            <nav class="mt-6 px-4">
                <a href="{{ url("/") }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ url("/") }}" class="flex items-center p-3 mt-2 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Usuarios
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center p-3 mt-2 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Productos
                </a>
            </nav>
        </aside>

        <!-- Contenido Principal -->
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm border-b px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Bienvenido, {{ auth()->user()->name ?? 'Admin' }}</span>
                        <form method="POST" action="{{ url("/") }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
