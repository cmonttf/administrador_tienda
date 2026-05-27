<?php

namespace App\Services;

use App\Collections\ProductoCantidadCollection;
use App\DTO\ProductoCantidadDTO;
use App\DTO\ResultadoDashboardDTO;
use App\Interfaces\DashboardInterface;

class DashboardService
{
    public function __construct(private DashboardInterface $dashboardInterface)
    {}

    public function obtenerDatosDashboard(): ResultadoDashboardDTO
    {
        $totalStockAcabando = new ProductoCantidadCollection(
            array_map(
                fn($dato) => ProductoCantidadDTO::fromObject($dato),
                $this->dashboardInterface::obtenerProductosQueSeAcaban()
            )
        );

        $totalProductos = $this->dashboardInterface::obtenerTotalProducto();

        return new ResultadoDashboardDTO(
            totalStock: $totalStockAcabando,
            cantidadProductos: $totalProductos
        );
    }
}
