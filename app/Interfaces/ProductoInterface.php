<?php
namespace App\Interfaces;

use App\DAO\ProductoDAO;
use App\DTO\ActualizarProductoDTO;
use App\DTO\ProductoDTO;

/**
 * Interface ProductoInterface
 *
 * Define el contrato para las operaciones de acceso a datos relacionadas
 * con los productos dentro de la aplicación. Cualquier clase que implemente
 * esta interfaz (como ProductoDAO) deberá proveer una implementación concreta
 * del método declarado.
 *
 * @author Camilo Montt <cmonttf@gmail.com>
 * @package App\Interfaces
 */
interface ProductoInterface
{
    /**
     * Obtiene el listado completo de productos disponibles.
     *
     * Debe retornar un arreglo con los datos de los productos
     * incluyendo nombre, imagen, precio de venta y stock.
     *
     * @return array Lista de productos en formato de arreglo.
     */
    public static function obtenerListadoProductos(): array;

    /**
     * Guarda un nuevo producto en el sistema.
     *
     * Recibe un DTO con los datos del producto y persiste la información
     * en la base de datos. Una vez creado el registro, retorna el
     * identificador (ID) autoincremental generado.
     *
     * @param ProductoDTO $producto DTO con la información del producto a guardar.
     * @return int ID del producto recién insertado.
     */
    public static function guardarProductoNuevo(ProductoDTO $producto): int;

    /**
     * Obtiene la información de un producto a partir de su identificador.
     *
     * Este método debe ser implementado por la clase concreta encargada
     * de acceder a la fuente de datos y retornar los datos del producto.
     *
     * @param int $id Identificador único del producto.
     *
     * @return array Arreglo con los datos del producto obtenido.
     */
    public static function obtenerProductoPorId(int $id): array;

    /**
     * Verifica si existe un producto a partir de su identificador.
     *
     * Este método debe ser implementado por la clase concreta encargada
     * de consultar la fuente de datos y determinar la existencia del
     * producto asociado al ID proporcionado.
     *
     * @param int $id Identificador único del producto.
     *
     * @return bool Retorna true si el producto existe, false en caso contrario.
     */
    public static function existeProductiPorId(int $id): bool;

    /**
     * Elimina un producto a partir de su identificador.
     *
     * Este método debe ser implementado por la clase concreta encargada
     * de acceder a la fuente de datos y realizar la eliminación del
     * producto asociado al ID proporcionado.
     *
     * @param int $id Identificador único del producto.
     *
     * @return bool Retorna true si el producto fue eliminado correctamente,
     *              false en caso contrario.
     */
    public static function eliminarProductoPorId(int $id): bool;

    /**
     * Actualiza la información de un producto.
     *
     * @param ActualizarProductoDTO $dato DTO con los datos actualizados del producto.
     *
     * @return bool Retorna true si la actualización fue exitosa,
     *              false en caso contrario.
     */
    public static function actualizarProducto(ActualizarProductoDTO $dato): bool;
}
