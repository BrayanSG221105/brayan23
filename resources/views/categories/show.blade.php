<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Categorías</p>
                <h2 class="text-2xl font-semibold text-slate-900">{{ $category->name }}</h2>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-400">
                    Editar
                </a>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-slate-50 via-white to-emerald-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <x-flash-message class="mb-6" />

            <div class="grid gap-6 lg:grid-cols-[2fr_1fr]">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">Descripción</h3>
                    <p class="mt-4 leading-7 text-slate-600">
                        {{ $category->description ?: 'Sin descripción' }}
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Productos</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $category->products_count }}</p>
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Estado</p>
                            <p class="mt-2 inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Activa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
