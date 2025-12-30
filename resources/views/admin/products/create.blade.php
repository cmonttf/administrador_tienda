@extends('layouts.admin')

@section('title', 'Nuevo Producto')
@section('page-title', 'Crear Producto')

@section('content')
<div class="max-w-2xl container">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium text-gray-900">Nuevo Producto</h3>
        <a href="{{ route('admin.products.index') }}"
           class="text-gray-600 hover:text-gray-900">
            ← Volver a lista
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow overflow-hidden sm:rounded-lg">
        @csrf

        <div class="px-6 py-6 border-b border-gray-200">
            <h4 class="text-lg font-medium text-gray-900 mb-6">Información Básica</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                    <div class="w-full px-3 py-2 border {{ $errors->has('nombre') ? 'border-red-500' : 'border-gray-300' }} rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    </div>
                </div>

                <!-- Precio -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Precio ($)*</label>
                    <input name="precio"
                        id="precio"
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        {{ old('precio') }}

                </div>
            </div>

            <!-- Descripción -->
            <div class="mt-6">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                <textarea name="descripcion"
                          id="descripcion"
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
        </div>

        <div class="px-6 py-6">
            <h4 class="text-lg font-medium text-gray-900 mb-6">Inventario e Imagen</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock Inicial</label>
                    <input type="number"
                           name="stock"
                           id="stock"
                           min="0"
                           value="{{ old('stock', 0) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Costo -->
                <div>
                    <label for="costo" class="block text-sm font-medium text-gray-700 mb-2">Costo ($)*</label>
                    <input type="number"
                            name="costo"
                            id="costo"
                            value="{{ old('costo', 0) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>
            </div>

            <!-- Imagen -->
            <div class="mt-6">
                <label for="imagen" class="block text-sm font-medium text-gray-700 mb-2">Imagen del Producto</label>
                <input type="file"
                       name="imagen"
                       id="imagen"
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-2 text-sm text-gray-500">PNG, JPG hasta 2MB</p>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.products.index') }}"
                   class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Crear Producto
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
