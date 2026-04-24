<div class="source-page">
    <div class="source-page__header">
        <p class="source-page__eyebrow">{{ $sourceLabel ?? 'Datos' }}</p>
        <h1 class="source-page__title">Listado disponible</h1>
        <p class="source-page__subtitle">Contenido consumido desde la ruta pública correspondiente.</p>
    </div>

    <div class="source-grid">
        @foreach ($proo as $p)
            <article class="source-card">
                <h3>{{ $p['name'] ?? $p['title'] ?? 'Sin titulo' }}</h3>
                <p>{{ $p['body'] ?? $p['description'] ?? 'Sin descripción disponible.' }}</p>
                <a href="{{ route(($sourceLabel ?? '') === 'MundoITI' ? 'mundoiti.d' : 'continentes.d', $p['code'] ?? $p['id']) }}">Ver detalles</a>
            </article>
        @endforeach
    </div>
</div>