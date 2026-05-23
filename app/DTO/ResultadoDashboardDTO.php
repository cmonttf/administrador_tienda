<?php

namespace App\DTO;

use App\Collections\ProductoCantidadCollection;

class ResultadoDashboardDTO
{
    public function __construct(
        public ProductoCantidadCollection $totalStock,
        public int $cantidadProductos
    )
    {}
}
