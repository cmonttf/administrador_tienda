@extends('layouts.admin')

@section('title', 'Producto')
@section('page-title', 'Producto')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Producto {{ $producto->nombre }}</h3>
                <a href="{{ route('admin.products.index') }}"
                class="text-gray-600 hover:text-gray-900">
                    ← Volver a lista
                </a>
            </div>
            <form action="{{ route('admin.products.update', ["id" => $id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container mt-12">
                    <h4 class="text-lg font-medium text-gray-900 mb-6">Información Básica</h4>

                    <div class="row mt-6">
                        <!-- SKU -->
                        <div class="col-md-4">
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                            <input class="form-control" type="text" name="sku" id="sku" value="{{ $producto->sku }}">
                        </div>

                        <!-- Nombre -->
                        <div class="col-md-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}">
                        </div>

                        <!-- Precio -->
                        <div class="col-md-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Precio ($)</label>
                            <input name="precio"
                                id="precio"
                                rows="4"
                                class="form-control"
                                value={{ $producto->precio }}
                            >
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="row mt-6">
                        <div class="col-md-12">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                            <textarea name="descripcion"
                                id="descripcion"
                                aria-label="With textarea"
                                rows="4"
                                class="form-control">{{ $producto->descripcion }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-6">Inventario e Imagen</h4>
                        <!-- Stock -->
                        <div class="col-md-6">
                            <label for="stock">Stock Inicial</label>
                            <input type="text"
                                    name="stock"
                                    id="stock"
                                    min="0"
                                    value="{{ $producto->stock }}"
                                    class="form-control">
                        </div>

                        <!-- Costo -->
                        <div class="col-md-6">
                            <label for="costo">Costo ($)*</label>
                            <input type="text"
                                    name="costo"
                                    id="costo"
                                    value="{{ $producto->costo }}"
                                    class="form-control">
                        </div>

                        <!-- Imagen -->
                        <div class="mt-6">
                            <label for="imagen" class="block text-sm font-medium text-gray-700 mb-2">Imagen del Producto</label>
                            <img class="form-control img-producto-preview" src="{{ asset("img/productos/{$id}/{$producto->imagen}") }}" alt="{{ $producto->nombre }}">
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
                                Grabar
                            </button>
                        </div>
                    </div>
                </div>

            </form>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Volver atrás
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
