<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Módulo</p>
                <h2 class="text-2xl font-semibold text-slate-900">Productos</h2>
            </div>

            <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-red-500">
                Nuevo producto
            </a>
        </div>
    </x-slot>

    <div class="bg-white py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <x-flash-message />

            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <form method="GET" action="{{ route('products.index') }}" class="grid gap-4 lg:grid-cols-[1fr_16rem_auto]">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                        <input
                            id="search"
                            name="search"
                            type="search"
                            value="{{ request('search') }}"
                            class="mt-2 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm outline-none transition focus:border-red-500 focus:ring-4 focus:ring-red-100"
                            placeholder="Nombre, descripción o texto largo"
                        >
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <select
                            id="category_id"
                            name="category_id"
                            class="mt-2 block w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm outline-none transition focus:border-red-500 focus:ring-4 focus:ring-red-100"
                        >
                            <option value="">Todas</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-3">
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-black">
                            Filtrar
                        </button>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-900">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">Producto</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">Categoría</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">Precio</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.2em] text-gray-500">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $product->name }}</div>
                                        <p class="mt-1 line-clamp-2 text-sm text-gray-500">{{ $product->description ?: 'Sin descripción corta' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            {{ $product->category?->name ?? 'Sin categoría' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                        ${{ number_format((float) $product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm">
                                        <div class="inline-flex flex-wrap justify-end gap-2">
                                            <a href="{{ route('products.show', $product) }}" class="rounded-2xl border border-gray-300 bg-white px-4 py-2 font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-900">
                                                Ver
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" class="rounded-2xl border border-gray-300 bg-white px-4 py-2 font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-900">
                                                Editar
                                            </a>
                                            <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('¿Eliminar este producto?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-2xl border border-red-200 bg-white px-4 py-2 font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        No hay productos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $products->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
