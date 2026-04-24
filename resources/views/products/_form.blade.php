@php($isEditing = isset($product) && $product->exists)

<form method="POST" action="{{ $action }}" class="space-y-6">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nombre</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $product->name ?? '') }}"
                class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                placeholder="Ej. Xbox Series X"
            >
            @error('name')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-slate-700">Precio</label>
            <input
                id="price"
                name="price"
                type="number"
                step="0.01"
                min="0"
                max="99999999.99"
                value="{{ old('price', $product->price ?? '') }}"
                class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                placeholder="0.00"
            >
            @error('price')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-slate-700">Categoría</label>
        <select
            id="category_id"
            name="category_id"
            class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
        >
            <option value="">Sin categoría</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-slate-700">Descripción corta</label>
        <textarea
            id="description"
            name="description"
            rows="4"
            class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            placeholder="Resumen breve del producto"
        >{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="descriptionLong" class="block text-sm font-medium text-slate-700">Descripción larga</label>
        <textarea
            id="descriptionLong"
            name="descriptionLong"
            rows="7"
            class="mt-2 block w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
            placeholder="Descripción detallada del producto"
        >{{ old('descriptionLong', $product->descriptionLong ?? '') }}</textarea>
        @error('descriptionLong')
            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap gap-3">
        <button type="submit" class="inline-flex items-center rounded-2xl bg-slate-950 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
            {{ $isEditing ? 'Actualizar producto' : 'Guardar producto' }}
        </button>

        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
            Cancelar
        </a>
    </div>
</form>
