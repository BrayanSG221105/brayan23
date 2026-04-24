@if (session('success') || session('error'))
    <div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm']) }}>
        @if (session('success'))
            <p class="text-sm font-medium text-emerald-700">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="text-sm font-medium text-rose-700">{{ session('error') }}</p>
        @endif
    </div>
@endif
