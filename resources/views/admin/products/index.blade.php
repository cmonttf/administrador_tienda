@extends('layouts.admin')

@section('title', 'Productos')
@section('page-title', 'Gestión de Productos')

@section('content')
<div class="container mt-4">

    @if (session("alert"))
        <div class="alert alert-success">
            {{ session("alert") }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lista de Productos</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                + Nuevo Producto
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td style="width: 80px">
                            @if($product->imagen)
                                <img
                                    src="{{ asset("img/productos/{$product->id}/{$product->imagen}") }}"
                                    alt="{{ $product->nombre }}"
                                    class="img-thumbnail"
                                    style="width: 48px; height: 48px; object-fit: cover;"
                                >
                            @else
                                <div class="bg-secondary-subtle d-flex align-items-center justify-content-center rounded"
                                     style="width: 48px; height: 48px;">
                                    <i class="bi bi-image text-secondary"></i>
                                </div>
                            @endif
                        </td>

                        <td>
                            <strong>{{ $product->nombre }}</strong>
                        </td>

                        <td>
                            ${{ number_format($product->precioVenta ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($product->stock > 10)
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                            @else
                                <span class="badge bg-danger">{{ $product->stock }}</span>
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.products.show', $product->id) }}"
                               class="btn btn-sm btn-outline-secondary">
                                Ver
                            </a>

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                Editar
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Eliminar este producto?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No hay productos registrados.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
