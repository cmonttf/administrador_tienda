<?php

namespace App\DAO;

use App\Interfaces\DashboardInterface;
use Illuminate\Support\Facades\DB;

class DashboardDAO implements DashboardInterface
{
    public static function obtenerProductosQueSeAcaban(): array
    {
        return DB::table("productos")
            ->select(
                "nombre",
                "sku",
                "stock"
            )
            ->where("stock", "<=", 10)
            ->get()
            ->toArray();
    }

    public static function obtenerTotalProducto(): int
    {
        return DB::table("productos")->count("*");
    }
}
