<?php
namespace App\DAO;

use App\DTO\ActualizarProductoDTO;
use App\DTO\ProductoDTO;
use App\Helpers\ConstantesHelper;
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

    /**
     * Obtiene la información de un producto a partir de su identificador.
     *
     * Este método consulta la tabla `productos` y recupera los campos necesarios
     * para representar un producto, aplicando alias para mantener consistencia
     * con la capa de dominio.
     *
     * @param int $id Identificador único del producto.
     *
     * @return array Arreglo de resultados que contiene los datos del producto.
     */
    public static function obtenerProductoPorId(int $id): array
    {
        return DB::table("productos")
            ->select(
                "nombre as nombre",
                "precio_venta as precioVenta",
                "descripcion as descripcion",
                "stock as stock",
                "precio_costo as precioCosto",
                "imagen as imagen"
            )
            ->where("id", "=", $id)
            ->get()
            ->toArray();
    }

    /**
     * Verifica la existencia de un producto a partir de su identificador.
     *
     * Este método consulta la tabla `productos` para determinar si existe
     * un registro asociado al ID proporcionado, sin necesidad de obtener
     * los datos completos del producto.
     *
     * @param int $id Identificador único del producto.
     *
     * @return bool Retorna true si el producto existe, false en caso contrario.
     */
    public static function existeProductiPorId(int $id): bool
    {
        return DB::table("productos")
            ->where("id", "=", $id)
            ->exists();
    }

    /**
     * Elimina un producto a partir de su identificador.
     *
     * Este método intenta eliminar el registro asociado al ID proporcionado
     * en la tabla `productos`. Retorna true si al menos un registro fue
     * eliminado, o false si no se eliminó ningún producto.
     *
     * @param int $id Identificador único del producto.
     *
     * @return bool Retorna true si el producto fue eliminado correctamente,
     *              false en caso contrario.
     */
    public static function eliminarProductoPorId(int $id): bool
    {
        return DB::table("productos")
            ->where("id", "=", $id)
            ->delete() > ConstantesHelper::CERO;
    }

    /**
     * Actualiza la información de un producto en la base de datos.
     *
     * Busca el producto mediante su ID y actualiza sus datos
     * utilizando la información contenida en el DTO.
     *
     * @param ActualizarProductoDTO $dato DTO con los nuevos datos del producto.
     *
     * @return bool Retorna true si al menos un registro fue actualizado,
     *              false en caso contrario.
     */
    public static function actualizarProducto(ActualizarProductoDTO $dato): bool
    {
        return DB::table("productos")
            ->where("id", "=", $dato->id)
            ->update([
                "nombre" => $dato->nombre,
                "precio_venta" => $dato->precio,
                "descripcion" => $dato->descripcion,
                "stock" => $dato->stock,
                "precio_costo" => $dato->costo
            ]) > 0;
    }
}
