<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ContinentApiController extends Controller
{
    private const CONTINENTS_URL = 'https://brayancontin.netlify.app/json/continentes.json';
    private const MUNDOITI_URL = 'https://holisss.mundoiti.com/';

    /**
     * Get all continents
     */
    public function continentesIndex()
    {
        return $this->jsonCollection(self::CONTINENTS_URL);
    }

    public function continentesShow($id)
    {
        return $this->jsonItem(self::CONTINENTS_URL, $id);
    }

    public function mundoitiIndex()
    {
        return $this->jsonCollection(self::MUNDOITI_URL);
    }

    public function mundoitiShow($id)
    {
        return $this->jsonItem(self::MUNDOITI_URL, $id);
    }

    private function jsonCollection(string $url)
    {
        try {
            $response = Http::timeout(15)->get($url);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'External source is not available'
                ], 502);
            }

            $continents = $this->normalizePayload($response->json());
            
            return response()->json([
                'success' => true,
                'data' => $continents
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    private function jsonItem(string $url, int|string $id)
    {
        try {
            $response = Http::timeout(15)->get($url);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'External source is not available'
                ], 502);
            }

            $continents = $this->normalizePayload($response->json());
            
            $continent = collect($continents)->firstWhere('code', $id)
                ?? collect($continents)->firstWhere('id', (int) $id)
                ?? collect($continents)->firstWhere('id', $id);
            
            if (!$continent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $continent
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching data: ' . $e->getMessage()
            ], 500);
        }
    }

    private function normalizePayload(mixed $payload): array
    {
        if (isset($payload['continents']) && is_array($payload['continents'])) {
            return $payload['continents'];
        }

        if (is_array($payload)) {
            return $payload;
        }

        return [];
    }
}
