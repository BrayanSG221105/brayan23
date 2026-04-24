<div class="source-page">
    <div class="source-detail">
        <p class="source-page__eyebrow">{{ $sourceLabel ?? 'Detalle' }}</p>
        <h1 class="source-page__title">{{ $detalle['name'] ?? $detalle['title'] ?? 'Detalle' }}</h1>

        <div class="source-detail__content">
            @if (isset($detalle['code']))
                <p><strong>Código:</strong> {{ $detalle['code'] }}</p>
            @endif

            @if (isset($detalle['id']))
                <p><strong>ID:</strong> {{ $detalle['id'] }}</p>
            @endif

            @if (isset($detalle['userId']))
                <p><strong>User ID:</strong> {{ $detalle['userId'] }}</p>
            @endif

            @if (isset($detalle['body']))
                <p><strong>Contenido:</strong><br>{!! nl2br(e($detalle['body'])) !!}</p>
            @endif

            @if (isset($detalle['area_km2']))
                <p><strong>Área (km²):</strong> {{ number_format($detalle['area_km2'], 0, ',', '.') }}</p>
            @endif

            @if (isset($detalle['population']))
                <p><strong>Población:</strong> {{ number_format($detalle['population'], 0, ',', '.') }}</p>
            @endif

            @if (isset($detalle['countries']))
                <p><strong>Países:</strong> {{ $detalle['countries'] }}</p>
            @endif

            @if (isset($detalle['largest_country']))
                <p><strong>País más grande:</strong> {{ $detalle['largest_country'] ?? 'N/A' }}</p>
            @endif

            @if (isset($detalle['highest_point']))
                <p><strong>Punto más alto:</strong> {{ $detalle['highest_point'] }}</p>
            @endif
        </div>

        <a class="source-detail__back" href="{{ route(($sourceLabel ?? '') === 'MundoITI' ? 'mundoiti' : 'continentes') }}">Volver</a>
    </div>
</div>
