<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Exception;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService)
    {}

    public function index(): string
    {
        try {
            $resultados = $this->dashboardService->obtenerDatosDashboard();
        } catch (Exception $error) {
            return view("admin.error", ["error" => $error])->render();
        }

        return view("admin.dashboard", [
            "resultado" => $resultados
        ])->render();
    }
}
