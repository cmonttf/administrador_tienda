<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Exception;

class DashboardApiController extends Controller
{
    public function __construct(
        private DashboardService $dashboardService
    ) {}

    public function index()
    {
        try {

            $resultados = $this->dashboardService->obtenerDatosDashboard();

            return response()->json([
                'productos_stock_bajo' => $resultados->totalStock,
                'total_productos' => $resultados->cantidadProductos
            ]);

        } catch (Exception $error) {

            return response()->json([
                'error' => $error->getMessage()
            ], 500);

        }
    }
}
