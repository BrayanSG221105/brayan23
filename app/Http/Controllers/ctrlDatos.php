<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ctrlDatos extends Controller
{
    private const CONTINENTS_URL = 'https://brayancontin.netlify.app/json/continentes.json';
    private const MUNDOITI_URL = 'https://holisss.mundoiti.com/';

    public function AccesoDatos()
    {
        $pro = Product::all();
        return view('vistaDatos', compact('pro'));
    }




    public function continentes()
    {
        $proo = $this->fetchContinentData(self::CONTINENTS_URL);

        return view('continentes', [
            'proo' => $proo,
            'sourceLabel' => 'Continentes',
        ]);
    }



    public function continentesd($id)
    {
        $detalle = $this->findItem(self::CONTINENTS_URL, $id);

        if (!$detalle) {
            abort(404, 'Elemento no encontrado en la fuente externa.');
        }

        return view('continentesd', [
            'detalle' => $detalle,
            'sourceLabel' => 'Continentes',
        ]);
    }

    public function mundoiti()
    {
        $proo = $this->fetchContinentData(self::MUNDOITI_URL);

        return view('continentes', [
            'proo' => $proo,
            'sourceLabel' => 'MundoITI',
        ]);
    }

    public function mundoitid($id)
    {
        $detalle = $this->findItem(self::MUNDOITI_URL, $id);

        if (!$detalle) {
            abort(404, 'Elemento no encontrado en la fuente externa.');
        }

        return view('continentesd', [
            'detalle' => $detalle,
            'sourceLabel' => 'MundoITI',
        ]);
    }

    public function products()
    {
        $pro = Product::all();
        return view('products', compact('pro'));
    }

    private function fetchContinentData(string $url): array
    {
        $response = Http::timeout(15)->get($url);

        if (!$response->successful()) {
            abort(502, 'No se pudo consultar la fuente externa.');
        }

        $payload = $response->json();

        if (isset($payload['continents']) && is_array($payload['continents'])) {
            return $payload['continents'];
        }

        if (is_array($payload)) {
            return $payload;
        }

        return [];
    }

    private function findItem(string $url, int|string $id): ?array
    {
        $proo = $this->fetchContinentData($url);

        return collect($proo)->firstWhere('code', $id)
            ?? collect($proo)->firstWhere('id', (int) $id)
            ?? collect($proo)->firstWhere('id', $id);
    }


}