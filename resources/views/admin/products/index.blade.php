@extends('layouts.admin')

@section('title', 'Productos')
@section('page-title', 'Gestión de Productos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-medium text-gray-900">Lista de Productos</h3>
    <a href="{{ route('admin.products.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        + Nuevo Producto
    </a>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                             class="h-12 w-12 object-cover rounded">
                    @else
                        <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                    <div class="text-sm text-gray-500">{{ Str::limit($product->description ?? '', 50) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    ${{ number_format($product->price ?? 0, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold
                        @if(($product->stock ?? 0) > 10) bg-green-100 text-green-800
                        @elseif(($product->stock ?? 0) > 0) bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif rounded-full">
                        {{ $product->stock ?? 0 }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold
                        {{ ($product->active ?? true) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}
                        rounded-full">
                        {{ ($product->active ?? true) ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="text-indigo-600 hover:text-indigo-900">Editar</a>
                    <a href="{{ route('admin.products.show', $product) }}"
                       class="text-indigo-600 hover:text-indigo-900">Ver</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-900"
                                onclick="return confirm('¿Eliminar este producto?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 py-12">
                    No hay productos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
