@php($isEditing = isset($category) && $category->exists)

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div>
        <label for="name" class="block text-sm font-medium text-slate-700">Nombre</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $category->name ?? '') }}"
            class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            placeholder="Ej. Tecnología"
        >
        @error('name')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-slate-700">Descripción</label>
        <textarea
            id="description"
            name="description"
            rows="5"
            class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            placeholder="Describe brevemente la categoría"
        >{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap gap-3">
        <button type="submit" class="inline-flex items-center rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
            {{ $isEditing ? 'Actualizar categoría' : 'Guardar categoría' }}
        </button>

        <a href="{{ route('categories.index') }}" class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
            Cancelar
        </a>
    </div>
</form>
