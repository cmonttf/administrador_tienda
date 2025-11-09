<?php
namespace App\DAO;

use App\Interfaces\ProductoInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductoDAO
 *
 * Clase responsable del acceso a datos relacionados con los productos.
 * Implementa la interfaz ProductoInterface y utiliza el Query Builder de Laravel
 * para interactuar con la tabla "productos".
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\DAO
 */
class ProductoDAO implements ProductoInterface
{
    /**
     * Obtiene un listado de productos con información básica.
     *
     * Recupera desde la base de datos los productos existentes, incluyendo su nombre,
     * imagen, precio de venta y stock actual.
     *
     * @return array Lista de productos en formato de arreglo de objetos stdClass.
     */
    public static function obtenerListadoProductos(): array
    {
        return DB::table("productos")
            ->select(
                "nombre",
                "imagen",
                "precio_venta as precioVenta",
                "stock"
            )
            ->get()
            ->toArray();
    }
}
