<?php
namespace App\DAO;

use App\DTO\ProductoDTO;
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
                "id",
                "nombre",
                "imagen",
                "precio_venta as precioVenta",
                "stock"
            )
            ->get()
            ->toArray();
    }

    /**
     * Guarda un nuevo producto en la base de datos.
     *
     * Inserta un registro en la tabla `productos` utilizando la información
     * contenida en el DTO ProductoDTO y retorna el ID autoincremental
     * generado por la base de datos.
     *
     * @param ProductoDTO $producto DTO con los datos del producto a registrar.
     * @return int ID del producto recién insertado.
     */
    public static function guardarProductoNuevo(ProductoDTO $producto): int
    {
        return DB::table("productos")
            ->insertGetId([
                "nombre" => $producto->nombre,
                "precio_venta" => $producto->precio,
                "descripcion" => $producto->descripcion,
                "stock" => $producto->stock,
                "precio_costo" => $producto->costo,
                "imagen" => $producto->imagen
            ]);
    }
}
