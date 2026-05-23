<?php

namespace App\Interfaces;

interface DashboardInterface
{
    public static function obtenerProductosQueSeAcaban(): array;

    public static function obtenerTotalProducto(): int;
}
