<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Productos</p>
            <h2 class="text-2xl font-semibold text-slate-900">Editar producto</h2>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-slate-50 via-white to-emerald-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <x-flash-message class="mb-6" />
                @include('products._form', ['action' => route('products.update', $product)])
            </div>
        </div>
    </div>
</x-app-layout>
