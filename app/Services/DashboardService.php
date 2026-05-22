<?php

namespace App\Services;

use App\Interfaces\DashboardInterface;

class DashboardService
{
    public function __construct(private DashboardInterface $dashboardInterface)
    {}

    public function obtenerDatosDashboard()
    {
        
    }
}
