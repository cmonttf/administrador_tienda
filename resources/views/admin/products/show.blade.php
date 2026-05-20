@extends('layouts.admin')

@section('title', 'Producto')
@section('page-title', 'Producto')

@section('content')
<div class="max-w-2xl container">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium text-gray-900">Producto {{ $producto->nombre }}</h3>
        <a href="{{ route('admin.products.index') }}"
           class="text-gray-600 hover:text-gray-900">
            ← Volver a lista
        </a>
    </div>

    <div class="px-6 py-6 border-b border-gray-200">
        <h4 class="text-lg font-medium text-gray-900 mb-6">Información Básica</h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" readonly>
            </div>

            <!-- Precio -->
            <div>
                <label for="price" class="form-label">Precio ($)</label>
                <input name="precio"
                    id="precio"
                    rows="4"
                    class="form-control"
                    value={{ $producto->precio }}
                    readonly
                >
            </div>
        </div>

        <!-- Descripción -->
        <div class="mt-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" readonly>
                {{ $producto->descripcion }}
            </textarea>
        </div>
    </div>

    <div class="px-6 py-6">
        <h4 class="text-lg font-medium text-gray-900 mb-6">Inventario e Imagen</h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <class class="mb-6">
                <!-- Stock -->
                <label for="stock" class="form-label">Stock Inicial</label>
                <div class="input-group mb-3">
                    <input type="text"
                            name="stock"
                            id="stock"
                            value="{{ $producto->stock }}"
                            readonly
                            class="form-control">
                </div>
            </class>

            <div class="mb-6">
                <!-- Costo -->
                <label for="costo" class="form-label">Costo ($)*</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text"
                            name="costo"
                            id="costo"
                            value="{{ $producto->costo }}"
                            readonly
                            class="form-control">
                </div>
            </div>
        </div>

        <!-- Imagen -->
<div class="mb-6">
    <label for="imagen" class="form-label">Imagen del Producto</label>
    <img class="form-control img-producto-preview"
         src="{{ asset("img/productos/{$id}/{$producto->imagen}") }}"
         alt="{{ $producto->nombre }}">
</div>
    </div>

    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.products.index') }}"
                class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Volver atrás
            </a>
        </div>
    </div>
</div>
@endsection
